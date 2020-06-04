<?php

namespace Grofie\Http\Controllers\apps;

use Illuminate\Http\Request;
use Grofie\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Validator;
use Grofie\Address;
use Grofie\Charge;
use Grofie\Cart;
use Grofie\User;
use Grofie\Store;
use Session;


class AddressController extends Controller
{
    
    public function index_for_order()
    {        
        $addressCount = Address::where('user_id', Auth::id())->count();
        $delCharges = Charge::select('id' , 'min_ordr_amount' ,'delivery_charges' ,'delivery_area','delivery_free_area','km_charges')->first();
        $address = Address::where('address.user_id', Auth::id())
                            ->join('users','address.user_id','=','users.id')
                            ->join('stores','address.store_id','=','stores.store_id')
                            ->get();
        //this will view all the address           
        return view('apps.address.order.address',['address'=>$address,'delCharges' => $delCharges]);
        //return [$address , $delCharges];  
    } 
    public function add_address(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'store_id' => 'required|not_in:0',
            'alt_phone' => 'required|numeric|regex:/[6-9][0-9]{9}/',
        ],[
            'alt_phone.required' => 'Please enter a Phone number.',                
            'alt_phone.numeric' => 'Please enter a Phone number.',
            'alt_phone.regex' => 'Please enter a Phone number.',
            'store_id.required' => 'Please choose your city.',
            'store_id.not_in' => 'Please choose your city.',
        ]);
        if ($validator->fails())
        {
          return response()->json(['errors' => $validator->errors()]);
        }
        
            $store = Store::find($request->store_id);

            /*MapBox cURL operation Start to get Distance and Duration*/

                //create & initialize a curl session
                $curl = curl_init();

                // set our url with curl_setopt()

                $token = "pk.eyJ1IjoiYW5pcnVkZGhhc2luaGEiLCJhIjoiY2s0MDZ1aG9kMDA1czNtcnM2dDBoNHc1bSJ9.o3LprQ2ywvN1_QQGUTL1uQ";

                curl_setopt($curl, CURLOPT_URL, "https://api.mapbox.com/optimized-trips/v1/mapbox/driving/$request->u_long,$request->u_lat;$store->long,$store->lat?access_token=$token");

                // return the transfer as a string, also with setopt()
                 curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

                // $output contains the output string
                $output = json_decode(curl_exec($curl), true);        
                curl_close($curl);

                //onway communication

                $distance = ($output['trips'][0]['distance'])/2;
                $duration = ($output['trips'][0]['duration'])/2;

            /*MapBox cURL operation End to get Distance and Duration*/

            $address = new Address;
            $address->user_id = $request->user_id;
            $address->distance = $distance;
            $address->duration = $duration;
            $address->select_city = $store->store_name;
            $address->store_id = $request->store_id;
            $address->long = $request->u_long;
            $address->lat = $request->u_lat;
            $address->place_name = $request->input_place_name;
            $address->alt_phone = $request->alt_phone;
            $is_save = $address->save();

            if($is_save){
                return response()->json(['success' => 1]);
            }
            
           

    }
    // Account Address

    public function index_for_account()
    {        
        $addressCount = Address::where('user_id', Auth::id())->count();
        $address = Address::where('address.user_id', Auth::id())
                            ->join('users','address.user_id','=','users.id')
                            ->join('stores','address.store_id','=','stores.store_id')
                            ->get();
        //this will view all the address           
        return view('apps.address.account.address',['address'=>$address]);
        //return [$address , $delCharges];  
    } 

    //destroy adress all
    public function destroy($address_id)
    {
        $del_add = Address::find($address_id)->delete();   
        return response()->json(['delAdd' => $del_add]);      
    } 
   
}