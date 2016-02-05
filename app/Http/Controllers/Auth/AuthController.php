<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Request;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';


    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|alpha_num|min:5',
            'email' => 'required|email|max:255',
            'mobile_number'=>'required|min:10',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        if(User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'mobile_number' => $data['mobile_number'],
            'password' => bcrypt($data['password']),
            'mobile_code' => $data['mobile_code'],
            'email_code' => $data['email_code'],
        ])){
            return !0;
        }
        else{
            return !1;
        }
    }

    public function getRegister(){

        return view('auth.register');
    }

    /**
     *
     */
    public function postRegister(){
        $input = Request::all();
        //return $input;
        $valid=$this->validator($input);
        //return ($valid->fails());
       //var_dump($valid);
        if(User::where('username',$input['username'])->exists()){
            return 'user exists';
        }
        elseif(User::where('email',$input['email'])->exists()){
            return 'email exists';
        }
        elseif(User::where('mobile_number',$input['mobile_number'])->exists()){
            return 'phone exists';
        }

        if($valid->fails()){
            return view('auth.register')->withErrors($valid);

        }
        //$input['status'] = '0';
        $input['email_code'] = rand(2000,9999);
        $input['mobile_code'] = rand(3000,9999);
        if($this->create($input)){
            //Email Activation Code
            //SMS Mobile Activation Code
            if(Auth::attempt(['email' => $input['email'],'password'=>$input['password']])){
                $user = Auth::user();
                Mail::queue(['html' => 'emails.registration'], ['user' => $user,'purpose'=>'Account created'], function ($m) use ($user) {
                    $m->from('citadmission@cit.ac.in', 'CIT Admission 2016');

                    $m->to($user->email, $user->username)->subject('Account created CIT Admission 2016');
                });
                $sms_key = env('SMS_API_KEY','30456B3180D00208553');
                $message = '{Your+SMS+Activation+Code+for+CIT+Kokrajhar+'.$input['mobile_code'].'}';
                file_get_contents('http://shortcode.hulksms.com/sms/api/http/send.php?api_key='.$sms_key.'&numbers='.$user->mobile_number.'&message='.$message.'&senderid="CITKOK"');
                return Redirect::to('dashboard');
            }
            else{
                return Redirect::to('auth/login');
            }


        }else{
            return view('auth.register')->with('errors','Error while creating account');
        }


    }
    public function getLogin(){

        return view('auth.login');
    }
    public function postLogin(){

        $input=Request::all();
        if (Auth::attempt(['email' => $input['login'], 'password' => $input['password']])) {
            // Authentication passed...
            return Redirect::to('dashboard');
        }
        elseif (Auth::attempt(['mobile_number' => $input['login'], 'password' => $input['password']])) {
            // Authentication passed...
            return Redirect::to('dashboard');
        }
        elseif (Auth::attempt(['id' => $input['login'], 'password' => $input['password']])) {
            // Authentication passed...
            return Redirect::to('dashboard');
        }
        elseif (Auth::attempt(['username' => $input['login'], 'password' => $input['password']])) {
            // Authentication passed...
            return Redirect::to('dashboard');
        }
        else{
            return view('auth.login')->with('error','Login credentials incorrect');
        }


    }

    /**
     *
     */
    public function getLogout(){

        Auth::logout();
        //Redirect::to('/');
        return Redirect::to('/auth/login');
    }

    /**
     * @param $appId
     * @param $mobileCode
     * @return string
     */
    public function mobileActivate($appId, $mobileCode){
        $user = User::find($appId);
        if(empty($user)){
            return 'Sorry! Wrong credentials....!';
        }
        else{
            if($user->mobile_code == $mobileCode){
                $mobileCode = rand(0,909909);
                $user->update(['mobile_active' => '1','mobile_code' => $mobileCode]);
                return Redirect::to('dashboard');
            }
            else{
                return 'Code incorrect';
            }
        }
    }

    public function emailActivate($appId, $emailCode){
        $user = User::find($appId);
        if(empty($user)){
            return 'Sorry! Wrong credentials....!';
        }
        else{
            if($user->email_code == $emailCode){
                $emailCode = rand(0,9099909);
                $user->update(['email_active' => '1', 'email_code' => $emailCode]);
                Mail::queue(['html' => 'emails.activated'], ['user' => $user], function ($m) use ($user) {
                    $m->from('citadmission@cit.ac.in', 'CIT Admission 2016');

                    $m->to($user->email, $user->username)->subject('Email activated CIT Admission 2016');
                });
                return Redirect::to('dashboard');
            }
            else{
                return 'Code incorrect';
            }
        }
    }

    /**
     * @return string
     */
    public function postEmailActivate(){
        if(Auth::check()){
            $user = Auth::user();
        }
        else{

            return Redirect::to('auth/login');
        }
        $input = Request::all();

        if($user->email_code == $input['email_code']){
            $emailCode = rand(0,9099909);
            $user->update(['email_active' => '1', 'email_code' => $emailCode]);
            Mail::queue(['html' => 'emails.activated'], ['user' => $user], function ($m) use ($user) {
                $m->from('citadmission@cit.ac.in', 'CIT Admission 2016');

                $m->to($user->email, $user->username)->subject('Email activated CIT Admission 2016');
            });
            return Redirect::to('dashboard');
        }
        else{
            return 'Code incorrect';
        }

    }

    public function postMobileActivate(){
        if(Auth::check()){
            $user = Auth::user();
        }
        else{

            return Redirect::to('auth/login');
        }
        $input = Request::all();

        if($user->mobile_code == $input['mobile_code']){
            $mobileCode = rand(0,9099909);
            $user->update(['mobile_active' => '1', 'mobile_code' => $mobileCode]);
            return Redirect::to('dashboard');
        }
        else{
            return 'Code incorrect';
        }

    }

    public function mobileCodeResend(){
        if(Auth::check()){
            $user = Auth::user();
        }
        else{

            return Redirect::to('auth/login');
        }
        if($user->mobile_active == 0) {
            $mobileCode = $user->mobile_code;
            //code to send to mobile
        }
        else{
            return Redirect::to('dashboard');
        }

    }

    public function emailCodeResend(){
        if(Auth::check()){
            $user = Auth::user();
        }
        else{

            return Redirect::to('auth/login');
        }

        if($user->email_active == 0) {
            //$emailCode = $user->email_code;
            Mail::queue(['html' => 'emails.registration'], ['user' => $user,'purpose'=>'Email Activation Code'], function ($m) use ($user) {
                $m->from('citadmission@cit.ac.in', 'CIT Admission 2016');

                $m->to($user->email, $user->username)->subject('Email activation Code CIT Admission 2016');
            });
            return Redirect::to('dashboard');
        }
        else{
            return Redirect::to('dashboard');
        }
    }


}
