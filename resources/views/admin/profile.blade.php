@extends('layouts.backend')

@section ('css')

	<link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap-fileinput.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('css/profile.min.css')}}">

@endsection

@section ('title', 'Profile')

@section ('content')

<div class="row">
    <div class="col-md-12">

        
        @if (session('status'))
            <span class="alert alert-success">
                <strong>{{ session('status') }}</strong>
            </span>
        @endif
        @if (session('error'))
            <span class="alert alert-warning">
                <strong>{{ session('error') }}</strong>
            </span>
        @endif        

        <div class="profile-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="portlet light bordered">
                        <div class="portlet-title tabbable-line">
                            <div class="caption caption-md">
                                <i class="icon-globe theme-font hide"></i>
                                <span class="caption-subject font-blue-madison bold uppercase">Profile Account</span>
                            </div>
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a href="#tab_1_1" data-toggle="tab">Personal Info</a>
                                </li>
                                <li>
                                    <a href="#tab_1_2" data-toggle="tab">Change Avatar</a>
                                </li>
                                <li>
                                    <a href="#tab_1_3" data-toggle="tab">Change Password</a>
                                </li>
                            </ul>
                        </div>
                        <div class="portlet-body">
                            <div class="tab-content">
                                
                                <div class="tab-pane active" id="tab_1_1">
                                    <form role="form" action="{{url('/update_profile')}}" method="post">

                                        {!! csrf_field() !!}
                                        <div class="form-group">
                                            <label class="control-label">First Name</label>
                                            <input type="text" value="{{Auth::user()->first_name}}" name='name' placeholder="John" class="form-control"> </div>
                                        <div class="form-group">
                                            <label class="control-label">Last Name</label>
                                            <input type="text" value="{{Auth::user()->last_name}}" name='surname' placeholder="Doe" class="form-control"> </div>
                                        <div class="form-group">
                                            <label class="control-label">Mobile Number</label>
                                            <input type="text" value="{{Auth::user()->cell_phone}}" readonly="true" placeholder="27833532301" class="form-control"> </div>
                                        <div class="margiv-top-10">
                                            <button class="btn green"> Save Changes </button>
                                        </div>
                                    </form>
                                </div>

                                <div class="tab-pane" id="tab_1_2">
                                    <p> </p>
                                    <form role="form" action="{{url('/update_avatar')}}" method="post"  enctype="multipart/form-data">

                                        {!! csrf_field() !!}
                                        <div class="form-group">
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                    <img src="{{ $avatar }}" alt=""> </div>
                                                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                                                <div>
                                                    <span class="btn default btn-file">
                                                        <span class="fileinput-new"> Select image </span>
                                                        <span class="fileinput-exists"> Change </span>
                                                        <input type="file" name="avatar"> </span>
                                                    <a href="javascript:;" class="btn default fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="margin-top-10">
                                            <button class="btn green"> Submit </button>
                                        </div>
                                    </form>
                                </div>
 
                                <div class="tab-pane" id="tab_1_3">
                                    <form role="form" action="{{url('/change_password')}}" method="post">

                                        {!! csrf_field() !!}
                                        <div class="form-group">
                                            <label class="control-label">Current Password</label>
                                            <input type="password" name="current_password" class="form-control">
                                            @if ($errors->has('current_password'))
                                                <span class="help-block error-message">
                                                    <strong>{{ $errors->first('current_password') }}</strong>
                                                </span>
                                            @endif 
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">New Password</label>
                                            <input type="password" name="password" class="form-control"> 

                                            @if ($errors->has('password'))
                                                <span class="help-block error-message">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Re-type New Password</label>
                                            <input type="password" name="password_confirmation" class="form-control"> 
                                            @if ($errors->has('password_confirmation'))
                                                <span class="help-block error-message">
                                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="margin-top-10">
                                            <button class="btn green"> Change Password </button>
                                        </div>
                                    </form>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>


@endsection

@section ('js')

	<script src="{{asset('js/jquery.sparkline.min.js')}}" type="text/javascript"></script>
	<script src="{{asset('js/profile.js')}}" type="text/javascript"></script>
	<script src="{{asset('js/bootstrap-fileinput.js')}}" type="text/javascript"></script>

@endsection