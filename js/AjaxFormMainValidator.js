/**
 * Javascript-Template, needs to be evaluated by Requirements::javascriptTemplate
 */
$.fn.getInputType = function () {
    return this[0].tagName == "INPUT" ? this[0].type.toLowerCase() : this[0].tagName.toLowerCase();
}

var AjaxFormMainValidator = function () {

    return {
        init: function () {

        },
        validate: function (form, aRequiredFields, prefix) {
            if (typeof prefix === 'undefined') {
                prefix = '';
            }
            if (aRequiredFields.length) {
                //Validate required fields
                for (var i = 0; i < aRequiredFields.length; i++) {
                    var input = $('#' + prefix + aRequiredFields[i]);
                    var isSelect = (input.getInputType() === 'select') ? true : false;
                    var inputVal = input.val();
                    var inputLabel = input.closest('div.field').find('label').text();
                    var inputName = (input.attr('placeholder')) ? input.attr('placeholder') : input.attr('name');

                    var inputTitle = inputLabel ? inputLabel : inputName;

                    var fieldErrorMsg = '"' + inputTitle + '" is required';
                    if ((inputVal === "") || (inputVal === fieldErrorMsg)) {
                        input.addClass("needsfilled");
                        if (isSelect) {
                            var optionNeedsfilled = "<option class=\"needsfilled\" value=\"\" disabled selected>" + fieldErrorMsg + "</option>";
                            input.prepend(optionNeedsfilled);
                        } else {
                            input.val(fieldErrorMsg);
                        }
                    } else {
                        if (input.length) {
                            input.removeClass("needsfilled");
                        }
                    }

                    if (input.attr('type') === 'email') {
                        // Validate the e-mail.
                        var testEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
                        if (testEmail.test(input.val())) {
                            input.removeClass("needsfilled");
                        } else {
                            input.val('Please enter a valid email.');
                            input.addClass("needsfilled");
                        }
                    }

                }
            }

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

            //if any inputs on the page have the class 'needsfilled' the form will not submit
            if ($(":input").hasClass("needsfilled")) {
                $('html, body').animate({
                    scrollTop: $(".needsfilled").offset().top - 120
                }, 1000);
                return "NotValidate";
            } else {
                AjaxFormMainValidator.loadButtonAjaxStart(form);
                AjaxFormMainValidator.loadAjaxStart(form.attr('id'));
                return "Validate";
            }


        },
        process: function (form, data, messageArea) {
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

            if (data.url) {
                window.location.href = data.url;
            } else {
                loadButtonAjaxStart(form, true);
                loadAjaxStart(form.attr('id'), true);
            }
        }
        ,
        loadAjaxStart: function (id, reverse) {
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
        ,
        loadButtonAjaxStart: function (form, reverse) {
            var $container = form.find('button.action');
            //$container.html('Saving...');
            if (reverse) {
                //$container.html('Submit')
            }
        }
    }
}
();