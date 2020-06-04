<?php

namespace Grofie\Http\Controllers\apps;

use Illuminate\Http\Request;
use Grofie\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Grofie\Payment;
use Grofie\Address;
use Session;

class PaymentController extends Controller
{
    public function index($address_id,$del_charge)
    {    	  	
    	$address = Address::find($address_id);
        Session::put('km_charges',$del_charge);// this charge for KM wise rate
        Session::put('address',$address);// this is to store user select address into order table
    	return view('apps.order.payment');
    }
 
	public function codPayment()
	{
		$codPayment = new Payment;
		$codPayment->user_id = Auth::id();
		$codPayment->payment_type = 'COD';
		$codPayment->save();
		Session::put('payment_chk',$codPayment);	
		return redirect()->route('apps.order.confirm');	
	}
}
