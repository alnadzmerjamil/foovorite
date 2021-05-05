<?php

namespace App\Http\Controllers;

use App\Models\Rider;
use Illuminate\Http\Request;
use Auth;
use Session;
class RiderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        if(Auth::user()->role !== 'Rider'){
            return redirect('/dashboard');
        }
        $rider=Rider::where('user_id',Auth::id())->first();
        if(!$rider){
            return redirect('/dashboard');

        }
        // dd($rider->order_items); gumagana
        Session::put('rider_id',$rider->id);//need to update status
        return view('rider.rider_page',['rider'=>$rider]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('rider.add_vehicle');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        
        $existing=Rider::where('user_id',Auth::id())->first();
        $role=Auth::user()->role;
        if($role!=='Rider'){
            return 'We cannot process your request, you are registered as '.$role;
        }
        elseif($existing){
            return 'You are already registered!';
        }else{
        $rider=new Rider();
        $rider->user_id=Auth::id();
        $rider->vehicle_model=$request->model;
        $rider->plate_number=$request->plate;
        $rider->registration=$request->registration;
        $rider->driver_licence=$request->dLicence;
        }
        $rider->save();
        return 'Thank you for being with us!';
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rider  $rider
     * @return \Illuminate\Http\Response
     */
    public function show(Rider $rider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rider  $rider
     * @return \Illuminate\Http\Response
     */
    public function edit(Rider $rider)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rider  $rider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rider $rider)
    {  
        Session::put('rider_status',$request->status);
        $rider->status=$request->status;
        $rider->save();
        return $request->status;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rider  $rider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rider $rider)
    {
        //
    }
}
