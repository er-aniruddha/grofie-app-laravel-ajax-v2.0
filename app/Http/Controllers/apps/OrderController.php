<?php

namespace Grofie\Http\Controllers\apps;

use Illuminate\Http\Request;
use Grofie\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Redirect;
use Session;
use Grofie\Address;
use Grofie\User;
use Grofie\Order;
use Grofie\Cart;
use Grofie\Product;
use Grofie\Charge;

class OrderController extends Controller
{
   
    public function confirm_process()
    {	
    	if(Auth::check())
    	{
    		$SessionData = Session::get('carts_details');
    		$address = Session::get('address');
    		$delivery_km_charges = Session::get('km_charges');    		
    		$paymentChk = Session::get('payment_chk');
    		$delCharges = Session::get('delivery_charges'); //From Cart Blade
	    	//radmon number for Order number
	    	$time = strtotime(date('Y-m-d H:m:s'));
		    // $mt = mt_rand('1000','9999');
		    $random = $time;
		    ///////////////////////////////////    	
	    	$order_info = Order::where('user_id',Auth::id())
	    				->first();	
	    	$carts = Cart::where('user_id' , Auth::id())->get();			
    		if($SessionData)
    		{
    			if (!$order_info) 
    			{
    				if($paymentChk)
    				{	    				
		    			foreach ($carts as $cart) 
			    		{
			    			$products = Product::find($cart->product_id);
			    			if($products->product_stat == 1 && $products->product_in_hand_stock > 0)
			    			{
						    	$order = new Order;
					    		$order->user_id = Auth::id();
					    		$order->delivery_charges = $delCharges;
					    		$order->delivery_km_charges = $delivery_km_charges; 
					    		$order->product_id = $cart->product_id;
					    		$order->cgst_rate_o = $products->cgst_rate;
					    		$order->sgst_rate_o = $products->sgst_rate;
					    		$order->igst_rate_o = $products->igst_rate;
					    		$order->ugst_rate_o = $products->ugst_rate;
					    		$order->cgst_amount_o = $products->cgst_amount;
					    		$order->sgst_amount_o = $products->sgst_amount;
					    		$order->igst_amount_o = $products->igst_amount;
					    		$order->ugst_amount_o = $products->ugst_amount;
					    		$order->offers = $products->product_offers;
					    		$order->sell_price = $products->product_sell_price;
					    		$order->sell_price_ex_gst = $products->product_sell_price_ex_gst;
					    		$order->sell_price_after_offer = $products->product_sell_price_after_offer;
					    		$order->sell_price_after_offer_ex_gst = $products->product_sell_price_after_offer_ex_gst;
					    		$order->qty = $cart->qty;	
					    		$order->order_id = $random;
					    		$order->distance = $address->distance;	    		
					    		$order->duration = $address->duration;
					    		$order->store_id = $address->store_id;
					    		$order->select_city = $address->select_city;
					    		$order->alt_phone = $address->alt_phone;
					    		$order->long = $address->long;
					    		$order->lat = $address->lat;
					    		$order->place_name = $address->place_name;
					    		$order->landmark = $address->landmark;
					    		$order->payment_id = $paymentChk->id; 
					    		$order->payment_type = $paymentChk->payment_type;  
					    		$order->order_stat = 1;  
					    		$order->order_date = now()->format('d-m-Y');		
				    			$order->save();	

				    			Cart::where('user_id' , Auth::id())
				    				->where('cart_id' , $cart->cart_id)
				    				->delete();
				    			
				    			$productQty = $products->product_in_hand_stock - $cart->qty;	
			    				$productOrderQty = $products->product_order_qty + $cart->qty;
				    			Product::where('product_id',$cart->product_id)
			    					->update(['product_in_hand_stock' => $productQty, 'product_order_qty' => $productOrderQty]);
		    				}	
			    		}
				    	
				    }
	    			else
	    			{
	    				return redirect()->to('apps/order/payment');
	    			}	    			
    			}
    			else
		    	{			    	 			
			    	foreach ($carts as $cart) 
			    	{
			    		$products = Product::find($cart->product_id);
		    			if($products->product_stat == 1 && $products->product_in_hand_stock > 0)
		    			{
				    		$order = new Order;
				    		$order->user_id = Auth::id();
				    		$order->delivery_charges = $delCharges;
				    		$order->delivery_km_charges = $delivery_km_charges; 
				    		$order->product_id = $cart->product_id;
				    		$order->cgst_rate_o = $products->cgst_rate;
				    		$order->sgst_rate_o = $products->sgst_rate;
				    		$order->igst_rate_o = $products->igst_rate;
				    		$order->ugst_rate_o = $products->ugst_rate;
				    		$order->cgst_amount_o = $products->cgst_amount;
				    		$order->sgst_amount_o = $products->sgst_amount;
				    		$order->igst_amount_o = $products->igst_amount;
				    		$order->ugst_amount_o = $products->ugst_amount;
				    		$order->offers = $products->product_offers;
				    		$order->sell_price = $products->product_sell_price;
				    		$order->sell_price_ex_gst = $products->product_sell_price_ex_gst;
				    		$order->sell_price_after_offer = $products->product_sell_price_after_offer;
				    		$order->sell_price_after_offer_ex_gst = $products->product_sell_price_after_offer_ex_gst;
				    		$order->qty = $cart->qty;	
				    		$order->order_id = $random;
				    		$order->distance = $address->distance;	    		
				    		$order->duration = $address->duration;
				    		$order->store_id = $address->store_id;
				    		$order->select_city = $address->select_city;
				    		$order->alt_phone = $address->alt_phone;
				    		$order->long = $address->long;
				    		$order->lat = $address->lat;
				    		$order->place_name = $address->place_name;
				    		$order->landmark = $address->landmark;
				    		$order->payment_id = $paymentChk->id; 
				    		$order->payment_type = $paymentChk->payment_type;  
				    		$order->order_stat = 1;  
				    		$order->order_date = now()->format('d-m-Y');		
			    			$order->save();

			    			Cart::where('user_id' , Auth::id())
			    				->where('cart_id' , $cart->cart_id)
			    				->delete();
			    			$productQty = $products->product_in_hand_stock - $cart->qty;	
			    			$productOrderQty = $products->product_order_qty + $cart->qty;
			    			Product::where('product_id',$cart->product_id)
			    					->update(['product_in_hand_stock' => $productQty, 'product_order_qty' => $productOrderQty]);	
		    			}
			    	}
			    // echo "<pre>";  print_r($carts) echo "</pre>";
			    	
		   		}	
			   		Session::put('carts_details' , null);
			   		Session::put('address' , null);
			   		Session::put('payment_chk', null);	
				    return redirect()->to('apps/order/success'); 
    		}
    			
		    
    	}

    }
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())
             	   ->join('products','orders.product_id','=','products.product_id')
                   ->join('units','products.unit_id','=','units.unit_id')
                   ->join('brands','products.unit_id','=','brands.brand_id')
                   ->orderBy('id', 'desc')
              	   ->get();
         return view('apps.order.order',['orders' => $orders]);
    }
    public function success()
    {
    	return view('apps.order.success');
    }
    public function orderDetails($order_id)
    {
    	$orderDetails = Order::where('order_id' , $order_id) 
    					->join('products','orders.product_id','=','products.product_id')
	                   ->join('units','products.unit_id','=','units.unit_id')
	                   ->join('brands','products.unit_id','=','brands.brand_id')
	                   ->orderBy('id', 'desc')
	              	   ->get();
	    $charges = Charge::select('delivery_charges' , 'min_ordr_amount')->first();
    	return view('apps.order.details',['orderDetails' => $orderDetails, 'charges' => $charges]);
    	// echo "<pre>"; print_r($orderDetails); echo "<pre>?";
    }
    public function orderCancel($order_id,$product_id)
    {
    	$subtotal = 0;
    	$delCharges = Charge::select('id' , 'min_ordr_amount' ,'delivery_charges' ,'delivery_area','delivery_free_area','km_charges')->first();
    	$order = Order::where('order_id','=',$order_id)->get();
    	foreach ($order as $c_order)
    	{
    		if($c_order->product_id != $product_id)
    		{
    			if($c_order->offers > 0)
    			{
    				$subtotal = $subtotal + $c_order->qty*$c_order->sell_price_after_offer;	
    			}
    			else
    			{
    				$subtotal = $subtotal + $c_order->qty*$c_order->sell_price;	
    			}
    		}
    	}
    	if($delCharges->min_ordr_amount > $subtotal )
    	{
    		$cancelorderQty = Order::where('order_id','=',$order_id)
    						->where('product_id','=',$product_id)->first();
    						
	    	$cancel_product = Product::where('product_id','=',$product_id)->first();
	    	$qty = $cancel_product->product_in_hand_stock + $cancelorderQty->qty;		

	    	Product::where('product_id','=',$product_id)->update(['product_in_hand_stock' => $qty]);
	    	Order::where('order_id','=',$order_id)->update(['delivery_charges' => $delCharges->delivery_charges]);

	    	$cancelorder = Order::where('order_id','=',$order_id)
    						->where('product_id','=',$product_id)
    						->update(['order_stat' => 0 ]);
    		return response()->json(['cancelorder' => $cancelorder]); 
    	}
    	else
    	{
    		$cancelorderQty = Order::where('order_id','=',$order_id)
    						->where('product_id','=',$product_id)->first();
    						
	    	$cancel_product = Product::where('product_id','=',$product_id)->first();
	    	$qty = $cancel_product->product_in_hand_stock + $cancelorderQty->qty;		

	    	Product::where('product_id','=',$product_id)->update(['product_in_hand_stock' => $qty]);
	    	
    		$cancelorder = Order::where('order_id','=',$order_id)
    						->where('product_id','=',$product_id)
    						->update(['order_stat' => 0 ]);

    		return response()->json(['cancelorder' => $cancelorder]); 

    	}

    	// return response()->json($subtotal); 
    	
    }

}
