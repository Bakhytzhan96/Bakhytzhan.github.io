(function($) {
    "use strict";

    $( window ).on( 'init', function() {
        elementor.hooks.addAction('panel/open_editor/widget/edu-featured-slider', function (panel, model, view) {
            if ('section' !== model.elType && 'column' !== model.elType) {
                return;
            }
            var $element = view.$el.find('.feature-slider');

            if ($element.length) {
                $element.slick();
            }
        });
    });

})(jQuery);
