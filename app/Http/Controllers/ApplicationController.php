<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;

use App\Application;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Request;

class ApplicationController extends Controller
{
    //
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    protected $fields = [
        "form_number"=>"",
        "first_name"=>"",
        "middle_name"=>"",
        "last_name"=>"",
        "guardian_name" =>"",
        "dob" =>"",
        "gender" =>"Male",
        "eligibility" =>1 ,
        "region_code" =>"",
        "category" => "",
        "entry_scheme" =>"",
        "center" =>"",
        "center_2" =>"",
        "center_3" => "",
        "nationality"=>1,
        "email" =>"",
        "mobile_number"=>"",
        "alternate_phone"=>"",
        "ca_care_of" =>"",
        "ca_village_town"=>"",
        "ca_post_office" =>"",
        "ca_district" =>"",
        "ca_state" =>"",
        "ca_pin" =>"",
        "pa_care_of" =>"",
        "pa_village_town" =>"",
        "pa_post_office" =>"",
        "pa_district" =>"",
        "pa_state"=>"",
        "pa_pin"=>""

    ];

    /**
     * @param $r
     * @return mixed
     * Application Status can be
     * 0 - Application not yet created
     * 111 - just saved but not submitted for preview
     * 222 - save available for preview
     * 333 - Finalize the application and ready for photo upload
     * 444 - photo submitted and preview available
     * 555 - photo and application submission finalize
     * 666 - payment made already its available in transaction table
     */
    protected function checkApplicationStatus($r){
        $data = $r;
        if($data['application_status']==0){

        }
        elseif($data['application_status']==111){
            return Redirect::to('application/edit');
        }
        elseif($data['application_status']==222){
            return Redirect::to('application/preview');

        }
        elseif($data['application_status']==333){

            return Redirect::to('application/photo');
        }
        elseif($data['application_status']==444){

            return Redirect::to('application/photo/preview');
        }
        elseif($data['application_status']==555){

            return Redirect::to('application/payment');
        }
        else{

            return Redirect::to('/application/preview/whole');
        }
        //$regdata=$user->application->toArray();

    }

    public function index(){
        if(Auth::check()){
            $user = Auth::user();
        }
        else{

            return Redirect::to('/auth/login');
        }
        $u = $user;
        //return ($user->application);
        //return ($user);
       // return var_dump($user,$regdata);
        $r=$user->application;
        $data=$r;
        if(!empty($r)){
            $data = $r;
            if($user->mobile_active == 0 || $user->email_active == 0){
                return view('dashboard')->with('user', $user);
            }
            elseif($data['application_status']==0){

            }
            elseif($data['application_status']==111){
                return Redirect::to('application/edit');
            }
            elseif($data['application_status']==222){
                return Redirect::to('application/preview');

            }
            elseif($data['application_status']==333){

                return Redirect::to('application/photo');
            }
            elseif($data['application_status']==444){

                return Redirect::to('application/photo/preview');
            }
            elseif($data['application_status']==555){

                return Redirect::to('application/payment');
            }
            else{

                return Redirect::to('/application/preview/whole');
            }
            $regdata=$user->application->toArray();
        }
        else{
            if($user->mobile_active == 0 || $user->email_active == 0){
                return view('dashboard')->with('user', $user);
            }
            $regdata=$this->fields;
        }
        //return $regdata;
        return view('application')->with('user',$u)->with('regdata',$regdata);
    }

    /**
     * @return mixed
     */
    public function edit(){
        if(Auth::check()){
            $user = Auth::user();
        }
        else{

            return Redirect::to('/auth/login');
        }

        //return ($user->application);
        //return ($user);
        // return var_dump($user,$regdata);
        $u = $user;
        $r=$user->application;
        $page = Application::find($user->id);
        $page->application_status = 111;
        $page->update();
        $data = $r;
        if(!empty($r)){
            //$this->checkApplicationStatus($r);
            /*
            if($data['application_status']==0){

            }
            elseif($data['application_status']==111){
                return Redirect::to('application/edit');
            }
            elseif($data['application_status']==222){
                return Redirect::to('application/preview');

            }
            elseif($data['application_status']==333){

                return Redirect::to('application/preview/whole');
            }
            else{

                return Redirect::to('/application/preview');
            }
            */
            $regdata=$r->toArray();
        }
        else{
            $regdata=$this->fields;
        }
        //return $regdata;
        return view('application.edit')->with('user',$u)->with('regdata',$regdata);

    }

    public function save(){
        if(Auth::check()){
            $user = Auth::user();
        }
        else{

            return Redirect::to('/auth/login');
        }
        $input = Request::all();
        $input['user_id'] =$user->id;
        Application::create($input);
        return Redirect::to('application/preview');
        //return $input;
    }

    public function update(){
        $id = Request::get('id');
        $application = Application::findOrFail($id);
        $application->update(Request::all());
        $data = $application->toArray();
        //return $data;
        if($data['application_status']==0){

        }
        elseif($data['application_status']==111){
            return Redirect::to('application/edit');
        }
        elseif($data['application_status']==222){
            return Redirect::to('application/preview');

        }
        elseif($data['application_status']==333){

            return Redirect::to('application/photo');
        }
        elseif($data['application_status']==444){

            return Redirect::to('application/preview/whole');
        }
        elseif($data['application_status']==555){

            return Redirect::to('application/payment');
        }
        else{

            return Redirect::to('/application/preview/whole');
        }
    }

    public function preview(){
        if(Auth::check()){
            $user = Auth::user();
        }
        else{

            return Redirect::to('/auth/login');
        }
        //$user=User::findOrFail(1);
        $u=$user;
        //return ($user->application);
        //return ($user);
        // return var_dump($user,$regdata);
        $r=$user->application;
        $data = $r;
        if(!empty($r)){
            //$this->checkApplicationStatus($r);
            //$data = $application->toArray();
            //return $data;
            if($user->mobile_active == 0 || $user->email_active == 0){
                return view('dashboard')->with('user', $user);
            }

            elseif($data['application_status']==0){

            }
            elseif($data['application_status']==111){
                return Redirect::to('application/edit');
            }

            elseif($data['application_status']==333){

                return Redirect::to('application/photo');
            }
            elseif($data['application_status']==444){

                return Redirect::to('application/preview/whole');
            }
            elseif($data['application_status']==555){

                return Redirect::to('application/payment');
            }

            $regdata=$user->application->toArray();
        }
        else{
            $regdata=$this->fields;
        }
        //return $regdata;
        return view('application.preview')->with('user',$u)->with('regdata',$regdata);
    }

    public function previewWhole(){
        if(Auth::check()){
            $user = Auth::user();
        }
        else{

            return Redirect::to('/auth/login');
        }
        //$user=User::findOrFail(1);
        $u=$user;
        //return ($user->application);
        //return ($user);
        // return var_dump($user,$regdata);
        $r=$user->application;
        if(!empty($r)){
            $this->checkApplicationStatus($r);
            $regdata=$user->application->toArray();
        }
        else{
            $regdata=$this->fields;
        }
        //return $regdata;
        return view('application.preview.whole')->with('user',$u)->with('regdata',$regdata);
    }


}
