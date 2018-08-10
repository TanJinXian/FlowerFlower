<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Consumer;
use DB;
class consumerProfileController extends Controller

{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       //$consumers = Consumer::all();
        $consumers = DB::table('consumers')
                        ->where( 'id','=',session('id'))
                        ->first();
        
       /* $consumers = Consumer::All();
        $selectConsumer = DB::select(DB::raw("select custName,custIC,custGender,custDob,address,email,ContactNo,companyName,status from consumers where id= 1"));*/
                        
       return view('pages.consumer.consumerProfile',compact('consumers','selectConsumer'));
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
        //
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
        //
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
        $consumers = Consumer::find($id);
        $consumers->custName=$request->get('custName');
        $consumers->custIC=$request->get('custIC');
        $consumers->custGender=$request->get('custGender');
        $consumers->custDob=$request->get('custDob');
        $consumers->address=$request->get('address');
        $consumers->email=$request->get('email');
        $consumers->companyName=$request->get('companyName');
        $consumers->password=$request->get('password');
        $consumers->status=$request->get('status');
        $consumers->save();
        return redirect('customer/custLogin');
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
