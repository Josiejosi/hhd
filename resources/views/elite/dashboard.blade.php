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


@endsection

@section ('js')


@endsection