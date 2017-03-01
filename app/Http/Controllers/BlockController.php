<?php

namespace App\Http\Controllers;

use App\ResidentialArea;

class BlockController extends Controller
{
    public function blockNameOfArea($areaId)
    {
        $area = ResidentialArea::find($areaId);
        return $area && $area->block ? $area->block->name : '';
    }
}
