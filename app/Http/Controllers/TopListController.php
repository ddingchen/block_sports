<?php

namespace App\Http\Controllers;

use App\Sport;

class TopListController extends Controller
{
    public function index(Sport $sport)
    {
        $sports = Sport::all()->filter(function ($sport) {
            return $sport->matchResults->contains(function ($result) {
                return $result->score !== null;
            });
        });

        $results = $sport->matchResults->filter(function ($result) use ($topLists) {
            return $result->score !== null;
        });

        $list = $results->map(function ($result, $index) {
            return [
                'rank' => $index,
                'name' => $result->ticket->owner->name,
                'score' => $result->score,
            ];
        });
        return view('top-list.index', compact('sports', 'sport', 'list'));
    }

    public function indexOfAll()
    {
        $topLists = collect();
        Sport::all()->each(function ($sport) use ($topLists) {
            $results = $sport->matchResults->filter(function ($result) use ($topLists) {
                return $result->score !== null;
            })->sortByDesc('score')->values();
            if (!$results->isEmpty()) {
                $prevScore = $results->first()->score;
                $prevRank = 1;
                $prev = [
                    'rank' => 1,
                    'score' => $results->first()->score,
                ];
                $topLists->push([
                    'sport' => [
                        'id' => $sport->id,
                        'name' => $sport->name,
                    ],
                    'list' => $results->map(function ($result, $index) use (&$prev) {
                        $rank = $index + 1;
                        if ($prev['score'] == $result->score) {
                            $rank = $prev['rank'];
                        }
                        $prev = [
                            'rank' => $rank,
                            'score' => $result->score,
                        ];
                        return [
                            'rank' => $rank,
                            'name' => $result->ticket->owner->name,
                            'score' => $result->score,
                        ];
                    }),
                ]);
            }
        });

        return view('top-list.index', compact('topLists'));
    }
}
