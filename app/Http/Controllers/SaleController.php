<?php

namespace App\Http\Controllers;

use App\Sale;
use Illuminate\Http\Request;
use App\Product;
use App\Family;
use App\Promo;
use App\Customer;
use App\PaymentMethod;
use Validator;
use Session;
use Redirect;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //con fines de prueba

        //crear familia de prueba
        //$familia = new family();
        //$familia->name="familia de prueba";
        //$familia->description="descripcion de prueba";
        //$familia->save();

        //crear producto de prueba
        // $producto = new Product();
        // $producto->family_id=10;
        // $producto->name="producto de prueba";
        // $producto->description="descripcion de prueba";
        // $producto->umbral=100;
        // $producto->stock=50;
        // $producto->available=true;
        // $producto->price=2500;
        // $producto->saveProduct($producto);
        
        //crear un combo oferton
        
        // $productos = array();
        // $promo = new Promo();
        // $promo->total_price = 5000;
        // $promo->total_discount = 40;
        // $promo->stock =10;
        // array_push($productos, $producto->find(13));
        // array_push($productos, $producto->find(14));
        // $promo->savePromo($promo, $productos);

        //crear una venta 
        // $sale = new Sale();
        // $sale->customer_id=1;
        // $sale->total_amount=5000;
        // $sale->saveSale($sale, $productos);
        
        //mostrar los productos mas vendidos
        //$resultado = $promo->getMostSelledProducts("2018-10-01 00:00:00", "2018-11-31 00:00:00");
        //return var_dump($resultado);
        //return (string)$producto->hasStock($producto->id);
        //return var_dump($producto);
        $sales = Sale::getByDate($request->date_from, $request->date_to);
        //$sales = Sale::all()->whereBetween('created_at', [$request->date_from, $request->date_to]);
        return view('sales/index', ['sales' => $sales]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = Customer::pluck('name', 'id');
        $payment_methods = PaymentMethod::pluck('name', 'id');
        return view('sales.create', ['customers' => $customers, 'payment_methods' => $payment_methods]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $productos = array();
        $product_ids = array();
        foreach ($request->product_id as $key => $value) {
            $product = Product::find($value);
            var_dump($value);
            if ($product){
                array_push($productos, $product);
                array_push($product_ids, $product->id);
            }
        }
        
        $total_products_ids = array_count_values($product_ids);
        $validator = Validator::make($request->all(), [
            'customer_id' => 'required|integer',
            'payment_method_id' => 'required|integer',
            //"products"    => "required|array|min:1",
            //"products.*"  => "integer|min:1"
            "product_id"    => "required|array|min:1",
            "product_id.*"  => "integer|min:1"
        ]);
        foreach ($total_products_ids as $key => $value) {
            if (!Product::hasStock($key, $value)){
                 $validator->after(function ($validator) {
                    $validator->errors()->add('product_id', 'No hay stock disponible');
                 });
            }
        }
        if ($validator->fails()) {
            return redirect('sales/create')
                        ->withErrors($validator)
                        ->withInput();
        }

        $sale = new Sale();
        $sale->customer_id = $request->customer_id;
        $sale->payment_method_id = $request->payment_method_id;
        $sale->saveSale($sale, $productos);

        Session::flash('success', 'Venta creada correctamente');
        return Redirect::to('sales');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function show($sale_id)
    {
        $sale = Sale::find($sale_id);
        return view('sales/show', ['sale' => $sale]);
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
