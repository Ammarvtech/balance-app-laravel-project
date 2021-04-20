<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Ixudra\Curl\Facades\Curl;

class DapiController extends Controller
{
     /**
         * Show the application dashboard.
         *
         * @return \Illuminate\Http\Response
         */
        public function getCURL()
        {
        	$response = Curl::to('https://api.dapi.co/v1/auth/login/check')
        	    ->withData([
        	    	'appSecret'=> config('services.dapi.appSecret'), 
        	    	'userSecret'=> config('services.dapi.userSecret'), 
        	    	'connectionID'=> config('services.dapi.connectionID')])
        	    ->withBearer(
        	    	'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzYWx0IjoiRmlHUUhDM2NwZ01NZmhaejNHMk8zNitHakdBUEs0ZFptSEgwRy9jN1cxWT0iLCJhcHBLZXkiOiJkZTk1YjM0MjkyNGQ2YTM2OGE5NmZlM2MyY2U3NzhhMzUyNTQ1ZDgwMmExZDYxOTNlOTRmYzBhYmRhYTZlMGViIiwidG9rZW5JRCI6ImJlNzkzOTgxLTQyMDYtNGQwZi1iYjM1LTIzZTViMzY5MTc0NSIsImF1dGhvcml6YXRpb25zIjp7ImF1dGhlbnRpY2F0aW9uIjp7ImNyZWF0ZSI6dHJ1ZX0sImlkZW50aXR5Ijp7ImdldCI6ZmFsc2V9LCJhY2NvdW50cyI6eyJnZXQiOmZhbHNlfSwiYmFsYW5jZSI6eyJnZXQiOmZhbHNlfSwidHJhbnNhY3Rpb25zIjp7ImdldCI6ZmFsc2V9LCJiZW5lZmljaWFyaWVzIjp7ImdldCI6ZmFsc2UsImNyZWF0ZSI6ZmFsc2V9LCJ0cmFuc2ZlciI6eyJjcmVhdGUiOmZhbHNlfSwiY2FyZHMiOnsiZ2V0IjpmYWxzZX0sInN0YXRlbWVudHMiOnsiZ2V0IjpmYWxzZX0sInByb2R1Y3RzIjpbImRhdGEiXX0sImlhdCI6MTYxMTgyNTA4Nn0.sZmJv8MFks_aZA1ODzzfHpkvMW2eodK84Vb6DoY2KA0')
        	    ->withContentType('application/json')
        	    ->asJson( true )
        	    ->post();
            dd($response);
        }

         public function exchangeToken(Request $request)
        {//1
            $response = Curl::to('https://api.dapi.co/v1/auth/ExchangeToken')
                ->withData([
                    'appSecret'=> config('services.dapi.appSecret'), 
                    'accessCode'=> $request->accessCode, 
                    'connectionID'=> $request->connectionID])
                ->withContentType('application/json')
                ->asJson( true )
                ->post();
            dd($response);
        }



        public function verifyToken(Request $request){

        	dd("here");

        	//2 https://api.dapi.co/v1/data/Identity/get
        	//3 https://api.dapi.co/v1/data/accounts/get
        	//4 https://api.dapi.co/v1/data/balance/get
        	$accessCode = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzYWx0IjoiRmlHUUhDM2NwZ01NZmhaejNHMk8zNitHakdBUEs0ZFptSEgwRy9jN1cxWT0iLCJhcHBLZXkiOiJmODFhODFjZDk5ZTg5MGRkN2FhY2FmNjk0ZjkzNDM3ZWNkMWRmZjdhNzlkMDgxYTcyOWMwOGI2OWJmNDhhMTgyIiwidG9rZW5JRCI6IjFlZDUwMDFjLTBhODMtNDdmNy1iM2ZiLWNkYjFhMTIzZWY0MiIsImlhdCI6MTYxMTkzMDMwMiwiZXhwIjoxNjExOTMwNjAyfQ.UG_AsUpAoYCvYFFG4NzsRy3dUQ0_hR8KWpBlcd0_6VE';
        	$userSecret = 'fV1oYeWVLNfchThkXCzKjzDwBf8Uu0eBBSrMB2o7xNWFJgd0aRt6diHHFvBdrTG9Pze9PWTPHjiS7OofVnrO1646acfnjTvmV+0/qWLGii0CAe41d/TrQR5mghLHYNo/TadFFsvClGWFVwdsScocctvqCxGldokdqhZ0Q1umTgBEJJY4JdcXKZz6mHHBxR+mfQa4MP9ePWgF/wSdalVGn7yo/5ZD3vdtgwAF1dyUu0I9aCGcP7EaUL/LmAU/FfGET8DxfBAO50Y0m/EAGpVDD52obygrQROuWx5hbGLRpSabU4jZcVTCYkkQLQqbCkyu1NfJsX0VMxzzRmOtaW3yvGXTPxBd0/XySi3LcVK3uPjueKocrVv0Yx9lqspRLUwYcNYF1fK135864AYiXt5LgZJVU5E8I8knlKfm4KmHC6NNNTm3t2mMkTMBpzh3UVCKkjocbMin+I5BZYFEY20MLNGbE1+Xy0KqfbxID9CzfhBiOGYwBoswZLItTLxo1Mk6jktcUhm84MaLiV1T2VHUvUD1ojVpEF0uCjKC8TcUAaZBGcqlabh3uXiFWkFNURTetPcFQqSC9dV6FCTcy8QFpaqhTNIM3pgAQf9ffEei+tG0k42z+5GnLuvnOgymswNjweCRcP9RKEOHPpUaF/YNHDQGA84tl+0u2ahVzwlDBt4=';

        	$response = Curl::to('https://api.dapi.co/v1/data/balance/get')
                ->withData([
                    'appSecret'=> config('services.dapi.appSecret'), 
                    'userSecret'=> $userSecret, 
                    'accountID' => 'ntV7rbYoexYaGDRfLCAo8vw1xXgu2VaXXtqvNoMU0sfy6aNErfUEGMD+P6lAlkzu/GKxPeoef7d7eNoxlHKyRw==',
                    'sync'=> true])
                ->withBearer('eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzYWx0IjoiRmlHUUhDM2NwZ01NZmhaejNHMk8zNitHakdBUEs0ZFptSEgwRy9jN1cxWT0iLCJhcHBLZXkiOiJmODFhODFjZDk5ZTg5MGRkN2FhY2FmNjk0ZjkzNDM3ZWNkMWRmZjdhNzlkMDgxYTcyOWMwOGI2OWJmNDhhMTgyIiwidG9rZW5JRCI6IjFlZDUwMDFjLTBhODMtNDdmNy1iM2ZiLWNkYjFhMTIzZWY0MiIsImF1dGhvcml6YXRpb25zIjp7ImF1dGhlbnRpY2F0aW9uIjp7ImNyZWF0ZSI6dHJ1ZX0sImlkZW50aXR5Ijp7ImdldCI6ZmFsc2V9LCJhY2NvdW50cyI6eyJnZXQiOmZhbHNlfSwiYmFsYW5jZSI6eyJnZXQiOmZhbHNlfSwidHJhbnNhY3Rpb25zIjp7ImdldCI6ZmFsc2V9LCJiZW5lZmljaWFyaWVzIjp7ImdldCI6ZmFsc2UsImNyZWF0ZSI6ZmFsc2V9LCJ0cmFuc2ZlciI6eyJjcmVhdGUiOmZhbHNlfSwiY2FyZHMiOnsiZ2V0IjpmYWxzZX0sInN0YXRlbWVudHMiOnsiZ2V0IjpmYWxzZX0sInByb2R1Y3RzIjpbImRhdGEiLCJwYXltZW50Il19LCJpYXQiOjE2MTE5MzAzMDl9._uJgNgj3_a7ydfBjNpyer8tUkpu4okVnJOkkZWCWZCE')
                ->withContentType('application/json')
                ->asJson( true )
                ->post();
            dd($response);
        }



        // public function getCURL()
        // {
        //    /* API URL */
        //    $url = 'https://api.dapi.co/v1/auth/login/check';
              
        //    /* Init cURL resource */
        //    $ch = curl_init($url);
             
        //    /* Array Parameter Data */
        //    $data = ['appSecret'=>'102320a96fbf28e6e6b6caf431f467dad6edb1e72ecd1bde6d19a40f9e22fd3ed66178e08bca4fcff9ab47bdff4f8fee6caec02227e74bd69a73a1ea0a174889d2fa52ef88d2025fcf2fd206556a77764c3b9237d017f68bfb33b3e6edc68a30f6c4236bc9b724f71ceb82bd7e0ab1bd0fd247dd6023a2a76577c896fc18d421', 'accessCode'=>'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzYWx0IjoiRmlHUUhDM2NwZ01NZmhaejNHMk8zNitHakdBUEs0ZFptSEgwRy9jN1cxWT0iLCJhcHBLZXkiOiJkZTk1YjM0MjkyNGQ2YTM2OGE5NmZlM2MyY2U3NzhhMzUyNTQ1ZDgwMmExZDYxOTNlOTRmYzBhYmRhYTZlMGViIiwidG9rZW5JRCI6ImUxOTIwZTRlLWE3MGItNDBmOS04NDk2LTdjNTAyMWRmNmQ2YiIsImlhdCI6MTYxMTgyMTAxMCwiZXhwIjoxNjExODIxMzEwfQ.Hrp7rM_kbh2gm_MewWdO-cYnVcPVHyk7vKrsWtYaM-Y','connectionID'=>'be349498d133f44b3587944becc86b368e78c4f9'];
             
        //    /* pass encoded JSON string to the POST fields */
        //    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        //    $authorization = "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzYWx0IjoiRmlHUUhDM2NwZ01NZmhaejNHMk8zNitHakdBUEs0ZFptSEgwRy9jN1cxWT0iLCJhcHBLZXkiOiJkZTk1YjM0MjkyNGQ2YTM2OGE5NmZlM2MyY2U3NzhhMzUyNTQ1ZDgwMmExZDYxOTNlOTRmYzBhYmRhYTZlMGViIiwidG9rZW5JRCI6ImJlNzkzOTgxLTQyMDYtNGQwZi1iYjM1LTIzZTViMzY5MTc0NSIsImF1dGhvcml6YXRpb25zIjp7ImF1dGhlbnRpY2F0aW9uIjp7ImNyZWF0ZSI6dHJ1ZX0sImlkZW50aXR5Ijp7ImdldCI6ZmFsc2V9LCJhY2NvdW50cyI6eyJnZXQiOmZhbHNlfSwiYmFsYW5jZSI6eyJnZXQiOmZhbHNlfSwidHJhbnNhY3Rpb25zIjp7ImdldCI6ZmFsc2V9LCJiZW5lZmljaWFyaWVzIjp7ImdldCI6ZmFsc2UsImNyZWF0ZSI6ZmFsc2V9LCJ0cmFuc2ZlciI6eyJjcmVhdGUiOmZhbHNlfSwiY2FyZHMiOnsiZ2V0IjpmYWxzZX0sInN0YXRlbWVudHMiOnsiZ2V0IjpmYWxzZX0sInByb2R1Y3RzIjpbImRhdGEiXX0sImlhdCI6MTYxMTgyNTA4Nn0.sZmJv8MFks_aZA1ODzzfHpkvMW2eodK84Vb6DoY2KA0";
             
        //    /* set the content type json */
        //    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        //                'Content-Type:application/json',
        //                 $authorization
        //     ));
             
        //    /* set return type json */
        //    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
             
        //    /* execute request */
        //    $result = curl_exec($ch);
        //    //dd($result);
        //    /* close cURL resource */
        //    curl_close($ch);
        // }


        ///////////////***Dapi Api's [Authentication]***\\\\\\\\\\\\\\\\\\\\\\
        public function dapiAuth(){
           $response = Curl::to('https://api.blockcypher.com/v1/eth/main/addrs?token=YOURTOKEN')->post();
           dd($response);
        }

        ///////////////***End-Dapi Api's [Authentication]***\\\\\\\\\\\\\\\\\\\


        ///////////////***CURL Post Request***\\\\\\\\\\\\\\\\\\\\\\
        // public function getCURL()
        // {

        //     $response = Curl::to('https://example.com/posts')

        //                 ->withData(['title'=>'Test', 'body'=>'sdsd', 'userId'=>1])

        //                 ->post();

        //     dd($response);

        // }

        ///////////////***CURL Put Request:***\\\\\\\\\\\\\\\\\\\\\\
        //public function getCURL()

        // {

        //     $response = Curl::to('https://example.com/posts/1')


    		//                 ->withData(['appSecret'=>'102320a96fbf28e6e6b6caf431f467dad6edb1e72ecd1bde6d19a40f9e22fd3ed66178e08bca4fcff9ab47bdff4f8fee6caec02227e74bd69a73a1ea0a174889d2fa52ef88d2025fcf2fd206556a77764c3b9237d017f68bfb33b3e6edc68a30f6c4236bc9b724f71ceb82bd7e0ab1bd0fd247dd6023a2a76577c896fc18d421', 'accessCode'=>'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzYWx0IjoiRmlHUUhDM2NwZ01NZmhaejNHMk8zNitHakdBUEs0ZFptSEgwRy9jN1cxWT0iLCJhcHBLZXkiOiJkZTk1YjM0MjkyNGQ2YTM2OGE5NmZlM2MyY2U3NzhhMzUyNTQ1ZDgwMmExZDYxOTNlOTRmYzBhYmRhYTZlMGViIiwidG9rZW5JRCI6ImUxOTIwZTRlLWE3MGItNDBmOS04NDk2LTdjNTAyMWRmNmQ2YiIsImlhdCI6MTYxMTgyMTAxMCwiZXhwIjoxNjExODIxMzEwfQ.Hrp7rM_kbh2gm_MewWdO-cYnVcPVHyk7vKrsWtYaM-Y', 'connectionID'=>'be349498d133f44b3587944becc86b368e78c4f9'])

    		//                 ->post();



        //                 ->withData(['title'=>'Test', 'body'=>'sdsd', 'userId'=>1])

        //                 ->patch();

        //     dd($response);

        // }
        ///////////////***CURL Delete Request:***\\\\\\\\\\\\\\\\\\\\\\
        // public function getCURL()

        // {

        //     $response = Curl::to('https://example.com/posts/1')

        //                 ->delete();

        //     dd($response);

        // }
        ///////////////***CURL Post Request***\\\\\\\\\\\\\\\\\\\\\\
        ///////////////***CURL Post Request***\\\\\\\\\\\\\\\\\\\\\\
        //     dd($response);

        // }
        ///////////////***CURL Patch Request:***\\\\\\\\\\\\\\\\\\\\\\
        // public function getCURL()

        // {

        //     $response = Curl::to('https://example.com/posts/1')
}
