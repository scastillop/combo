<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Family;
use Validator;
use Session;
use Redirect;

class FamilyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $families = Family::all();
        return view('families/index', ['families' => $families]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('families.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|unique:families',
        ]);

        if ($validator->fails()) {
            return redirect('families/create')
                        ->withErrors($validator)
                        ->withInput();
        }
        // store
        $family              = new Family;
        $family->name        = $request['name'];
        $family->description = $request['description'];
        $family->save();
        // redirect
        Session::flash('success', 'Familia creada correctamente');
        return Redirect::to('families');
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
    public function edit($id)
    {
        $family = Family::find($id);
        return view('families/edit', ['family' => $family, 'id' => $id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|unique:families',
        ]);

        if ($validator->fails()) {
            return redirect('families/'. $id .'/edit')
                        ->withErrors($validator)
                        ->withInput();
        }

        // store
        $family              = Family::find($id);
        $family->name        = $request['name'];
        $family->description = $request['description'];
        $family->save();

        // redirect
        Session::flash('success', 'Familia modificada correctamente');
        return Redirect::to('families');
        
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
