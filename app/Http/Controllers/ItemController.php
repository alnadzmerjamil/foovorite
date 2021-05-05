<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Auth;
use Session;
class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        
        $restaurants=Restaurant::where('user_id',Auth::id())->get();
        $categories=Category::all();
        $items=Item::where('resto_id',Session::get('resto_id')->get());
        // Session::put('items',$items);
        // Session::put('restaurants',$restaurants);

       return view('item.add_item',['restaurants'=>$restaurants,'categories'=>$categories,'items'=>$items]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $restaurants=Restaurant::where('user_id',Auth::id())->get();
        $categories=Category::all();

        
            $items=Item::all();
        
        // $items=array_filter($items,function($item){
        //     return $item->resto_id==Session::get('resto_id');
        // });
        // Session::put('items',$items);
        // Session::put('restaurants',$restaurants);

       return view('item.add_item',['restaurants'=>$restaurants,'categories'=>$categories,'items'=>$items]);
    // return view('item.add_item');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)

    {   
        // $myfile = fopen("newfile.txt", "w");
        // $txt = "Doe";
        // $jpg=fwrite($myfile, $txt);
        // return $jpg;
        // // dd($request);
        // $imageName= time() . '-' . $request->name . '- ' . $request->image->extension();
        // $request->image->move(public_path('item_images'),$request->image . '.jpg');
        $item=new Item();
        $item->name=$request->name;
        $item->category_id=$request->categoryId;
        $item->price=$request->price;
        $item->resto_id=$request->restoId;
        $item->image=$request->image;
        $item->save();
        return 'Ilove you lalone';

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        $item->name=$request->name;
        $item->category_id=$request->categoryId;
        $item->price=$request->price;
        $item->resto_id=$request->restoId;
        $item->image=$request->image;
        $item->save();
        return 'Updated';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
         $item->delete();
        return 'Deleted';
    }
}
