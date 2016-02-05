
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
                <a class="btn btn-default btn-block btn-lg disabled" href="#">Upload Photo & Signature</a>
                <a class="btn btn-primary btn-block btn-lg active" href="#">Payment Information</a>
                <a class="btn btn-default btn-block btn-lg" href="#">Download & Print Form</a>
            </div>
        </div>
        <div class="col-md-9">
            <div class="progress">
                <div class="progress-bar" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="min-width:2em;width:75%">
                    75% Completed
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
            <form method="get" action="/application/payment">

                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="id" value="{{ $data['id'] }}">
                <input type="hidden" name="user_id" value="{{ $data['user_id'] }}">
                <input type="hidden" name="application_status" value="444">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            Candidate's Name <label class="uc">
                                {{ $data['first_name'].' '.$data['middle_name'].' '.$data['last_name'] }}
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            Entry Scheme:
                            <label for="entryScheme">
                                @if($data['entry_scheme']==1) CITEE-2016 (Diploma) @endif
                                @if($data['entry_scheme']==2) CITDEE-2016 (Degree/B.Tech) @endif
                                @if($data['entry_scheme']==3) CITLET-2016 (Lateral Entry) @endif
                                @if($data['entry_scheme']==4) CITVAT-2016 (Vertical Entry) @endif

                            </label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            Category:
                            <label for="category">

                                @if($data['category']==1) General/Open @endif
                                @if($data['category']==2) OBC @endif
                                @if($data['category']==3) SC @endif
                                @if($data['category']==4) ST @endif
                            </label>

                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            Region:
                            <label for="region">
                                @if($data['region_code']==3) BTAD @endif
                                @if($data['region_code']==2) North East India @endif
                                @if($data['region_code']==1) All India @endif
                            </label>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6"><div class="form-group">
                            @if($data['category']==3||$data['category']==4)
                                Application fees amount <i class="fa fa-rupee alert alert-success">500</i>
                                <input type="hidden" name="amount" value="500">
                            @else
                                Application fees amount <i class="fa fa-rupee alert alert-success">1000</i>
                                <input type="hidden" name="amount" value="1000">
                            @endif
                        </div></div>
                    <div class="col-md-6"></div>
                </div>
                <div class="form-group">
                    Choose a Payment Method <i class="fa fa-rupee"></i> <input type="radio" name="paymentMode" id="onlinePayment" value="ONLINE" checked>Online Payment <input type="radio" id="ddPayment" name="paymentMode" value="DD">Demand Draft
                </div>
                <div class="paymentMode" id="onlineMode">
                    <input type="hidden" name="modeOperation" value="ONLINE" id="modeOperationONLINE" class="online"> ONLINE
                </div>
                <div class="paymentMode" id="ddMode" style="display: none;">
                    <input type="hidden" name="modeOperation" value="DD" id="modeOperationDD" class="dd"> DD Selected
                </div>
                <button type="submit" class="btn btn-lg btn-primary btn-block"><i class="fa fa-rupee"></i> Make Payment</button>
            </form>

        </div>

    </div>
@stop
