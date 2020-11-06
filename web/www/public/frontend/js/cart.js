////Showing the Collapse Button with condition base...
(function ($) {
    ///Make Collapse Shopping Cart is For Mobile View...
    $desktop_shopping_bag = $('.sticky-open-btn');
    $mobile_shopping_bag = $('.cart-bar');
    $desktop_cart_hovered = $('.carts-section');
    $shopping_cart = $('.shopping-cart');


    var x = window.matchMedia("(max-width: 720px)")
    myQueryFunction(x) // Call listener function at run time
    x.addListener(myQueryFunction) // Attach listener function on state changes

    function myQueryFunction(x) {
        if (x.matches) { // If media query matches
            //If Yes...
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


