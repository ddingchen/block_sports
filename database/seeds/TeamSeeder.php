<?php

use App\Team;
use App\User;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::first();
        $group = new Team(['name' => '精英队']);
        $group->leader()->associate($user);
        $group->save();

        $group->members()->attach($user);
    }
}
