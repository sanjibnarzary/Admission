<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redirect;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class ApplicationPhotoController extends Controller
{
    //
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'photo_url' => 'required',
            'signature_url' => 'required',
        ]);
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
        if(!empty($r)){
            //$this->checkApplicationStatus($r);
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

                //return Redirect::to('application/photo');
                return view('application.photo')->with('user_id',$r['user_id'])->with('id',$r['id']);
            }
            elseif($data['application_status']==444){

                $photo['photo_url'] = $r['photo_url'];
                $photo['signature_url'] = $r['signature_url'];
                return view('application.photo.preview')->with('user_id',$r['user_id'])->with('id',$r['id'])->with('photo',$photo);
            }
            elseif($data['application_status']==555){

                return Redirect::to('application/payment');
            }
            else{

                return Redirect::to('/application/preview/whole');
            }

            //$regdata=$user->application->toArray();
        }
        else{
            //$regdata=$this->fields;
            return Redirect::to('/application');
        }
        //return $regdata;
        //return view('application')->with('user',$u)->with('regdata',$regdata);
        return view('application.photo');
    }

    /**
     * @return mixed
     */
    public function savePhoto(Request $request){
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

        $photoPath = base_path().'\\public\\file\\photo';
        $signaturePath = base_path().'\\public\\file\\signature';
        $r=$user->application;
        $input['id'] = $request->get('id');
        $input['user_id'] = $request->get('user_id');
        $input['application_status'] = $request->get('application_status');
        $input['photo_url'] = $request->file('photo_url');
        $input['signature_url'] = $request->file('signature_url');

        $valid=$this->validator($input);
        if($valid->fails()){
            return view('application.photo')->withErrors($valid)->with('user_id',$r['user_id'])->with('id',$r['id']);

        }
        if($request->file('photo_url')->isFile()&&$request->file('signature_url')->isFile()){
            $fileExtension = ['jpg', 'jpeg', 'png', 'gif'];
            $fileName = md5($user->id);
            $photoFileExtension = $request->file('photo_url')->getClientOriginalExtension();
            $photoFile = $fileName.'.'.$photoFileExtension;
            $signatureFileExtension = $request->file('signature_url')->getClientOriginalExtension();
            $signatureFile = $fileName.'.'.$signatureFileExtension;



            if(in_array($photoFileExtension,$fileExtension) && in_array($signatureFileExtension,$fileExtension)){
                $request->file('photo_url')->move($photoPath,$photoFile);
                $request->file('signature_url')->move($signaturePath,$signatureFile);
                list($widthPhoto,$heightPhoto) = getImageSize($photoPath.'\\'.$photoFile);
                list($widthSignature,$heightSignature) = getImageSize($signaturePath.'\\'.$signatureFile);
                if($heightPhoto<220 && $heightPhoto > 100 && $heightSignature <120 && $heightSignature >20 && $widthSignature < 230 && $widthSignature > 70 && $widthPhoto < 280 && $widthPhoto>70){
                    //it is ok
                }
                else{
                    return view('application.photo')->with('image_error','Error: Photo dimension HxW (150-200px X 70-150px) Signature Dimension 40-60px X 70-150px')->with('user_id',$r['user_id'])->with('id',$r['id']);
                }

            }
            else{
                return view('application.photo')->with('image_error','You must upload both the image file in JPG, JPEG, PNG')->with('user_id',$r['user_id'])->with('id',$r['id']);
            }

        }
        else{
            return view('application.photo')->with('image_error','You must upload both the image file in JPG, JPEG, PNG format')->with('user_id',$r['user_id'])->with('id',$r['id']);
        }
        $input['photo_url'] = $photoFile;
        $input['signature_url'] = $signatureFile;
        $user->application()->update($input);
        return view('application.photo.preview')->with('user_id',$r['user_id'])->with('id',$r['id'])->with('photo',$input);
    }
    public function previewPhoto(){
        if(Auth::check()){
            $user = Auth::user();
        }
        else{

            return Redirect::to('/auth/login');
        }
        $u = $user->application;
        return view('application.photo.preview')->with('user_id',$user->id)->with('id',$u['id'])->with('photo',$u);
    }
    public function editPhoto(){
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
        if(!empty($r)){
            //$this->checkApplicationStatus($r);
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
        }
        else{
            //$regdata=$this->fields;
            return Redirect::to('/application');
        }
        //return $regdata;
        //return view('application')->with('user',$u)->with('regdata',$regdata);
        return view('application.photo');

    }
}
