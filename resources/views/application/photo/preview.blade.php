
@extends('master')

@section('header')
    @include('nav-header')
@stop

@section('content')
    <div class="row">

        <div class="col-md-3">
            <div>
                <a class="btn btn-default btn-block btn-lg disabled" href="#">Mobile and Mail Registration</a>
                <a class="btn btn-default btn-block btn-lg disabled" href="#">Details of Candidate</a>
                <a class="btn btn-primary btn-block btn-lg active" href="#">Upload Photo & Signature</a>
                <a class="btn btn-default btn-block btn-lg" href="#">Payment Information</a>
                <a class="btn btn-default btn-block btn-lg" href="#">Download & Print Form</a>
            </div>
        </div>
        <div class="col-md-9">
            <div class="progress">
                <div class="progress-bar" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="min-width:2em;width:25%">
                    50% Completed
                </div>
            </div>
            <center>
                <h3>CIT Admission 2016 Form Fillup</h3>
                <hr>
            </center>
            @if(isset($errors))
                @if(count($errors)>0)
                    <div class="alert alert-danger ">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </div>
                @endif
            @endif
            <form method="post" action="/application/photo" accept-charset="UTF-8" enctype="multipart/form-data">

                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="id" value="{{ $id }}">
                <input type="hidden" name="user_id" value="{{ $user_id }}">
                <input type="hidden" name="application_status" value="555">
                <table class="table table-bordered">
                    <tr>
                        <td class="col-md-9" style="height: 180px;"><label>Passport Photo</label>
                            <br>
                            <p>
                                If the photo is not looking good due to morph please re upload your passport photo of size height: 190px and width: 150px;
                            </p>
                        </td><td><img src="{{ '/file/photo/'.$photo['photo_url'] }}" border="1" height="230px" width="190px"></td>
                    </tr>
                    <tr>
                        <td class="col-md-9" style="height: 60px;"><label>Signature</label><br>
                        <p>
                            If the photo is not looking good due to morph please re upload your signature photo of size height: 60px and width: 150px;
                        </p>
                        </td><td><img src="{{ '/file/signature/'.$photo['signature_url'] }}" class="" height="60px" width="190px"></td>
                    </tr>
                </table>
                <div class="row">
                    <div class="col-md-4">
                        <a href="/application/photo/edit" class="btn btn-md btn-info btn-block"><i class="fa fa-edit"></i> Reupload Photo</a>
                    </div>
                    <div class="col-md-8">
                        <a href="/application/preview/whole" class="btn btn-md btn-primary btn-block"><i class="fa fa-eye"></i> Preview Form</a>
                    </div>


                </div>

            </form>

        </div>

    </div>
@stop
