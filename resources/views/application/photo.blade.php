
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
            @if(isset($image_error))
                <div class="alert alert-danger ">
                    <li>{{ $image_error }}</li>
                </div>
            @endif
            <form method="post" action="/application/photo" accept-charset="UTF-8" enctype="multipart/form-data">

                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="id" value="{{ $id }}">
                <input type="hidden" name="user_id" value="{{ $user_id }}">
                <input type="hidden" name="application_status" value="444">
                <table class="table table-bordered">
                    <tr>
                        <td class="col-md-6" style="height: 180px;"><label>Passport Photo</label>
                            <ul>
                                <li>Use photo editor to edit Photo to fit in (150-200)px height and (70-150)px width</li>
                                <li>Paint, Inskape, GIMP, Photoshop, Corel Draw etc. are good photo editors</li>
                                <li>Allowed photo extensions (JPG,JPEG, PNG, GIF)</li>
                            </ul>
                        </td><td><input type="file" name="photo_url" value=""></td>
                    </tr>
                    <tr>
                        <td class="col-md-6" style="height: 60px;"><label>Signature</label>
                            <ul>
                                <li>Size of signature (20-60)px height and (70-150)px width</li>
                                <li>Paint, Inskape, GIMP, Photoshop, Corel Draw etc. are good photo editors</li>
                                <li>Allowed signature photo extensions (JPG,JPEG, PNG, GIF)</li>
                            </ul>
                        </td><td><input type="file" name="signature_url" value=""></td>
                    </tr>
                </table>
                <button type="submit" class="btn btn-lg btn-primary btn-block">Upload and Submit</button>
            </form>

        </div>

    </div>
@stop
