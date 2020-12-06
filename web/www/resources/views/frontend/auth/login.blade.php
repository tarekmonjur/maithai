@extends('frontend.layouts.app')

@section('main_content')

    <!-------------------- Login and Register Form ------------------------>
    <section id="login-register" class="mt-5 mb-5">
        <div class="container">
            <div class="formContainer">
                <div class="row form-row d-flex">
                    <!------------ Login Div Column --------->
                    <div class="login-section ml-2 mr-4">
                        <form action="" class="form-section" style="margin-left: 2rem;">
                            <!-- Labels for Login -->
                            <div class="form-label">
                                <h1 class="text-capitalize">user login</h1>
                            </div>

                            <!-- Email On Login -->
                            <div class="form-group mt-4">
                                <input type="email" class="form-control" placeholder="Email">
                            </div>

                            <!-- Password On Login -->
                            <div class="form-group">
                                <input type="password" class="form-control" placeholder="password">
                            </div>

                            <!-- Remember Me Checkbox! -->
                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">Remember me!</label>
                            </div>

                            <!-- Button for Submit Login -->
                            <button type="submit" class="btn login-btn">login</button>
                        </form>
                    </div>

                    <!----------- Register Section ------------->
                    <div class="register-section">
                        <form action="" class="form-section" style="margin-right: 2rem;">
                            <!-- Form Label -->
                            <div class="form-label">
                                <h1 class="text-capitalize mb-4">register for first time user?</h1>
                                <p class="mb-4">
                                    If you havn't any "MaiThai" account, you can register from here. And login with your account. You can
                                    follow our terms <mark><a href="{{url('/terms-policy')}}">here</a></mark>
                                </p>
                            </div>

                            <!-- Register Button -->
                            <div class="form-group">
                                <!-- Button trigger modal -->
                                <a href="{{url('/signup')}}" class="btn btn-lg btn-warning register-btn text-capitalize">
                                    continue to register
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
