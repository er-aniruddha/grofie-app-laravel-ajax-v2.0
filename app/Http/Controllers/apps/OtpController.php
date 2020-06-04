<?php

namespace Grofie\Http\Controllers\apps;

use Illuminate\Http\Request;
use Grofie\Http\Controllers\Controller;

class OtpController extends Controller
{
    public function otp()
    {
    	$otp = mt_rand('1000','9999');  
        // $url="https://www.way2sms.com/api/v1/sendCampaign";
        // $message = urlencode('Hi, This is your OTP for register to store :'. $otp );// urlencode your message
        // $curl = curl_init();
        // curl_setopt($curl, CURLOPT_POST, 1);// set post data to true
        // curl_setopt($curl, CURLOPT_POSTFIELDS, "apikey=UF2R1HMFGDFBTSSS1X6QAVADDTBTL5G4&secret=C1QGFRQ44SC1P6CD&usetype=stage&phone=$number&senderid=aniruddhasinhaece@gmail.com&message=$message");// post data
        // // query parameter values must be given without squarebrackets.
        //  // Optional Authentication:
        // curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        // curl_setopt($curl, CURLOPT_URL, $url);
        // curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        // $result = curl_exec($curl);
        // curl_close($curl);
        Session::put('otp',$otp);
        Session::put('users', $users);
        return view('apps.auth.mobile_login');
    }
}
