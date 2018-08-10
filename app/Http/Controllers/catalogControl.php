<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Catalog;
use App\products;
use DateTime;
use DB;
class catalogControl extends Controller
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
        $allCatalog = DB::select('select distinct Month from catalogs order by Month');
        return view('pages/catalogIndex',['catalog'=>$allCatalog]);
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

    public function createMulti(){
        $product = products::count();
        $year = $_POST['year'];
        $month = $_POST['month'];
        $dateMonth = date_parse($month);
        $MonthYear=$dateMonth['month']."-10-".$year;
        $ymd = DateTime::createFromFormat('m-d-Y', $MonthYear)->format('Y-m-d');
        for($x =0; $x<$product;$x++){
            if(isset($_POST['checkproduct'.$x])){
                $productID=$_POST['checkproduct'.$x];
                $catalog = new Catalog();
                $catalog->productID = $productID;
                $catalog->Month = $ymd;
                $catalog->save();
                echo "success for ".$x;
            }
        }
        return redirect('createCatalog')->with('Success','Information has been added');
        /*
        for ($y = 0; $y < 4; $y++) {
                            echo " <option value=" . $currentYear . ">" . $currentYear . "</option>";
                            $currentYear = (string)((int)$currentYear+1);
                        }
        */

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
        $catalog = Catalog::find($id);
        $selectedProduct = DB::select(DB::raw("select P.id,P.type,P.name,P.desc,P.status,P.price,P.seasonPromo
        FROM products P, catalogs C
        where P.id=C.productID 
        AND C.Month=:month
        Order by P.type;"), 
        array('month' => $id,));
        return view('viewSelectedCatalog',compact('catalog','id','selectedProduct'));
    }

    /**
     * // P.id,P.type,P.name,P.desc,P.status,P.price,P.seasonPromo
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = products::All();
        $selectedProduct = DB::select(DB::raw("select P.id,P.type,P.name,P.desc,P.status,P.price,P.seasonPromo
        FROM products P, catalogs C
        where P.id=C.productID 
        AND C.Month=:month;"), 
        array('month' => $id,));
        return view('editCatalog',compact('product','id','selectedProduct'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $product = products::count();
        $year = $_POST['id'];
        $catalog = Catalog::find($year);
        $catalog->delete();
        for($x =0; $x<$product;$x++){
            if(isset($_POST['checkproduct'.$x])){
                $productID=$_POST['checkproduct'.$x];
                $catalog = new Catalog();
                $catalog->productID = $productID;
                $catalog->Month = $year;
                $catalog->save();
                echo "success for ".$x;
            }
        }
    
        //return redirect('createCatalog')->with('Success','Information has been editted');
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
    public function updateMonth(){
        $product = products::count();
        $year = $_POST['year'];
        $catalog = DB::table('catalogs')->where('Month', '=', $year)->delete();
        for($x =0; $x<$product;$x++){
            if(isset($_POST['checkproduct'.$x])){
                $productID=$_POST['checkproduct'.$x];
                $catalog = new Catalog();
                $catalog->productID = $productID;
                $catalog->Month = $year;
                $catalog->save();
                echo "success for ".$x;
            }
        }
        //ask xian
        return redirect()->route('showAllCatalog');
    }


    
    public function ShowPromo($id){
        $catalog = Catalog::find($id);
        $currentMonth = date('m');
        $current = "2000-".$currentMonth."-10 00:00:00";
        $selectedProduct = DB::select(DB::raw("select P.id,P.type,P.name,P.desc,P.status,P.price,P.seasonPromo
        FROM products P, catalogs C
        where P.id=C.productID 
        AND C.Month=:month
        AND P.seasonPromo=:promo
        Order by P.type;"), 
        array('month' => $id,'promo'=>$current,));
        return view('viewSelectedCatalog',compact('catalog','id','selectedProduct'));
    }
    public function ShowFlower($id){
        $catalog = Catalog::find($id);
        $currentMonth = date('m');
        $current = "2000-".$currentMonth."-10 00:00:00";
        $selectedProduct = DB::select(DB::raw("select P.id,P.type,P.name,P.desc,P.status,P.price,P.seasonPromo
        FROM products P, catalogs C
        where P.id=C.productID 
        AND C.Month=:month
        AND P.type='Flower'
        Order by P.type;"), 
        array('month' => $id,));
        return view('viewSelectedCatalog',compact('catalog','id','selectedProduct'));
    }
    public function ShowBonquet($id){
        $catalog = Catalog::find($id);
        $currentMonth = date('m');
        $current = "2000-".$currentMonth."-10 00:00:00";
        $selectedProduct = DB::select(DB::raw("select P.id,P.type,P.name,P.desc,P.status,P.price,P.seasonPromo
        FROM products P, catalogs C
        where P.id=C.productID 
        AND C.Month=:month
        AND P.type='bonquets'
        Order by P.type;"), 
        array('month' => $id,));
        return view('viewSelectedCatalog',compact('catalog','id','selectedProduct'));
    }
    public function ShowFloral($id){
        $catalog = Catalog::find($id);
        $currentMonth = date('m');
        $current = "2000-".$currentMonth."-10 00:00:00";
        $selectedProduct = DB::select(DB::raw("select P.id,P.type,P.name,P.desc,P.status,P.price,P.seasonPromo
        FROM products P, catalogs C
        where P.id=C.productID 
        AND C.Month=:month
        AND P.type='floralArrangements'
        Order by P.type;"), 
        array('month' => $id,));
        return view('viewSelectedCatalog',compact('catalog','id','selectedProduct'));
    }
}
