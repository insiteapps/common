/**
 * Javascript-Template, needs to be evaluated by Requirements::javascriptTemplate
 */
$.fn.getInputType = function () {
    return this[0].tagName == "INPUT" ? this[0].type.toLowerCase() : this[0].tagName.toLowerCase();
}


function loadButtonAjaxStart(form, reverse) {
    var $container = form.find('button.action');
    $container.html('Saving...');
    if (reverse) {
        $container.html('Submit')
    }
}
function loadAjaxStart(id, reverse) {
    var AjaxLoading = "<div class=\"AjaxLoading\"></div>";
    var $container = $("form#" + id);
    $container.append(AjaxLoading);
    var AjaxLoading = $container.find(".AjaxLoading");
    if (reverse) {
        AjaxLoading.remove();
    } else {
        AjaxLoading.show();
    }
}

/* Form Validation */
$(document).ready(function () {
    // Place ID's of all required fields here.
    var required = [$Required];
    // If using an ID other than #email or #error then replace it here
    var email = $("$EmailFieldId");
    // The text to show up within a field when it is incorrect
    var emptyerror = "Please fill out this field.";
    var emailerror = "Please enter a valid email.";

    $('<div id="MessageArea" class="message"></div>').insertBefore('fieldset');
    var messageArea = $('#MessageArea');

    var form = $('#$FormName');

    $('#$FormName').ajaxForm({
        dataType: 'json',
        beforeSubmit: function () {


            //Validate required fields
            for (i = 0; i < required.length; i++) {
                var input = $('#' + required[i]);
                var isSelect = (input.getInputType() === 'select') ? true : false;


                var inputVal = input.val();

                var fieldErrorMsg = '"' + input.attr('name') + '" is required';

                if ((inputVal === "") || (inputVal === fieldErrorMsg)) {
                    input.addClass("needsfilled");

                    if (isSelect) {
                        var optionNeedsfilled = "<option class=\"needsfilled\" value=\"\" disabled selected>" + fieldErrorMsg + "</option>";
                        input.prepend(optionNeedsfilled);
                    } else {
                        input.val(fieldErrorMsg);
                    }


                    //errornotice.fadeIn(750);
                } else {
                    if (input.length) {
                        input.removeClass("needsfilled");
                    }
                }
            }
            // Validate the e-mail.
            if (!/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(email.val())) {
                email.addClass("needsfilled");
                email.val(emailerror);
            } else {
                email.removeClass("needsfilled");
            }

            //if any inputs on the page have the class 'needsfilled' the form will not submit
            if ($(":input").hasClass("needsfilled")) {
                $('html, body').animate({
                    scrollTop: $(".needsfilled").offset().top
                }, 1000);
                return false;
            } else {
                loadButtonAjaxStart(form);
                loadAjaxStart(form.attr('id'));
                return true;
            }
        },
        success: function (data) {
            if (data.url) {
                window.location.href = data.url;
            }
            messageArea.removeClass('alert alert-danger');
            messageArea.html('');
            messageArea.hide();
            messageArea.html(data.message);
            messageArea.show();
            form.clearForm();
            form.resetForm();
            $('html, body').animate({
                scrollTop: $("#Layout").offset().top
            }, 1000);
            loadButtonAjaxStart(form, true);
            loadAjaxStart(form.attr('id'), true);
            form.find('fieldset,.Actions').hide();
        },
        clearForm: true,        // clear all form fields after successful submit
        resetForm: true        // reset the form after successful submit

    });


    // Clears any fields in the form when the user clicks on them
    $(":input").focus(function () {
        if ($(this).hasClass("needsfilled")) {
            if ($(this).getInputType() === 'select') {
                $(this).find('option.needsfilled').remove();
            } else {
                $(this).val("");

            }
            $(this).removeClass("needsfilled");
        }
    });
});
