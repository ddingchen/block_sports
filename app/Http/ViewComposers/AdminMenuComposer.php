<?php

namespace App\Http\ViewComposers;

use App\Match;
use Illuminate\View\View;

class AdminMenuComposer
{

    public function compose(View $view)
    {
        $matches = Match::all();
        $view->with('menuMatches', $matches);
    }
}
