@extends('frontend.layouts.app')
@push('style')

@endpush

@section('main_content')

<section id="home-cover" class=" food-list-home-banner">
    <div class="jumbotron">
        <div class="dark-bg">
            <div id="intro">
                <div id="intro-section" class="mb-4">
                    <h5 class="intro-title food-list-intro text-uppercase mb-4">find foods from food list</h5>
                </div>

                <div id="search-food" class="search-food mb-5">
                    <input type="text" placeholder="Find Your Choice!" class="form-control">

                    <button type="submit" class="btn btn-danger btn-custom text-uppercase">
                        <i class="fas fa-search"></i>
                        <span> </span>
                        <span>Search</span>
                    </button>
                </div>
            </div>
        </div>
    </div>


    <!--------- The Search Collapse DropDown Bar For Home Carousel ------->
    <ul class="search-dropdown-menu-food-list" style="display: none;">
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

</section>

<section id="food-list" class="mt-5 mb-5">
    <div class="container">
        <div class="food-list-header">
            <h3 class="text-capitalize">all food list to chooce by flat order some parcentage off</h3>
        </div>
        <hr>

        <!------- The Main Food List and Food Search, Filtering Section ----------->
        <div class="food-list-body row">
            <div class="filter-item-food-package col-md-3 col-sm-4 col-xs-12">
                <div class="forms">
                    <!------- Food Search Bar ------->
                    <div class="form-control search-input mb-3">
                        <input type="text" placeholder="Search for...">
                        <button class="btn-food-search left-side"><i class="fas fa-search"></i></button>
                    </div>
                    <!------ Select Catagories Bar ------->
                    <!-- <div class="form-control select-input mb-4">
                          <select name="parent" id="select">
                            <option value="1">Sort by: Popularity</option>
                            <option value="2">Top Rated</option>
                            <option value="3">Special Cuisins</option>
                            <option value="4">Cost</option>
                            <option value="5">Latest</option>
                          </select>
                        </div> -->
                </div>

                <!----------- Collapse Bar ----------->
                <div class="food-menu-title mb-2">
                    <h3 class="text-light">Food Menu</h3>
                </div>

                <div id="accordion" class="mb-2">
                    <div class="card">
                        <div class="card-header food-package" id="headingOne">
                            <h5 class="mb-0">
                                <h6 class="text-capitalize toggle-click-1" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    <span>
                                        <img class="collapse-img-1" src="{{asset('frontend/icons/minus_collapse.png')}}" alt="+" width="20">
                                    </span>
                                    <span class="ml-1">stir fried dishes</span>
                                </h6>
                            </h5>
                        </div>

                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                            <div class="card-body">
                                <!----- Food Filtering Area with Checkboxes ----->
                                <div class="checkbox-list">
                                    <ul>
                                        <li class="checkbox">
                                            <input type="checkbox" value="pad graprao">
                                            <span class="text-capitalize ml-2">pad graprao</span>
                                        </li>

                                        <li class="checkbox">
                                            <input type="checkbox" value="pad priew wan">
                                            <span class="text-capitalize ml-2">pad priew wan</span>
                                        </li>

                                        <li class="checkbox">
                                            <input type="checkbox" value="pad nam man hol">
                                            <span class="text-capitalize ml-2">pad nam man hol</span>
                                        </li>

                                        <li class="checkbox">
                                            <input type="checkbox" value="pad med mamuang">
                                            <span class="text-capitalize ml-2">pad med mamuang</span>
                                        </li>

                                        <li class="checkbox">
                                            <input type="checkbox" value="pad khing">
                                            <span class="text-capitalize ml-2">pad khing</span>
                                        </li>

                                        <li class="checkbox">
                                            <input type="checkbox" value="pad pak (v)">
                                            <span class="text-capitalize ml-2">pad pak (v)</span>
                                        </li>

                                        <li class="checkbox">
                                            <input type="checkbox" value="pad kratiem prik thai">
                                            <span class="text-capitalize ml-2">pad kratiem prik thai</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!---------------------- 2nd Collapse Bar --------------------------->
                <div id="accordion-2" class="mb-2">
                    <div class="card">
                        <div class="card-header food-package" id="headingOne">
                            <h5 class="mb-0">
                                <h6 class="text-capitalize toggle-click-2" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    <span>
                                        <img class="collapse-img-2" src="{{asset('frontend/icons/plus_collapse.png')}}" alt="+" width="20">
                                    </span>
                                    <span class="ml-1">duck dishes</span>
                                </h6>
                            </h5>
                        </div>

                        <div id="collapseTwo" class="collapse" aria-labelledby="headingOne" data-parent="#accordion-2">
                            <div class="card-body">
                                <!----- Food Filtering Area with Checkboxes ----->
                                <div class="checkbox-list">
                                    <ul>
                                        <li class="checkbox">
                                            <input type="checkbox" value="tamarind duck">
                                            <span class="text-capitalize ml-2">tamarind duck</span>
                                        </li>

                                        <li class="checkbox">
                                            <input type="checkbox" value="pad kee maow duck">
                                            <span class="text-capitalize ml-2">pad kee maow duck</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--------------------- 3rd Collapse Bar ---------------------->
                <div id="accordion-3" class="mb-2">
                    <div class="card">
                        <div class="card-header food-package" id="headingOne">
                            <h5 class="mb-0">
                                <h6 class="text-capitalize toggle-click-3" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    <span>
                                        <img class="collapse-img-3" src="{{asset('frontend/icons/plus_collapse.png')}}" alt="+" width="20">
                                    </span>
                                    <span class="ml-1">noodle dishes</span>
                                </h6>
                            </h5>
                        </div>

                        <div id="collapseThree" class="collapse" aria-labelledby="headingOne" data-parent="#accordion-3">
                            <div class="card-body">
                                <!----- Food Filtering Area with Checkboxes ----->
                                <div class="checkbox-list">
                                    <ul>
                                        <li class="checkbox">
                                            <input type="checkbox" value="pad thai">
                                            <span class="text-capitalize ml-2">pad thai</span>
                                        </li>

                                        <li class="checkbox">
                                            <input type="checkbox" value="pad see-ew">
                                            <span class="text-capitalize ml-2">pad see-ew</span>
                                        </li>

                                        <li class="checkbox">
                                            <input type="checkbox" value="pad kee maow">
                                            <span class="text-capitalize ml-2">pad kee maow</span>
                                        </li>

                                        <li class="checkbox">
                                            <input type="checkbox" value="pad sen mee">
                                            <span class="text-capitalize ml-2">pad sen mee</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!------------------- 4th Collapse Bar ------------------------->
                <div id="accordion-4" class="mb-2">
                    <div class="card">
                        <div class="card-header food-package" id="headingOne">
                            <h5 class="mb-0">
                                <h6 class="text-capitalize toggle-click-4" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                    <span>
                                        <img class="collapse-img-4" src="{{asset('frontend/icons/plus_collapse.png')}}" alt="+" width="20">
                                    </span>
                                    <span class="ml-1">Rice</span>
                                </h6>
                            </h5>
                        </div>

                        <div id="collapseFour" class="collapse" aria-labelledby="headingOne" data-parent="#accordion-4">
                            <div class="card-body">
                                <!----- Food Filtering Area with Checkboxes ----->
                                <div class="checkbox-list">
                                    <ul>
                                        <li class="checkbox">
                                            <input type="checkbox" value="steamed jesmine rice">
                                            <span class="text-capitalize ml-2">steamed jesmine rice</span>
                                        </li>

                                        <li class="checkbox">
                                            <input type="checkbox" value="egg fried rice">
                                            <span class="text-capitalize ml-2">egg fried rice</span>
                                        </li>

                                        <li class="checkbox">
                                            <input type="checkbox" value="kao pad prik pao">
                                            <span class="text-capitalize ml-2">kao pad prik pao</span>
                                        </li>

                                        <li class="checkbox">
                                            <input type="checkbox" value="kao pad supparot">
                                            <span class="text-capitalize ml-2">kao pad supparot</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!------------------- 5th Collapse Bar ------------------------->
                <div id="accordion-5" class="mb-2">
                    <div class="card">
                        <div class="card-header food-package" id="headingOne">
                            <h5 class="mb-0">
                                <h6 class="text-capitalize toggle-click-5" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                    <span>
                                        <img class="collapse-img-5" src="{{asset('frontend/icons/plus_collapse.png')}}" alt="+" width="20">
                                    </span>
                                    <span class="ml-1">starters</span>
                                </h6>
                            </h5>
                        </div>

                        <div id="collapseFive" class="collapse" aria-labelledby="headingOne" data-parent="#accordion-5">
                            <div class="card-body">
                                <!----- Food Filtering Area with Checkboxes ----->
                                <div class="checkbox-list">
                                    <ul>
                                        <li class="checkbox">
                                            <input type="checkbox" value="chicken satay (n)">
                                            <span class="text-capitalize ml-2">chicken satay (n)</span>
                                        </li>

                                        <li class="checkbox">
                                            <input type="checkbox" value="vegetable spring rolls">
                                            <span class="text-capitalize ml-2">vegetable spring rolls</span>
                                        </li>

                                        <li class="checkbox">
                                            <input type="checkbox" value="thai fish cakes (n)">
                                            <span class="text-capitalize ml-2">thai fish cakes (n)</span>
                                        </li>

                                        <li class="checkbox">
                                            <input type="checkbox" value="tempura prawns">
                                            <span class="text-capitalize ml-2">tempura prawns</span>
                                        </li>

                                        <li class="checkbox">
                                            <input type="checkbox" value="prawns on toast">
                                            <span class="text-capitalize ml-2">prawns on toast</span>
                                        </li>

                                        <li class="checkbox">
                                            <input type="checkbox" value="dumplings (dim sum)">
                                            <span class="text-capitalize ml-2">dumplings (dim sum)</span>
                                        </li>

                                        <li class="checkbox">
                                            <input type="checkbox" value="spare ribs">
                                            <span class="text-capitalize ml-2">spare ribs</span>
                                        </li>

                                        <li class="checkbox">
                                            <input type="checkbox" value="vagetable tempura (v)">
                                            <span class="text-capitalize ml-2">vagetable tempura (v)</span>
                                        </li>

                                        <li class="checkbox">
                                            <input type="checkbox" value="mix platter (n)">
                                            <span class="text-capitalize ml-2">mix platter (n)</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!------------------- 6th Collapse Bar ------------------------->
                <div id="accordion-6" class="mb-2">
                    <div class="card">
                        <div class="card-header food-package" id="headingOne">
                            <h5 class="mb-0">
                                <h6 class="text-capitalize toggle-click-6" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                    <span>
                                        <img class="collapse-img-6" src="{{asset('frontend/icons/plus_collapse.png')}}" alt="+" width="20">
                                    </span>
                                    <span class="ml-1">soups</span>
                                </h6>
                            </h5>
                        </div>

                        <div id="collapseSix" class="collapse" aria-labelledby="headingOne" data-parent="#accordion-6">
                            <div class="card-body">
                                <!----- Food Filtering Area with Checkboxes ----->
                                <div class="checkbox-list">
                                    <ul>
                                        <li class="checkbox">
                                            <input type="checkbox" value="tom yum">
                                            <span class="text-capitalize ml-2">tom yum</span>
                                        </li>

                                        <li class="checkbox">
                                            <input type="checkbox" value="tom kha">
                                            <span class="text-capitalize ml-2">tom kha</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!------------------- 7th Collapse Bar ------------------------->
                <div id="accordion-7" class="mb-2">
                    <div class="card">
                        <div class="card-header food-package" id="headingOne">
                            <h5 class="mb-0">
                                <h6 class="text-capitalize toggle-click-7" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                                    <span>
                                        <img class="collapse-img-7" src="{{asset('frontend/icons/plus_collapse.png')}}" alt="+" width="20">
                                    </span>
                                    <span class="ml-1">thai salads</span>
                                </h6>
                            </h5>
                        </div>

                        <div id="collapseSeven" class="collapse" aria-labelledby="headingOne" data-parent="#accordion-7">
                            <div class="card-body">
                                <!----- Food Filtering Area with Checkboxes ----->
                                <div class="checkbox-list">
                                    <ul>
                                        <li class="checkbox">
                                            <input type="checkbox" value="larb gai">
                                            <span class="text-capitalize ml-2">larb gai</span>
                                        </li>

                                        <li class="checkbox">
                                            <input type="checkbox" value="yum talay">
                                            <span class="text-capitalize ml-2">yum talay</span>
                                        </li>

                                        <li class="checkbox">
                                            <input type="checkbox" value="yum nua">
                                            <span class="text-capitalize ml-2">yum nua</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!------------------- 8th Collapse Bar ------------------------->
                <div id="accordion-8" class="mb-2">
                    <div class="card">
                        <div class="card-header food-package" id="headingOne">
                            <h5 class="mb-0">
                                <h6 class="text-capitalize toggle-click-8" data-toggle="collapse" data-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                                    <span>
                                        <img class="collapse-img-8" src="{{asset('frontend/icons/plus_collapse.png')}}" alt="+" width="20">
                                    </span>
                                    <span class="ml-1">thai curries</span>
                                </h6>
                            </h5>
                        </div>

                        <div id="collapseEight" class="collapse" aria-labelledby="headingOne" data-parent="#accordion-8">
                            <div class="card-body">
                                <!----- Food Filtering Area with Checkboxes ----->
                                <div class="checkbox-list">
                                    <ul>
                                        <li class="checkbox">
                                            <input type="checkbox" value="green curry">
                                            <span class="text-capitalize ml-2">green curry</span>
                                        </li>

                                        <li class="checkbox">
                                            <input type="checkbox" value="red curry">
                                            <span class="text-capitalize ml-2">red curry</span>
                                        </li>

                                        <li class="checkbox">
                                            <input type="checkbox" value="kao pad prik pao">
                                            <span class="text-capitalize ml-2">kao pad prik pao</span>
                                        </li>

                                        <li class="checkbox">
                                            <input type="checkbox" value="panang">
                                            <span class="text-capitalize ml-2">panang</span>
                                        </li>

                                        <li class="checkbox">
                                            <input type="checkbox" value="duck curry">
                                            <span class="text-capitalize ml-2">duck curry</span>
                                        </li>

                                        <li class="checkbox">
                                            <input type="checkbox" value="massaman (n)">
                                            <span class="text-capitalize ml-2">massaman (n)</span>
                                        </li>

                                        <li class="checkbox">
                                            <input type="checkbox" value="jungle curry">
                                            <span class="text-capitalize ml-2">jungle curry</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!------------------- 9th Collapse Bar ------------------------->
                <div id="accordion-9" class="mb-2">
                    <div class="card">
                        <div class="card-header food-package" id="headingOne">
                            <h5 class="mb-0">
                                <h6 class="text-capitalize toggle-click-9" data-toggle="collapse" data-target="#collapseNine" aria-expanded="false" aria-controls="collapseNine">
                                    <span>
                                        <img class="collapse-img-9" src="{{asset('frontend/icons/plus_collapse.png')}}" alt="+" width="20">
                                    </span>
                                    <span class="ml-1">scafood and fish</span>
                                </h6>
                            </h5>
                        </div>

                        <div id="collapseNine" class="collapse" aria-labelledby="headingOne" data-parent="#accordion-9">
                            <div class="card-body">
                                <!----- Food Filtering Area with Checkboxes ----->
                                <div class="checkbox-list">
                                    <ul>
                                        <li class="checkbox">
                                            <input type="checkbox" value="pla priew wan">
                                            <span class="text-capitalize ml-2">pla priew wan</span>
                                        </li>

                                        <li class="checkbox">
                                            <input type="checkbox" value="pla chu chee">
                                            <span class="text-capitalize ml-2">pla chu chee</span>
                                        </li>

                                        <li class="checkbox">
                                            <input type="checkbox" value="pad talay prik pao">
                                            <span class="text-capitalize ml-2">pad talay prik pao</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END of Left Side Bar -->

            </div>
            <!--END of the Left Side Section-->



            <!------------- Food List Area Here -------------->
            <div class="list-area col-md-9 col-sm-8 col-xs-12">
                <ul>
                    <li class="d-flex mb-4 all-food-list">
                        <!-- list-image -->
                        <div class="list-img">
                            <img src="{{asset('frontend/img/gellary/ma1.jpg')}}" alt="Hotel Logo">
                        </div>
                        <!-- list-body -->
                        <div class="list-body ml-4 mr-2">
                            <h5>Eagle Boys Village Plaza</h5>
                            <ul class="list-body-mini-list">
                                <li><a href="#">Pizza</a></li>
                                <li><a href="#">American</a></li>
                                <li><a href="#">Sandwiches</a></li>
                                <li><a href="#">Steak House</a></li>
                                <li><a href="#">Pasta</a></li>
                                <li><a href="#">Wraps</a></li>
                            </ul>
                            <p style="font-size: 14px;" class="text-muted mt-2">
                                Lorem, ipsum dolor sit amet consectetur adipisicing elit. Recusandae animi eum aliquam. Accusamus
                                cupiditate animi.
                            </p>
                        </div>
                        <!-- list-footer -->
                        <div class="list-footer">
                            <div class="discount-title">
                                <h5 class="text-danger">$200 / <del>$240</del></h5>
                            </div>
                            <div class="list-footer-btn mt-4">
                                <button class="btn-list-order">
                                    <i class="fas fa-plus-circle"></i>
                                    <span>Add Cart</span>
                                </button>
                            </div>
                        </div>
                    </li>

                    <li class="d-flex mb-4 all-food-list">
                        <!-- list-image -->
                        <div class="list-img">
                            <img src="{{asset('frontend/img/gellary/ma2.jpg')}}" alt="Hotel Logo">
                        </div>
                        <!-- list-body -->
                        <div class="list-body ml-4 mr-2">
                            <h5>Eagle Boys Village Plaza</h5>
                            <ul class="list-body-mini-list">
                                <li><a href="#">Pizza</a></li>
                                <li><a href="#">American</a></li>
                                <li><a href="#">Sandwiches</a></li>
                                <li><a href="#">Steak House</a></li>
                                <li><a href="#">Pasta</a></li>
                                <li><a href="#">Wraps</a></li>
                            </ul>
                            <p style="font-size: 14px;" class="text-muted mt-2">
                                Lorem, ipsum dolor sit amet consectetur adipisicing elit. Recusandae animi eum aliquam. Accusamus
                                cupiditate animi.
                            </p>
                        </div>
                        <!-- list-footer -->
                        <div class="list-footer">
                            <div class="discount-title">
                                <h5 class="text-danger">$150 / <del>$240</del></h5>
                            </div>
                            <div class="list-footer-btn mt-4">
                                <button class="btn-list-order">
                                    <i class="fas fa-plus-circle"></i>
                                    <span>Add Cart</span>
                                </button>
                            </div>
                        </div>
                    </li>

                    <li class="d-flex mb-4 all-food-list">
                        <!-- list-image -->
                        <div class="list-img">
                            <img src="{{asset('frontend/img/gellary/ma3.jpg')}}" alt="Hotel Logo">
                        </div>
                        <!-- list-body -->
                        <div class="list-body ml-4 mr-2">
                            <h5>Eagle Boys Village Plaza</h5>
                            <ul class="list-body-mini-list">
                                <li><a href="#">Pizza</a></li>
                                <li><a href="#">American</a></li>
                                <li><a href="#">Sandwiches</a></li>
                                <li><a href="#">Steak House</a></li>
                                <li><a href="#">Pasta</a></li>
                                <li><a href="#">Wraps</a></li>
                            </ul>
                            <p style="font-size: 14px;" class="text-muted mt-2">
                                Lorem, ipsum dolor sit amet consectetur adipisicing elit. Recusandae animi eum aliquam. Accusamus
                                cupiditate animi.
                            </p>
                        </div>
                        <!-- list-footer -->
                        <div class="list-footer">
                            <div class="discount-title">
                                <h5 class="text-danger">$550 / <del>$640</del></h5>
                            </div>
                            <div class="list-footer-btn mt-4">
                                <button class="btn-list-order">
                                    <i class="fas fa-plus-circle"></i>
                                    <span>Add Cart</span>
                                </button>
                            </div>
                        </div>
                    </li>

                    <li class="d-flex mb-4 all-food-list">
                        <!-- list-image -->
                        <div class="list-img">
                            <img src="{{asset('frontend/img/gellary/ma4.jpg')}}" alt="Hotel Logo">
                        </div>
                        <!-- list-body -->
                        <div class="list-body ml-4 mr-2">
                            <h5>Eagle Boys Village Plaza</h5>
                            <ul class="list-body-mini-list">
                                <li><a href="#">Pizza</a></li>
                                <li><a href="#">American</a></li>
                                <li><a href="#">Sandwiches</a></li>
                                <li><a href="#">Steak House</a></li>
                                <li><a href="#">Pasta</a></li>
                                <li><a href="#">Wraps</a></li>
                            </ul>
                            <p style="font-size: 14px;" class="text-muted mt-2">
                                Lorem, ipsum dolor sit amet consectetur adipisicing elit. Recusandae animi eum aliquam. Accusamus
                                cupiditate animi.
                            </p>
                        </div>
                        <!-- list-footer -->
                        <div class="list-footer">
                            <div class="discount-title">
                                <h5 class="text-danger">$150 / <del>$240</del></h5>
                            </div>
                            <div class="list-footer-btn mt-4">
                                <button class="btn-list-order">
                                    <i class="fas fa-plus-circle"></i>
                                    <span>Add Cart</span>
                                </button>
                            </div>
                        </div>
                    </li>

                    <li class="d-flex mb-4 all-food-list">
                        <!-- list-image -->
                        <div class="list-img">
                            <img src="{{asset('frontend/img/gellary/ma5.jpg')}}" alt="Hotel Logo">
                        </div>
                        <!-- list-body -->
                        <div class="list-body ml-4 mr-2">
                            <h5>Eagle Boys Village Plaza</h5>
                            <ul class="list-body-mini-list">
                                <li><a href="#">Pizza</a></li>
                                <li><a href="#">American</a></li>
                                <li><a href="#">Sandwiches</a></li>
                                <li><a href="#">Steak House</a></li>
                                <li><a href="#">Pasta</a></li>
                                <li><a href="#">Wraps</a></li>
                            </ul>
                            <p style="font-size: 14px;" class="text-muted mt-2">
                                Lorem, ipsum dolor sit amet consectetur adipisicing elit. Recusandae animi eum aliquam. Accusamus
                                cupiditate animi.
                            </p>
                        </div>
                        <!-- list-footer -->
                        <div class="list-footer">
                            <div class="discount-title">
                                <h5 class="text-danger">$150 / <del>$240</del></h5>
                            </div>
                            <div class="list-footer-btn mt-4">
                                <button class="btn-list-order">
                                    <i class="fas fa-plus-circle"></i>
                                    <span>Add Cart</span>
                                </button>
                            </div>
                        </div>
                    </li>
                </ul>
                <!---END of This All Food List ul--->

                <!------------- Page Pagination Bar ------------->
                <div class="pagination" aria-label="...">
                    <ul class="pagination pagination-sm">
                        <li class="page-item active" aria-current="page">
                            <span class="page-link">
                                1
                                <span class="sr-only">(current)</span>
                            </span>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">4</a></li>
                        <li class="page-item"><a class="page-link" href="#">5</a></li>
                        <li class="page-item"><a class="page-link" href="#">6</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('script')
<script src="{{asset('frontend/js/collapse_button.js')}}"></script>
@endpush
