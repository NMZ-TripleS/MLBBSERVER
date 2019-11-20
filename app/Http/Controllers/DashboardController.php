<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class DashboardController extends Controller
{
    //
    public function index()
    {
        return view('dashboard');
    }
    public function reducePoints(Request $request){
        $points = $request->points;
        $stopat = 5;
        if ($points=="10"){
            $stopat=5;
        }else if($points=="20"){
            $stopat=1;
        }else if($points=="30"){
            $stopat=6;
        }
        return Response::json(array(
           'success'=>true,
            'data'=>"points ".$request->points." have been deducted",
            'stopat'=>$stopat
        ));
    }
}
