<?php

use App\Sport;
use Illuminate\Database\Seeder;

class SportSeeder extends Seeder
{
    protected $data = [
        '跳绳',
        '踢毽子',
        '广场舞',
        '平板支撑',
        '掼蛋',
        '麻将',
        '五子棋',
        '羽毛球',
        '乒乓球',
        '足球5v5',
        '篮球3v3',
        '太极',
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Sport::truncate();

        $increament = 1;
        collect($this->data)->each(function ($sportName) use (&$increament) {
            Sport::create(['id' => $increament++, 'name' => $sportName]);
        });
    }
}
