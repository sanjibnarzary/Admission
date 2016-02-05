@extends('master')

@section('header')
    <nav class="navbar">
        <div>
            <img src="/assets/img/banner.jpg" class="img-responsive img-rounded banner">
        </div>
    </nav>

    <nav class="navbar navbar-default">
        <div class="container">

            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="./">Admission 2016</a>
            </div>
            <div id="navbar" class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="./">Home</a></li>
                    <li><a href="#about">About</a></li>
                    <li><a href="#contact">Contact</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">More <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="//www.cit.ac.in">CIT Kokrajhar</a></li>


                        </ul>
                    </li>
                    <li>
                        <a href="#" style="width:50%"><marquee>SMS <strong>CITK &nbsp;&nbsp; ADM2016</strong> to <strong>56161</strong> For information regarding CITK Admission 2016 (SMS charges Apply)</marquee></a>
                    </li>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </nav>
@stop

@section('content')
    <div class="row">

        <div class="col-md-3">

            <div>
                <a class="btn btn-default btn-block btn-lg disabled" href="#">Mobile and Mail Registration</a>
                <a class="btn btn-default btn-block btn-lg disabled" href="#">Details of Candidate</a>
                <a class="btn btn-default btn-block btn-lg @if($regdata['application_status']>=333) disabled @else active @endif  href="#">Upload Photo & Signature</a>
                <a class="btn btn-default btn-block btn-lg active" href="#">Payment Information</a>
                <a class="btn btn-default btn-block btn-lg active" href="#">Download & Print Form</a>
            </div>

        </div>
        <div class="col-md-9">
            @if($regdata['application_status']==222)
            <div class="progress">
                <div class="progress-bar" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="min-width:2em;width:75%">
                    75% Completed
                </div>
            </div>@endif
            <center>
                <h3>CIT Admission 2016 Form Fillup</h3>
                <hr>
            </center>

            <form class="" method="post" action="/application/edit">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="id" value="{{ $regdata['id'] }}">
                <input type="hidden" name="user_id" value="{{ $user->id }}">
                <input type="hidden" name="application_status" value="555">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="formNumber">Form Number <i class="fa">:</i></label>
                            <label id="formNumber">{{ $regdata['form_number'] }}</label>


                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">

                            <label for="mobile">Mobile <i class="fa">:</i></label>
                            <label id="mobile">{{ $user->mobile_number }}</label>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">

                        <div class="form-group">
                            Name:
                            <label id="name" class="uc"> {{ $regdata['first_name'] }} {{ $regdata['middle_name'] }} {{ $regdata['last_name'] }}</label>
                        </div>

                        <div class="form-group">
                            Guardian/Parent:
                            <label for="nameOfGuardian" class="uc">{{ $regdata['guardian_name'] }}</label>

                        </div>

                        <div class="form-group">
                            DOB of Candidate:
                            <label for="candidateDOB">{{ $regdata['dob'] }}</label>
                        </div>

                        <div class="form-group">
                            Gender:
                            <label for="gender">{{ $regdata['gender'] }}</label>
                        </div>

                        <div class="form-group">
                            Eligibility:
                            <label for="eligibility">
                                @if($regdata['eligibility']==1) Appeared @endif
                                @if($regdata['eligibility']==2) Appearing @endif
                            </label>
                        </div>

                        <div class="form-group">
                            Region:
                            <label for="region">
                                @if($regdata['region_code']==3) BTAD @endif
                                @if($regdata['region_code']==2) North East India @endif
                                @if($regdata['region_code']==1) All India @endif
                            </label>

                        </div>

                        <div class="form-group">
                            Category:
                            <label for="category">

                                @if($regdata['category']==1) General/Open @endif
                                @if($regdata['category']==2) OBC @endif
                                @if($regdata['category']==3) SC @endif
                                @if($regdata['category']==4) ST @endif
                            </label>

                        </div>

                        <div class="form-group">
                            Entry Scheme:
                            <label for="entryScheme">
                                @if($regdata['entry_scheme']==1) CITEE-2016 (Diploma) @endif
                                @if($regdata['entry_scheme']==2) CITDEE-2016 (Degree/B.Tech) @endif
                                @if($regdata['entry_scheme']==3) CITLET-2016 (Lateral Entry) @endif
                                @if($regdata['entry_scheme']==4) CITVAT-2016 (Vertical Entry) @endif

                            </label>
                        </div>

                    </div>
                    <div class="col-sm-6">
                       <div class="form-group">
                           <p class="pull-right">
                           <div class="form-group">
                                <img class="img-rounded" src="{{ '/file/photo/'.$regdata['photo_url'] }}" border="1" height="230px" width="210px">
                           </div>
                           <div class="form-group" style="margin-top: -10px;">
                                <img src="{{ '/file/signature/'.$regdata['signature_url'] }}" class="" height="60px" width="210px">
                           </div>
                           </p>
                       </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">

                    </div>
                    <div class="col-md-6">

                    </div>
                </div>



                <div class="row">
                    <div class="col-sm-6">

                    </div>
                    <div class="col-sm-6">

                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">

                    </div>
                    <div class="col-sm-6">

                    </div>

                </div>


                <div class="row">
                    <div class="col-sm-6">

                    </div>
                    <div class="col-sm-6">

                    </div>

                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            Center of Preference 1:
                            <label for="centre">

                                @if($regdata['center']==1) Kokrajhar, Assam @endif
                                @if($regdata['center']==2) Chirang, Assam @endif
                                @if($regdata['center']==3) Baksha, Assam @endif
                                @if($regdata['center']==4) Udalguri, Assam @endif
                                @if($regdata['center']==5) Jorhat, Assam @endif
                                @if($regdata['center']==6) Kolkata, West Bengal @endif
                                @if($regdata['center']==7) New Delhi, Delhi @endif
                                @if($regdata['center']==8) Chennai, Tamil Nadu @endif

                            </label>

                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            Center of Preference 2:
                            <label for="centre">

                                @if($regdata['center_2']==1) Kokrajhar, Assam @endif
                                @if($regdata['center_2']==2) Chirang, Assam @endif
                                @if($regdata['center_2']==3) Baksha, Assam @endif
                                @if($regdata['center_2']==4) Udalguri, Assam @endif
                                @if($regdata['center_2']==5) Jorhat, Assam @endif
                                @if($regdata['center_2']==6) Kolkata, West Bengal @endif
                                @if($regdata['center_2']==7) New Delhi, Delhi @endif
                                @if($regdata['center_2']==8) Chennai, Tamil Nadu @endif
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            Center of Preference 3:
                            <label for="centre_3">

                                @if($regdata['center_3']==1) Kokrajhar, Assam @endif
                                @if($regdata['center_3']==2) Chirang, Assam @endif
                                @if($regdata['center_3']==3) Baksha, Assam @endif
                                @if($regdata['center_3']==4) Udalguri, Assam @endif
                                @if($regdata['center_3']==5) Jorhat, Assam @endif
                                @if($regdata['center_3']==6) Kolkata, West Bengal @endif
                                @if($regdata['center_3']==7) New Delhi, Delhi @endif
                                @if($regdata['center_3']==8) Chennai, Tamil Nadu @endif
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            Nationality:
                            <label for="nationality">
                                @if($regdata['nationality']==1) Indian @endif
                                @if($regdata['nationality']==2) Others @endif
                            </label>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            Email:
                            <label for="email">{{ $user->email }}</label>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            Alternate Phone:
                            <label for="alternatePhone">{{ $regdata['alternate_phone'] }}</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <label>Address for Correspondence</label><br>
                        <div class="input-group two">
                            	<span class="input-group-addon" >
                                	<i class="fa sixty">CO</i>
                                </span>
                            <input type="text" id="careOf" value="{{ $regdata['ca_care_of'] }}" class="form-control disabled uc" disabled placeholder="Care Of Name">
                        </div>

                        <div class="input-group two">
                            	<span class="input-group-addon">
                                	<i class="fa sixty">Vill/Town</i>
                                </span>
                            <input type="text" value="{{ $regdata['ca_village_town'] }}" id="villOrTown" class="form-control uc" disabled placeholder="Vill/Town">
                        </div>

                        <div class="input-group two">
                            	<span class="input-group-addon">
                                	<i class="fa sixty">PO</i>
                                </span>
                            <input type="text"  value="{{ $regdata['ca_post_office'] }}" id="postOffice" class="form-control uc" disabled placeholder="Post Office">
                        </div>

                        <div class="input-group two">
                            	<span class="input-group-addon">
                                	<i class="fa sixty">District</i>
                                </span>
                            <input type="text" value="{{ $regdata['ca_district'] }}" id="district" class="form-control uc" disabled placeholder="District">
                        </div>

                        <div class="input-group two">
                            	<span class="input-group-addon">
                                	<i class="fa sixty">State</i>
                                </span>
                            <input type="text" value="{{ $regdata['ca_state'] }}" id="state" class="form-control uc" disabled placeholder="Name of State">
                        </div>
                        <div class="input-group two">
                            	<span class="input-group-addon">
                                	<i class="fa sixty">PIN</i>
                                </span>
                            <input type="text" value="{{ $regdata['ca_pin'] }}" id="pin" class="form-control" disabled placeholder="PIN Code">
                        </div>

                    </div>
                    <div class="col-sm-6">
                        <label>Permanent Address</label>

                        <br>
                        <div class="input-group two">
                            	<span class="input-group-addon" >
                                	<i class="fa sixty">CO</i>
                                </span>
                            <input type="text" value="{{ $regdata['pa_care_of'] }}" id="careOf" class="form-control uc" disabled placeholder="Care Of Name">
                        </div>

                        <div class="input-group two">
                            	<span class="input-group-addon">
                                	<i class="fa sixty">Vill/Town</i>
                                </span>
                            <input type="text" value="{{ $regdata['pa_village_town'] }}" id="villOrTown" disabled class="form-control uc" placeholder="Vill/Town">
                        </div>

                        <div class="input-group two">
                            	<span class="input-group-addon">
                                	<i class="fa sixty">PO</i>
                                </span>
                            <input type="text" value="{{ $regdata['pa_post_office'] }}" id="postOffice" disabled class="form-control uc" placeholder="Post Office">
                        </div>

                        <div class="input-group two">
                            	<span class="input-group-addon">
                                	<i class="fa sixty">District</i>
                                </span>
                            <input type="text" value="{{ $regdata['pa_district'] }}" id="district" disabled class="form-control uc" placeholder="District">
                        </div>

                        <div class="input-group two">
                            	<span class="input-group-addon">
                                	<i class="fa sixty">State</i>
                                </span>
                            <input type="text" value="{{ $regdata['pa_state'] }}" id="state" disabled class="form-control uc" placeholder="Name of State">
                        </div>
                        <div class="input-group two">
                            	<span class="input-group-addon">
                                	<i class="fa sixty">PIN</i>
                                </span>
                            <input type="text" value="{{ $regdata['pa_pin'] }}" id="pin" class="form-control" disabled placeholder="PIN Code">
                        </div>


                    </div>

                </div>

                <hr>
                <div style="margin:40px">

                </div>
                @if($regdata['application_status']==444)
                    <div class="row">
                        <div class="col-sm-4">
                            <a href="/application/photo/preview" name="continue" class="btn btn-info btn-block"><i class="fa fa-chevron-left"></i> Go Back</a>
                        </div>
                        <div class="col-sm-8">
                            <input type="submit" name="save" class="btn btn-success btn-block" value="Save & Final">
                        </div>
                    </div>
                @else
                    <a type="submit" href="/application/payment" name="continue" class="btn btn-info btn-block"><i class="fa fa-rupee"></i> Make Payment</a>
                @endif
                <br>
                <br>
                <div class="alert alert-info">
                    <label>Application is incomplete until you provide payment information, after completing payment process a download link will be activated.</label>
                </div>
            </form>
        </div>


    </div>
@stop