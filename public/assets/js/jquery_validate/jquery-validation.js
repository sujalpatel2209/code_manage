/**
 * Created by jaymin on 30/9/16.
 */

function validateForm(formId, formRules, msg) {

    $(formId).validate({
        rules: formRules,
        messages: msg,
        ignore: ".hide",
        /*  messages: {
         minlength: jQuery.validator.format("At least {0} characters required")
         },*/
        // Different components require proper error label placement
        errorPlacement: function (error, element) {
            if (element.parents('div').hasClass("checker") || element.parents('div').hasClass("choice")
                || element.parent().hasClass('bootstrap-switch-container')) {
                if (element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
                    error.appendTo(element.parent().parent().parent().parent());
                }
                else {
                    error.appendTo(element.parent().parent().parent().parent().parent());
                }
            }
            // Unstyled checkboxes, radios
            else if (element.parents('div').hasClass('checkbox') || element.parents('div').hasClass('radio')) {
                error.appendTo(element.parent().parent().parent());
            }

            // Input with icons and Select2
            else if (element.parents('div').hasClass('has-feedback') || element.hasClass('select2-hidden-accessible')) {
                error.appendTo(element.parent());
            }


            // Inline checkboxes, radios
            else if (element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
                error.appendTo(element.parent().parent());
            }

            // Input group, styled file input
            else if (element.parent().hasClass('uploader') || element.parents().hasClass('input-group')) {
                error.appendTo(element.parent().parent());
            }

            else {
                // console.log(element.parent());
                if(element.hasClass('radio')) {
                    error.appendTo('div.radio_inline_wrapper')
                } else {
                    error.appendTo(element.parent());
                }
            }
        },
        validClass: "validation-valid-label",
        errorClass: 'validation-error-label',
        successClass: 'validation-valid-label',
        highlight: function (element, errorClass) {
            $(element).removeClass(errorClass);
        },
        unhighlight: function (element, errorClass) {
            $(element).removeClass(errorClass);
        },
        /*   success: function (label) {
         label.addClass("validation-valid-label").text("Successfully")
         },*/
    });
    if (formId == "#configuration") {
        $("#configuration input[name='configureValue']").each(function () {
            $(this).rules("add", {required: true});
        });
    }

    //
    jQuery.validator.addMethod("html_validate", function (value, element) {
        if (this.optional(element) || /<\/?[^>]+(>|$)/g.test(value)) {
            return false;
        } else {
            return true;
        }
    });
}
