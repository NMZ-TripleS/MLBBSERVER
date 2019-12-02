<?php

namespace App\Http\Controllers;

use App\Achievement;
use App\Asset;
use App\ClaimeAchievement;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
            $stopat=$ten[rand(0,5)];
        }else if($points=="20"){
            $stopat=$twenty[rand(0,2)];
        }else if($points=="30"){
            $stopat=$thirty[rand(0,2)];
        }
        return Response::json(array(
           'success'=>true,
            'data'=>"points ".$request->points." have been deducted",
            'stopat'=>$stopat
        ));
    }
    public function claimAche($id){
        $dcount = Achievement::find($id)->first()->d_amount;
        $asset = Asset::where('user_id',Auth::user()->id)->first();
        $asset->d_count = $asset->d_count+$dcount;
        $asset->t_d_count = $asset->t_d_count+$dcount;
        $asset->save();
        ClaimeAchievement::create([
            "user_id"=>Auth::user()->id,
            "achievement_id"=>$id
        ]);
        return back();
    }
}
