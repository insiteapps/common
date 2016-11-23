// JavaScript Document

/*
 *
 * @author Patrick
 */

(function ($) {
    $(document).ready(function () {
        $("select.chosen-select").chosen({
            "allow_single_deselect": true,
            "disable_search_threshold": 10
        }); //
    });
})(jQuery);
