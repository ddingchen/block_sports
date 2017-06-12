<?php

namespace App\Http\ViewComposers;

use App\Match;
use App\Wm\Group;
use Illuminate\View\View;

class AdminMenuComposer
{

    public function compose(View $view)
    {
        $matches = Match::all();
        $groups = Group::all();
        $view->with([
            'menuMatches' => $matches,
            'menuGroups' => $groups,
        ]);
    }
}
