<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Session;
use Auth;
class ModalController extends Controller
{
    public function is_merchant(Request $request){
        Session::put('resto_id',$request->resto_id);
        // $orders=Order::where('status','pending')->get();
        return redirect('/orders');
    }
}
