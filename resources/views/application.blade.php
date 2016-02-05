@extends('master')

@section('header')
    @include('nav-header')
@stop

@section('content')
    <div class="row">

        <div class="col-md-3">
            <div>
                <a class="btn btn-default btn-block btn-lg disabled" href="#">Mobile and Mail Registration</a>
                <a class="btn btn-primary btn-block btn-lg active" href="#">Details of Candidate</a>
                <a class="btn btn-default btn-block btn-lg active" href="#">Upload Photo & Signature</a>
                <a class="btn btn-default btn-block btn-lg active" href="#">Payment Information</a>
                <a class="btn btn-default btn-block btn-lg active" href="#">Download & Print Form</a>
            </div>
        </div>
        <div class="col-md-9">
            <div class="progress">
                <div class="progress-bar" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="min-width:2em;width:25%">
                    25% Completed
                </div>
            </div>
            <center>
                <h3>CIT Admission 2016 Form Fillup</h3>
                <hr>
            </center>

            <form class="application-form" method="post" action="/application">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="formNumber">Form Number <i class="fa">:</i></label>
                            <label id="formNumber">{{ $user->id }}</label>
                            <input type="hidden" name="form_number" value="{{ $user->id }}">
                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                            <input type="hidden" name="mobile_number" value="{{ $regdata['mobile_number'] }}">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="mobile">Mobile <i class="fa">:</i></label>
                            <label id="mobile">{{ $user->mobile_number }}</label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="firstName">First Name <i class="fa fa-asterisk red"></i></label>
                            <input type="text" name="first_name" class="form-control uc" id="firstName" placeholder="First Name" value="{{ $regdata['first_name'] }}" required>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="middleName">Middle Name</label>
                            <input type="text" name="middle_name" class="form-control uc" id="middleName" value="{{ $regdata['middle_name'] }}" placeholder="Middle Name">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="firstName">Last Name <i class="fa fa-asterisk red"></i></label>
                            <input type="text" name="last_name" class="form-control uc" id="lastName" value="{{ $regdata['last_name'] }}" placeholder="Last Name" required>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="nameOfGuardian">Name of Guardian/Father/Mother <i class="fa fa-asterisk red"></i></label>
                    <input type="text" name="guardian_name" class="form-control uc" id="nameOfGuardian" value="{{ $regdata['guardian_name'] }}" placeholder="Name of Guardian/Father/Mother" required>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="candidateDOB">DOB of Candidate <i class="fa fa-asterisk red"></i></label>
                            <input type="text" name="dob" class="form-control" id="candidateDOB" value="{{$regdata['dob']}}" placeholder="Date of Birth of Candidate (DD/MM/YYYY)" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="gender">Gender <i class="fa fa-asterisk red"></i></label>
                            <select name="gender" class="form-control" id="gender" required>
                                <option @if($regdata['gender']=="Female") selected @endif>Female</option>
                                <option @if($regdata['gender']=="Female") selected @endif>Male</option>

                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="eligibility">Eligibility <i class="fa fa-asterisk red"></i></label>
                            <select name="eligibility" class="form-control" id="eligibility" required>
                                <option value="1" @if($regdata['eligibility']==1) selected @endif>Appeared</option>
                                <option value="2" @if($regdata['eligibility']==2) selected @endif>Appearing</option>

                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="region">Region <i class="fa fa-asterisk red"></i></label>
                            <select name="region_code" class="form-control" id="region" required>
                                <option value="3" @if($regdata['region_code']==3) selected @endif>BTAD</option>
                                <option value="2" @if($regdata['region_code']==2) selected @endif>North East India</option>
                                <option value="1" @if($regdata['region_code']==1) selected @endif>All India</option>

                            </select>
                        </div>
                    </div>

                </div>


                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="category">Category <i class="fa fa-asterisk red"></i></label>
                            <select name="category" class="form-control" id="category" required>
                                <option value="1" @if($regdata['category']==1) selected @endif>General/Open</option>
                                <option value="2" @if($regdata['category']==2) selected @endif>OBC</option>
                                <option value="3" @if($regdata['category']==3) selected @endif>SC</option>
                                <option value="4" @if($regdata['category']==4) selected @endif>ST</option>

                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="entryScheme">Entry Scheme <i class="fa fa-asterisk red"></i></label>
                            <select name="entry_scheme" class="form-control" id="entryScheme" required>
                                <option value="1" @if($regdata['entry_scheme']==1) selected @endif>CITEE-2016 (Diploma)</option>
                                <option value="2" @if($regdata['entry_scheme']==2) selected @endif>CITDEE-2016 (Degree/B.Tech)</option>
                                <option value="3" @if($regdata['entry_scheme']==3) selected @endif>CITLET-2016 (Lateral Entry)</option>
                                <option value="4" @if($regdata['entry_scheme']==4) selected @endif>CITVAT-2016 (Vertical Entry)</option>

                            </select>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="centre">Center of Preference 1 <i class="fa fa-asterisk red"></i></label>
                            <select name="center" class="form-control" id="centre" required>
                                <option value="1" @if($regdata['center']==1) selected @endif>Kokrajhar, Assam</option>
                                <option value="2" @if($regdata['center']==2) selected @endif>Chirang, Assam</option>
                                <option value="3" @if($regdata['center']==3) selected @endif>Baksha, Assam</option>
                                <option value="4" @if($regdata['center']==4) selected @endif>Udalguri, Assam</option>
                                <option value="5" @if($regdata['center']==5) selected @endif>Jorhat, Assam</option>
                                <option value="6" @if($regdata['center']==6) selected @endif>Kolkata, West Bengal</option>
                                <option value="7" @if($regdata['center']==7) selected @endif>New Delhi, Delhi</option>
                                <option value="8" @if($regdata['center']==8) selected @endif>Chennai, Tamil Nadu</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="centre">Center of Preference 2  <i class="fa fa-asterisk red"></i></label>
                            <select name="center_2" class="form-control" id="centre" required>

                                <option value="2" @if($regdata['center_2']==2) selected @endif>Chirang, Assam</option>
                                <option value="1" @if($regdata['center_2']==1) selected @endif>Kokrajhar, Assam</option>
                                <option value="3" @if($regdata['center_2']==3) selected @endif>Baksha, Assam</option>
                                <option value="4" @if($regdata['center_2']==4) selected @endif>Udalguri, Assam</option>
                                <option value="5" @if($regdata['center_2']==5) selected @endif>Jorhat, Assam</option>
                                <option value="6" @if($regdata['center_2']==6) selected @endif>Kolkata, West Bengal</option>
                                <option value="7" @if($regdata['center_2']==7) selected @endif>New Delhi, Delhi</option>
                                <option value="8" @if($regdata['center_2']==8) selected @endif>Chennai, Tamil Nadu</option>
                            </select>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="centre">Center of Preference 3  <i class="fa fa-asterisk red"></i></label>
                            <select name="center_3" class="form-control" id="centre" required>

                                <option value="3" @if($regdata['center_3']==3) selected @endif>Baksha, Assam</option>
                                <option value="1" @if($regdata['center_3']==1) selected @endif>Kokrajhar, Assam</option>
                                <option value="2" @if($regdata['center_3']==2) selected @endif>Chirang, Assam</option>
                                <option value="4" @if($regdata['center_3']==4) selected @endif>Udalguri, Assam</option>
                                <option value="5" @if($regdata['center_3']==5) selected @endif>Jorhat, Assam</option>
                                <option value="6" @if($regdata['center_3']==6) selected @endif>Kolkata, West Bengal</option>
                                <option value="7" @if($regdata['center_3']==7) selected @endif>New Delhi, Delhi</option>
                                <option value="8" @if($regdata['center_3']==8) selected @endif>Chennai, Tamil Nadu</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="nationality">Nationality <i class="fa fa-asterisk red"></i></label>
                            <select name="nationality" class="form-control" id="nationality" required>
                                <option value="1" @if($regdata['nationality']==1) selected @endif>Indian</option>
                                <option value="2" @if($regdata['nationality']==2) selected @endif>Others</option>
                            </select>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <p id="email" class="form-control disabled" title="Your email address" >{{ $user->email }}</p>
                            <input type="hidden" name="email" value="{{ $user->email }}">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="alternatePhone">Alternate Phone</label>
                            <input type="text" name="alternate_phone" value="{{ $regdata['alternate_phone'] }}" id="alternatePhone" class="form-control" placeholder="Alternate Mobile Number">
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
                            <input type="text" id="careOf" name="ca_care_of" value="{{ $regdata['ca_care_of'] }}" class="form-control uc" placeholder="Care Of Name">
                        </div>

                        <div class="input-group two">
                            	<span class="input-group-addon">
                                	<i class="fa sixty">Vill/Town</i>
                                </span>
                            <input type="text" name="ca_village_town" value="{{ $regdata['ca_village_town'] }}" id="villOrTown" class="form-control uc" placeholder="Vill/Town">
                        </div>

                        <div class="input-group two">
                            	<span class="input-group-addon">
                                	<i class="fa sixty">PO</i>
                                </span>
                            <input type="text" name="ca_post_office" value="{{ $regdata['ca_post_office'] }}" id="postOffice" class="form-control uc" placeholder="Post Office">
                        </div>

                        <div class="input-group two">
                            	<span class="input-group-addon">
                                	<i class="fa sixty">District</i>
                                </span>
                            <input type="text" name="ca_district" value="{{ $regdata['ca_district'] }}" id="district" class="form-control uc" placeholder="District">
                        </div>

                        <div class="input-group two">
                            	<span class="input-group-addon">
                                	<i class="fa sixty">State</i>
                                </span>
                            <input type="text" name="ca_state" value="{{ $regdata['ca_state'] }}" id="state" class="form-control uc" placeholder="Name of State">
                        </div>
                        <div class="input-group two">
                            	<span class="input-group-addon">
                                	<i class="fa sixty">PIN</i>
                                </span>
                            <input type="number" name="ca_pin" value="{{ $regdata['ca_pin'] }}" id="pin" class="form-control" placeholder="PIN Code">
                        </div>

                    </div>
                    <div class="col-sm-6">
                        <label>Permanent Address</label> <input type="checkbox" >Same as Correspondence

                        <br>
                        <div class="input-group two">
                            	<span class="input-group-addon" >
                                	<i class="fa sixty">CO</i>
                                </span>
                            <input type="text" name="pa_care_of" value="{{ $regdata['pa_care_of'] }}" id="careOf" class="form-control uc" placeholder="Care Of Name">
                        </div>

                        <div class="input-group two">
                            	<span class="input-group-addon">
                                	<i class="fa sixty">Vill/Town</i>
                                </span>
                            <input type="text" name="pa_village_town" value="{{ $regdata['pa_village_town'] }}" id="villOrTown" class="form-control uc" placeholder="Vill/Town">
                        </div>

                        <div class="input-group two">
                            	<span class="input-group-addon">
                                	<i class="fa sixty">PO</i>
                                </span>
                            <input type="text" name="pa_post_office" value="{{ $regdata['pa_post_office'] }}" id="postOffice" class="form-control uc" placeholder="Post Office">
                        </div>

                        <div class="input-group two">
                            	<span class="input-group-addon">
                                	<i class="fa sixty">District</i>
                                </span>
                            <input type="text" name="pa_district" value="{{ $regdata['pa_district'] }}" id="district" class="form-control uc" placeholder="District">
                        </div>

                        <div class="input-group two">
                            	<span class="input-group-addon">
                                	<i class="fa sixty">State</i>
                                </span>
                            <input type="text" name="pa_state" value="{{ $regdata['pa_state'] }}" id="state" class="form-control uc" placeholder="Name of State">
                        </div>
                        <div class="input-group two">
                            	<span class="input-group-addon">
                                	<i class="fa sixty">PIN</i>
                                </span>
                            <input type="number" name="pa_pin" value="{{ $regdata['pa_pin'] }}" id="pin" class="form-control" placeholder="PIN Code">
                        </div>


                    </div>

                </div>

                <hr>
                <div style="margin:40px">
                        <input type="hidden" name="application_status" value="0">
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <input type="submit" name="continue" class="btn btn-info btn-block" value="Save and Continue">
                    </div>
                    <div class="col-sm-6">
                        <input type="submit" name="save" class="btn btn-success btn-block" value="Save">
                    </div>
                </div>
                <br>
                <br>
                <div>
                    <label>Read the instructions carefully before filling up the form.</label>
                </div>
            </form>
        </div>

    </div>
@stop