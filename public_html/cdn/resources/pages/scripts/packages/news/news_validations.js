/**
 * This method validates news form fields
 * since   2016-12-24
 * author  NetQuick
 */
var Validate = function() {
    var handleNews = function() {
        $("#frmNews").validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            ignore: [],
            rules: {
                title: {
                    required: true,
                    noSpace: true,
                    xssProtection: true,
                    no_url: true
                },
                category_id:{
                    required: true,
                },
                start_date_time: {
                    required: true,
                },
                sector: {
                    required: true,
                },
                end_date_time: {
                    daterange: true,
                    required: {
                        depends: function() {
                            var isChecked = $('#news_end_date').attr('data-exp');
                            if (isChecked == 0) {
                                return $('input[name=end_date_time]').val().length == 0;
                            }
                        }
                    }
                },
                varMetaTitle: {
                    required: true,
                    noSpace: true,
                    xssProtection: true,
                    no_url: true
                },
                short_description: {
                    required: true,
                    noSpace: true,
                    xssProtection: true,
                    no_url: true
                },
                varMetaDescription: {
                    required: true,
                    noSpace: true,
                    xssProtection: true,
                    no_url: true
                },
                varExternalLink: {
                    url: true,
                },
                'new-alias': {
                    specialCharacterCheck: true,
                },
                new_password: {
                    required: {
                        depends: function() {
                            if ($('input[name="chrPageActive"][value="PP"]').prop("checked") == true) {
                                return true;
                            } else {
                                return false;
                            }
                        }
                    },
                    passwordrules: {
                        depends: function() {
                            if ($('input[name="chrPageActive"][value="PP"]').prop("checked") == true) {
                                return true;
                            } else {
                                return false;
                            }
                        }
                    },
                    minlength: 6,
                    maxlength: 20
                }
            },
            messages: {
                title:{
                    required: "Please enter the title",
                },
                sector: { required: "Please select the sector type" },
                display_order: {
                    required: "Display order must be a number greater than zero (0)"
                },
                category_id: { required: "Please select category" },
                short_description: {
                    required: "Please enter the short description"
                },
                varMetaTitle:{
                    required: "Please enter the meta title",
                },
                varMetaDescription:{
                    required: "Please enter the meta description",
                },
                varExternalLink: {
                    url: "Please enter a valid URL",
                },
                start_date_time: {
                    required: "Please select the start date",
                },
                end_date_time: {
                    required: "Please select the end date.",
                    daterange: 'The end date must be a greater than start date.'
                },
                new_password: {
                    required: Lang.get('validation.required', { attribute: 'Password' }),
                    passwordrules: 'Please follow rules for password.'
                }
            },
            errorPlacement: function(error, element) {
                if (element.parent('.input-group').length) {
                    error.insertAfter(element.parent());
                } else if (element.hasClass('choices__input')) {
                    error.insertAfter(element.parent().parent().next('span'));
                } else if (element.attr('name') == 'description') {
                    error.insertAfter(element.next().next('span'));
                } else {
                    error.insertAfter(element);
                }
            },
            invalidHandler: function(event, validator) { //display error alert on form submit  
                var errors = validator.numberOfInvalids();
                if (errors) {
                    $.loader.close(true);
                }
                $('.alert-danger', $('#frmNews')).show();
            },
            highlight: function(element) { // hightlight error inputs
                $(element).closest('.form-group').addClass('has-error'); // set error class to the control group
            },
            unhighlight: function(element) {
                $(element).closest('.form-group').removeClass('has-error'); // set error class to the control group
            },
            submitHandler: function(form) {
                $('body').loader(loaderConfig);
                form.submit();
                $("button[type='submit']").attr('disabled', 'disabled');
                return false;
            }
        });

        $('#tags-input input').on('keypress', function(e) {
            if (e.keyCode == 13) {
                e.keyCode = 188;
                e.preventDefault();
            };
        });

        $('#frmNews input').keypress(function(e) {
            if (e.which == 13 && e.keyCode != 188) {
                if ($('#frmNews').validate().form()) {
                    $('#frmNews').submit(); //form validation success, call ajax form submit
                }
                return false;
            }
        });
    }
    return {
        //main function to initiate the module
        init: function() {
            handleNews();
        }
    };
}();
jQuery(document).ready(function() {
    Validate.init();
    $("#varSector").rules('add', {
        required: true
    });
    jQuery.validator.addMethod("noSpace", function(value, element) {
        if (value.trim().length <= 0) {
            return false;
        } else {
            return true;
        }
    }, "Please enter the valid input, Space not allowed");

    // $('#news_start_date').datetimepicker({
    //     format: DEFAULT_DATE_FORMAT,
    //     onShow: function() {
    //         this.setOptions({})
    //     },
    //     timepicker: false,
    //     scrollMonth: false,
    //     scrollInput: false
    // });

    // $('#news_end_date').datetimepicker({
    //     format: DEFAULT_DATE_FORMAT,
    //     onShow: function() {
    //         this.setOptions({})
    //     },
    //     timepicker: false,
    //     scrollMonth: false,
    //     scrollInput: false
    // });

    var isChecked = $('#news_end_date').attr('data-exp');
    if (isChecked == 1) {
        $('.expdatelabel').removeClass('no_expiry');
        $('.expiry_lbl').text('Set Expiry');
        $(".expirydate").hide();
        $('#news_end_date').attr('disabled', 'disabled');
    } else {
        $('.expdatelabel').addClass('no_expiry');
        $('.expiry_lbl').text('No Expiry');
        $('#news_end_date').removeAttr('disabled');
    }

});

jQuery.validator.addMethod("phoneFormat", function(value, element) {
    // allow any non-whitespace characters as the host part
    return this.optional(element) || /((\(\d{3}\) ?)|(\d{3}-))?\d{3}-\d{4}/.test(value);
}, 'Please enter phone number in valid format');

jQuery.validator.addMethod("daterange", function(value, element) {
    var fromDateTime = $('#news_start_date').val();
    var toDateTime = $("#news_end_date").val();
    var isChecked = $('#news_end_date').attr('data-exp');

    if (toDateTime >= fromDateTime && fromDateTime <= toDateTime) {
        return true;
    } else {
        return false;
    }
}, "The end date must be a greater than start date.");

$('input[type=text]').change(function() {
    var input = $(this).val();
    var trim_input = input.trim();
    if (trim_input) {
        $(this).val(trim_input);
        return true;
    }
});

// $('.fromButton').click(function() {
//     $('#news_start_date').datetimepicker('show');
// });
// $('.toButton').click(function() {
//     $('#news_end_date').datetimepicker('show');
// });

$(document).on("change", '#news_end_date', function() {
    $(this).attr('data-newvalue', $(this).val());
});

$('#noexpiry').click(function() {
    var isChecked = $('#news_end_date').attr('data-exp');

    if (isChecked == 0) {
        $('.expdatelabel').removeClass('no_expiry');
        $('.expiry_lbl').text('Set Expiry');
        $('#news_end_date').attr('data-exp', '1');
        $('#news_end_date').attr('disabled', 'disabled');
        $(".expirydate").hide();
        $("#news_end_date").val(null);
        $('#news_end_date').val('');
        $('.expirydate').next('span.help-block').html('');
        $('.expirydate').parent('.form-group').removeClass('has-error');
    } else {
        $('.expdatelabel').addClass('no_expiry');
        $('.expiry_lbl').text('No Expiry');
        $('#news_end_date').attr('data-exp', '0');
        $('#news_end_date').removeAttr('disabled');
        $(".expirydate").show();
        if ($('#news_end_date').attr('data-newvalue').length > 0) {
            $("#news_end_date").val($('#news_end_date').attr('data-newvalue'));
        } else {
            $("#news_end_date").val('');
        }
    }
});

$('#news_start_date').flatpickr({
    dateFormat: DEFAULT_DATE_FORMAT + " H:i",
    minDate: 'today',
    enableTime: true
});
$('#news_end_date').flatpickr({
    dateFormat: DEFAULT_DATE_FORMAT + " H:i",
    minDate: 'today',
    enableTime: true
});
$('#news_start_date').on('change', function (e) {
    let index = e.target.getAttribute("data-dateIndex");
    let sdate = new Date(e.target.value)
    $('#news_end_date').flatpickr({
        dateFormat: DEFAULT_DATE_FORMAT + " H:i",
        minDate: sdate,
    enableTime: true
    }).clear();
});