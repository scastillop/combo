<?php

namespace App\Http\Controllers;

use App\provider;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;
use Session;
use Redirect;

class ProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $providers = Provider::all();
        return view('providers/index', ['providers' => $providers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('providers.create');
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
            'business_name' => 'required|string|max:255|unique:providers',
            'address' => "required|string|max:255"
        ]);
        if ($validator->fails()) {
            return redirect('providers/create')
                        ->withErrors($validator)
                        ->withInput();
        }
        $provider = new Provider;
        $provider->business_name = $request['business_name'];
        $provider->address = $request['address'];
        $provider->save();
        Session::flash('success', 'Proveedor creado correctamente');
        return Redirect::to('providers');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function show(provider $provider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $provider = Provider::find($id);
        return view('providers/edit', ['provider' => $provider, 'id' => $id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'business_name' => 'required|string|max:255|unique:providers',
            'address' => "required|string|max:255"
        ]);
        if ($validator->fails()) {
            return redirect('providers/'. $id .'/edit')
                        ->withErrors($validator)
                        ->withInput();
        }
        $provider = Provider::find($id);
        $provider->business_name = $request['business_name'];
        $provider->address = $request['address'];
        $provider->save();
        Session::flash('success', 'Proveedor modificado correctamente');
        return Redirect::to('providers');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function destroy(provider $provider)
    {
        //
    }
}
