@extends('layouts.front')

@section ('content')

    <section id="content">
        <div class="content-wrap">

                <!-- ============ Contact section ============ -->
                <div class="container clearfix">

                    <div class="row">

                        <div class="col-md-8">

                            @if (Session::has('account_not_found'))
                                <span class="alert alert-warning">
                                    <strong>{{ Session::get('account_not_found') }}</strong>
                                </span>
                            @endif

                            <div class="heading-block mb-60">
                                <h2 class="text-uppercase"><span class="text-theme">Give us</span> a line</h2>

                            </div>

                            <form id="contactForm"  action="{{url('/contactus')}}" method="post">

                                {!! csrf_field() !!}


                                <div class="row">

                                    <div class="form-group col-sm-4">
                                        <label for="name">Name <span class="text-lightred" style="font-size: 15px">*</span></label>
                                        <input name="name" type="text" class="form-control myInput" id="name"
                                        value="{{ old('name') }}">
                                        @if ($errors->has('name'))
                                            <span class="help-block error-message">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif 
                                    </div>

                                    <div class="form-group col-sm-4">
                                        <label for="email">Email <span class="text-lightred" style="font-size: 15px">*</span></label>
                                        <input name="email" type="email" class="form-control myInput" id="email" 
                                        value="{{ old('email') }}">
                                        @if ($errors->has('email'))
                                            <span class="help-block error-message">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif

                                    </div>

                                    <div class="form-group col-sm-4">
                                        <label for="phone">Phone</label>
                                        <input name="phone" type="text" class="form-control myInput" id="phone">
                                    </div>

                                </div>

                                <div class="row">

                                    <div class="form-group col-sm-12">
                                        <label for="subject">Subject <span class="text-lightred" style="font-size: 15px">*</span></label>
                                        <input name="subject" type="text" class="form-control myInput" id="subject" 
                                        value="{{ old('subject') }}">
                                        @if ($errors->has('subject'))
                                            <span class="help-block error-message">
                                                <strong>{{ $errors->first('subject') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                </div>

                                <div class="row">

                                    <div class="form-group col-sm-12">
                                        <label for="message">Message <span class="text-lightred" style="font-size: 15px">*</span></label>
                                        <textarea name="message" class="form-control myInput" id="message" rows="8" >{{ old('subject') }}</textarea>

                                        @if ($errors->has('message'))
                                            <span class="help-block error-message">
                                                <strong>{{ $errors->first('message') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                </div>

                                <button type="submit" class="myBtn myBtn-rounded myBtn-lg myBtn-3d m-0 mt-10">Send Message</button>


                            </form>

                            <script type="text/javascript" src="{{asset('js/happy.js')}}"></script>

                            <script type="text/javascript">
                                $(function(){
                                    $('#contactForm').isHappy({
                                        fields: {
                                            // reference the field you're talking about, probably by `id`
                                            // but you could certainly do $('[name=name]') as well.
                                            '#name': {
                                                required: true,
                                                message: 'Might we inquire your name'
                                            },
                                            '#email': {
                                                required: true,
                                                message: 'How are we to reach you sans email?'
                                            },
                                            '#subject': {
                                                required: true,
                                                message: 'About what you are contacting us?'
                                            },
                                            '#message': {
                                                required: true,
                                                message: 'Describe it more please'
                                            }
                                        }
                                    });
                                });
                            </script>

                        </div>

                        <div class="col-md-4">

                            <div>
                                <h3 class="text-uppercase">Headquarters</h3>

                                <address>
                                    <strong class="text-theme">Prestige Wallet.</strong><br>
                                    Pretoria West, 200 Kraai<br>
                                    102 Bloekenhout hof<br>

                                    <strong class="block mt-20">Email:</strong>
                                    <a href="#">info@prestigewallet.com</a><br>
                                    <a href="#">support@prestigewallet.com</a>

                                    <div class="social mt-40 mb-60">
                                        <a class="social-icon social-facebook" href="#">
                                            <div class="front">
                                                <i class="fa fa-facebook"></i>
                                            </div>
                                            <div class="back">
                                                <i class="fa fa-facebook"></i>
                                            </div>
                                        </a>

                                        <a class="social-icon social-twitter" href="#">
                                            <div class="front">
                                                <i class="fa fa-twitter"></i>
                                            </div>
                                            <div class="back">
                                                <i class="fa fa-twitter"></i>
                                            </div>
                                        </a>
                                    </div>
                                </address>

                                <h3 class="text-uppercase"><span class="text-theme">Business</span> Hours</h3>

                                <address>
                                    <strong>Monday - Friday:</strong> 9:00 - 17:00<br>
                                    <strong>Saturday:</strong> 9:00 - 12:00<br>
                                    <strong>Sunday:</strong> Closed
                                </address>

                            </div>

                        </div>

                    </div>

                </div>
                <!-- ============ /Contact section ============ -->

        </div>
    </section>

@endsection