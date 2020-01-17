<?php

namespace App\Http\Controllers\Admin;

use App\Model\ColisType;
use App\Model\Unit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ColisTypeController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $colisTypeList = ColisType::all();
        return view('admin.type.list', compact('colisTypeList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $unitList = Unit::all()->where('status', 'Active');
        return view('admin.type.add', compact('unitList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        $request->validate([
            'name' => 'required|max:50',
            'unit_id' => 'required',
            'price' => 'required|numeric'
        ]);

        $data = $request->all();

        if ($request->get('status')) {
            $data['status'] = "Active";
        } else {
            $data += ["status" => "Inactive"];
        }

        ColisType::create($data);

        return back()->withSuccess("Type created successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\ColisType  $colisType
     * @return \Illuminate\Http\Response
     */
    public function show(ColisType $colisType) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\ColisType  $colisType
     * @return \Illuminate\Http\Response
     */
    public function edit(ColisType $type) {

        $unitList = Unit::all();
        return view('admin.type.edit', compact('type', 'unitList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\ColisType  $colisType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ColisType $type) {

        if ($request->get('status')) {
            $status = "Active";
        } else {
            $status = "Inactive";
        }
        
        $type->price = $request->price;
        $type->status = $status;
        $type->save();
        
        return back()->withSuccess('Type updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\ColisType  $colisType
     * @return \Illuminate\Http\Response
     */
    public function destroy(ColisType $colisType) {
        //
    }

}
