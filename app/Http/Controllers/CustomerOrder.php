<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use Session;
use Auth;
class CustomerOrder extends Controller
{
  public function put_to_session(Request $request){
      $removeOrder=$request->remove;
        if($removeOrder){
            Session::forget('my_order');
            return 'Order has removed from Session';
        }

      $my_order=Session::get('my_order');
      $per_order=[
      'user_id'=>Auth::id(),
      'resto_id'=>$request->resto_id,
      'resto_name'=>$request->resto_name,
      'item_id'=>$request->item_id,
      'item_name'=>$request->item_name,
      'item_price'=>$request->item_price,
      'item_image'=>$request->item_image,
      'quantity'=>$request->quantity,
      'status'=>$request->status];
       
      $flag;
      if($my_order) {
        global $flag;
        $container=array();
        foreach($my_order as $order){
          if($order['user_id']==Auth::id() && $order['item_id']==$request->item_id){
            $flag=$order;
            $flag['quantity']+=$request->quantity;
          }else{
           array_push($container,$order);
          }
        }
          
        if($flag){
          array_push($container,$flag);
          Session::put('my_order',$container);
          return 'Order quantity updated';
        }else{
            array_push($my_order,$per_order);
            Session::put('my_order',$my_order);
            return 'Order is not existing and successfully put to session';
        }
      } else{
        $new_order=array();
        array_push($new_order,$per_order);
        Session::put('my_order',$new_order);
        return 'First order';
      }
    
  }

  public function remove_order(Request $request){
    //remove individual item
      $my_order=Session::get('my_order');
      $updated=array();
      foreach($my_order as $order){
        if($order['user_id']==Auth::id()&&$order['item_id'] !=$request->item_id){ 
              array_push($updated,$order);
        }
      };
      Session::put('my_order',$updated);
      return "Item has removed from order";
  }

  public function search_items(Request $request){
    // dd($request->category_id);
    $costumer_orders=Session::get('my_order');
    if($costumer_orders){
        $my_orders=$costumer_orders;
    }else{
        $my_orders=[];
    }
   $items=Item::where('category_id',$request->category_id)->get();
        return view('dashboard',['items'=>$items, 'my_orders'=>$my_orders]);
    
  
  }
}
