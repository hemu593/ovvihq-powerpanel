/**
 * This method validates news form fields
 * since   2016-12-24
 * author  NetQuick
 */
var Validate = function() {
    var handleNews = function() {
        $("#frmPublicRecord").validate({
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
                doc_id: "required",
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

                author: {
                    required: true,
                    noSpace: true,
                    xssProtection: true,
                    no_url: true
                },

                'category_id': {
                    required: true
                },
            },
            messages: {
                title: { required: Lang.get('validation.required', { attribute: Lang.get('template.title') }) },
                doc_id: {
                    required: "Please upload a Document.",
                },
                author: {
                    required: "Author field is required.",
                },

                start_date_time: {
                    required: "Start date field is required.",
                },
                end_date_time: {
                    required: Lang.get('validation.required', { attribute: Lang.get('template.enddate') }),
                    daterange: 'The end date must be a greater than start date.'
                },

                'category_id': {
                    required: 'Category is required.'
                },
            },
            errorPlacement: function(error, element) {
                if (element.parent('.input-group').length) {
                    error.insertAfter(element.parent());
                } else if (element.hasClass('select2')) {
                    error.insertAfter(element.next('span'));
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
                $('.alert-danger', $('#frmPublicRecord')).show();
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

        $('#frmPublicRecord input').keypress(function(e) {
            if (e.which == 13 && e.keyCode != 188) {
                if ($('#frmPublicRecord').validate().form()) {
                    $('#frmPublicRecord').submit(); //form validation success, call ajax form submit
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
    jQuery.validator.addMethod("noSpace", function(value, element) {
        if (value.trim().length <= 0) {
            return false;
        } else {
            return true;
        }
    }, "This field is required");

    $("#publicrecord_start_date").datetimepicker({
        format: 'd-m-Y',
        onShow: function(ct) {
            this.setOptions({})
        },
        timepicker: false,
        scrollMonth: false,
        scrollInput: false
    });

    var isChecked = $('#end_date_time').attr('data-exp');
    // if (isChecked == 1) {
    //     $('.expdatelabel').removeClass('no_expiry');
    //     $('.expiry_lbl').text('Set Expiry');
    //     $(".expirydate").hide();
    //     $('#end_date_time').attr('disabled', 'disabled');
    // } else {
    //     $('.expdatelabel').addClass('no_expiry');
    //     $('.expiry_lbl').text('No Expiry');
    //     $('#end_date_time').removeAttr('disabled');
    // }

});
jQuery.validator.addMethod("phoneFormat", function(value, element) {
    // allow any non-whitespace characters as the host part
    return this.optional(element) || /((\(\d{3}\) ?)|(\d{3}-))?\d{3}-\d{4}/.test(value);
}, 'Please enter a valid phone number.');

jQuery.validator.addMethod("daterange", function(value, element) {
    var fromDateTime = $('#publicrecord_start_date').val();
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

$('input[type=text]').change(function() {
    var input = $(this).val();
    var trim_input = input.trim();
    if (trim_input) {
        $(this).val(trim_input);
        return true;
    }
});

$('.fromButton').click(function() {
    $('#publicrecord_start_date').datetimepicker('show');
});
$('.toButton').click(function() {
    $('#end_date_time').datetimepicker('show');
});

$(document).on("change", '#end_date_time', function() {
    $(this).attr('data-newvalue', $(this).val());
});

// $('#noexpiry').click(function() {
//     var isChecked = $('#end_date_time').attr('data-exp');

//     if (isChecked == 0) {
//         $('.expdatelabel').removeClass('no_expiry');
//         $('.expiry_lbl').text('Set Expiry');
//         $('#end_date_time').attr('data-exp', '1');
//         $('#end_date_time').attr('disabled', 'disabled');
//         $(".expirydate").hide();
//         $("#end_date_time").val(null);
//         $('#end_date_time').val('');
//         $('.expirydate').next('span.help-block').html('');
//         $('.expirydate').parent('.form-group').removeClass('has-error');
//     } else {
//         $('.expdatelabel').addClass('no_expiry');
//         $('.expiry_lbl').text('No Expiry');
//         $('#end_date_time').attr('data-exp', '0');
//         $('#end_date_time').removeAttr('disabled');
//         $(".expirydate").show();
//         if ($('#end_date_time').attr('data-newvalue').length > 0) {
//             $("#end_date_time").val($('#end_date_time').attr('data-newvalue'));
//         } else {
//             $("#end_date_time").val('');
//         }
//     }
// });