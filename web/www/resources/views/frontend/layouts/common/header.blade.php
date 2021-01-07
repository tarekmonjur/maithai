<header>
    <div class="container">
        <!----Left Side Of Header---->
        <div class="leftHeaderItem">
            <img src="{{asset('frontend/logo/logo.png')}}" alt="Mai Thai" />
        </div>

        <div class="float-left">
            <div style="margin: auto;padding: 5px 50px 0px;text-align: center;">
                <h5 style="color:white">
                    We are still working on our website.<br>
                    For place an order please<br>
                    Call: 01992641133
                </h5>
            </div>
        </div>

        <!----Right Side Of Header---->
        <div class="d-flex rightHeaderItem">
            <div class="items mr-4 rightHeaderItem">
                <!-- Top Menu -->
                <div class="topMenu">
                    <ul>
                        <li><a href="{{url('/contact')}}" class="text-capitalize">request call back</a></li>
                        <li><a href="{{url('/signup')}}" class="text-capitalize">register</a></li>
                        <li><a href="{{url('/login')}}" class="text-capitalize">login</a></li>
                    </ul>
                </div>
                <!-- Phone Contact -->
                <div class="mt-3 top-contact">
                    <div class="phone-num-bar">
                        <i class="fas fa-phone-alt icon"></i>
                        <div class="num">call: <span class="font-weight-bold">0199 2641 133</span></div>
                    </div>
                    <!-- Charts Total -->
                    <div class="cart-bar">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="badge badge-light">4</span>
                        <div class="carts-section text-uppercase">
                            <!-- <span class="mr-2">total carts: <span class="text-danger font-weight-bold">4</span></span>
                            <div style="border-left: 2px solid tomato;"></div>
                            <span>price amount: <span class="text-danger font-weight-bold">$1200</span></span> -->

                            <span class="text-uppercase font-weight-bold">
                                    total carts: <span class="text-danger font-weight-bold">4</span>
                                    <span class="ml-2 mr-2"> | </span>
                                    price amount: <span class="text-danger font-weight-bold">$1200</span>
                                </span>

                        </div>
                    </div>
                    <!-- Clock for Opening and closing time -->
                    <div class="buisness-hour">
                        <i class="far fa-clock"></i>
                        <div class="time-table">
                            <a href="#time-table-bookmark" class="bookmark-text">
                                    <span class="text-uppercase font-weight-bold">opening time & delivery time
                                        slot</span>
                            </a>
                        </div>
                    </div>

                </div>
            </div>

            <!-- QR-Code Section -->
            <div class="qr-code">
                <img class="img img-thumbnail img-qr-code img-fluid" src="{{asset('frontend/logo/qr-code.png')}}" alt="QR-CODE">
            </div>
        </div>
    </div>
</header>
