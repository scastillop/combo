<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Product;
use App\Family;
use Validator;
use Session;
use Redirect;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('products/index', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $families = Family::pluck('name', 'id');
        return view('products.create', ['families' => $families]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $max_umbral = isset($request['stock']) ? (int)$request['stock']-1 : 0;
        $validator = Validator::make($request->all(), [
            'family_id' => 'required|integer|exists:families,id',
            'name' => 'required|string|unique:products',
            'price' => 'required|numeric|min:1|max:10000000',
            'stock' => 'required|integer|min:1',
            'init_stock' => 'required|integer|min:1',
            'umbral' => 'required_with:stock|integer|max:'.$max_umbral
        ]);
        if ($validator->fails()) {
            return redirect('products/create')
                        ->withErrors($validator)
                        ->withInput();
        }

        $product = new Product;
        $product->name = $request['name'];
        $product->stock = $request['stock'];
        $product->init_stock = $request['init_stock'];
        $product->family_id = $request['family_id'];
        $product->description = $request['description'];
        $product->price = $request['price'];
        $product->umbral = $request['umbral'];
        $product->available = true;
        Product::saveProduct($product);
        // redirect
        Session::flash('success', 'Producto creado correctamente');
        return Redirect::to('products');
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
        $product = Product::find($id);
        $families = Family::pluck('name', 'id');
        return view('products/edit', ['product' => $product, 'id' => $id, 'families' => $families]);
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
        $max_umbral = isset($request['stock']) ? (int)$request['stock']-1 : 0;
        $validator = Validator::make($request->all(), [
            'family_id' => 'required|integer|exists:families,id',
            'name' => 'required|string|unique:products,name,'.$id,
            'price' => 'required|numeric|min:1|max:10000000',
            'stock' => 'required|integer|min:1',
            'init_stock' => 'required|integer|min:1',
            'available' => 'required|boolean',
            'umbral' => 'required_with:stock|integer|max:'.$max_umbral
        ]);
        if ($validator->fails()) {
            return redirect('products/'. $id .'/edit')
                        ->withErrors($validator)
                        ->withInput();
        }

        $product = Product::find($id);
        $product->name = $request['name'];
        $product->stock = $request['stock'];
        $product->init_stock = $request['init_stock'];
        $product->family_id = $request['family_id'];
        $product->description = $request['description'];
        $product->price = $request['price'];
        $product->umbral = $request['umbral'];
        $product->available = $request['available'];
        $product->save();
        // redirect
        Session::flash('success', 'Producto creado correctamente');
        return Redirect::to('products');
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

    public function search(Request $request)
    {
        return Product::getByParam($request->search_by, $request->search);
    }
}
