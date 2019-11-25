<?php

namespace App\Http\Controllers;

use App\Asset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $this->middleware('auth');
        return view('dashboard');
    }
    public function reducePoints(Request $request){
        $points = $request->points;
        $id = $request->id;
        $asset = Asset::where("user_id",$id)->first();
        if ($asset->p_count>=$points){
            $asset->p_count=$asset->p_count-$points;
        }else{
            $stopat=0;
            return Response::json(array(
                'success'=>false,
                'data'=>"You haven't enough point to spin.",
                'stopat'=>$stopat
            ));
        }
        $asset->save();
        $ten = array("1","4","5","8","9","12");
        $twenty = array("2","6","10");
        $thirty = array("3","7","11");
        $stopat = 5;
        if ($points=="10"){
            $stopat=$ten[rand(1,6)];
        }else if($points=="20"){
            $stopat=$twenty[rand(1,3)];
        }else if($points=="30"){
            $stopat=$thirty[rand(1,3)];
        }
        return Response::json(array(
           'success'=>true,
            'data'=>"points ".$request->points." have been deducted",
            'stopat'=>$stopat
        ));
    }
}
