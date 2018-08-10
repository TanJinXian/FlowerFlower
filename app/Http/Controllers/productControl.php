<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\products;
use App\Catalog;
use App\lib\proxyXMLgenerator;
use DateTime;
use DB;

class productControl extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:staff');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product=products::all();
        return view('productIndex',compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('createProduct');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = new products();
        $product->name=$request->get('name');
        $product->type=$request->get('type');
        $product->desc=$request->get('desc');
        $product->price=$request->get('price');

                $dateMonth = date_parse($request->get('promo'));
                $MonthYear=$dateMonth['month']."-10-2000";
                $ymd = DateTime::createFromFormat('m-d-Y', $MonthYear)->format('Y-m-d');
        
        $product->seasonPromo=$ymd;
        $product->status="Available";
        $product->save();
        
        return redirect('createProduct')->with('success','Information has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $product = products::all()->where('status', 'Available');
        
        $month=$request->get('month');
        //$month = $_REQUEST['month'];
        //$year = $_REQUEST['year'];
        $year=$request->get('year');
        return view('creatingCatalog',['product'=>$product, 'month'=>$month, 'year'=>$year]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = products::find($id);
        return view('ProductEdit',compact('product','id'));
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
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product =products::find($id);
        $product->status="Deleted";
        $product->save();
        return redirect()->route("allProduct"); 
    }

    public function destroyThem($id){
        $product =products::find($id);
        $product=delete();
        return redirect()->route("allProduct"); 
    }

    public function creating(){
        return view('createProduct');
    }
    public function showall(Request $request){
        
        $product = products::all()->where('status', 'Available');
        
        $month=$request->get('month');
        $year=$request->get('year');
        $dateMonth = date_parse($month);
        $MonthYear=$dateMonth['month']."-10-".$year;
        $ymd = DateTime::createFromFormat('m-d-Y', $MonthYear)->format('Y-m-d');
        
        if(Catalog::where('Month', '=', $ymd)->exists()){
            echo $year.$month;
            echo $ymd;
            echo "not create";
            return view('pages.createCatalog')->with('failed','this month and year catalog is created before.');
        }else{
            echo "create";
            return view('creatingCatalog',['product'=>$product, 'month'=>$month, 'year'=>$year]);
        }
        
    }
    public function test(Request $request){
        $this->showall($request);
    }

    public function updating(){
        $product = products::find($_POST['id']);
        $product->name=$_POST['name'];
        $product->type=$_POST['type'];
        $product->desc=$_POST['desc'];
        $product->price=$_POST['price'];

                $dateMonth = date_parse($_POST['promo']);
                $MonthYear=$dateMonth['month']."-10-2000";
                $ymd = DateTime::createFromFormat('m-d-Y', $MonthYear)->format('Y-m-d');
        
        $product->seasonPromo=$ymd;
        $product->status=$_POST['status'];
        $product->save();
        
        return redirect()->route("allProduct");
    }


    public function generateXMLproduct(){
        return $proxyXmlgenerator = (new proxyXMLgenerator)->generatorXML();
    }


    //this function can be deleted, it is used like back button, for going back to part A home page, which use to show all partA function
    public function jumpBackPartA(){
        return view('Linking');
    }


}?>
    