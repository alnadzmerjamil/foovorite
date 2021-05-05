<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CustomerOrder;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\ModalController;
use App\Http\Controllers\RiderController;
use App\Models\Item;
use App\Models\Order;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    // dd(Session::get('resto_id'));
    
    $costumer_orders=Session::get('my_order');
    if($costumer_orders){
        $my_orders=$costumer_orders;
    }else{
        $my_orders=[];
    }

    $items=Item::all();
     if(Auth::user()->role=='Merchant' && !Session::get('resto_id') && Auth::user()->restos->first()){
        return view('modal.modal_merchant');
    }else{
        return view('dashboard',['items'=>$items, 'my_orders'=>$my_orders]);
    }
    
})->name('dashboard');

Route::resource('/items', ItemController::class);
Route::resource('/categories', CategoryController::class);
Route::resource('/restaurants', RestaurantController::class);
Route::resource('/orders', OrderController::class);
// Route::resource('/items.orders', OrderController::class)->shallow();
Route::resource('/restaurants.order_items', OrderItemController::class)->shallow();
Route::resource('/orderitems', OrderItemController::class);
Route::resource('/riders', RiderController::class);

Route::post('/customers/order', [CustomerOrder::class, 'put_to_session']);
Route::post('/customers/removeorder', [CustomerOrder::class, 'remove_order']);
Route::post('/searchitems', [CustomerOrder::class, 'search_items']);
Route::post('/authentication', [ModalController::class, 'is_merchant']);
