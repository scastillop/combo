<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PurchaseOrder;
use App\PurchaseOrderDetail;
use Validator;
use Session;
use Redirect;

class PurchaseOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $purchases = PurchaseOrder::all();
        return view('purchase_orders/index', ['purchases' => $purchases]);
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
        $request->validate([
            'provider_id' => 'required|integer|min:1',
            "purchase_order_details"    => "required|array|min:1",
            "purchase_order_details.*"  => "integer|min:1"
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $purchase = PurchaseOrder::find($id);
        $purchase_detail = PurchaseOrderDetail::where('purchase_order_id', '=', $id)->first();
        
        return view('purchase_orders/show', ['purchase' => $purchase, 'purchase_detail' => $purchase_detail]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $purchase = PurchaseOrder::find($id);
        $purchase_detail = PurchaseOrderDetail::where('purchase_order_id', '=', $id)->first();
        $statuses = ['pending' => 'Pendiente', 'rejected' => 'Rechazada', 'done' => 'Hecha'];
        return view('purchase_orders/edit', ['purchase' => $purchase, 'purchase_detail' => $purchase_detail, 'statuses' => $statuses]);
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
            'status' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect('purchase_orders/'. $id .'/edit')
                        ->withErrors($validator)
                        ->withInput();
        }

        // store
        $purchase_order              = PurchaseOrder::find($id);
        $purchase_order->status        = $request['status'];
        $purchase_order->save();

        // redirect
        Session::flash('success', 'Orden modificada correctamente');
        return Redirect::to('purchase_orders');
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
