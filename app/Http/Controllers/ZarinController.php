<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Zarinpal\Zarinpal;

class ZarinController extends Controller
{
    public function Payment()
    {
        $user = Auth::user();
        $lessons = $user->lessons;
        $result= [];
        foreach ($lessons as $lesson){
            if($lesson->pivot->bought == 0){
                $result[] = $lesson;
            }
        }
        $lessons = collect($result);
        $desc = 'خریدهای '.$user->full_name;
        $test = new Zarinpal('0929e80a-00a1-11e7-88d6-005056a205be');
        //dd($test);
        echo json_encode($answer = $test->request('http://amar7.dev/payment-result',$lessons->sum('cost'),$desc));
        //dd($answer);
        if(isset($answer['Authority'])) {
            file_put_contents('Authority',$answer['Authority']);
            $test->redirect();
        }
    }

    public function PaymentVerify(){
        $user = Auth::user();
        $lessons = $user->lessons;
        $result= [];
        foreach ($lessons as $lesson){
            if($lesson->pivot->bought == 0){
                $result[] = $lesson;
            }
        }
        $lessons = collect($result);
        $test = new Zarinpal('0929e80a-00a1-11e7-88d6-005056a205be');
        $answer['Authority'] = file_get_contents('Authority');
        echo json_encode($test->verify('OK',$lessons->sum('cost'),$answer['Authority']));
        $Authority = $_GET['Authority'];
        $Status = $_GET['Status'];
        if($Status == 'OK' && $Authority == $answer['Authority']){
            foreach ($user->lessons as $lesson){
                $lesson->pivot->bought = 1;
                $lesson->pivot->save();
            }
            return redirect('/user-courses');
        }else{
            return redirect('/cart');
        }
    }
}
