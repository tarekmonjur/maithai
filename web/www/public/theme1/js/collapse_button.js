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

    var image_5 = $('.collapse-img-5');
    var toggle_click_5 = $('.toggle-click-5');

    var image_6 = $('.collapse-img-6');
    var toggle_click_6 = $('.toggle-click-6');

    var image_7 = $('.collapse-img-7');
    var toggle_click_7 = $('.toggle-click-7');

    var image_8 = $('.collapse-img-8');
    var toggle_click_8 = $('.toggle-click-8');

    var image_9 = $('.collapse-img-9');
    var toggle_click_9 = $('.toggle-click-9');

    // image.attr("src", "assets/icons/minus_collapse.png");

    function makeChangeWithToggle(toggle_click, image){
        toggle_click.click(function(){
            $(this).attr("aria-expanded", function(index, attr){
                return attr === "true" ? image.attr("src", "frontend/icons/plus_collapse.png") : image.attr("src", "frontend/icons/minus_collapse.png");
            });
        }); 
    }

    makeChangeWithToggle(toggle_click_1, image_1);
    makeChangeWithToggle(toggle_click_2, image_2);
    makeChangeWithToggle(toggle_click_3, image_3);
    makeChangeWithToggle(toggle_click_4, image_4);
    makeChangeWithToggle(toggle_click_5, image_5);
    makeChangeWithToggle(toggle_click_6, image_6);
    makeChangeWithToggle(toggle_click_7, image_7);
    makeChangeWithToggle(toggle_click_8, image_8);
    makeChangeWithToggle(toggle_click_9, image_9);


})(jQuery);


