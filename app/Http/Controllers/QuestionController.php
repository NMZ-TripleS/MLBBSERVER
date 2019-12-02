<?php

namespace App\Http\Controllers;

use App\Asset;
use App\Questions;
use App\User;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function answerQuestion(Request $request){
        //api_key , points , questions id , right or wrong
        $api_key = $request->token;
        $points = $request->points;
        $questions_id="";
        $questions_id = $request->question_id;
        $questions_id_arr = explode(',', $questions_id);;
        $results = "";
        $results = $request->result;
        $user_id = $request->uid;
        $asset = Asset::where('user_id',$user_id)->first();
        $asset->p_count=$asset->p_count+$points;
        $asset->t_p_count=$asset->t_p_count+$points;
        $asset->save();
        for ($i=0;$i<count($questions_id_arr);$i++){
            $question = Questions::where("id",$questions_id_arr[$i])->first();
            if ($results[$i]=="1")
                {
                    $question->right_count = $question->right_count+1;
                }else{
                    $question->wrong_count = $question->wrong_count+1;
                }
            $question->save();
        }
        return "true";
    }
}
