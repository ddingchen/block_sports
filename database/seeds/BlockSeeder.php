<?php

use App\Block;
use App\ResidentialArea;
use Illuminate\Database\Seeder;

class BlockSeeder extends Seeder
{
    protected $data = [
        '新惠路社居委' => [
            '新民村',
            '腐乳浜',
            '九曲基',
            '新惠一村',
            '造船二村',
            '惠山雅苑',
        ],
        '兴隆桥社居委' => [
            '香榭花园一期',
            '香榭花园二期',
            '香榭一品',
            '五里新村',
            '兴东小区',
            '枫棚间',
        ],
        '棉花巷' => [
            '棉花巷小区',
            '西康路小区',
            '人民西路小区',
            '邮电新村',
            '锡惠弄',
            '李巷',
            '郑巷',
            '西横街小区',
            '西直街小区',
            '西河沿路小区',
        ],
        '五里新村社居委' => [
            '五里新村',
        ],
        '金马国际社居委' => [
            '金马国际花园小区',
            '后龙船浜小区',
        ],
        '盛岸一村社居委' => [
            '西苑新村',
            '盛岸一村',
            '湖光新村',
        ],
        '盛岸二村社居委' => [
            '盛岸二村',
            '惠盛路小区',
        ],
        '惠泉山社居委' => [
            '君和佳园',
            '惠钱路一弄',
            '惠钱路二弄',
            '听松坊',
            '惠麓东苑',
        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Block::truncate();
        ResidentialArea::truncate();

        $blockIncreament = 1;
        $areaIncreament = 1;
        collect($this->data)->each(function ($areas, $blockName) use (&$blockIncreament, &$areaIncreament) {
            $block = Block::create([
                'id' => $blockIncreament++,
                'name' => $blockName,
            ]);

            collect($areas)->each(function ($areaName) use (&$areaIncreament, $block) {
                $area = new ResidentialArea([
                    'id' => $areaIncreament++,
                    'name' => $areaName,
                    'py' => getPyHeadersOfZhWord($areaName),
                ]);
                $area->block()->associate($block);
                $area->save();
            });
        });

        ResidentialArea::create([
            'id' => $areaIncreament++,
            'name' => '其他',
            'py' => 'ZZZZZZ',
        ]);
    }
}
