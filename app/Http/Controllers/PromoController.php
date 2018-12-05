<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Promo;
use App\Product;
use Validator;
use Session;
use Redirect;

class PromoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //$promos = Promo::getMostSelledProducts("2018-10-01 00:00:00", "2018-11-31 00:00:00");
        $promos = Promo::all();
        $most_and_least_sold_products = Promo::getMostAndLeastSoldProduct($request->date_from, $request->date_to);
        return view('promos/index', ['promos' => $promos, 'most_and_least_sold_products' => $most_and_least_sold_products, 'date_from' => $request->date_from, 'date_to' => $request->date_to]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $total_price = 0;
        $promo_type = $request->get('promo_type');
        if ($promo_type == 'most_and_least_sold_products'){
            $most_and_least_sold_products = Promo::getMostAndLeastSoldProduct($request->date_from, $request->date_to);
            $total_price = isset($most_and_least_sold_products[0]) ? $total_price+$most_and_least_sold_products[0]["least"]->price : $total_price;
            $total_price = isset($most_and_least_sold_products[1]) ? $total_price+$most_and_least_sold_products[1]["most"]->price : $total_price;
            $total_price = number_format($total_price, 0, '', '.');
            return view('promos/create', ['most_and_least_sold_products' => $most_and_least_sold_products, 'total_price'=>$total_price, 'promo_type'=>$promo_type, 'date_from' => $request->date_from, 'date_to' => $request->date_to]);
        }else{
            $promos = Promo::all();
            $most_and_least_sold_products = Promo::getMostAndLeastSoldProduct($request->date_from, $request->date_to);
            return view('promos/index', ['promos' => $promos, 'most_and_least_sold_products' => $most_and_least_sold_products, 'promo_type'=>$promo_type, 'date_from' => $request->date_from, 'date_to' => $request->date_to]);
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
        $most_and_least_sold_products = Promo::getMostAndLeastSoldProduct($request->date_from, $request->date_to);
        $products = array();
        if(isset($most_and_least_sold_products[0])){
            array_push($products, $most_and_least_sold_products[0]["least"]);
        }
        if(isset($most_and_least_sold_products[1])){
            array_push($products, $most_and_least_sold_products[1]["most"]);
        }
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'total_discount' => 'required|numeric|min:1|max:99',
            'stock' => 'required|numeric|min:1',
            'init_date' => 'date_format:Y-m-d|required|after:today',
            'end_date' => 'date_format:Y-m-d|required|after:init_date',
        ]);
        if(empty($products)){
             $validator->after(function ($validator) {
                    $validator->errors()->add('stock', 'Debe ingresar productos al combo');
                 });
        }
        foreach ($products as $value) {
            if (!Product::hasStock($value->id, $request->stock)){
                 $validator->after(function ($validator) {
                    $validator->errors()->add('stock', 'No hay stock disponible');
                 });
            }
        }
        if ($validator->fails()) {
            return redirect('promos/create?promo_type='.$request['promo_type'].'&date_from='. $request['date_from'] .'&date_to='.$request['date_to'])
                        ->withErrors($validator)
                        ->withInput();
        }
        
        $promo = new Promo;
        $promo->name = $request['name'];
        $promo->description = $request['description'];
        $promo->stock = $request['stock'];
        $promo->total_discount = $request['total_discount'];
        $promo->init_date = $request['init_date'];
        $promo->end_date = $request['end_date'];
        
        if (Promo::savePromo($promo, $products)){
            $message_type = 'success';
            $message = 'Combo creado correctamente';
        }else{
            $message_type = 'warning';
            $message = 'Ocurrio un problema, intenta nuevamente';
        }
        Session::flash($message_type, $message);
        return Redirect::to('promos');
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
