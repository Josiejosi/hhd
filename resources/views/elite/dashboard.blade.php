@extends('layouts.elite')

@section ('title', 'Home')

@section ('css')

    <link rel="stylesheet" type="text/css" href="{{asset('css/ion.rangeSlider.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/ion.rangeSlider.skinNice.css')}}">

    <link rel="stylesheet" type="text/css" href="{{asset('css/profile.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/loader.css')}}">

    <style type="text/css">
        
        .icon-btn {
            min-width: 150px;
        }

        .widget-thumb {
            padding: 3px;
            border-radius: 4px;
        }
        .hasCountdown {
            border:  none ; 
            background-color: none ;
        }

        .widget-thumb .widget-thumb-body .widget-thumb-body-stat {
            display: block;
            font-size: 14px;
            font-weight: none;
            color: red;
        }
        .widget-thumb .widget-thumb-heading {
            font-size: 10px;
        }

        .dashboard-stat .details .desc {
            font-size: 12px;
        }
    </style>

@endsection

@section ('content')

    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <a class="dashboard-stat dashboard-stat-v2 blue" href="#">
                <div class="visual">
                    <i class="fa fa-comments"></i>
                </div>
                <div class="details">
                    <div class="number">
                        <span data-counter="counterup" data-value="{{$members}}">{{$members}}</span>
                    </div>
                    <div class="desc"> Active Members </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <a class="dashboard-stat dashboard-stat-v2 red" href="#">
                <div class="visual">
                    <i class="fa fa-bar-chart-o"></i>
                </div>
                <div class="details">
                    <div class="number">
                        <span data-counter="counterup" data-value="{{$elite}}">{{$elite}}</span> 
                    </div>
                    <div class="desc"> Active Elite Member </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <a class="dashboard-stat dashboard-stat-v2 green" href="#">
                <div class="visual">
                    <i class="fa fa-shopping-cart"></i>
                </div>
                <div class="details">
                    <div class="number">
                        <span data-counter="counterup" data-value="{{$scheduled}}">{{$scheduled}}</span>
                    </div>
                    <div class="desc"> Scheduled Donations </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <a class="dashboard-stat dashboard-stat-v2 purple" href="#">
                <div class="visual">
                    <i class="fa fa-globe"></i>
                </div>
                <div class="details">
                    <div class="number">
                        <span data-counter="counterup" data-value="{{$donation}}">{{$donation}}</span> 
                    </div>
                    <div class="desc"> Active Donations </div>
                </div>
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="fa fa-calender-plus-o font-dark"></i>
                        <span class="caption-subject bold uppercase">Add Member to Active Donation</span>
                    </div>
                </div>
                <div class="portlet-body">

                    @if (Session::has('message'))
                        <span class="alert alert-success">
                            <strong>{{ session('message') }}</strong>
                        </span>
                    @endif
                    @if (Session::has('error'))
                        <span class="alert alert-success">
                            <strong>{{ session('error') }}</strong>
                        </span>
                    @endif
                    <form action="{{url('/admin/create/donation/elite')}}" method="post">

                        {!! csrf_field() !!}

                        <div class="row">

                            <div class="form-group col-md-12">
                                <label for="email">Email <span class="text-lightred" style="font-size: 15px">*</span></label>
                                <select name="email" 
                                        class="form-control myInput" 
                                        id="email">
                                    <option>Select Email</option>

                                    @if ( !empty( $elite_members ) )

                                        @foreach( $elite_members as $member )

                                            <option value="{{ $member->id }}">
                                               {{ $member->first_name }} {{ $member->last_name }}, {{ $member->email }}
                                            </option>

                                        @endforeach

                                    @endif
                                </select>
                                @if ($errors->has('email'))
                                    <span class="help-block error-message">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif 
                            </div> 

                            <div class="form-group col-md-12">
                                <label for="amount">Amount <span class="text-lightred" style="font-size: 15px">*</span></label>
                                <input name="amount" 
                                        type="text" 
                                        class="form-control myInput" 
                                        id="email"
                                        value="{{ old('amount') }}">
                                @if ($errors->has('amount'))
                                    <span class="help-block error-message">
                                        <strong>{{ $errors->first('amount') }}</strong>
                                    </span>
                                @endif 
                            </div>                           


                            <div class="col-md-12">
                                <button type="submit" id="submit_btn" class="btn btn-success">Add</button>
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