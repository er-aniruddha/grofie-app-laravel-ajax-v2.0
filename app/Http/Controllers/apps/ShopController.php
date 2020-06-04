<?php

namespace Grofie\Http\Controllers\apps;

use Illuminate\Http\Request;
use Grofie\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Grofie\User;
use Grofie\Category;
use Grofie\Product;
use Redirect;
use Session;
use Grofie\Cart;
use Grofie\Charge;
class ShopController extends Controller
{
  
  public function index($product_id)
  {  
    $user = Session::get('AuthUser');
    $single_product = Product::where('products.product_id',$product_id)
    ->join('categories','products.category_id','=','categories.category_id')
    ->join('brands','products.brand_id','=','brands.brand_id')
    ->join('units','products.unit_id','=','units.unit_id')
    ->first();
    if($user)
    {
      $i = Cart::where('user_id' ,'=', Auth::id())->count();
      return view ('apps.shop.single_product',[ 'single_product' => $single_product , 'i' => $i]); 
    }
    else
    {
      $i = 0 ;
      $categories = Category::orderBy('category_id','DESC')->get();
      return view ('apps.shop.single_product',[ 'single_product' => $single_product , 'i' => $i]);
    }
     	/*echo "<pre>";
  	print_r($single_product);
  	echo "</pre>";*/	
  }
  

  public function add_to_cart(Request $request)
  {

    $cartItems = json_decode( $request->all()['allProductsInfo'], true);

    $cartItemsTotal = count ( json_decode( $request->all()['allProductsInfo'], true) );

    for ( $count=0; $count < $cartItemsTotal; $count++ ) 
    {
      $prsntItemCount = Cart::where('user_id' , Auth::id())->where('product_id' , $cartItems[$count]['selectProductId'])->count();      

      $product = Product::find($cartItems[$count]['selectProductId']);

      if($prsntItemCount > 0)
      {
        $cartItemProduct =  Cart::where('user_id', Auth::id())->where('product_id' , $cartItems[$count]['selectProductId'])->first();
        $qtyUpdate = $cartItemProduct->qty + $cartItems[$count]['selectProductQty'];

          Cart::where('user_id' , Auth::id())->where('product_id' , $cartItems[$count]['selectProductId'])->update(['qty' => $qtyUpdate]);
      }
      else
      {
        $carts = new Cart;
        $carts->user_id = Auth::id();
        $carts->product_id = $cartItems[$count]['selectProductId'];
        $carts->qty =  $cartItems[$count]['selectProductQty'];         
        $carts-> save(); 
      }      
      
    }
    $cartItem = Cart::where('user_id' , Auth::id())->get();
    $i = count( $cartItem );
    return response()->json(['success' => 1 , 'i' => $i , 'cartItem' => $cartItem]);
  }

  public function showCart()
  {
    
  	$chk_cart = Cart::where('user_id' , Auth::id())->get();

    foreach ($chk_cart as $cart)
    {
      $product = Product::find($cart->product_id);
      if($cart->qty > $product->product_in_hand_stock)
      {
        Cart::where('user_id' , Auth::id())->where('product_id', $cart->product_id)->update(['qty' => $product->product_in_hand_stock]);
        
      }   
    }
    
    $carts = Cart::where('user_id' , Auth::id())
                    ->join('products','carts.product_id','=','products.product_id')
                    ->join('units','products.unit_id','=','units.unit_id')
                    ->orderBy('cart_id', 'desc')
                    ->get();

    $i = Cart::where('user_id' , Auth::id())->count();
    $charges = Charge::select('delivery_charges' , 'min_ordr_amount')->first();
     // This Session data use for store data into Orders Table  
    Session::put('carts_details',$carts);
    return view('apps.shop.cart',['carts' => $carts , 'i' => $i ,'charges' => $charges ]);
    
  }

  public function cartAddQty(Request $request)
  {
    $data = $request->all();

    $cart=Cart::where('user_id', Auth::id())  
    ->where('cart_id' ,$request->cart_id)                
    ->where('cart_id' ,$request->cart_id)
    ->update(['qty' => $request->qty]);

    return response()->json(['success' => $cart]);  
    //echo "<pre>"; print_r($data); echo "</pre>";
  }
  public function cart_product_delete($cart_id)
  {
    $delete = Cart::where('cart_id',$cart_id)->delete();
    return response()->json(['delete' => $delete]);
  }

  
}
// $productId = Cart::where('user_id', Auth::id())
//                       ->where('product_id' , $product_id)
//                       ->count();
//     $carts =  Cart::where('user_id', Auth::id())
//                   ->where('product_id',$product_id)
//                   ->first();
//     $product = Product::find($product_id);
//     if(Auth::check())
//     {               
//       if(!$carts)
//       {
//         $cartsQty = $qty;  
//       }
//       else
//       {
//         $cartsQty = $carts->qty + $qty; 
//       }    

//       if($cartsQty <= $product->product_in_hand_stock)
//       {
//         if($productId>0)
//         {          
//           if($cartsQty>5)
//           {
//             $tmessage = array('tmessage' => 'Maximum 5 quantity can be added');
//             return response()->json($tmessage);
//           }
//           else
//           {
//             Cart::where('product_id',$product_id)->update(['qty' => $cartsQty]);
//             return response()->json(['success' => 1]);
//           }     
//         }  
//        else
//        {
//         $user_id = Auth::id();
//         $carts = new Cart;
//         $carts->user_id = $user_id;
//         $carts->product_id =$product_id;
//         $carts->qty =  $qty;         
//         $carts-> save(); 
//         return response()->json(['success' => 1]);
//        }
//       }
//       else
//       {
//         $tmessage = array('tmessage' => $product->product_in_hand_stock.' quantity available');
//         return response()->json($tmessage);
//       }   

//     }
//     else
//     {
//       return redirect()->route('apps.login');
//       //return response()->json(['login' => 1]);
//     }   