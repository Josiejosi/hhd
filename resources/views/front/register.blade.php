@extends('layouts.front')

@section ('content')

    <section id="content">
        <div class="content-wrap">

                <!-- ============ sign up ============ -->
                <div class="container clearfix w-3xl">

                    <h3><i class="fa fa-lock"></i> Register a new account</h3>

                    <form>
                        <div class="row">

                            <div class="form-group col-md-12">
                                <label for="name">Name <span class="text-lightred" style="font-size: 15px">*</span></label>
                                <input name="name" type="text" class="form-control myInput" id="name" required>
                            </div>

                            <div class="form-group col-md-12">
                                <label for="email">Email <span class="text-lightred" style="font-size: 15px">*</span></label>
                                <input name="email" type="email" class="form-control myInput" id="email" required>
                            </div>

                            <div class="form-group col-md-12">
                                <label for="username">Username <span class="text-lightred" style="font-size: 15px">*</span></label>
                                <input name="username" type="text" class="form-control myInput" id="username" required>
                            </div>

                            <div class="form-group col-md-12">
                                <label for="phone">Phone</label>
                                <input name="phone" type="text" class="form-control myInput" id="phone">
                            </div>

                            <div class="form-group col-md-12">
                                <label for="password">Password <span class="text-lightred" style="font-size: 15px">*</span></label>
                                <input name="password" type="password" class="form-control myInput" id="password" required>
                            </div>

                            <div class="form-group col-md-12">
                                <label for="password-conf">Password Confirm <span class="text-lightred" style="font-size: 15px">*</span></label>
                                <input name="password-conf" type="password" class="form-control myInput" id="password-conf" required>
                            </div>

                            <div class="col-md-12">
                                <button type="submit" class="myBtn myBtn-rounded myBtn-dark m-0 mt-10">Register Now</button>
                            </div>

                        </div>
                    </form>


                </div><!-- /sign up -->

        </div>
    </section>

@endsection