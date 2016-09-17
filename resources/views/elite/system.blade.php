@extends('layouts.elite')

@section ('css')

@section ('title', 'Settings')

@endsection

@section ('content')
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="fa fa-calender-plus-o font-dark"></i>
                        <span class="caption-subject bold uppercase">Admin System Settings</span>
                    </div>
                </div>
                <div class="portlet-body">

                    @if (Session::has('message'))
                        <span class="alert alert-warning">
                            <strong>{{ Session::get('message') }}</strong>
                        </span>
                    @endif
                    <form action="{{url('/admin/edit/settings')}}" method="post">

                        {!! csrf_field() !!}

                        <div class="row">

                            <div class="form-group col-md-12">
                                <label for="percentage">Percentage</label>
                                <input name="percentage" 
                                        type="text" 
                                        class="form-control myInput" 
                                        id="email"
                                        value="{{ $settings->percentage }}">
                                @if ($errors->has('percentage'))
                                    <span class="help-block error-message">
                                        <strong>{{ $errors->first('percentage') }}</strong>
                                    </span>
                                @endif 
                            </div>                           
                            <div class="form-group col-md-12">
                                <label for="days">Maturity days</label>
                                <input name="days" 
                                        type="text" 
                                        class="form-control myInput" 
                                        id="email"
                                        value="{{ $settings->days }}">
                                @if ($errors->has('days'))
                                    <span class="help-block error-message">
                                        <strong>{{ $errors->first('days') }}</strong>
                                    </span>
                                @endif 
                            </div> 
                            <div class="form-group col-md-12">
                                <label for="daily_reserves">Max daily reserves allowed</label>
                                <input name="daily_reserves" 
                                        type="text" 
                                        class="form-control myInput" 
                                        id="daily_reserves"
                                        value="{{ $settings->daily_reserves }}">
                                @if ($errors->has('daily_reserves'))
                                    <span class="help-block error-message">
                                        <strong>{{ $errors->first('daily_reserves') }}</strong>
                                    </span>
                                @endif 
                            </div> 
                            <div class="form-group col-md-12">
                                <label for="expiry_hours">Max expiry hours allowed</label>
                                <input name="expiry_hours" 
                                        type="text" 
                                        class="form-control myInput" 
                                        id="expiry_hours"
                                        value="{{ $settings->expiry_hours }}">
                                @if ($errors->has('expiry_hours'))
                                    <span class="help-block error-message">
                                        <strong>{{ $errors->first('expiry_hours') }}</strong>
                                    </span>
                                @endif 
                            </div> 
                            <div class="form-group col-md-12">
                                <label for="start_help_time">Start time</label>
                                <input name="start_help_time" 
                                        type="text" 
                                        class="form-control myInput" 
                                        id="start_help_time"
                                        value="{{ $settings->start_help_time }}">
                                @if ($errors->has('start_help_time'))
                                    <span class="help-block error-message">
                                        <strong>{{ $errors->first('start_help_time') }}</strong>
                                    </span>
                                @endif 
                            </div> 
                            <div class="form-group col-md-12">
                                <label for="end_help_time">Close time</label>
                                <input name="end_help_time" 
                                        type="text" 
                                        class="form-control myInput" 
                                        id="end_help_time"
                                        value="{{ $settings->end_help_time }}">
                                @if ($errors->has('end_help_time'))
                                    <span class="help-block error-message">
                                        <strong>{{ $errors->first('end_help_time') }}</strong>
                                    </span>
                                @endif 
                            </div>  
                            <div class="form-group col-md-12">
                                <label for="count_down_hours">Count down hours</label>
                                <input name="count_down_hours" 
                                        type="text" 
                                        class="form-control myInput" 
                                        id="count_down_hours"
                                        value="{{ $settings->count_down_hours }}">
                                @if ($errors->has('count_down_hours'))
                                    <span class="help-block error-message">
                                        <strong>{{ $errors->first('count_down_hours') }}</strong>
                                    </span>
                                @endif 
                            </div> 
                            <div class="col-md-12">
                                <button type="submit" id="submit_btn" class="btn btn-success">Update</button>
                            </div>

                        </div>
                    </form>

               </div>
            </div>
        </div>
    </div>


@endsection

@section ('js')



@endsection