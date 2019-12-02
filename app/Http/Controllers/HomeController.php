<?php

namespace App\Http\Controllers;

use App\Achievement;
use App\Asset;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $id = Auth::user()->id;
        $asset = Asset::where("user_id",$id)->first();
        $achievements = $this->getAchievements($id);
        return  view('home')->with(['points'=>$asset->p_count,'diamonds'=>$asset->d_count,"achievements"=>$achievements]);
    }
    public function gA(Request $request){
        return $this->getAchievements($request->id);
    }public function getAchievements($id){
        $user = User::find($id);
        $achievements = array();
        $asset = Asset::where('user_id',$id)->first();
        $ca = DB::table("claime_achievements")
            ->where('user_id',"=",$id)
            ->select('achievement_id');
        $tpachievement = Achievement::where('t_p_count','<=',$asset->t_p_count)
            ->where('t_p_count','!=',0)
            ->whereNotIn("id",$ca)
            ->get();
        foreach ($tpachievement as $achievement){
            array_push($achievements,$achievement);
        }
            $raachievement = Achievement::where('r_a_count','<=',$user->come_web)
                ->where('r_a_count','!=',0)
                ->whereNotIn("id",$ca)
                ->get();
            foreach ($raachievement as $achievement){
                array_push($achievements,$achievement);
            }
            $taachievement = Achievement::where('t_a_count','<=',$user->come_mobile)
                ->where('t_a_count','!=',0)
                ->whereNotIn("id",$ca)
                ->get();
            foreach ($taachievement as $achievement){
                array_push($achievements,$achievement);
            }
        return $achievements;
    }

}
