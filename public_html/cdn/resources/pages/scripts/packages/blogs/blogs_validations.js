/**
 * This method validates FAQs form fields
 * since   2016-12-24
 * author  NetQuick
 */
var Validate = function () {
    var handleBlogs = function () {
        $("#frmBlogs").validate({
            errorElement: 'span',
            errorClass: 'help-block',
            ignore: [],
            rules: {
                title: {
                    required: true,
                    noSpace: true,
                    xssProtection: true,
                    no_url:true
                },
                category_id: {
                    required: true,
                    noSpace: true
                },
                short_description: {
                    required: true,
                    noSpace: true,
                    xssProtection: true,
                    no_url:true
                },
                start_date_time: {
                    required: true,
                },
                end_date_time: {
                    daterange: true,
                    required: {
                        depends: function () {
                            var isChecked = $('#end_date_time').attr('data-exp');
                            if (isChecked == 0) {
                                return $('input[name=end_date_time]').val().length == 0;
                            }
                        }
                    }
                },
                order: {
                    required: true,
                    number: true,
                    noSpace: true,
                    minStrict: true
                },
                varMetaTitle: {
                    required: true,
                    noSpace: true,
                    xssProtection: true,
                    no_url:true
                },
                varMetaDescription: {
                    required: true,
                    noSpace: true,
                    xssProtection: true,
                    no_url:true
                },
                new_password: {
                    required: {
                        depends: function () {
                            if ($('input[name="chrPageActive"][value="PP"]').prop("checked") == true) {
                                return true;
                            } else {
                                return false;
                            }
                        }
                    },
                    passwordrules: {
                        depends: function () {
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
                category_id: {
                    required:"Please select the blog category"
                },
                short_description:{
                    required: "Please enter the short description"
                },
                order: {
                    required: "Display order must be a number greater than zero (0)"
                },
                start_date_time: {
                    required: "Please select the start date",
                },
                end_date_time: {
                    required: "Please select the end date",
                    daterange: 'The end date must be a greater than start date.'
                },
                new_password: {
                    required: Lang.get('validation.required', {attribute: 'Password'}),
                    passwordrules: 'Please follow rules for password'
                },
                varMetaTitle:{
                    required: "Please enter the meta title",
                },
                varMetaDescription:{
                    required: "Please enter the meta description",
                },
                img_id: "Please select featured image",
            },
            errorPlacement: function (error, element) {
                if (element.parent('.input-group').length) {
                    error.insertAfter(element.parent());
                } else if (element.hasClass('choices__input')) {
                    error.insertAfter(element.parent().parent().next('span'));
                } else {
                    error.insertAfter(element);
                }
            },
            invalidHandler: function (event, validator) {
                var errors = validator.numberOfInvalids();
                if (errors) {
                    $.loader.close(true);
                }
                $('.alert-danger', $('#frmBlogs')).show();
            },
            highlight: function (element) {
                $(element).closest('.form-group').addClass('has-error');
            },
            unhighlight: function (element) {
                $(element).closest('.form-group').removeClass('has-error');
            },
            submitHandler: function (form) {
                $('body').loader(loaderConfig);
                form.submit();
                $("button[type='submit']").attr('disabled','disabled');
                return false;
            }
        });

        $('#tags-input input').on('keypress', function(e) {
            if (e.keyCode == 13){
              e.keyCode = 188;
              e.preventDefault();
            };
        });
        $('#frmBlogs input').on('keypress',function(e) {
            if (e.keyCode == 13 && e.keyCode != 188) {
                if ($('#frmBlogs').validate().form()) {
                    $('#frmBlogs').submit();
                }
                return false;
            }
        });
    }
    return {
        init: function () {
            handleBlogs();
        }
    };
}();

jQuery(document).ready(function () {
    Validate.init();

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

$('.fromButton').click(function () {
    $('#start_date_time').datetimepicker('show');
});
$('.toButton').click(function () {
    $('#end_date_time').datetimepicker('show');
});
$(document).on("change", '#end_date_time', function () {
    $(this).attr('data-newvalue', $(this).val());
});

jQuery.validator.addMethod("daterange", function (value, element) {
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
}, "The end date must be a greater than start date");

jQuery.validator.addMethod("phoneFormat", function (value, element) {
    return this.optional(element) || /((\(\d{3}\) ?)|(\d{3}-))?\d{3}-\d{4}/.test(value);
}, 'Please enter phone number in valid format');

jQuery.validator.addMethod("noSpace", function (value, element) {
    if (value.trim().length <= 0) {
        return false;
    } else {
        return true;
    }
}, "Please enter the valid input, Space not allowed");

jQuery.validator.addMethod("minStrict", function (value, element) {
    if (value > 0) {
        return true;
    } else {
        return false;
    }
}, 'Display order must be a number greater than zero (0)');

jQuery.validator.addMethod("avoidonlyzero", function (value, element) {
    var newVal = value;
    if (newVal <= 0)
    {
        return false;
    } else
    {
        return true;
    }
}, "Please enter a valid input");

$('input[type=text]').change(function () {
    var input = $(this).val();
    var trim_input = input.trim();
    if (trim_input) {
        $(this).val(trim_input);
        return true;
    }
});

$('#noexpiry').click(function () {
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

/*********** Remove Image code start Here  *************/
$(document).ready(function() {
    if ($("input[name='img_id']").val() == '') {
        $('.removeimg').hide();
        $('.image_thumb .overflow_layer').css('display', 'none');
    } else {
        $('.removeimg').show();
        $('.image_thumb .overflow_layer').css('display', 'block');
    }
    $(document).on('click', '.removeimg', function(e) {
        $("input[name='img_id']").val('');
        $("input[name='image_url']").val('');
        $(".fileinput-preview").html('<div class="dz-message needsclick w-100 text-center"><div class="dropzone_icon"><i class="display-5 text-muted ri-upload-cloud-2-fill"></i></div><h5 class="sbold dropzone-title">Drop files here or click to upload</h5></div>');

        if ($("input[name='img_id']").val() == '') {
            $('.removeimg').hide();
            $('.image_thumb .overflow_layer').css('display', 'none');
        } else {
            $('.removeimg').show();
            $('.image_thumb .overflow_layer').css('display', 'block');
        }
    });
});
/************** Remove Images Code end ****************/
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