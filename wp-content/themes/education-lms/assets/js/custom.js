
(function($) {
    "use strict";

    $('.nav-form li.menu-item-has-children > span.arrow').click(function(){
        $(this).next('ul.sub-menu').slideToggle( 500 );
        $(this).toggleClass('active');
        return false;
    });
    if ( Education_LMS.menu_sidebar == 'dropdown' ) {
        $('#mobile-open').click(function (e) {
            e.preventDefault();
            $('.nav-form').toggleClass('open').css('transition', 'none');
            $(this).toggleClass('nav-is-visible');
        });
    } else {
        $('.mobile-menu').click(function (e) {
            e.preventDefault(); // prevent the default action
            e.stopPropagation(); // stop the click from bubbling

            $('.nav-form').toggleClass('open');
            // click body one click for close menu
            $(document).on('click', function closeMenu (e){
                if ( $('.nav-form').has(e.target).length === 0){
                    $('.nav-form').removeClass('open');
                } else {
                    $(document).on('click', closeMenu);
                }
            });

        });
    }



    


})(jQuery);
