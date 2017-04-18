<?php

namespace App\Console\Commands;

use App\Block;
use App\Match;
use App\MatchGroup;
use App\Sport;
use App\Street;
use DB;
use Illuminate\Console\Command;

class GenerateHSStreetInfo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'data:update_data_model_for_street';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '将数据结构更新为多街道模式，升级之前的惠山街道的数据结构';

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
        // sport
        Sport::whereIn('name', ['广场舞', '篮球3v3'])->update(['is_group' => true]);
        // street
        $street = Street::create(['name' => '惠山街道']);
        Block::whereNotNull('id')->update(['street_id' => $street->id]);
        // match
        $match = Match::create([
            'street_id' => $street->id,
        ]);
        $match->sports()->attach(Sport::all()->pluck('id'));
        // group
        $group = MatchGroup::create([
            'name' => '惠山街道街区运动会',
            'title' => '街区运动会-惠山街道站',
            'sub_title' => '现已开启招募',
            'top' => true,
        ]);
        $match->group()->associate($group);
        $match->save();
        // ticket
        DB::table('tickets')->update(['match_id' => $match->id]);
    }
}
