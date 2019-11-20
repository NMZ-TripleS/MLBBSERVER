<?php

namespace App\Http\Controllers;

use App\Asset;
use App\Questions;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //

    public function userLogin(Request $request){
        $username = $request->username;
        $password = $request->password;
        if(Auth::attempt(['email'=>$username,"password"=>$password])){
            $user = Auth::user();
            $token = $user->createToken("myApp")-> accessToken;
            return response()->json(['success'=>"true","message"=>"Login Successfully!","api_key"=>$token,"data"=> $user], 200);
        } else{
            return response()->json(['success'=>"false","message"=>"This credential is not our one","api_key"=>"no token","data"=> ["id"=>"","name"=>"","email"=>"","game_id"=>""]], 200);
        }
    }
    public function userRegister(Request $request){
        $validator = Validator::make($request->all(),
            [   "name" => "required",
                "email" => "required|email",
                "password"=> "required",
            ]);

        if ($validator->fails()) {
            return response()->json(["success"=>"fail","message"=>"Errors".$validator->errors(),"data"=>["name"=>"","email"=>""]], 200);
        }
        $input = $request->all();
        $input["password"] =Hash::make($input["password"]);


        $user = User::create($input);
        Asset::create([
            'user_id'=>$user->id
        ]);
        return response()->json(["success"=>"true","message"=>"Register Successfully","data"=>$user], 200);
    }
    public function getAssets(Request $request){
        $data = Asset::where('user_id',$request->id)->get();
        return response()->json(["success"=>"true","message"=>"Register Successfully","data"=>$data], 200);
    }
    public function getTopUers(Request $request){
        $topusers = User::leftJoin('assets','users.id','=','assets.user_id')
            ->select('users.name','assets.t_d_count')
            ->orderBy('assets.t_d_count')
            ->limit(10)
            ->get();
        return response()->json(["success"=>"true","message"=>"Top 10 user data!","data"=>$topusers], 200);
    }
    public function getQuestionSet(Request $request){
        $question = Questions::all()->random(5);
        return response()->json(["success"=>"true","message"=>"Top 10 user data!","data"=>$question], 200);
    }
    public function updateQuestion(Request $request){
        if ($request->answer == "right") {
            Questions::increment('right_count');
            return response()->json(["success"=>"true","message"=>"Top 10 user data!","data"=>[]], 200);
        }else{
            Questions::increment('wrong_count');
        }
    }
}
