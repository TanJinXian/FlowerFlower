<?php

namespace App\Http\Controllers;

use App\Catalog;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function userShow()
    {
        $allCatalog = \DB::select('select distinct Month from catalogs order by Month');
        return view('pages.index',['catalog'=>$allCatalog]);
    }

    public function showViewForConsumer($id)
    {
        $catalog = Catalog::find($id);
        $selectedProduct = \DB::select(\DB::raw("select P.id,P.type,P.name,P.desc,P.status,P.price,P.seasonPromo
        FROM products P, catalogs C
        where P.id=C.productID 
        AND C.Month=:month
        Order by P.type;"), 
        array('month' => $id,));
        return view('viewSelectedCatalog',compact('catalog','id','selectedProduct'));
    }

}
