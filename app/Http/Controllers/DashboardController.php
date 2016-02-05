<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class DashboardController extends Controller
{
    /**
     * @return string
     */
    public function index(){
        if(Auth::check()){
            $user = Auth::user();
            if($user->mobile_active == 1 && $user->email_active == 1){
               return Redirect::to('application');
            }
            else {
                return view('dashboard')->with('user', $user);
            }
        }
        else{
            return Redirect::to('/auth/login');
        }
    }

    public function test(){
        return Request::input('name');
    }
}
