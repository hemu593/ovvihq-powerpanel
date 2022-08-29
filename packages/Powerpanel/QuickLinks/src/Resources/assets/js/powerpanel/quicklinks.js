/**
 * This method show hides default banner fields
 * since   2016-12-22
 * author  NetQuick
 */
var Custom = function() {
    return {
        //main function
        init: function() {
            //initialize here something.            
        },
        checkType: function() {
            var radioValue = $("input[name='link_type']:checked").val();
            if (radioValue == 'internal') {
                $('#ext_Link_div').hide();
                $('#pages').show();
                if ($('#modules').val() != ' ') {
                    $('#records').show();
                }
                $('#inner_recommandation').show();
                $('#home_recommandation').hide();
            } else if (radioValue == 'external') {
                $('#ext_Link_div').show();
                $('#pages').hide();
                $('#records').hide();
                $('#home_recommandation').show();
                $('#inner_recommandation').hide();
            }
            $('#modules').select2({
                placeholder: "Select Module",
                width: '100%',
                minimumResultsForSearch: 5
            });
        },
        getModuleRecords: function(moduleName, modelName) {
            var ajaxUrl = site_url + '/powerpanel/quick-links/selectRecords';
            jQuery.ajax({
                type: "POST",
                url: ajaxUrl,
                dataType: 'HTML',
                data: { "module": moduleName, "model": modelName, 'selected': selectedRecord },
                async: false,
                success: function(result) {
                    $('#foritem').html(result).select2({
                        placeholder: "Select Module",
                        width: '100%',
                        minimumResultsForSearch: 5
                    });
                }
            });
        }
    }
}();
/**
 * This method validates banner form fields
 * since   2016-12-24
 * author  NetQuick
 */
var Validate = function() {
    var handleQuickLinks = function() {
        $("#frmQuicklinks").validate({
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
                sector: {
                    required: true,
                },
                start_date_time: {
                    required: true,
                },
                end_date_time: {
                    daterange: true,
                    required: {
                        depends: function() {
                            var isChecked = $('#quickLinks_end_date').attr('data-exp');
                            if (isChecked == 0) {
                                return $('input[name=end_date_time]').val().length == 0;
                            }
                        }
                    }
                },
                ext_Link: {
                    required: {
                        depends: function() {
                            return ($('input:radio[name="link_type"][value="external"]').is(":checked")) ? true : false;
                        }
                    },
                    url: true,
                },
                display_order: {
                    required: true,
                    minStrict: true,
                    number: true,
                    noSpace: true,
                    xssProtection: true,
                    no_url: true
                },
                modules: {
                    required: {
                        depends: function() {
                            return $('#internal_linktype[value="internal"]:checked').length > 0;
                        }
                    },
                    noSpace: {
                        depends: function() {
                            return $('#internal_linktype[value="internal"]:checked').length > 0;
                        }
                    }
                },
                foritem: {
                    required: {
                        depends: function() {
                            return $('#internal_linktype[value="internal"]:checked').length > 0;
                        }
                    },
                    noSpace: {
                        depends: function() {
                            return $('#internal_linktype[value="internal"]:checked').length > 0;
                        }
                    }
                }
            },
            messages: {
                title: { required: Lang.get('validation.required', { attribute: Lang.get('template.title') }) },
                modules: Lang.get('validation.required', { attribute: Lang.get('template.module') }),
                foritem: Lang.get('validation.required', { attribute: Lang.get('template.page') }),
                display_order: {
                    required: Lang.get('validation.required', { attribute: Lang.get('template.displayorder') }),
                    minStrict: Lang.get('validation.minStrict', { attribute: Lang.get('template.displayorder') }),
                    number: Lang.get('validation.number', { attribute: Lang.get('template.displayorder') }),
                    noSpace: Lang.get('validation.noSpace', { attribute: Lang.get('template.displayorder') })
                },
                sector: {
                    required: "Sector Type is required.",
                },
                ext_Link: {
                    required: "External Link is required.",
                },
                start_date_time: {
                    required: "Start date field is required.",
                },
                end_date_time: {
                    required: Lang.get('validation.required', { attribute: Lang.get('template.enddate') }),
                    daterange: 'The end date must be a greater than start date.'
                },
            },
            errorPlacement: function(error, element) {
                if (element.parent('.input-group').length) {
                    error.insertAfter(element.parent());
                } else if (element.hasClass('select2')) {
                    error.insertAfter(element.next('span'));
                } else {
                    error.insertAfter(element);
                }
            },
            invalidHandler: function(event, validator) { //display error alert on form submit
                var errors = validator.numberOfInvalids();
                if (errors) {
                    $.loader.close(true);
                }
                $('.alert-danger', $('#frmQuicklinks')).show();
            },
            highlight: function(element) { // hightlight error inputs
                $(element).closest('.form-group').addClass('has-error'); // set error class to the control group
            },
            unhighlight: function(element) {
                $(element).closest('.form-group').removeClass('has-error'); // set error class to the control group
            },
            submitHandler: function(form) { // for demo
                $('body').loader(loaderConfig);
                form.submit();
                $("button[type='submit']").attr('disabled', 'disabled');
                return false;
            }
        });
        $('#frmQuicklinks input').keypress(function(e) {
            if (e.which == 13) {
                if ($('#frmQuicklinks').validate().form()) {
                    $('#frmQuicklinks').submit(); //form validation success, call ajax form submit
                }
                return false;
            }
        });
    }
    return {
        //main function to initiate the module
        init: function() {
            handleQuickLinks();
        }
    };
}();
jQuery(document).ready(function() {
    Custom.init();
    Custom.checkType();
    Validate.init();

    $(document).on('click', '.banner', function(e) {
        Custom.checkType();
    });

    $('#modules').on("change", function(e) {
        Custom.getModuleRecords($("#modules option:selected").data('module'), $("#modules option:selected").data('model'));
    });

    jQuery.validator.addMethod("noSpace", function(value, element) {
        if (value.trim().length <= 0) {
            return false;
        } else {
            return true;
        }
    }, "This field is required");

    var isChecked = $('#quickLinks_end_date').attr('data-exp');
    if (isChecked == 1) {
        $('.expdatelabel').removeClass('no_expiry');
        $('.expiry_lbl').text('Set Expiry');
        $(".expirydate").hide();
        $('#quickLinks_end_date').attr('disabled', 'disabled');
    } else {
        $('.expdatelabel').addClass('no_expiry');
        $('.expiry_lbl').text('No Expiry');
        $('#quickLinks_end_date').removeAttr('disabled');
    }

});
jQuery.validator.addMethod("phoneFormat", function(value, element) {
    // allow any non-whitespace characters as the host part
    return this.optional(element) || /((\(\d{3}\) ?)|(\d{3}-))?\d{3}-\d{4}/.test(value);
}, 'Please enter a valid phone number.');

jQuery.validator.addMethod("minStrict", function(value, element) {
    // allow any non-whitespace characters as the host part
    if (value > 0) {
        return true;
    } else {
        return false;
    }
}, 'Display order must be a number higher than zero');

jQuery.validator.addMethod("noSpace", function(value, element) {
    if (value.trim().length <= 0) {
        return false;
    } else {
        return true;
    }
}, "This field is required");
$('input[name=title]').change(function() {
    var title = $(this).val();
    var trim_title = title.trim();
    if (trim_title) {
        $(this).val(trim_title);
        return true;
    }
});

$(window).load(function() {
    var radioValue = $("input[name='link_type']:checked").val();
    if (selectedRecord > 0) {
        $('#modules').trigger('change');
        if (radioValue == 'external') {
            $('#modules').select2({
                placeholder: "Select Module",
                width: '100%',
                minimumResultsForSearch: 5
            });
            $('#records').hide();
        }
    }
});

jQuery.validator.addMethod("daterange", function(value, element) {
    var fromDateTime = $('#quickLinks_start_date').val();
    var toDateTime = $("#quickLinks_end_date").val();
    var isChecked = $('#quickLinks_end_date').attr('data-exp');
    if (isChecked == 0) {
        toDateTime = new Date(toDateTime);
        fromDateTime = new Date(fromDateTime);
        return toDateTime >= fromDateTime && fromDateTime <= toDateTime;
    } else {
        return true;
    }
}, "The end date must be a greater than start date.");

$('.fromButton').click(function() {
    $('#quickLinks_start_date').datetimepicker('show');
});
$('.toButton').click(function() {
    $('#quickLinks_end_date').datetimepicker('show');
});

$(document).on("change", '#quickLinks_end_date', function() {
    $(this).attr('data-newvalue', $(this).val());
});

$('#noexpiry').click(function() {
    var isChecked = $('#quickLinks_end_date').attr('data-exp');

    if (isChecked == 0) {
        $('.expdatelabel').removeClass('no_expiry');
        $('.expiry_lbl').text('Set Expiry');
        $('#quickLinks_end_date').attr('data-exp', '1');
        $('#quickLinks_end_date').attr('disabled', 'disabled');
        $(".expirydate").hide();
        $("#quickLinks_end_date").val(null);
        $('#quickLinks_end_date').val('');
        $('.expirydate').next('span.help-block').html('');
        $('.expirydate').parent('.form-group').removeClass('has-error');
    } else {
        $('.expdatelabel').addClass('no_expiry');
        $('.expiry_lbl').text('No Expiry');
        $('#quickLinks_end_date').attr('data-exp', '0');
        $('#quickLinks_end_date').removeAttr('disabled');
        $(".expirydate").show();
        if ($('#quickLinks_end_date').attr('data-newvalue').length > 0) {
            $("#quickLinks_end_date").val($('#quickLinks_end_date').attr('data-newvalue'));
        } else {
            $("#quickLinks_end_date").val('');
        }
    }
});