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

            <div class="container clearfix w-3xl">

                <h3><i class="fa fa-user-secret"></i> Support</h3>

                @if (Session::has('account_not_found'))
                    <div class="alert alert-warning">
                        <strong>{{ Session::get('account_not_found') }}</strong>
                    </div>
                @endif

                <form action="{{url('/signin')}}" method="post">

                    {!! csrf_field() !!}
                    
                    <div class="row">

                        <div class="form-group col-md-12">
                            <label for="username">Name</label>
                            <input 
                                name="username" 
                                type="text" 
                                class="form-control myInput" 
                                value="{{ old('username') }}"
                                id="username" required>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="username">Preferable Language</label>
                            <select
                                name="username" 
                                type="text" 
                                class="form-control myInput" 
                                value="{{ old('username') }}"
                                id="username" required>

                                <option>English</option>
                                <option>Sotho</option>
                                <option>Zulu</option>

                            </select> 
                        </div>

                        <div class="form-group col-md-12">
                            <label for="username">Email</label>
                            <input 
                                name="username" 
                                type="text" 
                                class="form-control myInput" 
                                value="{{ old('username') }}"
                                id="username" required>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="username">Subject</label>
                            <input 
                                name="username" 
                                type="text" 
                                class="form-control myInput" 
                                value="{{ old('username') }}"
                                id="username" required>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="username">Message</label>
                            <input 
                                name="username" 
                                type="text" 
                                class="form-control myInput" 
                                value="{{ old('username') }}"
                                id="username" required>
                        </div>


                        <div class="col-md-12">
                            <button type="submit" class="btn btn-lg btn-success">Submit</button>
                        </div>

                    </div>
                </form>


            </div>

        </div>
    </section>

@endsection