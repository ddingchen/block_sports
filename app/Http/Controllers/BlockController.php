<?php

namespace App\Http\Controllers;

use App\ResidentialArea;

class BlockController extends Controller
{
    public function blockNameOfArea($areaId)
    {
        $area = ResidentialArea::findOrFail($areaId);
        return $area->block ? $area->block->name : '';
    }
}
