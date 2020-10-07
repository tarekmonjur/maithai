////Showing the Collapse Button with condition base...
(function ($) {

    var image_1 = $('.collapse-img-1');
    var toggle_click_1 = $('.toggle-click-1');

    var image_2 = $('.collapse-img-2');
    var toggle_click_2 = $('.toggle-click-2');

    var image_3 = $('.collapse-img-3');
    var toggle_click_3 = $('.toggle-click-3');

    var image_4 = $('.collapse-img-4');
    var toggle_click_4 = $('.toggle-click-4');

    // image.attr("src", "assets/icons/minus_collapse.png");

    function makeChangeWithToggle(toggle_click, image){
        toggle_click.click(function(){
            $(this).attr("aria-expanded", function(index, attr){
                return attr === "true" ? image.attr("src", "assets/icons/plus_collapse.png") : image.attr("src", "assets/icons/minus_collapse.png");
            });
        }); 
    }

    makeChangeWithToggle(toggle_click_1, image_1);
    makeChangeWithToggle(toggle_click_2, image_2);
    makeChangeWithToggle(toggle_click_3, image_3);
    makeChangeWithToggle(toggle_click_4, image_4);

})(jQuery);


