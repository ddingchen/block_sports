<?php

namespace App\Console\Commands;

use App\Match;
use App\Result;
use App\Sport;
use App\Ticket;
use App\User;
use DB;
use Illuminate\Console\Command;

class SimplifyMatchStruct extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'data:simplify_match_struct';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '简化比赛结构（去除街道、比赛组）';

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
        // 将之前的比赛中的项目转换为单独的比赛
        $oldMatchSports = DB::table('match_sports')->select()->get();
        DB::table('matches')->truncate();
        $oldMatchSports->each(function ($oldMatchSport) {
            $sport = Sport::find($oldMatchSport->sport_id);
            $match = new Match(['title' => "惠山街道{$sport->name}比赛"]);
            $match->sport()->associate($sport);
            $match->save();
        });
        // 报名信息和成绩信息对应至新的比赛信息
        $oldTickets = DB::table('tickets')
            ->join('ticket_sports', 'tickets.id', '=', 'ticket_sports.ticket_id')
            ->select('tickets.owner_id', 'tickets.note', 'ticket_sports.sport_id', 'ticket_sports.score', 'ticket_sports.team_name', 'tickets.created_at')
            ->get();
        DB::table('tickets')->truncate();
        $oldTickets->each(function ($oldTicket) {
            $match = Match::where('sport_id', $oldTicket->sport_id)->firstOrFail();
            // 报名信息
            $ticket = new Ticket(['note' => $oldTicket->note]);
            $ticket->match()->associate($match);
            $ticket->owner()->associate(User::findOrFail($oldTicket->owner_id));
            $ticket->created_at = $oldTicket->created_at;
            $ticket->updated_at = $oldTicket->created_at;
            $ticket->save();
            // 成绩信息
            if ($oldTicket->score) {
                $result = new Result(['score' => $oldTicket->score]);
                $result->match()->associate($match);
                $result->owner()->associate(User::findOrFail($oldTicket->owner_id));
                $result->save();
            }
        });

    }
}
