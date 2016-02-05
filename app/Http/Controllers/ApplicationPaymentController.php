<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ApplicationPaymentController extends Controller
{
    //
    /**
     * @return mixed
     */
    public function paymentProcess(){

        if(Auth::check()){
            $user = Auth::user();
        }
        else{

            return Redirect::to('/auth/login');
        }
        $u = $user;
        $applicationData = $user->application;
        return view('application.payment')->with('user',$user)->with('data',$applicationData);
    }
}
