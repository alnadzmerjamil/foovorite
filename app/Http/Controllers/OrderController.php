<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Restaurant;
use App\Models\Order_Item;
use Illuminate\Http\Request;
use Auth;
use Session;
class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $resto_id=Session::get('resto_id');
         if(Auth::user()->role=='Merchant' && $resto_id){
            $orders=Order::where('date',date("Y-m-j"))->get();
            return view('merchant.merchant_index',['orders'=>$orders]);
         }elseif(Auth::user()->role='Customer'){
             $orders=Order::where('date',date("Y-m-j"))
             ->where('user_id',Auth::id())->get()
             ;
             return view('customer.customer_page',['orders'=>$orders]);
             
         }elseif(Auth::user()->role=='Rider' ){
            return redirect('/riders');
         }else{
            return view('modal.modal_merchant');
         }
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
       
        $order=new Order();
        $order->user_id=Auth::id();
        $order->date=date("Y-m-j");
        $order->mop='COD';
        $order->save();
        
        $my_orders=Session::get('my_order');
        foreach($my_orders as $item){
          $order_item= new Order_Item();
          $order_item->resto_id=$item['resto_id'];
          $order_item->order_id=$order->id;
          $order_item->item_id=$item['item_id'];
          $order_item->quantity=$item['quantity'];
          $order_item->status='pending';
          $order_item->save();
        }
        Session::forget('my_order');
        return 'Order Successful';
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        Session::forget('my_order');
        $order->status='pending';
        $order->save();
        return 'Updated';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
