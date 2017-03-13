<?php

namespace App\Http\Controllers\Admin;

use App\Block;
use App\Http\Controllers\Controller;
use App\ResidentialArea;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->has('block')) {
            $block = Block::findOrFail($request->input('block'));
            $areas = $block->residentialAreas;
        } else {
            $block = null;
            $areas = ResidentialArea::all();
        }
        return view('admin.area.index', compact('areas', 'block'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $defaultBlock = $request->input('block') ?: null;
        $blocks = Block::all();
        return view('admin.area.create', compact('blocks', 'defaultBlock'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            // 'block' => 'exists:blocks,id',
        ]);

        $area = new ResidentialArea;
        $area->id = ResidentialArea::all()->max('id') + 1;
        $area->name = $request->input('name');
        $area->py = getPyHeadersOfZhWord($request->input('name'));
        $area->block_id = $request->input('block') ?: null;
        $area->save();

        return redirect('admin/area');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ResidentialArea $area)
    {
        $blocks = Block::all();
        return view('admin.area.edit', compact('area', 'blocks'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ResidentialArea $area)
    {
        $this->validate($request, [
            'name' => 'required',
            // 'block' => 'exists:blocks,id',
        ]);

        $area->name = $request->input('name');
        $area->py = getPyHeadersOfZhWord($request->input('name'));
        $area->block_id = $request->input('block') ?: null;
        $area->save();
        return redirect('admin/area');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
