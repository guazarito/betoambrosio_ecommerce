<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Mobile_Detect;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Mobile_Detect $detect)
    {
      
        if ( $detect->isMobile() ) {
           $isMobile= true;
        }else{
            $isMobile= false;
        }
        return view('homeLoja', compact('isMobile'));
    }
}
