<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Zarinpal\Zarinpal;

class ZarinController extends Controller
{
    public function Payment(Request $request)
    {
        $input = $request->all();
        $test = new Zarinpal('0929e80a-00a1-11e7-88d6-005056a205be');
        //dd($test);
        echo json_encode($answer = $test->request('http://amar7.dev/payment-result',1000,'testing'));
        //dd($answer);
        if(isset($answer['Authority'])) {
            file_put_contents('Authority',$answer['Authority']);
            $test->redirect();
        }
    }

    public function PaymentVerify(){
        $test = new Zarinpal('0929e80a-00a1-11e7-88d6-005056a205be');
        $answer['Authority'] = file_get_contents('Authority');
        echo json_encode($test->verify('OK',1000,$answer['Authority']));
        $Authority = $_GET['Authority'];
        $Status = $_GET['Status'];
        if($Status == 'OK' && $Authority == $answer['Authority']){
            return redirect('/user-courses');
        }else{
            return redirect('/cart');
        }
    }
}
