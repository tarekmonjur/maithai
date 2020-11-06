<!-----****** The Shopping Cart Drawer System... ******------>
<div class="shopping-cart sticky">
        <!-- Close Icons Button -->
        <div class="shoppingCartButton"></div>

        <!-- Drawer Opening Button When Drawer will close this will appear -->
        <!-- Showing Icon and Drawer opening Bar(When Drawer is Close) -->
        <section class="stickyHeader sticky-open-btn">
            <!-- Item Couter with Icon SVG -->
            <div class="shopping-badget-items-counter">
                <!-- The Shopping Bag Icon -->
                <svg version="1.1" id="Calque_1" x="0px" y="0px" style="fill:#FDD670; stroke:#FDD670;" width="16px"
                    height="24px" viewBox="0 0 100 160.13">
                    <polygon points="11.052,154.666 21.987,143.115 35.409,154.666"></polygon>
                    <path
                        d="M83.055,36.599c-0.323-7.997-1.229-15.362-2.72-19.555c-2.273-6.396-5.49-7.737-7.789-7.737   c-6.796,0-13.674,11.599-16.489,25.689l-3.371-0.2l-0.19-0.012l-5.509,1.333c-0.058-9.911-1.01-17.577-2.849-22.747   c-2.273-6.394-5.49-7.737-7.788-7.737c-8.618,0-17.367,18.625-17.788,37.361l-13.79,3.336l0.18,1.731h-0.18v106.605l17.466-17.762   l18.592,17.762V48.06H9.886l42.845-10.764l2.862,0.171c-0.47,2.892-0.74,5.865-0.822,8.843l-8.954,1.75v106.605l48.777-10.655   V38.532l0.073-1.244L83.055,36.599z M36.35,8.124c2.709,0,4.453,3.307,5.441,6.081c1.779,5.01,2.69,12.589,2.711,22.513   l-23.429,5.667C21.663,23.304,30.499,8.124,36.35,8.124z M72.546,11.798c2.709,0,4.454,3.308,5.44,6.081   c1.396,3.926,2.252,10.927,2.571,18.572l-22.035-1.308C61.289,21.508,67.87,11.798,72.546,11.798z M58.062,37.612l22.581,1.34   c0.019,0.762,0.028,1.528,0.039,2.297l-23.404,4.571C57.375,42.986,57.637,40.234,58.062,37.612z M83.165,40.766   c-0.007-0.557-0.01-1.112-0.021-1.665l6.549,0.39L83.165,40.766z">
                    </path>
                </svg>
                <p class="shopping-cart-items">
                    <span class="mr-1">4</span>
                    <span>ITEMS</span>
                </p>
            </div>
            <!-- Shopping Badgets Bottom -->
            <div class="total shopping-badget-total">
                <span class="dollar">$</span>
                <span class="price">1200</span>
            </div>
        </section>
        <!--END of The Drawer Opening Button-->

        <!-- Shopping Cart Header -->
        <div class="cart-header d-flex">
            <div class="left-header-item">
                <!-- Shopping bag Icon -->
                <svg class="mr-1" version="1.1" id="Calque_1" x="0px" y="0px"
                    style="fill:#fff; stroke:#fff; margin-top: -1px;" width="20px" height="30px"
                    viewBox="0 0 100 160.13">
                    <polygon points="11.052,154.666 21.987,143.115 35.409,154.666"></polygon>
                    <path
                        d="M83.055,36.599c-0.323-7.997-1.229-15.362-2.72-19.555c-2.273-6.396-5.49-7.737-7.789-7.737   c-6.796,0-13.674,11.599-16.489,25.689l-3.371-0.2l-0.19-0.012l-5.509,1.333c-0.058-9.911-1.01-17.577-2.849-22.747   c-2.273-6.394-5.49-7.737-7.788-7.737c-8.618,0-17.367,18.625-17.788,37.361l-13.79,3.336l0.18,1.731h-0.18v106.605l17.466-17.762   l18.592,17.762V48.06H9.886l42.845-10.764l2.862,0.171c-0.47,2.892-0.74,5.865-0.822,8.843l-8.954,1.75v106.605l48.777-10.655   V38.532l0.073-1.244L83.055,36.599z M36.35,8.124c2.709,0,4.453,3.307,5.441,6.081c1.779,5.01,2.69,12.589,2.711,22.513   l-23.429,5.667C21.663,23.304,30.499,8.124,36.35,8.124z M72.546,11.798c2.709,0,4.454,3.308,5.44,6.081   c1.396,3.926,2.252,10.927,2.571,18.572l-22.035-1.308C61.289,21.508,67.87,11.798,72.546,11.798z M58.062,37.612l22.581,1.34   c0.019,0.762,0.028,1.528,0.039,2.297l-23.404,4.571C57.375,42.986,57.637,40.234,58.062,37.612z M83.165,40.766   c-0.007-0.557-0.01-1.112-0.021-1.665l6.549,0.39L83.165,40.766z">
                    </path>
                </svg>
                <span class="mr-1 mt-2">4</span>
                <span class="text-uppercase mt-2">items</span>
            </div>

            <div class="right-header-item">
                <button class="shopping-car-close-btn">
                    close
                </button>
            </div>
        </div>
        <!--END of Shopping-Cart Header-->

        <!-- Shopping cart Content (When Bag Is Empty!) -->
        <div class="cart-content-empty">
            <div class="content-item-empty">
                <img src="{{asset('frontend/logo/shopping-beg-1.png')}}" alt="">

                <div class="shopping-title-empty text-capitalize">
                    <p class="text-muted">Your shopping bag is empty!</p>
                </div>
            </div>
        </div>

        <!-- Shopping cart Content/Body (When Bag Is Not-Empty!) -->
        <!-- <div class="cart-content">
            <div class="row content-title">
                <div class="col-md-12 body-heading-title">
                    <p>Your delivery items</p>
                </div>
            </div>

            <div class="row content-title items-nav sticky-top">
                <div class="col-md-3">Quantity</div>
                <div class="col-md-3">Image</div>
                <div class="col-md-3">Name</div>
                <div class="col-md-3">Price</div>
            </div>

            <div class="row content-items-list">
                <div class="col-md-3 delivery-counter">
                    <button type="button" class="counter-left-btn">
                        <span>
                            < </span>
                    </button>
                    <span class="counter-num font-weight-bold">1</span>
                    <button type="button" class="counter-right-btn">
                        <span> > </span>
                    </button>
                </div>

                <div class="col-md-3 delivery-img">
                    <img src="assets/img/gellary/ma1.jpg" alt="maiThai-1">
                </div>

                <div class="col-md-3 delivery-name">
                    <h6>Thai Italian Masala</h6>
                </div>

                <div class="col-md-3 delivery-price">
                    <span class="text-danger font-weight-bold">$40</span>
                    <span class="text-muted"><del>$70</del></span>
                </div>
            </div>

            <div class="row content-items-list">
                <div class="col-md-3 delivery-counter">
                    <button type="button" class="counter-left-btn">
                        <span> < </span>
                    </button>
                    <span class="counter-num">2</span>
                    <button type="button" class="counter-right-btn">
                        <span> > </span>
                    </button>
                </div>
                <div class="col-md-3 delivery-img">
                    <img src="assets/img/gellary/ma1.jpg" alt="maiThai-1">
                </div>
                <div class="col-md-3 delivery-name">
                    <h6>Green Vagetable</h6>
                </div>
                <div class="col-md-3 delivery-price">
                    <span class="text-danger font-weight-bold">$120</span>
                    <span class="text-muted"><del>$150</del></span>
                </div>
            </div>
        </div> -->

        <!-- Shopping Cart Footer -->
        <div class="cart-footer">
            <!-- The Collapse Accordion -->
            <div class="accordion shopping-special-code" id="shoppingExample">
                <div class="special-code-card">
                    <div id="shoppingHeading">
                        <h2 class="mb-0">
                            <button class="btn btn-block text-left toggle-special-code" type="button"
                                data-toggle="collapse" data-target="#collapseCart" aria-expanded="false"
                                aria-controls="collapseCart">
                                <span class="special-code-arrow-up">
                                    <i class="fa fa-chevron-circle-up mr-2" aria-hidden="true"></i>
                                </span>
                                <span class="special-code-arrow-down">
                                    <i class="fa fa-chevron-circle-down mr-2" aria-hidden="false"></i>
                                </span>
                                <span class="special-code-title">Have a special code?</span>
                            </button>
                        </h2>
                    </div>

                    <div id="collapseCart" class="collapse" aria-labelledby="shoppingHeading" data-parent="#shoppingExample">
                        <div class="card-body">
                            <form action="" method="" class="special-code-form">
                                <input type="text" placeholder="Special Code" name="special-code" class="special-input">
                                <input type="submit" name="special-go" value="Go" class="special-go">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!---END of Accordion for Speicial Code Send-->

            <!-- Place Order Footer -->
            <div class="place-order-footer">
                <a href="" class="btn btn-outline-danger text-capitalize">
                    <span class="mr-2">
                        <i class="fa fa-cart-arrow-down" aria-hidden="true"></i>
                    </span>
                    <span>place order</span>
                </a>
            </div>
            <!-- END of Place-Order's Footer -->
        </div>
        <!--END of Shopping-Cart's Footer-->
    </div>
    <!--END of Shopping Cart Drawer-->