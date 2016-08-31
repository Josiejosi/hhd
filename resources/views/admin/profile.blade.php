@extends('layouts.backend')

@section ('css')

	<link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap-fileinput.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('css/profile.min.css')}}">

@endsection

@section ('title', 'Profile')

@section ('content')

<div class="row">
    <div class="col-md-12">

        
        @if (Session::has('account_creation_error'))
            <span class="alert alert-warning">
                <strong>{{ Session::get('account_creation_error') }}</strong>
            </span>
        @endif
            <span class="alert alert-warning">
                <strong>{{ Session::get('account_creation_error') }}</strong>
            </span>        
        <div class="profile-sidebar">
            
            <div class="portlet light profile-sidebar-portlet bordered">
                
                <div class="profile-userpic">
                    <img src="{{asset('imgs/avatar/avatar.png')}}" class="img-responsive" alt=""> 
                </div>

                <div class="profile-usertitle">
                    <div class="profile-usertitle-name"> 
                        {{Auth::user()->first_name}} {{Auth::user()->last_name}}
                    </div>
                </div>
                
            </div>
            
        </div>

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
                                    <form role="form" action="#">
                                        <div class="form-group">
                                            <label class="control-label">First Name</label>
                                            <input type="text" value="{{Auth::user()->first_name}}" placeholder="John" class="form-control"> </div>
                                        <div class="form-group">
                                            <label class="control-label">Last Name</label>
                                            <input type="text" value="{{Auth::user()->last_name}}" placeholder="Doe" class="form-control"> </div>
                                        <div class="form-group">
                                            <label class="control-label">Mobile Number</label>
                                            <input type="text" value="{{Auth::user()->cell_phone}}" placeholder="27833532301" class="form-control"> </div>
                                        <div class="margiv-top-10">
                                            <a href="javascript:;" class="btn green"> Save Changes </a>
                                            <a href="javascript:;" class="btn default"> Cancel </a>
                                        </div>
                                    </form>
                                </div>

                                <div class="tab-pane" id="tab_1_2">
                                    <p> </p>
                                    <form action="#" role="form">
                                        <div class="form-group">
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                    <img src="{{asset('imgs/avatar/avatar.png')}}" alt=""> </div>
                                                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                                                <div>
                                                    <span class="btn default btn-file">
                                                        <span class="fileinput-new"> Select image </span>
                                                        <span class="fileinput-exists"> Change </span>
                                                        <input type="file" name="..."> </span>
                                                    <a href="javascript:;" class="btn default fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                                </div>
                                            </div>
                                            <div class="clearfix margin-top-10">
                                                <span class="label label-danger">NOTE! </span>
                                                <span>Attached image thumbnail is supported in Latest Firefox, Chrome, Opera, Safari and Internet Explorer 10 only </span>
                                            </div>
                                        </div>
                                        <div class="margin-top-10">
                                            <a href="javascript:;" class="btn green"> Submit </a>
                                            <a href="javascript:;" class="btn default"> Cancel </a>
                                        </div>
                                    </form>
                                </div>
 
                                <div class="tab-pane" id="tab_1_3">
                                    <form action="#">
                                        <div class="form-group">
                                            <label class="control-label">Current Password</label>
                                            <input type="password" class="form-control"> </div>
                                        <div class="form-group">
                                            <label class="control-label">New Password</label>
                                            <input type="password" class="form-control"> </div>
                                        <div class="form-group">
                                            <label class="control-label">Re-type New Password</label>
                                            <input type="password" class="form-control"> </div>
                                        <div class="margin-top-10">
                                            <a href="javascript:;" class="btn green"> Change Password </a>
                                            <a href="javascript:;" class="btn default"> Cancel </a>
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