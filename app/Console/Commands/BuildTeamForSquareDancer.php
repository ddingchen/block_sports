<?php

namespace App\Console\Commands;

use App\Match;
use App\Team;
use App\Ticket;
use App\User;
use DB;
use Illuminate\Console\Command;

class BuildTeamForSquareDancer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'data:build_team_for_square_dancer';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '转换广场舞的个人报名变成团队报名';

    protected $match;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $this->match = Match::where('title', 'like', '%广场舞%')->first();
        $this->newTicket(146, '马莉娜', '百灵时装队');
        $this->newTicket(292, '于莲文', '惠泉山快乐舞队');
        $this->newTicket(290, '郑秀英', '赛夕阳舞蹈队');
        $this->newTicket(167, '金增萍', '金韵舞蹈队');
        $this->newTicket(289, '邵铁', '朗诗民星艺术团');
        $this->newTicket(187, '王昊芳', '国标舞队');
        $this->newTicket(200, '李彩英', '童心艺术团');
        $this->newTicket(291, '张素贞', '君和缘健身队');
        $this->newTicket(191, '孙国兰', '天天乐舞蹈队');
        $this->newTicket(189, '马龙珍', '俏江南艺术团');
        $this->newTicket(190, '尤静亚', '蓉弈艺术团');

        $this->deleteSingleDancer(157);
        $this->deleteSingleDancer(230);
        $this->deleteSingleDancer(239);
        $this->deleteSingleDancer(245);
        $this->deleteSingleDancer(284);

    }

    private function deleteSingleDancer($userId)
    {
        DB::table('tickets')->where('owner_id', $userId)
            ->where('owner_type', 'App\User')
            ->where('match_id', $this->match->id)->delete();
    }

    private function newTicket($userId, $name, $teamName)
    {
        $user = User::find($userId);
        $user->name = $name;
        $user->save();
        $team = new Team(['name' => $teamName]);
        $team->leader()->associate($user);
        $team->save();
        $team->members()->attach($user);

        DB::table('tickets')->where('owner_id', $userId)
            ->where('owner_type', 'App\User')
            ->where('match_id', $this->match->id)->delete();

        $ticket = new Ticket();
        $ticket->match()->associate($this->match);
        $ticket->owner()->associate($team);
        $ticket->save();
    }
}
