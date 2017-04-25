<?php

namespace App\Http\Controllers;

use App\Sport;

class TopListController extends Controller
{
    public function index(Sport $sport)
    {
        $js = app('wechat')->js;

        $sports = Sport::all()->filter(function ($sport) {
            return $sport->matchResults->contains(function ($result) {
                return $result->score !== null;
            });
        });

        $results = $sport->matchResults->filter(function ($result) {
            return $result->score !== null;
        });

        $list = $results->isEmpty() ? collect() : $this->sortResults($results);

        return view('top-list.index', compact('sports', 'sport', 'list', 'js'));
    }

    public function fetchFirstTopList()
    {
        $sports = Sport::all()->filter(function ($sport) {
            return $sport->matchResults->contains(function ($result) {
                return $result->score !== null;
            });
        });

        if ($sports->isEmpty()) {
            return view("top-list.not_found");
        }
        return redirect("sport/{$sports->first()->id}/top-list");
    }

    private function sortResults($results)
    {
        $results = $results->sortByDesc('score')->values();
        if ($results->isEmpty()) {
            return collect();
        }

        $prev = [
            'rank' => 1,
            'score' => $results->first()->score,
        ];
        return $results->map(function ($result, $index) use (&$prev) {
            $rank = $prev['score'] == $result->score ? $prev['rank'] : $index + 1;
            $prev = [
                'rank' => $rank,
                'score' => $result->score,
            ];
            return [
                'rank' => $rank,
                'name' => $result->ticket->owner->name,
                'score' => $result->score,
                'readable_score' => $result->readable_score,
            ];
        });
    }
}
