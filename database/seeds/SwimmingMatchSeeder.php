<?php

use App\Wm\Group;
use App\Wm\RegisterTeam;
use App\Wm\Ticket;
use Illuminate\Database\Seeder;

class SwimmingMatchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $groups = collect([
            Group::create(['name' => '50米自由泳', 'price' => 20]),
            Group::create(['name' => '100米自由泳', 'price' => 20]),
            Group::create(['name' => '50米蛙泳', 'price' => 20]),
            Group::create(['name' => '100米蛙泳', 'price' => 20]),
            Group::create(['name' => '800米自由泳', 'price' => 20]),
            Group::create(['name' => '4X50米混合接力', 'price' => 80, 'team_required' => true]),
        ]);
        $groups->each(function ($group) {
            $this->createTicketForGroup($group);
            $this->createTicketForGroup($group);
        });
    }

    private function createTicketForGroup($group)
    {
        if ($group->team_required) {
            $registion = RegisterTeam::create();
            $registion->registions()->saveMany(factory('App\Wm\Registion', 4)->create());
        } else {
            $registion = factory('App\Wm\Registion')->create();
        }
        $ticket = new Ticket;
        $ticket->group()->associate($group);
        $ticket->owner()->associate(factory('App\User')->create());
        $ticket->registion()->associate($registion);
        $ticket->save();
        return $ticket;
    }
}
