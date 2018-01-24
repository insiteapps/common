var AjaxFormMainValidator = function () {

    return {
        validate: function (form, aRequiredFields, prefix, canSubmit) {

            var valid = AjaxValidator.IsValid(form, aRequiredFields, prefix);
         //   console.log(canSubmit);
            if (valid) {
                if (canSubmit) {
                    return AjaxFormMainValidator.submit(form);
                } else {
                    return 'Validate';
                }
            }
        },
        submit: function (form) {
            AjaxLoading.start(form.attr('id'));
            var messageArea = form.find('.message');
            form.ajaxSubmit({
                dataType: 'json',
                type: 'post',
                success: function (data) {
                    if (data.url) {
                        window.location.href = data.url;
                        return;
                    }

                    messageArea.html('');
                    messageArea.html(data.message);
                    messageArea.addClass("good");
                    $('html, body').animate({
                        scrollTop: $(form.attr('id')).offset().top
                    }, 1000);
                    messageArea.show();
                    form.clearForm();
                    form.resetForm();
                    //form.find('fieldset,.Actions').hide();
                    //AjaxFormMainValidator.loadButtonAjaxStart(form, true);
                    AjaxLoading.start(form.attr('id'), true);
                }
            });
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
            var $container = $("#" + id);
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
}();
