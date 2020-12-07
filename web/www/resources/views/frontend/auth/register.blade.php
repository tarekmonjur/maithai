@extends('frontend.layouts.app')

@section('main_content')

    <section id="login-register" class="mt-5 mb-5">
        <div class="container">
            <div class="formContainer">
                <div class="row form-row d-flex">
                    <!----------- Register Section ------------->
                    <div class="register-section-2">
                        <form action="" class="form-section" style="margin-right: 2rem;">
                            <!-- Form Label -->
                            <div class="form-label">
                                <h1 class="text-capitalize mb-4">register now !</h1>
                            </div>

                            <!-- First & Last Name -->
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <input type="text" class="form-control" placeholder="First Name">
                                </div>

                                <div class="form-group col-md-6">
                                    <input type="text" class="form-control" placeholder="Last Name">
                                </div>
                            </div>

                            <!-- Address On Regiser -->
                            <div class="form-group">
                                <textarea class="form-control" placeholder="Addresss" name="" id="" cols="30" rows="5"></textarea>
                            </div>

                            <!-- Email On Register -->
                            <div class="form-group">
                                <input type="email" class="form-control" placeholder="Email">
                            </div>

                            <!-- Password On Register -->
                            <div class="form-group">
                                <input type="password" class="form-control" placeholder="Password">
                            </div>

                            <!-- Re_Password On Register -->
                            <div class="form-group">
                                <input type="password" class="form-control" placeholder="Re-password">
                            </div>

                            <!-- Number Register -->
                            <div class="form-group">
                                <input type="number" class="form-control" placeholder="Phone Number">
                            </div>

                            <!-- Register Button -->
                            <div class="form-group">
                                <!-- Button trigger modal -->
                                <a href="register.html" class="btn btn-lg btn-warning register-btn text-capitalize">
                                    Register
                                </a>
                            </div>
                        </form>
                    </div>

                    <!------------ Login Div Column --------->
                    <div class="login-section-2 ml-2 mr-4">
                        <div class="form-section" style="margin-left: 2rem;">
                            <!-- Labels for Login -->
                            <div class="form-label">
                                <h1 class="text-capitalize">already have an account ?</h1>
                            </div>

                            <div class="form-label mt-4 mb-4">
                                <p>
                                    Go to login section to login now. If you are have already an account. You can know our users login &
                                    register policy. And follow our terms (Changing Or Accessing Your Information) of user registration &
                                    login from <mark><a href="{{url('/terms-policy')}}">here</a></mark>
                                </p>
                            </div>

                            <!-- Button for Submit Login -->
                            <a href="{{url('/login')}}" class="btn login-btn">Go For Login</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

@endsection
