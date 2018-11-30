<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Promo;

class PromoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$promos = Promo::getMostSelledProducts("2018-10-01 00:00:00", "2018-11-31 00:00:00");
        $promos = Promo::all();
        $most_and_least_sold_products = Promo::getMostAndLeastSoldProduct("2018-10-01 00:00:00", "2018-11-31 00:00:00");
        return view('promos/index', ['promos' => $promos, 'most_and_least_sold_products' => $most_and_least_sold_products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if ($request->get('promo_type')){
            $most_and_least_sold_products = Promo::getMostAndLeastSoldProduct("2018-10-01 00:00:00", "2018-11-31 00:00:00");
            return view('promos/create', ['most_and_least_sold_products' => $most_and_least_sold_products]);
        }else{

        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validar fecha inicio mayor a la de termino
        //validar que el valor sea menor al total de la suma de los productos
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        echo "promos-show";
        echo url()->current();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
