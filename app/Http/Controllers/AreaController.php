<?php

namespace App\Http\Controllers;

use App\Street;

class AreaController extends Controller
{
    public function indexByStreet(Street $street)
    {
        return $street->areas->sortBy('py')->values();
    }
}
