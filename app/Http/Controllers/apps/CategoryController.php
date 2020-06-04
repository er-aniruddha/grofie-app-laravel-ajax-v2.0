<?php

namespace Grofie\Http\Controllers\apps;

use Illuminate\Http\Request;
use Grofie\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Session;
use Grofie\Cart;
use Grofie\Category;
use Grofie\SubCategory;
use Grofie\Product;

class CategoryController extends Controller
{
  public function index()
  {
    $user = Session::get('AuthUser');// this is for get User Id to show cart value
    if(request()->ajax())
    {
      $categories = Category::where('categories.publication_status','=',1)->orderBy('category_id','ASC')->get();
      $sub_categories = SubCategory::where('sub_categories.publication_status','=',1)->orderBy('sub_cat_id','ASC')->get();
      return response()->json(['categories' => $categories , 'sub_categories' => $sub_categories]);
    }
    else
    {
      if($user)
      {
        $i = Cart::where('user_id' , $user->id)->count();
        return view('apps.category.category', ['i' => $i]);
      }
      else
      {
        $i = 0 ;
        return view('apps.category.category', ['i' => $i]);
      }
    }
  }
  
  public function product_by_sub_category($sub_cat_id)
  {
    $user = Session::get('AuthUser');// this is for get User Id to show cart value
    if(request()->ajax())
    {
      $products = Product::join('categories','products.category_id','=','categories.category_id')
                          ->join('brands','products.brand_id','=','brands.brand_id')
                          ->join('units','products.unit_id','=','units.unit_id')
                          ->orderBy('product_id', 'ASC')
                          ->where('products.sub_cat_id', $sub_cat_id)
                          ->where('products.product_stat','=',1)
                          ->limit(6)
                          ->get();  
      // this is to collect last pro id to controll scroll evernt           
      $last_pro_id = Product::where('products.sub_cat_id', $sub_cat_id)->latest()->first(); 
      return response()->json(['products'=>$products, 'success'=>1 , 'last_pro_id' => $last_pro_id]);
    }
    else
    {
      if($user)
      {
        // $i = Cart::where('user_id' , $user->id)->count();
        $cartItem = Cart::where('user_id' , $user->id)->get();
        $i = count( $cartItem );
        return view('apps.category.products', ['i' => $i , 'sub_cat_id' => $sub_cat_id , 'cart_item' => $cartItem]);
      }
      else
      {
        $i = 0 ;
        $cartItem = '';
        return view('apps.category.products', ['i' => $i , 'sub_cat_id' => $sub_cat_id , 'cart_item' => $cartItem]);
      }
    }
    
  }
  public function load_more($sub_cat_id , $product_id)
  {
    $moreProducts = Product::where('products.sub_cat_id', $sub_cat_id)
                      ->where('product_id','>',$product_id)
                      ->where('products.product_stat','=',1)
                      ->join('categories','products.category_id','=','categories.category_id')
                      ->join('brands','products.brand_id','=','brands.brand_id')
                      ->join('units','products.unit_id','=','units.unit_id')
                      ->orderBy('product_id', 'ASC')
                      ->limit(6)
                      ->get();
    return response()->json(['moreProducts' => $moreProducts]);
  }
}
