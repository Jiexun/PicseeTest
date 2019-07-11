<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function picsee()
    {
        $url = $_GET['url'];

        $postdata = array(
            "url"           => $url,
            "externalId"    => 'customer_test_1',
        );

        $data_string = json_encode($postdata);

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://api.pics.ee/v1/links/?access_token=20f07f91f3303b2f66ab6f61698d977d69b83d64');

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLINFO_HEADER_OUT, true);

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        // curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/plain'));
        $response = curl_exec($ch); // 回傳 access_token
        $info = curl_getinfo($ch);

        curl_close($ch);

        $response = json_decode($response,true);
        // echo "<pre>";print_r($response);exit;

        return response()->json(array('url'=> $response['data']['picseeUrl']), 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

}
