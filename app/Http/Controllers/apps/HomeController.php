<?php

namespace Grofie\Http\Controllers\apps;

use Illuminate\Http\Request;
use Grofie\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Grofie\Cart;
use Grofie\Product;
use Grofie\Brand;
use Session;

class HomeController extends Controller
{
    public function index()
    {
    	$user = Session::get('AuthUser');      
    	if($user)
    	{    		
    		 $i = Cart::where('user_id' , $user->id)->count();
        	return view('apps.home.home',['i' => $i ]);
    	}
    	else
    	{
    		$i = 0 ;
    		return view('apps.home.home',['i' => $i ]);
    	}
    } 
    public function topSavers()
    {
        $topsevers = Product::where('home_show_stat','=',1)->where('product_offers','>',0)
                            ->join('brands','products.brand_id','=','brands.brand_id')
                            ->join('units','products.unit_id','=','units.unit_id')
                            ->get();
        return response()->json(['topsevers' => $topsevers]);

    }
    public function search_index()
    {
        return view('apps.home.search');           
    }
    public function searchProduct(Request $request)
    {
        if($request->get('query'))
        {
            $query = $request->get('query');
            $products = Product::where('product_name', 'LIKE', "%{$query}%")
                        ->join('brands','products.brand_id','=','brands.brand_id') 
                        ->join('units','products.unit_id','=','units.unit_id')     
                        ->get();
            return response()->json(['products' => $products]); 
        }
    }
}
