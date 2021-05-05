<?php

namespace App\Http\Controllers;

use App\Models\Order_Item;
use App\Models\Rider;
use Illuminate\Http\Request;
use Auth;
use Session;
class OrderItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    {   $count=0;
        
        $my_orders=Session::get('my_order');
        $order_id=Auth::user()->orders()->where('status','waiting')->first()->id;
        foreach($my_orders as $order){
          $order_item= new Order_Item();
          $order_item->resto_id=$order['resto_id'];
          $order_item->order_id=$order_id;
          $order_item->item_id=$order['item_id'];
          $order_item->quantity=$order['quantity'];
          $order_item->status='pending';
          $order_item->save();
          $count++;
          
        }
    
        return "From Order Item count $count $order_id";
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order_Item  $order_Item
     * @return \Illuminate\Http\Response
     */
    public function show(Order_Item $order_Item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order_Item  $order_Item
     * @return \Illuminate\Http\Response
     */
    public function edit(Order_Item $order_Item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order_Item  $order_Item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order_Item $order_item)
    {   
        $rider=Rider::where('status','active')->first();
        if(!$rider){
            return 'Sorry, no active rider!';
        }
        $order_item->status = $request->status;
        $order_item->rider_id = $rider->id;
        $order_item->save();

        return 'Rider with ID number '.$rider->id.' is coming!';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order_Item  $order_Item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order_Item $order_Item)
    {
        //
    }
}
