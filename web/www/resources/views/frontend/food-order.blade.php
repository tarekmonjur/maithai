@extends('frontend.layouts.app')

@push('style')
<link rel="stylesheet" href="{{asset('frontend/css/foodList.css')}}">
@endpush

@section('main_content')

    <section id="food-list" class="mt-5 mb-5">
        <div class="container">
            <div class="food-list-header">
                <h3 class="text-capitalize text-danger">food grids, combo food catagories</h3>
            </div>
            <hr>

            <!------- The Main Food Grid and Food Search, Filtering Section ----------->
            <div class="food-list-body row">
                <div class="filter-item left-aside col-md-3 col-sm-4 col-xs-12">
                    <div class="forms">
                        <!------- Food Search Bar ------->
                        <div class="form-control search-input mb-3">
                            <input type="text" placeholder="Search for...">
                            <button class="btn-food-search"><i class="fas fa-search"></i></button>
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
                            <div class="card-header" id="headingOne">
                                <h5 class="mb-0">
                                    <h6 class="text-capitalize toggle-click-1" data-toggle="collapse" data-target="#collapseOne"
                                        aria-expanded="true" aria-controls="collapseOne">
                    <span>
                      <img class="collapse-img-1" src="assets/icons/minus_collapse.png" alt="+" width="20">
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
                            <div class="card-header" id="headingOne">
                                <h5 class="mb-0">
                                    <h6 class="text-capitalize toggle-click-2" data-toggle="collapse" data-target="#collapseTwo"
                                        aria-expanded="false" aria-controls="collapseTwo">
                    <span>
                      <img class="collapse-img-2" src="assets/icons/plus_collapse.png" alt="+" width="20">
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
                            <div class="card-header" id="headingOne">
                                <h5 class="mb-0">
                                    <h6 class="text-capitalize toggle-click-3" data-toggle="collapse" data-target="#collapseThree"
                                        aria-expanded="false" aria-controls="collapseThree">
                    <span>
                      <img class="collapse-img-3" src="assets/icons/plus_collapse.png" alt="+" width="20">
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
                            <div class="card-header" id="headingOne">
                                <h5 class="mb-0">
                                    <h6 class="text-capitalize toggle-click-4" data-toggle="collapse" data-target="#collapseFour"
                                        aria-expanded="false" aria-controls="collapseFour">
                    <span>
                      <img class="collapse-img-4" src="assets/icons/plus_collapse.png" alt="+" width="20">
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
                            <div class="card-header" id="headingOne">
                                <h5 class="mb-0">
                                    <h6 class="text-capitalize toggle-click-5" data-toggle="collapse" data-target="#collapseFive"
                                        aria-expanded="false" aria-controls="collapseFive">
                    <span>
                      <img class="collapse-img-5" src="assets/icons/plus_collapse.png" alt="+" width="20">
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
                            <div class="card-header" id="headingOne">
                                <h5 class="mb-0">
                                    <h6 class="text-capitalize toggle-click-6" data-toggle="collapse" data-target="#collapseSix"
                                        aria-expanded="false" aria-controls="collapseSix">
                    <span>
                      <img class="collapse-img-6" src="assets/icons/plus_collapse.png" alt="+" width="20">
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
                            <div class="card-header" id="headingOne">
                                <h5 class="mb-0">
                                    <h6 class="text-capitalize toggle-click-7" data-toggle="collapse" data-target="#collapseSeven"
                                        aria-expanded="false" aria-controls="collapseSeven">
                    <span>
                      <img class="collapse-img-7" src="assets/icons/plus_collapse.png" alt="+" width="20">
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
                            <div class="card-header" id="headingOne">
                                <h5 class="mb-0">
                                    <h6 class="text-capitalize toggle-click-8" data-toggle="collapse" data-target="#collapseEight"
                                        aria-expanded="false" aria-controls="collapseEight">
                    <span>
                      <img class="collapse-img-8" src="assets/icons/plus_collapse.png" alt="+" width="20">
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
                            <div class="card-header" id="headingOne">
                                <h5 class="mb-0">
                                    <h6 class="text-capitalize toggle-click-9" data-toggle="collapse" data-target="#collapseNine"
                                        aria-expanded="false" aria-controls="collapseNine">
                    <span>
                      <img class="collapse-img-9" src="assets/icons/plus_collapse.png" alt="+" width="20">
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
                <!--END of The Left Side Section  -->



                <!------------- Food List Area Here -------------->
                <div class="grid-area col-md-9 col-sm-8 col-xs-12">
                    <!------- Food Grid Cards With Row & Cols --------->
                    <div class="row row-cols-1 row-cols-md-3">
                        <div class="col mb-4">
                            <div class="card h-100">
                                <img src="assets/img/wideCard1.jpg" class="card-img-top img-thumbnail grid-card-img" alt="...">
                                <div class="card-body grid-body">
                                    <h5 class="card-title">Eagle Boys Village Plaza</h5>
                                    <ul class="list-body-mini-list">
                                        <li><a href="#">Pizza</a></li>
                                        <li><a href="#">American</a></li>
                                        <li><a href="#">Sandwiches</a></li>
                                        <li><a href="#">Pasta</a></li>
                                    </ul>
                                    <hr>
                                    <div class="d-grid grid-footer text-center">
                                        <div class="discount-title">
                                            <h5 class="text-danger">$25 / <del>$24</del></h5>
                                        </div>
                                        <div class="grid-footer-btn mt-2">
                                            <button class="btn-grid-order text-capitalize">
                                                <i class="fas fa-plus-circle"></i>
                                                <span>add cart</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col mb-4">
                            <div class="card h-100">
                                <img src="assets/img/wideCard2.jpg" class="card-img-top img-thumbnail grid-card-img" alt="...">
                                <div class="card-body grid-body">
                                    <h5 class="card-title">Eagle Boys Village Plaza</h5>
                                    <ul class="list-body-mini-list">
                                        <li><a href="#">Pizza</a></li>
                                        <li><a href="#">American</a></li>
                                        <li><a href="#">Sandwiches</a></li>
                                        <li><a href="#">Pasta</a></li>
                                    </ul>
                                    <hr>
                                    <div class="d-grid grid-footer text-center">
                                        <div class="discount-title">
                                            <h5 class="text-danger">$10 / <del>$24</del></h5>
                                        </div>
                                        <div class="grid-footer-btn mt-2">
                                            <button class="btn-grid-order text-capitalize">
                                                <i class="fas fa-plus-circle"></i>
                                                <span>add cart</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col mb-4">
                            <div class="card h-100">
                                <img src="assets/img/wideCard3.jpg" class="card-img-top img-thumbnail grid-card-img" alt="...">
                                <div class="card-body grid-body">
                                    <h5 class="card-title">Eagle Boys Village Plaza</h5>
                                    <ul class="list-body-mini-list">
                                        <li><a href="#">Pizza</a></li>
                                        <li><a href="#">American</a></li>
                                        <li><a href="#">Sandwiches</a></li>
                                        <li><a href="#">Pasta</a></li>
                                    </ul>
                                    <hr>
                                    <div class="d-grid grid-footer text-center">
                                        <div class="discount-title">
                                            <h5 class="text-danger">$45 / <del>$74</del></h5>
                                        </div>
                                        <div class="grid-footer-btn mt-2">
                                            <button class="btn-grid-order text-capitalize">
                                                <i class="fas fa-plus-circle"></i>
                                                <span>add cart</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col mb-4">
                            <div class="card h-100">
                                <img src="assets/img/2.jpg" class="card-img-top img-thumbnail grid-card-img" alt="...">
                                <div class="card-body grid-body">
                                    <h5 class="card-title">Eagle Boys Village Plaza</h5>
                                    <ul class="list-body-mini-list">
                                        <li><a href="#">Pizza</a></li>
                                        <li><a href="#">American</a></li>
                                        <li><a href="#">Sandwiches</a></li>
                                        <li><a href="#">Pasta</a></li>
                                    </ul>
                                    <hr>
                                    <div class="d-grid grid-footer text-center">
                                        <div class="discount-title">
                                            <h5 class="text-danger">$15 / <del>$24</del></h5>
                                        </div>
                                        <div class="grid-footer-btn mt-2">
                                            <button class="btn-grid-order text-capitalize">
                                                <i class="fas fa-plus-circle"></i>
                                                <span>add cart</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col mb-4">
                            <div class="card h-100">
                                <img src="assets/img/1.jpg" class="card-img-top img-thumbnail grid-card-img" alt="...">
                                <div class="card-body grid-body">
                                    <h5 class="card-title">Eagle Boys Village Plaza</h5>
                                    <ul class="list-body-mini-list">
                                        <li><a href="#">Pizza</a></li>
                                        <li><a href="#">American</a></li>
                                        <li><a href="#">Sandwiches</a></li>
                                        <li><a href="#">Pasta</a></li>
                                    </ul>
                                    <hr>
                                    <div class="d-grid grid-footer text-center">
                                        <div class="discount-title">
                                            <h5 class="text-danger">$33 / <del>$44</del></h5>
                                        </div>
                                        <div class="grid-footer-btn mt-2">
                                            <button class="btn-grid-order text-capitalize">
                                                <i class="fas fa-plus-circle"></i>
                                                <span>add cart</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col mb-4">
                            <div class="card h-100">
                                <img src="assets/img/coverA.jpg" class="card-img-top img-thumbnail grid-card-img" alt="...">
                                <div class="card-body grid-body">
                                    <h5 class="card-title">Eagle Boys Village Plaza</h5>
                                    <ul class="list-body-mini-list">
                                        <li><a href="#">Pizza</a></li>
                                        <li><a href="#">American</a></li>
                                        <li><a href="#">Sandwiches</a></li>
                                        <li><a href="#">Pasta</a></li>
                                    </ul>
                                    <hr>
                                    <div class="d-grid grid-footer text-center">
                                        <div class="discount-title">
                                            <h5 class="text-danger">$50 / <del>$100</del></h5>
                                        </div>
                                        <div class="grid-footer-btn mt-2">
                                            <button class="btn-grid-order text-capitalize">
                                                <i class="fas fa-plus-circle"></i>
                                                <span>add cart</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col mb-4">
                            <div class="card h-100">
                                <img src="assets/img/cover2.jpg" class="card-img-top img-thumbnail grid-card-img" alt="...">
                                <div class="card-body grid-body">
                                    <h5 class="card-title">Eagle Boys Village Plaza</h5>
                                    <ul class="list-body-mini-list">
                                        <li><a href="#">Pizza</a></li>
                                        <li><a href="#">American</a></li>
                                        <li><a href="#">Sandwiches</a></li>
                                        <li><a href="#">Pasta</a></li>
                                    </ul>
                                    <hr>
                                    <div class="d-grid grid-footer text-center">
                                        <div class="discount-title">
                                            <h5 class="text-danger">$120 / <del>$240</del></h5>
                                        </div>
                                        <div class="grid-footer-btn mt-2">
                                            <button class="btn-grid-order text-capitalize">
                                                <i class="fas fa-plus-circle"></i>
                                                <span>add cart</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col mb-4">
                            <div class="card h-100">
                                <img src="assets/img/cover3.jpg" class="card-img-top img-thumbnail grid-card-img" alt="...">
                                <div class="card-body grid-body">
                                    <h5 class="card-title">Eagle Boys Village Plaza</h5>
                                    <ul class="list-body-mini-list">
                                        <li><a href="#">Pizza</a></li>
                                        <li><a href="#">American</a></li>
                                        <li><a href="#">Sandwiches</a></li>
                                        <li><a href="#">Pasta</a></li>
                                    </ul>
                                    <hr>
                                    <div class="d-grid grid-footer text-center">
                                        <div class="discount-title">
                                            <h5 class="text-danger">$15 / <del>$54</del></h5>
                                        </div>
                                        <div class="grid-footer-btn mt-2">
                                            <button class="btn-grid-order text-capitalize">
                                                <i class="fas fa-plus-circle"></i>
                                                <span>add cart</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col mb-4">
                            <div class="card h-100">
                                <img src="assets/img/cover1.jpg" class="card-img-top img-thumbnail grid-card-img" alt="...">
                                <div class="card-body grid-body">
                                    <h5 class="card-title">Eagle Boys Village Plaza</h5>
                                    <ul class="list-body-mini-list">
                                        <li><a href="#">Pizza</a></li>
                                        <li><a href="#">American</a></li>
                                        <li><a href="#">Sandwiches</a></li>
                                        <li><a href="#">Pasta</a></li>
                                    </ul>
                                    <hr>
                                    <div class="d-grid grid-footer text-center">
                                        <div class="discount-title">
                                            <h5 class="text-danger">$150 / <del>$240</del></h5>
                                        </div>
                                        <div class="grid-footer-btn mt-2">
                                            <button class="btn-grid-order text-capitalize">
                                                <i class="fas fa-plus-circle"></i>
                                                <span>add cart</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

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