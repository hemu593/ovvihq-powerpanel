var gridRows = 0;
var grid = '';
var TableDatatablesAjax = function () {
    var initPickers = function () {
        //init date pickers
        $('.date-picker').datepicker({
            rtl: App.isRTL(),
            autoclose: true
        });
    }
    var handleRecords = function () {
        grid = new Datatable();
        grid.init({
            src: $("#datatable_ajax"),
            onSuccess: function (grid, response) {
                gridRows = response.recordsTotal;
                if (response.recordsTotal < 1) {
                    $('.deleteMass').hide();
                } else {
                    $('.deleteMass').show();
                }

                if (response.newRecordCount > 0) {
                    $('.newcounter').text(response.newRecordCount).show();
                } else {
                    $('.newcounter').hide();
                }

                // grid:        grid object
                // response:    json object of server side ajax response
                // execute some code after table records loaded
            },
            onError: function (grid) {
                // execute some code on network or other general error
            },
            onDataLoad: function (grid) {
                // execute some code on ajax data load
                $('.make-switch').bootstrapSwitch();
            },
            loadingMessage: 'Loading...',
            dataTable: {// here you can define a typical datatable settings from http://datatables.net/usage/options
                // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
                // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/scripts/datatable.js).
                // So when dropdowns used the scrollable div should be removed.
                //"dom": "<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'<'table-group-actions pull-right'>>r>t<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'>>",
                "deferRender": true,
                "stateSave": true, // save datatable state(pagination, sort, etc) in cookie.
                "lengthMenu": [
                    [10, 20, 50, 100],
                    [10, 20, 50, 100] // change per page values here
                ],
                "pageLength": 100, // default record count per page
                //Code for sorting
                "serverSide": true,
                "columns": [{
                        "data": 0,
                        "bSortable": false
                    }, {
                        "data": 1,
                        className: 'text-left mob-show_div',
                        "name": 'varTitle',
                        "bSortable": true
                    },
                    {
                        "data": 2,
                        className: 'text-center',
                        "name": 'intDisplayOrder'
                    }, {
                        "data": 3,
                        className: 'text-center',
                        "name": 'intDisplayOrder'
                    }, {
                        "data": 4,
                        className: 'text-center publish_switch',
                        "bSortable": false
                    }, {
                        "data": 5,
                        className: 'text-right last_td_action mob-show_div',
                        "bSortable": false
                    }, {
                        "data": 6,
                        className: 'text-center',
                        "bSortable": false
                    }],
                "columnDefs": [{
                        "targets": [6],
                        "visible": false,
                        "searchable": false
                    }],
                "ajax": {
                    "url": window.site_url + "/powerpanel/onlinepollingcategory/get_list", // ajax source
                },
                'fnCreatedRow': function (nRow, aData, iDataIndex) {
                    $(nRow).attr('data-order', aData[6]);
                },
                "order": [
                    [3, "asc"]
                ]
            }
        });
        $('#datatable_ajax tbody').on('click', '.moveDwn', function () {
            var order = $(this).data('order');
            exOrder = order + 1;
            reorder(order, exOrder);
        });
        $('#datatable_ajax tbody').on('click', '.moveUp', function () {
            var order = $(this).data('order');
            exOrder = order - 1;
            reorder(order, exOrder);
        });
        $(document).on('keyup', '#searchfilter', function (e) {
            e.preventDefault();
            var action = $('#searchfilter').val();
            if (action.length >= 2) {
                $.cookie('onlinepollingcategorysearch', action);
                grid.setAjaxParam("customActionType", "group_action");
                grid.setAjaxParam("searchValue", action);
                grid.setAjaxParam("id", grid.getSelectedRows());
                grid.getDataTable().ajax.reload();
            } else {
                $.removeCookie('onlinepollingcategorysearch');
                grid.setAjaxParam("customActionType", "group_action");
                grid.setAjaxParam("searchValue", action);
                grid.setAjaxParam("id", grid.getSelectedRows());
                grid.getDataTable().ajax.reload();
            }
        });
        $(document).on('change', '#statusfilter', function (e) {

            e.preventDefault();
            var action = $('#statusfilter').val();
            if (action != " ") {
                //$.cookie('ServiceCategoryStatus',action);
            } else {
                //$.removeCookie('ServiceCategoryStatus');
            }
            if (action != "") {
                grid.setAjaxParam("customActionType", "group_action");
                grid.setAjaxParam("statusValue", action);
                grid.setAjaxParam("id", grid.getSelectedRows());
                grid.getDataTable().ajax.reload();
            } else {
                grid.setAjaxParam("customActionType", "group_action");
                grid.setAjaxParam("statusValue", action);
                grid.setAjaxParam("id", grid.getSelectedRows());
            }
        });
        $(document).on("switchChange.bootstrapSwitch", ".publish", function (event, state) {
            //e.preventDefault();
            var controller = $(this).data('controller');
            var alias = $(this).data('alias');
            var val = $(this).data('value');
            var url = site_url + '/' + controller + '/publish';
            $.ajax({
                url: url,
                data: {
                    alias: alias,
                    val: val
                },
                type: "POST",
                dataType: "HTML",
                success: function (data) {
                    grid.getDataTable().ajax.reload(null, false);
                },
                error: function () {
                    console.log('error!');
                }
            });
        });

        if (!showChecker) {
            grid.getDataTable().column(3).visible(false);
            grid.getDataTable().column(4).visible(false);
        } else {
            if ($.cookie('OnlinePollingCategory_publish_P_3') == 'Y') {
                grid.getDataTable().column(3).visible(true);
            }
            if ($.cookie('OnlinePollingCategory_publish_P_4') == 'Y') {
                grid.getDataTable().column(4).visible(true);
            }
        }

        $(document).on("click", '#grpChkBox .checkbox_P', function () {
            if ($(this).prop("checked") == true) {
                var datatable_P = $(this).attr("name").split("_");
                grid.getDataTable().column(datatable_P[3]).visible(true);
                Cookies.set($(this).attr("name"), 'Y');
                grid.getDataTable().ajax.reload();
            } else {
                var datatable_P = $(this).attr("name").split("_");
                grid.getDataTable().column(datatable_P[3]).visible(false);
                Cookies.set($(this).attr("name"), 'N');
                grid.getDataTable().ajax.reload();
            }
        });

        grid.setAjaxParam("customActionType", "group_action");
        grid.clearAjaxParams();
        grid.getDataTable().columns().iterator('column', function (ctx, idx) {
            $(grid.getDataTable().column(idx).header()).append('<span class="sort-icon"/>');
        });
    }
    return {
        //main function to initiate the module
        init: function () {
            initPickers();
            handleRecords();
        }
    };
}();

var grid1Rows = 0;
var grid1 = '';
var TableDatatablesAjax1 = function () {
    var initPickers1 = function () {
        //init date pickers
        $('.date-picker').datepicker({
            rtl: App.isRTL(),
            autoclose: true
        });
    }
    var handleRecords1 = function () {
        grid1 = new Datatable();
        grid1.init({
            src: $("#datatable_ajax1"),
            onSuccess: function (grid1, response) {
                gridRows1 = response.recordsTotal;
                if (response.recordsTotal < 1) {
                    $('.deleteMass').hide();
                } else {
                    $('.deleteMass').show();
                }

                if (response.newRecordCount > 0) {
                    $('.newcounter').text(response.newRecordCount).show();
                } else {
                    $('.newcounter').hide();
                }

                // grid:        grid object
                // response:    json object of server side ajax response
                // execute some code after table records loaded
            },
            onError: function (grid1) {
                // execute some code on network or other general error
            },
            onDataLoad: function (grid1) {
                // execute some code on ajax data load
                $('.make-switch').bootstrapSwitch();
            },
            loadingMessage: 'Loading...',
            dataTable: {// here you can define a typical datatable settings from http://datatables.net/usage/options
                // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
                // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/scripts/datatable.js).
                // So when dropdowns used the scrollable div should be removed.
                //"dom": "<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'<'table-group-actions pull-right'>>r>t<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'>>",
                "deferRender": true,
                "stateSave": true, // save datatable state(pagination, sort, etc) in cookie.
                "lengthMenu": [
                    [10, 20, 50, 100],
                    [10, 20, 50, 100] // change per page values here
                ],
                "pageLength": 100, // default record count per page
                //Code for sorting
                "serverSide": true,
                "columns": [{
                        "data": 0,
                        "bSortable": true,
                        className: 'text-left mob-show_div',
                        "name": 'varTitle'
                    },
                    {
                        "data": 1,
                        className: 'text-center',
                        "name": 'intDisplayOrder'
                    }, {
                        "data": 2,
                        className: 'text-center publish_switch',
                        "bSortable": false
                    }, {
                        "data": 3,
                        className: 'text-right last_td_action mob-show_div',
                        "bSortable": false
                    }],
                "ajax": {
                    "url": window.site_url + "/powerpanel/onlinepollingcategory/get_list_New", // ajax source
                },
                'fnCreatedRow': function (nRow, aData, iDataIndex) {
                    $(nRow).attr('data-order', aData[4]);
                },
                "order": [
                    [1, "desc"]
                ]
            }
        });

        $(document).on('keyup', '#searchfilter', function (e) {
            e.preventDefault();
            var action = $('#searchfilter').val();
            if (action.length >= 2) {
                $.cookie('onlinepollingcategorysearch', action);
                grid1.setAjaxParam("customActionType", "group_action");
                grid1.setAjaxParam("searchValue", action);
                grid1.setAjaxParam("id", grid1.getSelectedRows());
                grid1.getDataTable().ajax.reload();
            } else {
                $.removeCookie('onlinepollingcategorysearch');
                grid1.setAjaxParam("customActionType", "group_action");
                grid1.setAjaxParam("searchValue", action);
                grid1.setAjaxParam("id", grid1.getSelectedRows());
                grid1.getDataTable().ajax.reload();
            }
        });
        $(document).on('change', '#statusfilter', function (e) {

            e.preventDefault();
            var action = $('#statusfilter').val();
            if (action != " ") {
                //$.cookie('ServiceCategoryStatus',action);
            } else {
                //$.removeCookie('ServiceCategoryStatus');
            }
            if (action != "") {
                grid1.setAjaxParam("customActionType", "group_action");
                grid1.setAjaxParam("statusValue", action);
                grid1.setAjaxParam("id", grid1.getSelectedRows());
                grid1.getDataTable().ajax.reload();
            } else {
                grid1.setAjaxParam("customActionType", "group_action");
                grid1.setAjaxParam("statusValue", action);
                grid1.setAjaxParam("id", grid1.getSelectedRows());
            }
        });
        $(document).on("switchChange.bootstrapSwitch", ".publish", function (event, state) {
            //e.preventDefault();
            var controller = $(this).data('controller');
            var alias = $(this).data('alias');
            var val = $(this).data('value');
            var url = site_url + '/' + controller + '/publish';
            $.ajax({
                url: url,
                data: {
                    alias: alias,
                    val: val
                },
                type: "POST",
                dataType: "HTML",
                success: function (data) {
                    grid1.getDataTable().ajax.reload(null, false);
                },
                error: function () {
                    console.log('error!');
                }
            });
        });

        $('a[data-toggle="tab"][id="MenuItem1"]').on('shown.bs.tab', function (e) {
            e.preventDefault();
            grid.setAjaxParam("id", grid.getSelectedRows());
            grid.getDataTable().ajax.reload();
        });
        $('a[data-toggle="tab"][id="MenuItem2"]').on('shown.bs.tab', function (e) {
            e.preventDefault();
            grid1.setAjaxParam("id", grid1.getSelectedRows());
            grid1.getDataTable().ajax.reload();
        });
        
        grid1.getDataTable().column(1).visible(false);

        $(document).on("click", '#AgrpChkBox .checkbox_A', function () {
            if ($(this).prop("checked") == true) {
                var datatable_A = $(this).attr("name").split("_");
                grid1.getDataTable().column(datatable_A[3]).visible(true);
                Cookies.set($(this).attr("name"), 'Y');
                grid1.getDataTable().ajax.reload();
            } else {
                var datatable_A = $(this).attr("name").split("_");
                grid1.getDataTable().column(datatable_A[3]).visible(false);
                Cookies.set($(this).attr("name"), 'N');
                grid1.getDataTable().ajax.reload();
            }
        });

        grid1.setAjaxParam("customActionType", "group_action");
        grid1.clearAjaxParams();
        grid1.getDataTable().columns().iterator('column', function (ctx, idx) {
            $(grid1.getDataTable().column(idx).header()).append('<span class="sort-icon"/>');
        });
    }
    return {
        //main function to initiate the module
        init: function () {
            initPickers1();
            handleRecords1();
        }
    };
}();


$(window).on('load', function () {
    if ($.cookie('onlinepollingcategorysearch')) {
        $('#searchfilter').val($.cookie('onlinepollingcategorysearch'));
        $('#searchfilter').trigger('keyup');
    }
});
jQuery(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-Token': $('input[name="_token"]').val()
        }
    });
    TableDatatablesAjax.init();
    if (!showChecker) {
        grid.getDataTable().column(0).visible(false);
    } else {
        grid.getDataTable().column(0).visible(true);
    }
});

$('a[data-toggle="tab"][id="MenuItem2"]').on('shown.bs.tab', function (e) {
    if (!$.fn.DataTable.isDataTable('#datatable_ajax1')) {
        TableDatatablesAjax1.init();
    }
});

function reorder(curOrder, excOrder) {
    var ajaxurl = site_url + '/powerpanel/onlinepollingcategory/reorder';
    $.ajax({
        url: ajaxurl,
        data: {
            order: curOrder,
            exOrder: excOrder
        },
        type: "POST",
        dataType: "HTML",
        success: function (data) {
        },
        complete: function () {
            grid.getDataTable().ajax.reload(null, false);
        },
        error: function () {
            console.log('error!');
        }
    });
}
function modelpopup(id, yes, no) {
    var ajaxurl = site_url + '/powerpanel/onlinepollingcategory/getonlinepollingdata';
    var data = '';
    $.ajax({
        url: ajaxurl,
        data: {
            id: id
        },
        type: "POST",
        dataType: "json",
        success: function (pollingdata) {
            chart = new CanvasJS.Chart('chartContainer_' + id + '', config);
            chart.options.data[0].dataPoints = pollingdata[0];
            chart.options.data[0].color = '#ff6384';
            chart.options.data[0].name = "Yes";
            chart.options.data[1].dataPoints = pollingdata[1];
            chart.options.data[1].name = "No";
            chart.options.data[1].color = '#36a2eb';
//            chart.axisX[1].remove();
            showDefaultText(chart, "No Online Polling Data Available.");
            chart.render();
            $('#desc_' + id).modal('show');
            $('a.canvasjs-chart-credit').remove();
        }
    });
}


function showDefaultText(chart, text) {

    var isEmpty = !(chart.options.data[0].dataPoints && chart.options.data[0].dataPoints.length > 0);

    if (!chart.options.subtitles)
        (chart.options.subtitles = []);

    if (isEmpty)
        chart.options.subtitles.push({
            text: text,
            verticalAlign: 'center',
        });
    else
        (chart.options.subtitles = []);
}