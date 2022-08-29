@extends('powerpanel.layouts.app')
@section('title')
{{Config::get('Constant.SITE_NAME')}} - PowerPanel
@endsection
@section('css')
<!-- <link href="{{ $CDN_PATH.'resources/global/plugins/datatables/datatables.min.css' }}" rel="stylesheet" type="text/css" />
<link href="{{ $CDN_PATH.'resources/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css' }}" rel="stylesheet" type="text/css" /> -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<link href="{{ $CDN_PATH.'resources/global/plugins/highslide/highslide.css' }}" rel="stylesheet" type="text/css" />
<!-- <style>
.fancybox-wrap{width:50% !important;text-align:center}
.fancybox-inner{width:100% !important;vertical-align:middle ;height:auto !important}
</style> -->
@endsection
@section('content')
<!--@include('powerpanel.partials.breadcrumbs')-->
<!-- BEGIN PAGE BASE CONTENT -->
{!! csrf_field() !!}
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header border-0">
                <div class="d-flex align-items-center">
                    <h5 class="card-title mb-0 flex-grow-1"></h5>
                    <div class="flex-shrink-0">
                        @can('organizations-create')
                            <a class="btn btn-light bg-gradient waves-effect waves-light btn-label" href="{{ url('powerpanel/organizations/add') }}">
                                <div class="d-flex">
                                    <div class="flex-shrink-0">
                                        <i class="ri-add-line label-icon align-middle fs-20 me-2"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        {{ trans('organizations::template.organizationsModule.addOrganization') }}
                                    </div>
                                </div>
                            </a>
                        @endcan
                    </div>
                </div>
            </div><!-- end card header -->

            <div class="card-body border border-dashed border-end-0 border-start-0">
                <div class="row g-3">
                    <div class="col-lg-2 col-sm-4">
                        <div class="search-box">
                            <input type="search" class="form-control search" placeholder="Search by Name" id="searchfilter">
                            <i class="ri-search-line search-icon"></i>
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-4" id="hidefilter">
                        <select class="form-control" id="statusfilter" data-choices data-choices-search-false>
                            <option value="">{!! trans('organizations::template.common.selectstatus') !!}</option>
                            <option value="Y">{!! trans('organizations::template.common.publish') !!}</option>
                            <option value="N">{!! trans('organizations::template.common.unpublish') !!}</option>
                        </select>
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
                        @include('powerpanel.partials.tabpanel',['tabarray'=>['']])
                        @endif
                        @php
                        $tablearray = [
                            'DataTableTab'=>[
                                'ColumnSetting'=>[
                                    ['Identity_Name'=>'name','TabIndex'=>'2','Name'=>'Name'],
                                    ['Identity_Name'=>'designation','TabIndex'=>'3','Name'=>'Designation'],
                                    ['Identity_Name'=>'porganization','TabIndex'=>'4','Name'=>'Parent Organization'],
                                    ['Identity_Name'=>'order','TabIndex'=>'5','Name'=>'Order'],
                                    ['Identity_Name'=>'publish','TabIndex'=>'6','Name'=>'Publish'],
                                    ['Identity_Name'=>'dactions','TabIndex'=>'7','Name'=>'Action']
                                ],
                                'DataTableHead'=>[
                                    ['Title'=>'Name','Align'=>'left'],
                                    ['Title'=>'Designation','Align'=>'left'],
                                    ['Title'=>'Parent Organization','Align'=>'left'],
                                    ['Title'=>'Order','Align'=>'left'],
                                    ['Title'=>'Publish','Align'=>'left'],
                                    ['Title'=>'Action','Align'=>'right']
                                ]
                            ]
                        ];
                        @endphp
                        @include('powerpanel.partials.datatable-view',['ModuleName'=>'Organizations','Permission_Delete'=>'organizations-delete','tablearray'=>$tablearray,'userIsAdmin'=>$userIsAdmin,'Module_ID'=>Config::get('Constant.MODULE.ID')])
                    </div>
                </div><!-- end card-body -->
                <!-- Modal -->
                @else
                @if (File::exists(base_path() . '/resources/views/powerpanel/partials/addrecordsection.blade.php') != null)
                @include('powerpanel.partials.addrecordsection',['type'=>Config::get('Constant.MODULE.TITLE'), 'adUrl' => url('powerpanel/organizations/add')])
                @endif
            @endif
        </div><!-- end card -->
    </div>
</div>
@if (File::exists(base_path() . '/resources/views/powerpanel/partials/deletePopup.blade.php') != null)
@include('powerpanel.partials.deletePopup')
@endif
@if (File::exists(base_path() . '/resources/views/powerpanel/partials/moveto.blade.php') != null)
@include('powerpanel.partials.moveto')
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
	window.site_url =  '{!! url("/") !!}';
	var DELETE_URL =  '{!! url("/powerpanel/organizations/DeleteRecord") !!}';
	var APPROVE_URL = '{!! url("/powerpanel/organizations/ApprovedData_Listing") !!}';
	var getChildData = window.site_url + "/powerpanel/organizations/getChildData";
	var getChildData_rollback = window.site_url +"/powerpanel/organizations/getChildData_rollback";
	var ApprovedData_Listing = window.site_url +"/powerpanel/organizations/ApprovedData_Listing";
    var rollbackRoute = window.site_url + "/powerpanel/organizations/rollback-record";
	var Get_Comments = window.site_url + "/powerpanel/organizations/Get_Comments";
    var Quick_module_id = '<?php echo Config::get('Constant.MODULE.ID'); ?>';
    var showChecker = true;
	@if(!$userIsAdmin)
	showChecker = false;
	@endif
    var settingarray = jQuery.parseJSON('{!!$settingarray!!}');
	var orgnizationsData = jQuery.parseJSON('{!!$orgdata!!}');
</script>
<script src="{{ $CDN_PATH.'resources/global/plugins/jquery-cookie-master/src/jquery.cookie.js' }}" type="text/javascript"></script>
<script src="{{ $CDN_PATH.'resources/global/scripts/datatable.js' }}" type="text/javascript"></script>
<script src="{{ $CDN_PATH.'resources/global/plugins/datatables/datatables.min.js' }}" type="text/javascript"></script>
<script src="{{ $CDN_PATH.'resources/global/plugins/datatables/dataTables.editor.js' }}" type="text/javascript"></script>
<script src="{{ $CDN_PATH.'resources/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js' }}" type="text/javascript"></script>
<script src="{{ $CDN_PATH.'resources/pages/scripts/custom.js' }}" type="text/javascript"></script>
<script src="{{ $CDN_PATH.'resources/pages/scripts/packages/organizations/organizations-datatables-ajax.js' }}" type="text/javascript"></script>
<script src="{{ $CDN_PATH.'resources/pages/scripts/user-updates-approval.js' }}" type="text/javascript"></script>
@if((File::exists(app_path() . '/Workflow.php') != null || File::exists(base_path() . '/packages/Powerpanel/Workflow/src/Models/Workflow.php') != null))
<script src="{{ $CDN_PATH.'resources/pages/scripts/user-updates-approval-category.js' }}" type="text/javascript"></script>
@endif
<script type="text/javascript">
	// $('.fancybox-buttons').fancybox({
	// 	autoWidth: true,
	// 	autoHeight: true,
	// 	autoResize: true,
	// 	autoCenter: true,
	// 	closeBtn: true,
	// 	openEffect: 'elastic',
	// 	closeEffect: 'elastic',
	// 	helpers: {
	// 		title: {
	// 			type: 'inside',
	// 			position: 'top'
	// 		}
	// 	},
	// 	beforeShow: function() {
	// 		this.title = $(this.element).data("title");
    //         this.width = $('.fancybox-iframe').contents().find('html').width();
    //         this.height = $('.fancybox-iframe').contents().find('html').height();
	// 	}
	// });
    $(document).on('click', '.share', function (e) {
        e.preventDefault();
        $('.new_share_popup').modal('show');
        $('#confirm_share').modal({backdrop: 'static', keyboard: false})
        .one('click', '#share', function () {
            deleteItem(url, alias);
        });
    });
</script>
@endsection