/**
 * This method validates service form fields
 * since   2016-12-24
 * author  NetQuick
 */
var Validate = function() {
    var handlePhotoAlbum = function() {
        $("#frmPhotoAlbum").validate({
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
                order: {
                    required: true,
                    minStrict: true,
                    number: true,
                    noSpace: true,
                    xssProtection: true,
                    no_url: true
                },
                start_date_time: {
                    required: true,
                },
                end_date_time: {
                    daterange: true,
                    required: {
                        depends: function() {
                            var isChecked = $('#end_date_time').attr('data-exp');
                            if (isChecked == 0) {
                                return $('input[name=end_date_time]').val().length == 0;
                            }
                        }
                    }
                },
                start_date: {
                    required: true,
                    noSpace: true
                },
                varMetaTitle: {
                    required: true,
                    noSpace: true,
                    xssProtection: true,
                    no_url: true,
                },
                varMetaDescription: {
                    required: true,
                    noSpace: true,
                    xssProtection: true,
                    no_url: true,
                },
                short_description: {
                    required: true,
                    noSpace: true,
                    xssProtection: true,
                    no_url: true,
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
                },
                img_id: "required",
            },
            messages: {
                title:{
                    required: "Please enter the title",
                },
                order: {
                    required: "Display order must be a number greater than zero (0)"
                },
                doc_id: {
                    required: 'Please select the document'
                },
                short_description: {
                    required: "Please enter the short description"
                },
                varMetaTitle:{
                    required: "Please enter the meta title",
                },
                varMetaDescription:{
                    required: "Please enter the meta description",
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
                },
                img_id: "Please select featured image",
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
                $('.alert-danger', $('#frmPhotoAlbum')).show();
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
                return false;
            }
        });
        $('#tags-input input').on('keypress', function(e) {
            if (e.keyCode == 13) {
                e.keyCode = 188;
                e.preventDefault();
            };
        });
        $('#frmPhotoAlbum input').keypress(function(e) {
            if (e.which == 13 && e.keyCode != 188) {
                if ($('#frmPhotoAlbum').validate().form()) {
                    $('#frmPhotoAlbum').submit(); //form validation success, call ajax form submit
                }
                return false;
            }
        });
    }
    return {
        //main function to initiate the module
        init: function() {
            handlePhotoAlbum();
        }
    };
}();
jQuery(document).ready(function() {
    Validate.init();
    jQuery.validator.addMethod("noSpace", function(value, element) {
        if (value.trim().length <= 0) {
            return false;
        } else {
            return true;
        }
    }, "Please enter the valid input, Space not allowed");

    jQuery.validator.addMethod("minStrict", function(value, element) {
        // allow any non-whitespace characters as the host part
        if (value > 0) {
            return true;
        } else {
            return false;
        }
    }, 'Display order must be a number higher than zero');


    var isChecked = $('#end_date_time').attr('data-exp');
    if (isChecked == 1) {
        $('.expdatelabel').removeClass('no_expiry');
        $('.expiry_lbl').text('Set Expiry');
        $(".expirydate").hide();
        $('#end_date_time').attr('disabled', 'disabled');
    } else {
        $('.expdatelabel').addClass('no_expiry');
        $('.expiry_lbl').text('No Expiry');
        $('#end_date_time').removeAttr('disabled');
    }

});

// $('.fromButton').click(function() {
//     $('#start_date_time').datetimepicker('show');
// });
// $('.toButton').click(function() {
//     $('#end_date_time').datetimepicker('show');
// });
$(document).on("change", '#end_date_time', function() {
    $(this).attr('data-newvalue', $(this).val());
});

jQuery.validator.addMethod("daterange", function(value, element) {
    var fromDateTime = $('#start_date_time').val();
    var toDateTime = $("#end_date_time").val();
    var isChecked = $('#end_date_time').attr('data-exp');
    if (isChecked == 0) {
        toDateTime = new Date(toDateTime);
        fromDateTime = new Date(fromDateTime);
        return toDateTime >= fromDateTime && fromDateTime <= toDateTime;
    } else {
        return true;
    }
}, "The end date must be a greater than start date.");


$('#noexpiry').click(function() {
    var isChecked = $('#end_date_time').attr('data-exp');

    if (isChecked == 0) {
        $('.expdatelabel').removeClass('no_expiry');
        $('.expiry_lbl').text('Set Expiry');
        $('#end_date_time').attr('data-exp', '1');
        $('#end_date_time').attr('disabled', 'disabled');
        $(".expirydate").hide();
        $("#end_date_time").val(null);
        $('#end_date_time').val('');
        $('.expirydate').next('span.help-block').html('');
        $('.expirydate').parent('.form-group').removeClass('has-error');
    } else {
        $('.expdatelabel').addClass('no_expiry');
        $('.expiry_lbl').text('No Expiry');
        $('#end_date_time').attr('data-exp', '0');
        $('#end_date_time').removeAttr('disabled');
        $(".expirydate").show();
        if ($('#end_date_time').attr('data-newvalue').length > 0) {
            $("#end_date_time").val($('#end_date_time').attr('data-newvalue'));
        } else {
            $("#end_date_time").val('');
        }
    }
});

$('#start_date_time').flatpickr({
    dateFormat: DEFAULT_DATE_FORMAT + " H:i",
    minDate: 'today',
    enableTime: true
});
$('#end_date_time').flatpickr({
    dateFormat: DEFAULT_DATE_FORMAT + " H:i",
    minDate: 'today',
    enableTime: true
});
$('#start_date_time').on('change', function (e) {
    let index = e.target.getAttribute("data-dateIndex");
    let sdate = new Date(e.target.value)
    $('#end_date_time').flatpickr({
        dateFormat: DEFAULT_DATE_FORMAT + " H:i",
        minDate: sdate,
    enableTime: true
    }).clear();
});