@extends('frontend.layouts.app')
@push('style')
<link rel="stylesheet" type="text/css" href="{{asset('frontend/css/home.css')}}">
@endpush

@section('main_content')
<!------------- SECTION of Banners Page ----------------->
<div id="homeCarouselIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#homeCarouselIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#homeCarouselIndicators" data-slide-to="1"></li>
    </ol>

    <!---------- All Sliders Carousel's Here! --------->
    <div class="carousel-inner">
        <!----------- The Carousels First Item here ------------->
        <div class="carousel-item active">
            <section id="home-cover">
                <div class="jumbotron">
                    <div class="dark-bg">
                        <div id="intro">
                            <div id="intro-section" class="mb-4">
                                <h1 class="intro-title text-uppercase mb-4">
                                    mai thai
                                    <br>
                                    <span>
                                            <small class="small">kitchen</small>
                                        </span>
                                </h1>
                                <h5 class="intro-info text-capitalize mb-3">find the best food, cafes & cuisine.
                                </h5>
                            </div>

                            <!-- 1st Home Carousels Search bar -->
                            <div class="search-food mb-5">
                                <input type="text" placeholder="Find Your Choice!" class="form-control">
                                <button type="submit" class="btn btn-danger btn-custom text-uppercase">
                                    <i class="fas fa-search"></i>
                                    <span> </span>
                                    <span>Search</span>
                                </button>
                            </div>

                            <a href="aboutUs.html" class="about-btn mt-4">About The Restaurant</a>
                            <a href="foodOrder.html" class="order-btn mt-4 ml-3">Order Food Online!</a>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <!-------- Carousels 2nd Item here -------->
        <div class="carousel-item">
            <section id="home-cover-2">
                <div class="jumbotron">
                    <div class="dark-bg">
                        <div id="intro">
                            <div id="intro-section" class="mb-4">
                                <h1 class="intro-title home-slide-intro-2 mb-4"
                                    style="font-weight: 500; font-size: 50px;">
                                        <span style="font-weight: lighter;">
                                            "Short of screaming-hot Thai food,
                                        </span>
                                    <span class="text-light" style="font-weight: bold;">
                                            everything can be suitable for kids too"
                                        </span>
                                </h1>
                            </div>

                            <a href="aboutUs.html" class="about-btn mt-4">About The Restaurant</a>
                            <a href="foodOrder.html" class="order-btn mt-4 ml-3">Order Food Online!</a>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>


    <!-- Carousel's Arrow Buttons for Next & Previous -->
    <a class="carousel-control-prev home-slide-prev" href="#homeCarouselIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next home-slide-next" href="#homeCarouselIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
<!---- END of The Banners Slider Section of Home page ---->


<!--------- The Search Collapse DropDown Bar For Home Carousel ------->
<ul class="search-dropdown-menu" style="display: none;">
    <li class="search-item mt-2"><a href="#">
            <div class="image">
                <img src="{{asset('frontend/img/card1.jpg')}}" alt="card1" class="search-bar-image">
            </div>
            <div class="nameAndPrice">
                <div class="name">Big 8</div>
                <div class="price">$800.</div>
            </div>
        </a></li>
    <hr>

    <li class="search-item"><a href="#">
            <div class="image">
                <img src="{{asset('frontend/img/card1.jpg')}}" alt="card1" class="search-bar-image">
            </div>

            <div class="nameAndPrice">
                <div class="name">Pizza</div>
                <div class="price">$700.</div>
            </div>
        </a></li>
    <hr>

    <li class="search-item"><a href="#">
            <div class="image">
                <img src="{{asset('frontend/img/card1.jpg')}}" alt="card1" class="search-bar-image">
            </div>

            <div class="nameAndPrice">
                <div class="name">Fish Kabab</div>
                <div class="price">$430.</div>
            </div>
        </a></li>
    <hr>

    <li class="search-item"><a href="#">
            <div class="image">
                <img src="{{asset('frontend/img/card1.jpg')}}" alt="card1" class="search-bar-image">
            </div>

            <div class="nameAndPrice">
                <div class="name">Mutton Biriyani</div>
                <div class="price">$860.</div>
            </div>
        </a></li>
    <hr>

    <li class="search-item mb-2"><a href="#">
            <div class="image">
                <img src="{{asset('frontend/img/card1.jpg')}}" alt="card1" class="search-bar-image">
            </div>

            <div class="nameAndPrice">
                <div class="name">Masala Pasta</div>
                <div class="price">$600.</div>
            </div>
        </a></li>
</ul>


<!---------------- Title Of Delivery and Others ShowCase ------------>
<section class="jumbotron jumbo-one mt-0 mb-5">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-jumbo-one">
                <div class="rounded-icon"><i class="fas fa-bolt"></i></div>
                <p>Fast Delivery</p>
            </div>
            <div class="col-md-3 col-jumbo-one">
                <div class="rounded-icon"><i class="fas fa-weight"></i></div>
                <p>Minimum order &#163;10</p>
            </div>
            <div class="col-md-3 col-jumbo-one">
                <div class="rounded-icon"><i class="far fa-credit-card"></i></div>
                <p>Pay via Card/Cash</p>
            </div>
            <div class="col-md-3 col-jumbo-one">
                <div class="rounded-icon"><i class="fas fa-dollar-sign"></i></div>
                <p>Deals Discounts</p>
            </div>
        </div>
    </div>
</section>

<!--------------- WELCOME Section --------------->
<section class="container mb-4">
    <div class="mt-5 row">
        <!-- Aside LeftSide -->
        <aside class="col-md-6 text-center">
            <div class="card" style="width: 33rem; min-height: 380px;">
                <div class="card-body">
                    <h1 class="card-title text-capitalize m-4" style="color: tomato;">welcome to MAITHAI</h1>
                    <h6 class="card-subtitle mb-2">Get Best, Feel Happy!</h6>
                    <p class="card-text text-muted"
                       style="font-size: 13px; word-spacing: 2px; letter-spacing: 0.5px; ">Mai Thai Delivers
                        Deliciously Authentic Thai Mai Kitchen & an atmosphere that is friendly and fun for the
                        whole family. Our authentic Thai Mai Menu balances elements of sweet and sour, salt and
                        spice to bring the best Thai Flavours
                        to your Table. Prepared by experienced Thai Chefs, We offer a range of dishes from the
                        classic Pad Thai to Authentic Thai curries.</p>

                    <a href="aboutUs.html" class="btn btn-custom m-4">
                        <span class="text-uppercase">more info</span>
                    </a>
                </div>
            </div>
        </aside>

        <!-- Aside RightSide -->
        <aside class="col-md-6">
            <img src="{{asset('frontend/img/mai.png')}}" alt="PIZZAAA" class="img img-fluid" style="min-height: 380px">
        </aside>
    </div>
</section>
<br>
<hr>

<!-------------- Food Content ----------------->
<section class="container mt-5">
    <div class="text-center mb-4 d-block">
        <h1 style="color: tomato; text-align: center;" class="text-shadow our-food-style-title">Our Food Styles</h1>
        <div class="underline mt-2"
             style="border-bottom: 4px solid tomato; width: 5rem; position: absolute; left: 50%; transform: translate(-50%, 0); ">
        </div>
    </div>

    <!-- Top Sale Foods 1st ROW -->
    <div class="row mb-5 mt-5 top-sales-food">
        <div class="col-md-4">
            <div class="card special-food-card" style="width: 20rem;">
                <!-- <div class="cart-top-banner"></div> -->
                <img src="{{asset('frontend/img/gellary/ma7.jpg')}}" class="card-img-top cart-img food-style-cart" alt="...">
                <div class="card-body">
                    <h5 class="card-title text-uppercase font-weight-bold">big 8</h5>
                    <p class="text-danger mb-2 font-weight-bold">$800.00</p>
                    <p class="text-muted mb-2">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Dignissimos fugit blanditiis libero
                        debitis!
                    </p>
                    <a href="#" class="btn btn-custom">
                        <i class="fas fa-plus-circle"></i>
                        <span class="text-capitalize">add cart</span>
                    </a>
                </div>
            </div>
        </div>
        <!-- COL -->
        <div class="col-md-4">
            <div class="card special-food-card" style="width: 20rem;">
                <!-- <div class="cart-top-banner"></div> -->
                <img src="{{asset('frontend/img/gellary/ma8.jpg')}}" class="card-img-top cart-img food-style-cart" alt="...">
                <div class="card-body">
                    <h5 class="card-title text-uppercase font-weight-bold">triple treat meal</h5>
                    <p class="text-danger mb-2 font-weight-bold">$999.00</p>
                    <p class="text-muted mb-2">
                        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eum omnis id, ut cumque.
                    </p>
                    <a href="#" class="btn btn-custom">
                        <i class="fas fa-plus-circle"></i>
                        <span class="text-capitalize">add cart</span>
                    </a>
                </div>
            </div>
        </div>
        <!-- COL -->
        <div class="col-md-4">
            <div class="card special-food-card" style="width: 20rem;">
                <!-- <div class="cart-top-banner"></div> -->
                <img src="{{asset('frontend/img/gellary/ma9.jpg')}}" class="card-img-top cart-img food-style-cart" alt="...">
                <div class="card-body">
                    <h5 class="card-title text-uppercase font-weight-bold">Buddy Rice Combo</h5>
                    <p class="text-danger mb-2 font-weight-bold">$899.00</p>
                    <p class="text-muted mb-2">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Cumque sapiente tenetur repellendus
                        necessitatibus.
                    </p>
                    <a href="#" class="btn btn-custom">
                        <i class="fas fa-plus-circle"></i>
                        <span class="text-capitalize">add cart</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Top Sale Foods 2nd ROW -->
    <div class="row mb-5">
        <div class="col-md-4">
            <div class="card special-food-card" style="width: 20rem;">
                <!-- <div class="cart-top-banner"></div> -->
                <img src="{{asset('frontend/img/gellary/ma10.jpg')}}" class="card-img-top cart-img food-style-cart" alt="...">
                <div class="card-body">
                    <h5 class="card-title text-uppercase font-weight-bold">Buddy Zinger Combo</h5>
                    <p class="text-danger mb-2 font-weight-bold">$800.00</p>
                    <p class="text-muted mb-2">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Dignissimos fugit blanditiis libero
                        debitis!
                    </p>
                    <a href="#" class="btn btn-custom">
                        <i class="fas fa-plus-circle"></i>
                        <span class="text-capitalize">add cart</span>
                    </a>
                </div>
            </div>
        </div>
        <!-- COL -->
        <div class="col-md-4">
            <div class="card special-food-card" style="width: 20rem;">
                <!-- <div class="cart-top-banner"></div> -->
                <img src="{{asset('frontend/img/gellary/ma5.jpg')}}" class="card-img-top cart-img food-style-cart" alt="...">
                <div class="card-body">
                    <h5 class="card-title text-uppercase font-weight-bold">Zing N Fries Meal</h5>
                    <p class="text-danger mb-2 font-weight-bold">$999.00</p>
                    <p class="text-muted mb-2">
                        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eum omnis id, ut cumque.
                    </p>
                    <a href="#" class="btn btn-custom">
                        <i class="fas fa-plus-circle"></i>
                        <span class="text-capitalize">add cart</span>
                    </a>
                </div>
            </div>
        </div>
        <!-- COL -->
        <div class="col-md-4">
            <div class="card special-food-card" style="width: 20rem;">
                <!-- <div class="cart-top-banner"></div> -->
                <img src="{{asset('frontend/img/gellary/ma6.jpg')}}" class="card-img-top cart-img food-style-cart" alt="...">
                <div class="card-body">
                    <h5 class="card-title text-uppercase font-weight-bold">Stay at Home Bucket</h5>
                    <p class="text-danger mb-2 font-weight-bold">$899.00</p>
                    <p class="text-muted mb-2">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Cumque sapiente tenetur repellendus
                        necessitatibus.
                    </p>
                    <a href="#" class="btn btn-custom">
                        <i class="fas fa-plus-circle"></i>
                        <span class="text-capitalize">add cart</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<hr>

<!----------- FOOD OFFERS Tab ------------->
<section class="mt-5 mb-5">
    <div class="text-center mb-5 d-block">
        <h1 style="color: tomato; text-align: center;" class="text-shadow food-menu-title">Food Menu</h1>
        <div class="underline mt-2"
             style="border-bottom: 4px solid tomato; width: 5rem; position: absolute; left: 50%; transform: translate(-50%, 0); ">
        </div>
    </div>
    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner container">
            <div class="row carousel-item food-menu-carousel active">
                <div class="col-md-6 carousel-image">
                    <img src="{{asset('frontend/img/gellary/ma8.jpg')}}"
                         class="d-block img img-fluid img-offer food-image img-thumbnail" alt="...">
                </div>
                <div class="col-md-6 float-right text-dark food-menu-list">
                    <h1 class="text-uppercase display-2 text-shadow">Indian</h1>

                    <div class="d-flex offer-list">
                        <ul class="list-group list-group-flush offer-list-ul">
                            <li class="list-group-item">- veggie wrap</li>
                            <li class="list-group-item">- karahi panner</li>
                            <li class="list-group-item">- tandoori murgi</li>
                            <li class="list-group-item">- mutton biriyani</li>
                            <li class="list-group-item">- fish pakora</li>
                        </ul>
                        <ul class="list-group list-group-flush offer-list-ul">
                            <li class="list-group-item">- kabab meet</li>
                            <li class="list-group-item">- fish kabab</li>
                            <li class="list-group-item">- thai</li>
                            <li class="list-group-item">- malai kofta</li>
                            <li class="list-group-item">- pizza</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Fast Food List -->
            <div class="row carousel-item food-menu-carousel fast-food-row">
                <div class="col-md-6 carousel-image">
                    <img src="{{asset('frontend/img/gellary/ma9.jpg')}}"
                         class="d-block img img-fluid img-offer food-image img-thumbnail" alt="...">
                </div>
                <div class="col-md-6 float-right text-dark food-menu-list">
                    <h1 class="text-uppercase display-2 text-shadow">Fast</h1>

                    <div class="d-flex offer-list">
                        <ul class="list-group list-group-flush offer-list-ul">
                            <li class="list-group-item">- veggie wrap</li>
                            <li class="list-group-item">- karahi panner</li>
                            <li class="list-group-item">- tandoori murgi</li>
                            <li class="list-group-item">- mutton biriyani</li>
                            <li class="list-group-item">- fish pakora</li>
                        </ul>
                        <ul class="list-group list-group-flush offer-list-ul">
                            <li class="list-group-item">- kabab meet</li>
                            <li class="list-group-item">- fish kabab</li>
                            <li class="list-group-item">- malai kofta</li>
                            <li class="list-group-item">- pizza</li>
                            <li class="list-group-item">- tandoori</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Junk Food List -->
            <div class="row carousel-item food-menu-carousel">
                <div class="col-md-6 carousel-image">
                    <img src="{{asset('frontend/img/gellary/ma7.jpg')}}"
                         class="d-block img img-fluid img-offer food-image img-thumbnail" alt="...">
                </div>
                <div class="col-md-6 float-right text-dark food-menu-list">
                    <h1 class="text-uppercase display-2 text-shadow">Thai</h1>

                    <div class="d-flex offer-list">
                        <ul class="list-group list-group-flush offer-list-ul">
                            <li class="list-group-item">- veggie wrap</li>
                            <li class="list-group-item">- karahi panner</li>
                            <li class="list-group-item">- tandoori murgi</li>
                            <li class="list-group-item">- mutton biriyani</li>
                            <li class="list-group-item">- fish pakora</li>
                        </ul>
                        <ul class="list-group list-group-flush offer-list-ul">
                            <li class="list-group-item">- malai kofta</li>
                            <li class="list-group-item">- malai ice</li>
                            <li class="list-group-item">- fish kabab</li>
                            <li class="list-group-item">- malai kofta</li>
                            <li class="list-group-item">- chiness</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Chineese Food List -->
            <div class="row carousel-item fast-food-row food-menu-carousel">
                <div class="col-md-6 carousel-image">
                    <img src="{{asset('frontend/img/gellary/ma6.jpg')}}"
                         class="d-block img img-fluid img-offer food-image img-thumbnail" alt="...">
                </div>
                <div class="col-md-6 float-right text-dark food-menu-list">
                    <h1 class="text-uppercase display-2 text-shadow">Chinese</h1>

                    <div class="d-flex offer-list">
                        <ul class="list-group list-group-flush offer-list-ul">
                            <li class="list-group-item">- veggie wrap</li>
                            <li class="list-group-item">- karahi panner</li>
                            <li class="list-group-item">- tandoori murgi</li>
                            <li class="list-group-item">- mutton biriyani</li>
                            <li class="list-group-item">- fish pakora</li>
                        </ul>
                        <ul class="list-group list-group-flush offer-list-ul">
                            <li class="list-group-item">- kabab meet</li>
                            <li class="list-group-item">- fish kabab</li>
                            <li class="list-group-item">- malai kofta</li>
                            <li class="list-group-item">- pizza</li>
                            <li class="list-group-item">- tandoori</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Italian Food List -->
            <div class="row carousel-item fast-food-row food-menu-carousel">
                <div class="col-md-6 carousel-image">
                    <img src="{{asset('frontend/img/gellary/ma5.jpg')}}"
                         class="d-block img img-fluid img-offer food-image img-thumbnail" alt="...">
                </div>
                <div class="col-md-6 float-right text-dark food-menu-list">
                    <h1 class="text-uppercase display-2 text-shadow">Italian</h1>

                    <div class="d-flex offer-list">
                        <ul class="list-group list-group-flush offer-list-ul">
                            <li class="list-group-item">- veggie wrap</li>
                            <li class="list-group-item">- karahi panner</li>
                            <li class="list-group-item">- tandoori murgi</li>
                            <li class="list-group-item">- mutton biriyani</li>
                            <li class="list-group-item">- fish pakora</li>
                        </ul>
                        <ul class="list-group list-group-flush offer-list-ul">
                            <li class="list-group-item">- kabab meet</li>
                            <li class="list-group-item">- fish kabab</li>
                            <li class="list-group-item">- malai kofta</li>
                            <li class="list-group-item">- pizza</li>
                            <li class="list-group-item">- tandoori</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- The Arrow Buttons For Next Previous -->
        <a class="ml-5 carousel-control-prev menu-btn" href="#carouselExampleControls" role="button"
           data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="mr-5 carousel-control-next menu-btn" href="#carouselExampleControls" role="button"
           data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</section>

<!--------------------- SPECIAL OFFERS FOOD MENU ------------------>
<section class="jumbotron special-food-menu">
    <div class="dark-bg-opacity">
        <div class="container">
            <div class="carousel-title mb-5">
                <h1 class="text-light no-margin-top text-center-sm text-center-xs">Special Offers</h1>
            </div>
        </div>
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <!-- Carousel One -->
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="d-flex justify-content-center cards-group">
                        <div class="card ml-2 mr-2 special-card">
                            <!-- <img src="assets/img/card1.jpg" class="card-img-top card-img" alt="..."> -->
                            <img src="{{asset('frontend/img/mai2.jpg')}}" class="card-img-top card-img" alt="...">
                            <div class="card-body">
                                <h3 class="card-title">Food Paradise</h3>
                                <p class="card-text text-muted">This is a wider card with supporting text below as a
                                    natural lead-in to additional content. This content is a little bit longer.</p>
                                <h6 class="text-danger mt-2 font-weight-bold">About 20% Off</h6>
                            </div>
                        </div>

                        <div class="card ml-2 mr-2 special-card">
                            <!-- <img src="assets/img/card2.jpg" class="card-img-top card-img" alt="..."> -->
                            <img src="{{asset('frontend/img/mai3.jpg')}}" class="card-img-top card-img" alt="...">
                            <div class="card-body">
                                <h3 class="card-title">Vanilla Food</h3>
                                <p class="card-text text-muted">This is a wider card with supporting text below as a
                                    natural lead-in to additional content. This content is a little bit longer.</p>
                                <h6 class="text-danger mt-2 font-weight-bold">About 20% Off</h6>
                            </div>
                        </div>

                        <div class="card ml-2 mr-2 special-card">
                            <!-- <img src="assets/img/card3.jpg" class="card-img-top card-img" alt="..."> -->
                            <img src="{{asset('frontend/img/mai4.jpg')}}" class="card-img-top card-img" alt="...">
                            <div class="card-body">
                                <h3 class="card-title">Food Basera</h3>
                                <p class="card-text text-muted">This is a wider card with supporting text below as a
                                    natural lead-in to additional content. This content is a little bit longer.</p>
                                <h6 class="text-danger mt-2 font-weight-bold">About 50% Off</h6>
                            </div>
                        </div>
                        <div class="card ml-2 mr-2 special-card">
                            <!-- <img src="assets/img/card4.jpg" class="card-img-top card-img" alt="..."> -->
                            <img src="{{asset('frontend/img/mai5.jpg')}}" class="card-img-top card-img" alt="...">
                            <div class="card-body">
                                <h3 class="card-title">Thai Food</h3>
                                <p class="card-text text-muted">This is a wider card with supporting text below as a
                                    natural lead-in to additional content. This content is a little bit longer.</p>
                                <h6 class="text-danger mt-2 font-weight-bold">About 30% Off</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Carousel Two -->
                <div class="carousel-item">
                    <div class="d-flex justify-content-center cards-group">
                        <div class="card ml-2 mr-2 special-card">
                            <!-- <img src="assets/img/card5.jpg" class="card-img-top card-img" alt="..."> -->
                            <img src="{{asset('frontend/img/mai6.jpg')}}" class="card-img-top card-img" alt="...">
                            <div class="card-body">
                                <h3 class="card-title">Taj Mahal Food</h3>
                                <p class="card-text text-muted">This is a wider card with supporting text below as a
                                    natural lead-in to additional content. This content is a little bit longer.</p>
                                <h6 class="text-danger mt-2 font-weight-bold">About 20% Off</h6>
                            </div>
                        </div>

                        <div class="card ml-2 mr-2 special-card">
                            <!-- <img src="assets/img/card6.jpg" class="card-img-top card-img" alt="..."> -->
                            <img src="{{asset('frontend/img/mai5.jpg')}}" class="card-img-top card-img" alt="...">
                            <div class="card-body">
                                <h3 class="card-title">Indian Biriyani</h3>
                                <p class="card-text text-muted">This is a wider card with supporting text below as a
                                    natural lead-in to additional content. This content is a little bit longer.</p>
                                <h6 class="text-danger mt-2 font-weight-bold">About 10% Off</h6>
                            </div>
                        </div>

                        <div class="card ml-2 mr-2 special-card">
                            <!-- <img src="assets/img/kacchi.jpg" class="card-img-top card-img" alt="..."> -->
                            <img src="{{asset('frontend/img/mai4.jpg')}}" class="card-img-top card-img" alt="...">
                            <div class="card-body">
                                <h3 class="card-title">Green Bawarchi</h3>
                                <p class="card-text text-muted">This is a wider card with supporting text below as a
                                    natural lead-in to additional content. This content is a little bit longer.</p>
                                <h6 class="text-danger mt-2 font-weight-bold">About 20% Off</h6>
                            </div>
                        </div>
                        <div class="card ml-2 mr-2 special-card">
                            <img src="{{asset('frontend/img/gellary/ma8.jpg')}}" class="card-img-top card-img" alt="...">
                            <div class="card-body">
                                <h3 class="card-title">Chineese</h3>
                                <p class="card-text text-muted">This is a wider card with supporting text below as a
                                    natural lead-in to additional content. This content is a little bit longer.</p>
                                <h6 class="text-danger mt-2 font-weight-bold">About 5% Off</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Carousel Buttons To Control -->
            <a class="carousel-control-prev offer-slide" href="#carouselExampleIndicators" role="button"
               data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next offer-slide" href="#carouselExampleIndicators" role="button"
               data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
</section>

<!--------------- CONTACT US ---------------->
<section class="jumbotron contact-jumbo mb-4">
    <div class="container">
        <!-- 1st Row -->
        <div class="row">
            <div class="col-md-12 text-center mb-5 d-block">
                <h2 class="text-capitalize contact-us-title">contact us</h2>
                <p class="text-capitalize">for any queries or concerns</p>
                <div class="underline mt-3 m-auto"
                     style="border-bottom: 4px solid tomato; width: 5rem; padding-top: 15px;"></div>
            </div>
        </div>
        <!-- 2nd Row -->
        <div class="row text-center">
            <div class="col-md-4 d-block contact-col">
                <div class="rounded-contact-icon m-auto">
                    <i class="fas fa-map-marker-alt"></i>
                </div>
                <h6 class="font-weight-bold">Address</h6>
                <p class="text-muted">
                    37 High street Cheshunt, Waltham Cross, EN80BS, UK
                </p>
            </div>
            <div class="col-md-4 d-block contact-col">
                <div class="rounded-contact-icon m-auto">
                    <i class="fas fa-phone"></i>
                </div>
                <h6 class="font-weight-bold">Phone Number</h6>
                <p class="text-muted">
                    01992 641133
                </p>
            </div>
            <div class="col-md-4 d-block contact-col">
                <div class="rounded-contact-icon m-auto">
                    <i class="fas fa-envelope"></i>
                </div>
                <h6 class="font-weight-bold">Email</h6>
                <p class="text-muted">
                    maithaikitchen@hotmail.com
                </p>
            </div>
        </div>
    </div>
</section>
<hr>
<br>

<!--------------- Gellary Section ---------------->
<section class="jumbotron contact-jumbo mb-4">
    <div class="">
        <!-- 1st Row -->
        <div class="row">
            <div class="col-md-12 text-center mb-5 d-block" style="margin-bottom: 0 !important">
                <h2 class="text-capitalize gellary-title">Gallery</h2>
                <p class="text-capitalize">check gallery for our most popular dishes</p>
                <div class="underline mt-3 m-auto"
                     style="border-bottom: 4px solid tomato; width: 5rem; padding-top: 15px;"></div>
            </div>
        </div>
        <!-- 2nd Row  The Popular Gellary Section of here-->
        <div class="row text-center" style="overflow: unset !important;">
            <div class="slideGellary hi-slide" style="overflow: unset !important;">
                <!-- Next & Previos Buttons -->
                <a class="hi-prev carousel-control-prev" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="hi-next carousel-control-next" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>

                <ul>
                    <li>
                        <img class="img-fluid" src="{{asset('frontend/img/gellary/ma1.jpg')}}" alt="Img 1" />
                    </li>

                    <li>
                        <img class="img-fluid" src="{{asset('frontend/img/gellary/ma2.jpg')}}" alt="Img 2" />
                    </li>

                    <li>
                        <img class="img-fluid" src="{{asset('frontend/img/gellary/ma3.jpg')}}" alt="Img 3" />
                    </li>

                    <li>
                        <img class="img-fluid" src="{{asset('frontend/img/gellary/ma4.jpg')}}" alt="Img 4" />
                    </li>

                    <li>
                        <img class="img-fluid" src="{{asset('frontend/img/gellary/ma5.jpg')}}" alt="Img 5" />
                    </li>

                    <li>
                        <img class="img-fluid" src="{{asset('frontend/img/gellary/ma6.jpg')}}" alt="Img 6" />
                    </li>

                    <li>
                        <img class="img-fluid" src="{{asset('frontend/img/gellary/ma7.jpg')}}" alt="Img 7" />
                    </li>

                    <li>
                        <img class="img-fluid" src="{{asset('frontend/img/gellary/ma8.jpg')}}" alt="Img 8" />
                    </li>

                    <li>
                        <img class="img-fluid" src="{{asset('frontend/img/gellary/ma9.jpg')}}" alt="Img 9" />
                    </li>

                    <li>
                        <img class="img-fluid" src="{{asset('frontend/img/gellary/ma10.jpg')}}" alt="Img 10" />
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>
<hr>
<br>

<!-- Subcriptions and the newsletter -->
<section class="subcription mt-5">
    <div class="container">
        <div class="row">
            <!-- Col-1 -->
            <div class="col-md-3 col-xs-12 col-md-offset-1 col-md-pull-8 mr-5">
                <div class="newsletters-phone">
                    <img src="{{asset('frontend/logo/mobile.png')}}" alt="Mobilee">
                </div>
            </div>
            <!-- Col-2 -->
            <div class="col-md-8 col-xs-12 col-md-push-4 ml-4">
                <div class="mt-5 subcription-to-phone-only">
                    <h2 style="color: #ff6347;">The Best MAITHAI Delivery App!</h2>
                    <h5 class="mt-4">Download our free iOS, Windows phone and Android App and order food online the
                        fastest way possible.</h5>

                    <!-- Buttons For Android, Apple, Microsoft -->
                    <div class="d-flex mt-4">
                        <a href="https://apps.apple.com/in/app/mai-thai/id1524480953">
                        <img src="{{asset('frontend/logo/apple-badge.png')}}" alt="Download on app store" class="img img-fluid"></a>

                        <a href="https://play.google.com/store/apps/details?id=com.eposhybrid.maithai&gl=GB" class="ml-4">
                        <img src="{{asset('frontend/logo/google-play-badge.png')}}" alt="Get it on Google Play" class="img img-fluid"></a>

                        <!-- <a href="#" class="ml-4"><img src="assets/logo/windows-badge.png"
                                alt="Download from windows phone store" class="img img-fluid"></a> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('script')
<!--For Gellary Sliders Animation With JQuery-->
<!-- jQuery (1.12.4) for Gellary Animation this version is required -->
<script src="{{asset('frontend/js/jqueryv2.min.js')}}"></script>

<!-- Gellary Sliders Custom JQuery File -->
<script type="text/javascript" src="{{asset('frontend/js/jquery.hislide.js')}}"></script>

<script>
  $('.slideGellary').hiSlide();
</script>
@endpush