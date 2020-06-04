<?php

namespace Grofie\Http\Controllers\apps;

use Illuminate\Http\Request;
use Grofie\Http\Controllers\Controller;
use Grofie\Store;


class StoreController extends Controller
{
    public function show()
    {
    	$stores = Store::orderBy('store_id','ASC')->get();
        return response()->json([ 'stores' => $stores ] );        
    } 
}
