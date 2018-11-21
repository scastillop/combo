<?php

namespace App\Http\Controllers;

use App\Sale;
use Illuminate\Http\Request;
use App\Product;
use App\Family;
use App\Promo;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //con fines de prueba

        //crear familia de prueba
        $familia = new family();
        $familia->name="familia de prueba";
        $familia->description="descripcion de prueba";
        $familia->save();

        //crear producto de prueba
        $producto = new Product();
        $producto->family_id=10;
        $producto->name="producto de prueba";
        $producto->description="descripcion de prueba";
        $producto->umbral=100;
        $producto->stock=50;
        $producto->available=true;
        $producto->price=2500;
        $producto->saveProduct($producto);
        
        //crear un combo oferton
        
        $productos = array();
        $promo = new Promo();
        $promo->total_price = 5000;
        $promo->total_discount = 40;
        $promo->stock =10;
        array_push($productos, $producto->find(13));
        array_push($productos, $producto->find(14));
        $promo->savePromo($promo, $productos);

        //crear una venta 
        $sale = new Sale();
        $sale->customer_id=1;
        $sale->total_amount=5000;
        $sale->saveSale($sale, $productos);
        
        //mostrar los productos mas vendidos
        $resultado = $promo->getMostSelledProducts("2018-10-01 00:00:00", "2018-11-31 00:00:00");
        return var_dump($resultado);
        //return (string)$producto->hasStock($producto->id);
        //return var_dump($producto);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function show(Sale $sale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function edit(Sale $sale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sale $sale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sale $sale)
    {
        //
    }
}
