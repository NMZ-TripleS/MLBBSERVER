<?php

namespace App\Http\Controllers;

use App\Energy;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EnergyController extends Controller
{
    //
    public function index(Request $request){
        $id = $request->Uid;
        $energy = Energy::where('user_id',$id)->first();
        if ($energy->energy_count<25){
            $current_date = Carbon::now()->toDateTimeString();
            $old_date = $energy->last_request_time;
            $times = Carbon::parse($current_date)->diffInSeconds(Carbon::parse($old_date));
            $toaddenergy = $times/10;
            $totalenergy = $toaddenergy+$energy->energy_count;
            if ($totalenergy>25){
                $totalenergy = $energy->energy_count=25;
            }else{
                $totalenergy = $energy->energy_count=$energy->energy_count+$toaddenergy;
            }
            $energy->last_request_time = $current_date;
            $energy->save();
            return (int)$totalenergy;
        }
        $current_date = Carbon::now()->toDateTimeString();
        $energy->last_request_time = $current_date;
        $energy->save();
        return 25;

    }
}
