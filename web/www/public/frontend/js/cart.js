////Showing the Collapse Button with condition base...
(function ($) {
    ///Shopping-bag/cart's Collapse Item...
    ///The JavaScript's jQuery...
    $shopping_cart = $('.shopping-cart');
    $close_btn = $('.shopping-car-close-btn');
    $close_arrow = $('.shoppingCartButton');
    $open_btn = $('.sticky-open-btn');

    $close_btn.click(function () {
        $shopping_cart.css({
            right: '-50rem'
        });
        $open_btn.css({
            display: 'block'
        });
    });
    $close_arrow.click(function () {
        $shopping_cart.css({
            right: '-50rem'
        });
        $open_btn.css({
            display: 'block'
        });
    });

    //For Opening Drawer with this button...
    $open_btn.click(function () {
        $shopping_cart.css({
            right: '0rem'
        });
        $open_btn.css({
            display: 'none'
        });
    });

    ///Collapse Shopping-Cart's Special Code Arrow Up/Down Button Control...
    //Done Some CSS with jQuery Help....
    $arrow_up = $('.special-code-arrow-up');
    $arrow_down = $('.special-code-arrow-down');
    $special_code_toggle = $('.toggle-special-code');

    ///The Default Arrow Down Will Desapear..
    $arrow_down.css({ display: 'none' });

    $special_code_toggle.click(function () {
        $(this).attr("aria-expanded", function (index, attr) {
            if (attr === "true") {
                $arrow_up.css({
                    display: 'inline'
                });
                $arrow_down.css({
                    display: 'none'
                })
            } else {
                $arrow_up.css({
                    display: 'none'
                });
                $arrow_down.css({
                    display: 'inline'
                })
            }
        });
    });

    ///Make Collapse Shopping Cart is For Mobile View...
    $desktop_shopping_bag = $('.sticky-open-btn');
    $mobile_shopping_bag = $('.cart-bar');
    $desktop_cart_hovered = $('.carts-section');
    $shopping_cart = $('.shopping-cart');


    var x = window.matchMedia("(max-width: 720px)")
    myQueryFunction(x) // Call listener function at run time
    x.addListener(myQueryFunction) // Attach listener function on state changes

    function myQueryFunction(x) {
        if (x.matches) { // If media query matches...
            //If Yes...(Then Make Behavier of shopping_cart_drawer)
            $desktop_shopping_bag.css({ display: 'none' });
            $desktop_cart_hovered.css({display: 'none'});
            $mobile_shopping_bag.click(function(){
                $shopping_cart.css({
                    height: '100%',
                    width: '100%',
                    right: '0'
                });
                $desktop_shopping_bag.css({ display: 'none' });
            });
        }
    }



})(jQuery);


