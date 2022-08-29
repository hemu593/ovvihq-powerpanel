var Custom = function() {
    return {
        //main function
        init: function() {
            //initialize here something.
        },
        getModuleRecords: function(sectorName) {
            var ajaxUrl = site_url + '/powerpanel/events/getCategory';
            jQuery.ajax({
                type: "POST",
                url: ajaxUrl,
                dataType: 'HTML',
                data: { "sectorname": sectorName,"selectedCategory":selectedCategory,"selectedId":selectedId},
                async: false,
                success: function(result) {
                    $("#category_id").html(result).trigger('change.select2');
                }
            });
        }
    }
}();
var Validate = function() {
    var handleEvents = function() {
        $("#frmEvents").validate({
            errorElement: 'span',
            errorClass: 'help-block',
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
                    noSpace: true
                },
                category_id: {
                    required: true,
                    noSpace: true
                },
                img_id: { required: false },
                short_description: {
                    required: true,
                    noSpace: true,
                    xssProtection: true,
                    no_url: true
                },
                varAdminEmail: {
                    email: true,
                    required: false,
                    noSpace: true,
                },
                varAdminPhone: {
                    required: false,
                    number: true,
                    minlength: 10,
                    maxlength: 15,

                },
                varMetaTitle: {
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
                }
            },
            messages: {
                title: {
                    required: Lang.get('validation.required', {
                        attribute: Lang.get('template.title')
                    })
                },
                category_id: "Please select category",
                sector: "Please select Sector Type",
                short_description: { required: "Please enter short description" },
                varMetaTitle: {
                    required: Lang.get('validation.required', {
                        attribute: Lang.get('template.metatitle')
                    })
                },
                varAdminPhone: {
                    minlength: "Phone number should be minimum 10 digits",
                    maxlength: "Phone number should be more 15 digits",
                    number: "Phone no should only consist numbers"
                },
                varMetaDescription: {
                    required: Lang.get('validation.required', {
                        attribute: Lang.get('template.metadescription')
                    })
                }
                // img_id: Lang.get('validation.required', { attribute: Lang.get('template.image') }),
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
            invalidHandler: function(event, validator) {
                var errors = validator.numberOfInvalids();
                if (errors) {
                    $.loader.close(true);
                }
                $('.alert-danger', $('#frmEvents')).show();
            },
            highlight: function(element) {
                $(element).closest('.form-group').addClass('has-error');
            },
            unhighlight: function(element) {
                $(element).closest('.form-group').removeClass('has-error');
            },
            submitHandler: function(form) {
                if($('#frmEvents').validate().form()){
                    $('body').loader(loaderConfig);
                    form.submit();
                    $("button[type='submit']").attr('disabled', 'disabled');
                }else{
                    return false;
                }
            }
        });
        $('#tags-input input').on('keypress', function(e) {
            if (e.keyCode == 13) {
                e.keyCode = 188;
                e.preventDefault();
            };
        });
        $('#frmEvents input').keypress(function(e) {
            if (e.which == 13 && e.keyCode != 188) {
                if ($('#frmEvents').validate().form()) {
                    $('#frmEvents').submit();
                }
                return false;
            }
        });
    }
    return {
        init: function() {
            handleEvents();
        }
    };
}();

$(window).load(function() {
    if (selectedCategory > 0 && selectedId > 0) {
        $('#varSector').trigger('change');
    }
});

jQuery(document).ready(function() {
    Validate.init();
    Custom.init();
    $('#varSector').on("change", function(e) {
        Custom.getModuleRecords($("#varSector option:selected").val());
    });
    $("#varAdminEmail").rules('add', {
        email: true,
        noSpace: true,
        required: false,
    });
    $("#varAdminPhone").rules('add', {
        number: true,
        minlength: 10,
        maxlength: 15,
        required: false,
    });

    $('.schedules').each(function(key) {

        // $('#dateTimeSlot' + key + ' #start_date_time' + key).datepicker({
        //     autoclose: true,
        //     format: DEFAULT_DT_FMT_FOR_DATEPICKER, //'yyyy-mm-dd',
        //     minDate: new Date(),
        //     startDate: new Date(),
        //     scrollMonth: false,
        //     scrollInput: false
        // }).on("change", function (e) {
        //     let index = e.target.getAttribute("data-dateIndex");    
        //     var minDate = new Date(e.target.value);
        //     $('#dateTimeSlot' + key + ' #end_date_time' + key).datepicker('setStartDate', minDate);
        // });

        // $('#dateTimeSlot' + key + ' #end_date_time' + key).datepicker({
        //     autoclose: true,
        //     format: DEFAULT_DT_FMT_FOR_DATEPICKER,
        //     minDate: $('#dateTimeSlot' + key + ' #start_date_time' + key).val(),
        //     startDate: $('#dateTimeSlot' + key + ' #start_date_time' + key).val(),
        //     scrollMonth: false,
        //     scrollInput: false
        // }).on('changeDate', function (e) {
        //     var maxDate = new Date(e.target.value);
        //     $('#dateTimeSlot' + key + ' #start_date_time' + key).datepicker('setEndDate', maxDate);
        // });
        
        $('#dateTimeSlot' + key + ' #start_date_time'+key).on('change', function (e) {
            let index = e.target.getAttribute("data-dateIndex");
            let date = new Date(e.target.value)
            $('#dateTimeSlot' + index + ' #end_date_time' + index).flatpickr({
                dateFormat: DEFAULT_DATE_FORMAT,
                minDate: date
            }).clear();
        });
        $('#dateTimeSlot'+ key +' #end_date_time'+key).on('change', function (e) {
            let index = e.target.getAttribute("data-dateIndex");
            let date = new Date(e.target.value)
            $('#dateTimeSlot' + index + ' #start_date_time' + index).flatpickr({
                dateFormat: DEFAULT_DATE_FORMAT,
                minDate: 'today',
                maxDate: date
            });
        });
        $('#dateTimeSlot' + key + ' #start_date_time'+key).rules('add', { required: true });
        $('#dateTimeSlot'+ key +' #end_date_time'+key).rules('add', { required: true });
        $('.time-slots-'+key).each(function(tkey) {
            $("#dateTimeSlot" + key + " #timeSlotFrom"+tkey).rules('add', { required: true });
            $("#dateTimeSlot" + key + " #timeSlotTo"+tkey).rules('add', {
                required: true,
                TimeValid:[key, tkey]
            });
            $("#dateTimeSlot" + key + " #attendees"+tkey).rules('add', {
                required: true,
                number: true,
                maxlength: 3,
                noSpace: true,
                zero_not_allow: true
            });
        });
    });

    jQuery.validator.addMethod("TimeValid", function (value, element, params) {
        var dtStartDate = $('#dateTimeSlot' + params[0] + ' #start_date_time' + params[0]).val();
        var dtEndDate = $('#dateTimeSlot' + params[0] + ' #end_date_time' + params[0]).val();
        var eventStartTime = $("#dateTimeSlot" + params[0] + " #timeSlotFrom" + params[1]).val();
        var eventEndTime = value;
        if (Date.parse(dtStartDate) != NaN && Date.parse(dtEndDate) != NaN && Date.parse(dtStartDate) == Date.parse(dtEndDate)) {
            if(Date.parse(dtEndDate+' '+eventEndTime) > Date.parse(dtStartDate+' '+eventStartTime)) {
                return true;
            }else{
                return false;
            }   
        }else{
            return true;
        }
    }, "End time must be greater than the start time.");

    
    jQuery.validator.addMethod("noSpace", function(value, element) {
        if (value.trim().length <= 0) {
            return false;
        } else {
            return true;
        }
    }, "This field is required");

    jQuery.validator.addMethod("daterange", function (element) {
        console.log('dateRange Element', element)
        var fromDateTime = $('#start_date_time').val();
        var toDateTime = $("#end_date_time").val();
        return toDateTime >= fromDateTime;
    }, "The end date must be a greater than start date.");

    jQuery.validator.addMethod("greaterThan", function(value, element, params) {
        if (!/Invalid|NaN/.test(new Date(value))) {
            return new Date(value) > new Date($(params).val());
        }
        return isNaN(value) && isNaN($(params).val()) 
        || (Number(value) > Number($(params).val())); 
    },'The end date must be a greater than start date.'); 

    jQuery.validator.addMethod("phoneFormat", function(value, element) {
        return this.optional(element) || /((\(\d{3}\) ?)|(\d{3}-))?\d{3}-\d{4}/.test(value);
    }, 'Please enter a valid phone number.');

    jQuery.validator.addMethod("noSpace", function(value, element) {
        if (value.trim().length <= 0) {
            return false;
        } else {
            return true;
        }
    }, "This field is required");
    jQuery.validator.addMethod("minStrict", function(value, element) {
        if (value > 0) {
            return true;
        } else {
            return false;
        }
    }, 'Display order must be a number higher than zero');

    jQuery.validator.addMethod("zero_not_allow", function(value, element) {
        if (value > 0) {
            return true;
        } else {
            return false;
        }
    }, "Please enter a valid value");
    
    $('input[type=text]').change(function() {
        var input = $(this).val();
        var trim_input = input.trim();
        if (trim_input) {
            $(this).val(trim_input);
            return true;
        }
    });
});


function addDateTimeSlot(event, id) {
    let nextId = parseInt(id) + 1;
    let current = document.querySelector('#' + event.id);
    let nextSibling = current.nextElementSibling;

    if (nextSibling === null & $("#" + 'dateTimeSlot' + nextId).length == 0) {
        let html = '';
        html += '<div class="row schedules" data-parentIndex='+nextId+' id="dateTimeSlot'+nextId+'">';

        html += '<div class="col-md-5"><div class="cm-floating form-md-line-input">';
        html += '<label class="form_title">Start Date<span aria-required="true" class="required"> * </span></label>';
        html += '<div class="input-group date form_meridian_datetime">';
        html += '<input type="text" class="form-control" data-provider="flatpickr" autocomplete="off" name="start_date_time[' + parseInt(nextId) + '][startDate]"  id="start_date_time' + nextId + '" date("Y-m-d") readonly="readonly" data-dateIndex="' + nextId + '">';
        html += '</div><span class="help-block"></span></div></div>';

        html += '<div class="col-md-5"><div class="form-md-line-input">';
        html += '<div class="cm-floating date form_meridian_datetime expirydate">';
        html += '<label class="form_title" >End Date <span aria-required="true" class="required"> * </span></label>';
        html += '<div class="pos_cal">';
        html += '<input type="text" class="form-control" data-provider="flatpickr" autocomplete="off" name="start_date_time[' + parseInt(nextId) + '][endDate]" id="end_date_time' + nextId + '" onkeypress="javascript: return KeycheckOnlyDate(event);" onpaste="return false" readonly="readonly" date("Y-m-d") data-dateIndex="' + nextId + '">';
        html += '</div></div>';
        html += '<span class="help-block"></span></div></div>';
        
        html += '<div class="col-md-2 addDateButton">';
        html += '<input type="button" name="Remove" value="Remove" class="btn btn-danger" onclick="removeDateTimeSlot(this,' + nextId + ')" id="dateTimeSlotRemove' + nextId + '">';
        html += '<input type=button name="Add" value="Add" class="btn btn-primary" onclick="addDateTimeSlot(this,' + nextId + ')" id="dateTimeSlotAdd' + nextId + '"></div>';
        
        html += '<div class="col-md-12"><h5 class="form-section mb-3">Time & Attendees:</h5>';
        html += '<div class="row time-slots-'+nextId+'" id="timeSlot0" data-parentName="dateTimeSlot' + nextId + '"  data-index="0">';
        html += '<div class="col-md-3"><div class="cm-floating form-md-line-input">';
        html += '<label class="form-label">From</label>';
        html += '<input type="text" data-provider="timepickr" readonly="readonly" data-time-basic="true" class="form-control" autocomplete="off" name="start_date_time[' + parseInt(nextId) + '][timeSlotFrom][]" id="timeSlotFrom0" onkeydown="event.preventDefault()">';
        html += '</div></div>';

        html += '<div class="col-md-3"><div class="cm-floating form-md-line-input">';
        html += '<label class="form-label">To</label>';
        html += '<input type="text" data-provider="timepickr" data-time-basic="true" readonly="readonly" class="form-control" autocomplete="off" name="start_date_time[' + parseInt(nextId) + '][timeSlotTo][]" id="timeSlotTo0" onkeydown="event.preventDefault()">';
        html += '</div></div>';

        html += '<div class="col-md-3"><div class="cm-floating form-md-line-input">';
        html += '<label class="form-label">Please enter no of attendees</label>';
        html += '<input type="number" maxlength="3" class="form-control" autocomplete="off" name="start_date_time[' + parseInt(nextId) + '][attendees][]" id="attendees0" maxlength="3">';
        html += '<span class="help-block"></span></div></div>';

        html += '<div class="col-md-3 addTimeButton">';
        html += '<input type="button" name="Add" value="Add" class="btn btn-primary" onclick="addTimeSlot(this,0,' + nextId + ')" id="timeSlotAdd0">';
        html += '</div></div></div></div>';

        $('#dateTimeSlot' + id).after(html);
        
        //start-date and end-date flatpickr
        $('#dateTimeSlot' + nextId + ' #start_date_time' + nextId).flatpickr({
            dateFormat: DEFAULT_DATE_FORMAT,
            minDate: 'today'
        });
        $('#dateTimeSlot' + nextId + ' #end_date_time' + nextId).flatpickr({
            dateFormat: DEFAULT_DATE_FORMAT,
            minDate: 'today'
        });
        //disable end-date
        $('#dateTimeSlot' + nextId + ' #start_date_time' + nextId).on('change', function (e) {
            let index = e.target.getAttribute("data-dateIndex");
            let sdate = new Date(e.target.value)
            $('#dateTimeSlot' + index + ' #end_date_time' + index).flatpickr({
                dateFormat: DEFAULT_DATE_FORMAT,
                minDate: sdate
            }).clear();
        });
        //disable start-date
        $('#dateTimeSlot' + nextId + ' #end_date_time' + nextId).on('change', function (e) {
            let index = e.target.getAttribute("data-dateIndex");
            let date = new Date(e.target.value)
            $('#dateTimeSlot' + index + ' #start_date_time' + index).flatpickr({
                dateFormat: DEFAULT_DATE_FORMAT,
                minDate: 'today',
                maxDate: date
            });
        });
        $('#dateTimeSlot' + nextId + ' #timeSlotFrom0').flatpickr({
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
        });
        $('#dateTimeSlot' + nextId + ' #timeSlotTo0').flatpickr({
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
        });

        $("#dateTimeSlotAdd" + parseInt(id)).remove();
        $('#dateTimeSlot' + nextId + ' #start_date_time' + nextId).rules('add', { required: true });
        $('#dateTimeSlot' + nextId + ' #end_date_time' + nextId).rules('add', { required: true });
        $('#dateTimeSlot' + nextId + ' #timeSlotFrom0').rules('add', { required: true });
        $('#dateTimeSlot' + nextId + ' #timeSlotTo0').rules('add', {
            required: true,
            TimeValid: [nextId, 0]
        });
        $('#dateTimeSlot' + nextId + ' #attendees0').rules('add', {
            required: true,
            number: true,
            maxlength: 3,
            noSpace: true,
            zero_not_allow: true
        });
    }
}

function removeDateTimeSlot(event, id) {
    let current = document.querySelector('#' + event.id);
    let prevSibling = document.querySelector('#' + $('#' + event.id).parent().parent().prev().attr('id'));
    let nextSibling = document.querySelector('#' +$('#' + event.id).parent().parent().next().attr('id'));
    
    if (nextSibling === null) {
        let dataIndex = parseInt($(prevSibling).data('parentindex'));
        $('#dateTimeSlot' + dataIndex + ' .addDateButton').append('<input type="button" name="Add" value="Add" class="btn btn-primary" onclick="addDateTimeSlot(this,' + dataIndex + ')" id="dateTimeSlotAdd' + dataIndex + '">')
    }
    
    if ($("#" + event.id).parent().parent().length != 0) {
        $("#" + event.id).parent().parent().remove();
    }
}

function addTimeSlot(event, id, parentIndex) {
    let nextId = parseInt(id) + 1;
    let current = document.querySelector('#' + event.id);
    let nextSibling = current.nextElementSibling;

    if ($("#dateTimeSlot"+parentIndex+" #"+"timeSlot"+nextId).length == 0) {
        let html = '';
        html += '<div class="row time-slots-'+parentIndex+'" id="timeSlot'+nextId+'" data-parentName="dateTimeSlot' + parentIndex + '"  data-index="'+nextId+'">';
        html += '<div class="col-md-3"><div class="cm-floating form-md-line-input">';
        html += '<label class="form-label">From</label>';
        html += '<input type="text" data-provider="timepickr" data-time-basic="true" readonly="readonly" class="form-control" autocomplete="off" name="start_date_time[' + parseInt(parentIndex) + '][timeSlotFrom][]" id="timeSlotFrom'+nextId+'" onkeydown="event.preventDefault()">';
        html += '</div></div>';

        html += '<div class="col-md-3"><div class="cm-floating form-md-line-input">';
        html += '<label class="form-label">To</label>';
        html += '<input type="text" data-provider="timepickr" data-time-basic="true" readonly="readonly" class="form-control" autocomplete="off" name="start_date_time[' + parseInt(parentIndex) + '][timeSlotTo][]" id="timeSlotTo'+nextId+'" onkeydown="event.preventDefault()">';
        html += '</div></div>';

        html += '<div class="col-md-3"><div class="cm-floating form-md-line-input">';
        html += '<label class="form-label">Please enter no of attendees</label>';
        html += '<input type="number" maxlength="3" class="form-control" autocomplete="off" name="start_date_time[' + parseInt(parentIndex) + '][attendees][]" id="attendees'+parseInt(nextId)+'" maxlength="3">';
        html += '<span class="help-block"></span></div></div>';

        html += '<div class="col-md-3 addTimeButton">';
        html += '<input type="button" name="Remove" value="Remove" class="btn btn-danger" onclick="removeTimeSlot(this,' + nextId + ',' + parentIndex + ')" id="timeSlotRemove' + nextId + '" />';
        html += '<input type="button" name="Add" value="Add" class="btn btn-primary" onclick="addTimeSlot(this,' + nextId + ',' + parentIndex + ')" id="timeSlotAdd' + nextId + '" />';
        html += '</div></div>';

        $('#dateTimeSlot' + parentIndex + ' #timeSlot' + id).after(html);
        
        $('#dateTimeSlot' + parentIndex + ' #timeSlotFrom' + nextId).flatpickr({
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
        });
        $('#dateTimeSlot' + parentIndex + ' #timeSlotTo' + nextId).flatpickr({
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
        });

        $('#dateTimeSlot' + parentIndex + ' #timeSlotFrom' + nextId).rules('add', { required: true });
        $('#dateTimeSlot' + parentIndex + ' #timeSlotTo' + nextId).rules('add', {
            required: true,
            TimeValid: [parentIndex, nextId]
        });
        $('#dateTimeSlot' + parentIndex + ' #attendees' + nextId).rules('add', {
            required: true,
            number: true,
            maxlength: 3,
            noSpace: true,
            zero_not_allow:true
        });
        $('#dateTimeSlot' + parentIndex + " #timeSlotAdd" + id).remove();
    }
}

function removeTimeSlot(event, id, parentIndex) {
    let current = document.querySelector('#' + event.id);
    let nextSibling = document.querySelector('#' + $('#' + event.id).parent().parent().next().attr('id'));
    let prevSibling = document.querySelector('#' + $('#' + event.id).parent().parent().prev().attr('id'));
    
    if (nextSibling === null) {
        let dataIndex = parseInt($(prevSibling).data('index'))
        $("#dateTimeSlot" + parentIndex + ' #timeSlot' + dataIndex + ' .addTimeButton').append('<input type="button" name="Add" value="Add" class="btn btn-primary" onclick="addTimeSlot(this,' + dataIndex + ',' + parentIndex + ')" id="timeSlotAdd' + dataIndex + '">')
    }

    if ($("#dateTimeSlot" + parentIndex + " #timeSlot" + parseInt(id)).length != 0) {
        $("#dateTimeSlot" + parentIndex + " #timeSlot" + parseInt(id)).remove();
    }
}