@extends('powerpanel.layouts.app')
@section('title')
{{Config::get('Constant.SITE_NAME')}} - PowerPanel
@endsection
@section('css')
<!-- <link href="{{ $CDN_PATH.'resources/global/plugins/datatables/datatables.min.css' }}" rel="stylesheet" type="text/css" />
<link href="{{ $CDN_PATH.'resources/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css' }}" rel="stylesheet" type="text/css"/>
<link href="{{ $CDN_PATH.'resources/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css' }}" rel="stylesheet" type="text/css" />
<link href="{{ $CDN_PATH.'resources/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css' }}" rel="stylesheet" type="text/css" />
<link href="{{ $CDN_PATH.'resources/global/plugins/fancybox/source/helpers/jquery.fancybox-thumbs.css' }}" rel="stylesheet" type="text/css"/> -->
<link href="{{ $CDN_PATH.'resources/global/plugins/highslide/highslide.css' }}" rel="stylesheet" type="text/css" />
<!-- <link href="{{ $CDN_PATH.'resources/global/plugins/tooltips/tooltip.css' }}" rel="stylesheet" type="text/css"/> -->
<!-- <style>
    .fancybox-wrap{width:50% !important;text-align:center}
    .fancybox-inner{width:100% !important;vertical-align:middle ;height:auto !important}
</style> -->
@endsection
@section('content')
<!--@include('powerpanel.partials.breadcrumbs')-->
{!! csrf_field() !!}
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header border-0">
                <div class="d-flex align-items-center">
                    <h5 class="card-title mb-0 flex-grow-1"></h5>
                    <div class="flex-shrink-0">
                        @can('decision-create')
                            @if( isset(App\Helpers\MyLibrary::getFront_Uri('decision')['uri']) )
                            <a class="btn btn-light bg-gradient waves-effect waves-light btn-label" href="{{ url('powerpanel/decision/add') }}">
                                <div class="d-flex">
                                    <div class="flex-shrink-0">
                                        <i class="ri-add-line label-icon align-middle fs-20 me-2"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        {{ trans('decision::template.decisionModule.addDecision') }}
                                    </div>
                                </div>
                            </a>
                            @endif
                        @endcan
                    </div>
                </div>
            </div><!-- end card header -->

            <div class="card-body border border-dashed border-end-0 border-start-0">
                <div class="row g-3">
                    <div class="col-lg-2 col-sm-4">
                        <div class="search-box">
                            <input type="search" class="form-control search" placeholder="Search by Title" id="searchfilter">
                            <i class="ri-search-line search-icon"></i>
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-4" id="hidefilter">
                        <select class="form-control" id="statusfilter" data-choices data-choices-search-false>
                            <option value="">{!! trans('decision::template.common.selectstatus') !!}</option>
                            <option value="Y">{!! trans('decision::template.common.publish') !!}</option>
                            <option value="N">{!! trans('decision::template.common.unpublish') !!}</option>
                        </select>
                    </div>

                    @if(!empty($userIsAdmin))
                        <div class="col-lg-2 col-sm-4">
                            <select id="sectorfilter" class="form-control" data-choices>
                                <option value="">{{ trans('Select Sector') }}</option>
                                @if(!empty($sectorList))
                                    @foreach($sectorList as $key => $ValueSector)
                                        <option value="{{$key}}">{{$ValueSector}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    @endif

                    <div class="col-lg-2 col-sm-4" id="hidefilter">
                        @if(isset($categories))
                        {!! $categories !!}
                        @endif
                    </div>

                    <div class="col-lg-1 col-sm-2">
                        <button type="button" class="btn btn-light waves-effect waves-light btn-light btn-label" title="Reset" id="refresh">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <i class="ri-refresh-line label-icon align-middle fs-20 me-2"></i>
                                </div>
                                <div class="flex-grow-1">
                                    Reset
                                </div>
                            </div>
                        </button>
                    </div>
                </div><!--end row-->
            </div><!-- end card body -->

            @if($iTotalRecords > 0)
                <div class="card-body">
                    <div class="live-preview">
                        @if(Session::has('message'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ Session::get('message') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                        
                        @if (File::exists(base_path() . '/resources/views/powerpanel/partials/tabpanel.blade.php') != null)
                        @include('powerpanel.partials.tabpanel',['tabarray'=>['favoriteTotalRecords','draftTotalRecords','trashTotalRecords']])
                        @endif
                        @php
                        $tablearray = [
                            'DataTableTab'=>[
                                'ColumnSetting'=>[
                                    ['Identity_Name'=>'title','TabIndex'=>'2','Name'=>'Title'],
                                    ['Identity_Name'=>'decision_date','TabIndex'=>'3','Name'=>'DecisionDate'],
                                    ['Identity_Name'=>'cat','TabIndex'=>'4','Name'=>'Category'],
                                    ['Identity_Name'=>'publish','TabIndex'=>'5','Name'=>'Publish'],
                                    ['Identity_Name'=>'dactions','TabIndex'=>'6','Name'=>'Action']
                                ],
                                'DataTableHead'=>[
                                    ['Title'=>'Title','Align'=>'left'],
                                    ['Title'=>'DecisionDate','Align'=>'left'],
                                    ['Title'=>'Category','Align'=>'left'],
                                    ['Title'=>'Publish','Align'=>'left'],
                                    ['Title'=>'Action','Align'=>'right']
                                ]
                            ]
                        ];
                        @endphp
                        @include('powerpanel.partials.datatable-view',['ModuleName'=>'Decision','Permission_Delete'=>'decision-delete','tablearray'=>$tablearray,'userIsAdmin'=>$userIsAdmin,'Module_ID'=>Config::get('Constant.MODULE.ID')])
                    </div>
                </div><!-- end card-body -->
                <!-- Modal -->
                @if (File::exists(base_path() . '/resources/views/powerpanel/partials/quickeditpopup.blade.php') != null)
                @include('powerpanel.partials.quickeditpopup',['TableName'=>'decision'])
                @endif
                @else
                @if (File::exists(base_path() . '/resources/views/powerpanel/partials/addrecordsection.blade.php') != null)
                @include('powerpanel.partials.addrecordsection',['type'=>Config::get('Constant.MODULE.TITLE'), 'adUrl' => url('powerpanel/decision/add')])
                @endif
            @endif
        </div><!-- end card -->
    </div>
</div>
  @if (File::exists(base_path() . '/resources/views/powerpanel/partials/deletePopup.blade.php') != null)
    @include('powerpanel.partials.deletePopup')
    @endif
    @if (File::exists(base_path() . '/resources/views/powerpanel/partials/onepushmodal.blade.php') != null)
    @include('powerpanel.partials.onepushmodal',['moduleHasImage'=>false])
    @endif
    @if (File::exists(base_path() . '/resources/views/powerpanel/partials/approveRecord.blade.php') != null)
    @include('powerpanel.partials.approveRecord')
    @endif
    @if (File::exists(base_path() . '/resources/views/powerpanel/partials/cmsPageComments.blade.php') != null)
    @include('powerpanel.partials.cmsPageComments',['module'=>Config::get('Constant.MODULE.TITLE')])
    @endif
@endsection
@section('scripts')
<script type="text/javascript">
    window.site_url = '{!! url("/") !!}';
    var DELETE_URL = '{!! url("/powerpanel/decision/DeleteRecord") !!}';
    var onePushShare = '{!! url("/powerpanel/share") !!}';
    var onePushGetRec = '{!! url("/powerpanel/share/getrec") !!}';
    var APPROVE_URL = '{!! url("/powerpanel/decision/ApprovedData_Listing") !!}';
    var rollbackRoute = window.site_url + "/powerpanel/decision/rollback-record";
    var getChildData = window.site_url + "/powerpanel/decision/getChildData";
    var getChildData_rollback = window.site_url + "/powerpanel/decision/getChildData_rollback";
    var ApprovedData_Listing = window.site_url + "/powerpanel/decision/ApprovedData_Listing";
    var Get_Comments = window.site_url + "/powerpanel/decision/Get_Comments";
    var Quick_module_id = '<?php echo Config::get('Constant.MODULE.ID'); ?>';
    var settingarray = jQuery.parseJSON('{!!$settingarray!!}');
    var showChecker = true;
    @if (!$userIsAdmin)
    showChecker = false;
    @endif
</script>
<script src="{{ $CDN_PATH.'resources/global/plugins/jquery-cookie-master/src/jquery.cookie.js' }}" type="text/javascript"></script>
<script src="{{ $CDN_PATH.'resources/global/scripts/datatable.js' }}" type="text/javascript"></script>
<script src="{{ $CDN_PATH.'resources/global/plugins/datatables/datatables.min.js' }}" type="text/javascript"></script>
<script src="{{ $CDN_PATH.'resources/global/plugins/datatables/dataTables.editor.js' }}" type="text/javascript"></script>
<script src="{{ $CDN_PATH.'resources/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js' }}" type="text/javascript"></script>
<script src="{{ $CDN_PATH.'resources/pages/scripts/packages/decision/decision-datatables-ajax.js' }}" type="text/javascript"></script>
<script src="{{ $CDN_PATH.'resources/pages/scripts/custom.js' }}" type="text/javascript"></script>
<script src="{{ $CDN_PATH.'resources/pages/scripts/sharer-validations.js' }}" type="text/javascript"></script>
<!-- <script src="{{ $CDN_PATH.'resources/global/plugins/fancybox/source/helpers/jquery.fancybox-thumbs.js' }}" type="text/javascript"></script>
<script src="{{ $CDN_PATH.'resources/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js' }}" type="text/javascript"></script> -->
 <script src="{{ $CDN_PATH.'resources/global/plugins/highslide/highslide-with-html.js' }}" type="text/javascript"></script>
 @if((File::exists(app_path() . '/Workflow.php') != null || File::exists(base_path() . '/packages/Powerpanel/Workflow/src/Models/Workflow.php') != null))
<script src="{{ $CDN_PATH.'resources/pages/scripts/user-updates-approval.js' }}" type="text/javascript"></script>
@endif
<!-- <script type="text/javascript">
    $('.fancybox-buttons').fancybox({
        autoWidth: true,
        autoHeight: true,
        autoResize: true,
        autoCenter: true,
        closeBtn: true,
        openEffect: 'elastic',
        closeEffect: 'elastic',
        helpers: {
            title: {
                type: 'inside',
                position: 'top'
            }
        },
        beforeShow: function () {
            this.title = $(this.element).data("title");
        }
    });
    $(".fancybox-thumb").fancybox({
        prevEffect: 'none',
        nextEffect: 'none',
        helpers:
        {
            title: {
                type: 'outside'
            },
            thumbs: {
                width: 60,
                height: 50
            }
        }
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#statusfilter').select2({
            placeholder: "Select status"
        });
    });
	$(document).ready(function () {
        var today = moment.tz("{{Config::get('Constant.DEFAULT_TIME_ZONE')}}").format(DEFAULT_DT_FORMAT);
        $('#start_date').datepicker({
            autoclose: true,
            //startDate: today,
            minuteStep: 5,
            format: DEFAULT_DT_FMT_FOR_DATEPICKER
        }).on("changeDate", function (e) {
            $("#start_date").closest('.has-error').removeClass('has-error');
            $("#app_post_date-error").remove();
            $('#end_date').val('');
            var endingdate = $(this).val();
            var date = new Date(endingdate);
            var enddate = new Date(date.getFullYear(), date.getMonth(), date.getDate() + 1);
            $('#end_date').datepicker('remove');
            $('#end_date').datepicker({
                autoclose: true,
                startDate: enddate,
                minuteStep: 5,
                format: DEFAULT_DT_FMT_FOR_DATEPICKER
            });
        });
        var endingdate = $('#start_date').val();
        var date = new Date(endingdate);
        var enddate = new Date(date.getFullYear(), date.getMonth(), date.getDate() + 1);
        $('#end_date').datepicker({
            autoclose: true,
            startDate: enddate,
            minuteStep: 5,
            format: DEFAULT_DT_FMT_FOR_DATEPICKER
        });
	});
</script> -->
<script src="{{ $CDN_PATH.'resources/global/plugins/moment.min.js' }}"></script>
<script src="{{ $CDN_PATH.'resources/global/plugins/moments-timezone.js' }}"></script>
@endsection
