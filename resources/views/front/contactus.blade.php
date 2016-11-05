@extends('layouts.front')

@section ('content')

    <div id="fh5co-cut">
        <div class="container">
            <div class="row row-bottom-padded-lg">
                <div class="col-md-12 section-heading text-center">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2 to-animate"></div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <section id="content">
        <div class="content-wrap">

                <!-- ============ Contact section ============ -->
                <div class="container clearfix">

                    <div class="row">

                        <div class="col-md-8 col-md-offset-2">

                            @if (Session::has('account_not_found'))
                                <div class="alert alert-warning">
                                    <strong>{{ Session::get('account_not_found') }}</strong>
                                </div>
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

                        <div class="form-group col-md-12">
                            <label for="language">Preferable Language</label>
                            <select
                                name="language" 
                                type="text" 
                                class="form-control myInput" 
                                value="{{ old('language') }}"
                                id="language" required>

                                <option>English</option>
                                <option>Sotho</option>
                                <option>Zulu</option>

                            </select> 
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

                                <button type="submit" class="btn btn-success">Send Message</button>


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


                    </div>

                </div>
                <!-- ============ /Contact section ============ -->

        </div>
    </section>

    <hr />

@endsection