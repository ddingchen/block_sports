<?php

namespace App\Http\Controllers\Admin;

use App\Block;
use App\Http\Controllers\Controller;
use App\Match;
use App\Street;
use Illuminate\Http\Request;

class MatchController extends Controller
{
    public function index()
    {
        $matches = Match::all();
        return view('admin.match.index', compact('matches'));
    }

    public function create()
    {
        $streets = Street::all();
        return view('admin.match.create', compact('streets'));
    }

    public function store(Request $request)
    {
        Match::create([
            'street_id' => $request->input('street'),
        ]);

        return redirect('admin/match');
    }

    public function registerQrcodeForm()
    {
        $matches = Match::all();
        $blocks = $matches->first()->street->blocks;
        return view('admin.match.qrcode', compact('matches', 'blocks'));
    }

    public function generateRegisterQrcode(Request $request)
    {
        $match = Match::findOrFail($request->input('match'));
        $block = Block::findOrFail($request->input('block'));

        $qrcode = app('wechat')->qrcode;
        $result = $qrcode->forever("reg_{$match->id}_{$block->id}");
        $ticket = $result->ticket;
        return $qrcode->url($ticket);
    }
}
