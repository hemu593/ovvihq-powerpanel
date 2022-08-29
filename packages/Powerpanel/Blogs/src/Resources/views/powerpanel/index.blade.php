@extends('powerpanel.layouts.app')
    @section('title')
        {{Config::get('Constant.SITE_NAME')}} - PowerPanel
    @endsection
    @section('css')
        <link href="{{ $CDN_PATH.'resources/global/plugins/highslide/highslide.css' }}" rel="stylesheet" type="text/css"/>
    @endsection
@section('content')

<!-- BEGIN PAGE BASE CONTENT -->
<div class="row">
    <div class="col-xl-12">
        @if(Session::has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ Session::get('message') }}
        </div>
        @endif
        @if(Session::has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ Session::get('error') }}
        </div>
        @endif
        <div class="card">
        	@if($iTotalRecords > 0)

                <div class="card-header cmpage-topheader border border-dashed border-end-0 border-start-0 border-top-0">
                    <div class="d-xl-flex flex-wrap align-items-center">

                        <div class="flex-shrink-0 addpage-btn order-sm-2">
                            @can('blogs-create')
                                <a class="btn btn-light btn-theme bg-gradient waves-effect waves-light btn-label" href="{{ url('powerpanel/blogs/add') }}">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0">
                                            <i class="ri-add-line label-icon align-middle fs-20 me-2"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            {{ trans('blogs::template.blogsModule.add') }}
                                        </div>
                                    </div>
                                </a>
                            @endcan
                        </div>

                        <div class="cm-filter flex-grow-1 order-sm-1 d-flex align-items-center">
                            @if (File::exists(base_path() . '/resources/views/powerpanel/partials/tabpanel.blade.php') != null)
                                @include('powerpanel.partials.tabpanel',['tabarray'=>['favoriteTotalRecords','draftTotalRecords','trashTotalRecords','approvalTotalRecords']])
                            @endif
                            <div class="btn-group d-inline-block filter-dropdown">
                                <button type="button" class="btn fs-14 fw-medium p-0 border-0 filter-btn" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ri-filter-line fs-21"></i></button>
                                <div class="dropdown-menu">
                                    <div class="p-3 dropdown-body">
                                        <div class="mb-3" id="hidefilter">
                                            <select class="form-select" id="statusfilter">
                                                <option value="">{!! trans('blogs::template.common.selectstatus') !!}</option>
                                                <option value="Y">{!! trans('blogs::template.common.publish') !!}</option>
                                                <option value="N">{!! trans('blogs::template.common.unpublish') !!}</option>
                                            </select>
                                        </div>
                                        @if($userIsAdmin)
                                            <div class="mb-3">
                                                <select class="form-select" id="sectorfilter">
                                                    <option value="">{{ trans('Select Sector') }}</option>
                                                    @if(!empty($sectorList))
                                                        @foreach($sectorList as $key =>  $ValueSector)
                                                            <option value="{{ $key }}">{{ $ValueSector }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        @endif
                                        <div class="mb-3">
                                            <select class="form-select" id="category" name="category">
                                                <option value="">Select Category</option>
                                                @if(!empty($blogCategory))
                                                    @foreach ($blogCategory as $cat)
                                                        @php $permissionName = 'faq-list' @endphp
                                                        @php $selected = ''; @endphp
                                                        @if(isset($blog->intFKCategory))
                                                            @if($cat['id'] == $blog->intFKCategory)
                                                                @php $selected = 'selected'; @endphp
                                                            @endif
                                                        @endif
                                                        <option value="{{ $cat['id'] }}" {{ $selected }} >{{ $cat['varModuleName']== "managementteam"?'Select Category':$cat['varTitle'] }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>

                                        <div class="reset-btn">
                                            <button type="button" class="btn btn-light bg-gradient waves-effect waves-light btn-light btn-label" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Reset" id="refresh">
                                                <div class="d-flex">
                                                    <div class="flex-shrink-0">
                                                        <i class="ri-refresh-line label-icon align-middle fs-18 me-2"></i>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        Reset
                                                    </div>
                                                </div>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="filter-search d-inline-block">
                                <input type="search" class="form-control search" placeholder="Search by Title" id="searchfilter">
                                <span class="iconsearch cursor-pointer"><i class="ri-search-2-line fs-21"></i></span>
                            </div>
                        </div>

                    </div>
                </div><!-- end card header -->

                <div class="card-body">
                    <div class="live-preview">
                        <div class="table-responsive">
                            @php
                            $tablearray = [
                                'DataTableTab'=>[
                                    'ColumnSetting'=>[
                                        ['Identity_Name'=>'title','TabIndex'=>'1','Name'=>'Title'],
                                        ['Identity_Name'=>'sdate','TabIndex'=>'2','Name'=>'Start Date'],
                                        ['Identity_Name'=>'publish','TabIndex'=>'3','Name'=>'Publish'],
                                        ['Identity_Name'=>'dactions','TabIndex'=>'4','Name'=>'Action']
                                    ],
                                    'DataTableHead'=>[
                                        ['Title'=>'Title','Align'=>'left'],
                                        ['Title'=>'Start Date','Align'=>'left'],
                                        ['Title'=>'Publish','Align'=>'left'],
                                        ['Title'=>'Action','Align'=>'right']
                                    ]
                                ]
                            ];
                            @endphp
                            @include('powerpanel.partials.datatable-view',['ModuleName'=>'Blogs','Permission_Delete'=>'blogs-delete','tablearray'=>$tablearray,'userIsAdmin'=>$userIsAdmin,'Module_ID'=>Config::get('Constant.MODULE.ID')])
                        </div>
                    </div>
                </div><!-- end card-body -->

                <!-- Modal -->
                @if (File::exists(base_path() . '/resources/views/powerpanel/partials/quickeditpopup.blade.php') != null)
                @include('powerpanel.partials.quickeditpopup',['TableName'=>'blogs'])
                @endif
                @else
                @if (File::exists(base_path() . '/resources/views/powerpanel/partials/addrecordsection.blade.php') != null)
                @include('powerpanel.partials.addrecordsection',['type'=>Config::get('Constant.MODULE.TITLE'), 'adUrl' => url('powerpanel/blogs/add')])
                @endif
            @endif

        </div><!-- end card -->
    </div>
    <!-- end col -->
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
    var DELETE_URL = '{!! url("powerpanel/blogs/DeleteRecord") !!}';
    var APPROVE_URL = '{!! url("/powerpanel/blogs/ApprovedData_Listing") !!}';
    var getChildData = window.site_url + "/powerpanel/blogs/getChildData";
    var getChildData_rollback = window.site_url + "/powerpanel/blogs/getChildData_rollback";
    var ApprovedData_Listing = window.site_url + "/powerpanel/blogs/ApprovedData_Listing";
    var rollbackRoute = window.site_url + "/powerpanel/blogs/rollback-record";
    var Get_Comments = '{!! url("/powerpanel/blogs/Get_Comments") !!}';
    var Quick_module_id = "@php echo Config::get('Constant.MODULE.ID'); @endphp";
    var settingarray = jQuery.parseJSON('{!!$settingarray!!}');
    var showChecker = true;
    @if (!$userIsAdmin)
    showChecker = false;
    @endif
    var onePushShare = '{!! url("/powerpanel/share") !!}';
    var onePushGetRec = '{!! url("/powerpanel/share/getrec") !!}';
</script>

<script src="{{ $CDN_PATH.'resources/global/plugins/jquery-cookie-master/src/jquery.cookie.js' }}" type="text/javascript"></script>
<script src="{{ $CDN_PATH.'resources/global/scripts/datatable.js' }}" type="text/javascript"></script>
<script src="{{ $CDN_PATH.'resources/global/plugins/datatables/datatables.min.js' }}" type="text/javascript"></script>
<script src="{{ $CDN_PATH.'resources/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js' }}" type="text/javascript"></script>
<script src="{{ $CDN_PATH.'resources/pages/scripts/packages/blogs/blogs-datatables-ajax.js?v='.time() }}" type="text/javascript"></script>
@if((File::exists(app_path() . '/Workflow.php') != null || File::exists(base_path() . '/packages/Powerpanel/Workflow/src/Models/Workflow.php') != null))
    <script src="{{ $CDN_PATH.'resources/pages/scripts/user-updates-approval.js' }}" type="text/javascript"></script>
@endif
<script src="{{ $CDN_PATH.'resources/pages/scripts/custom.js' }}" type="text/javascript"></script>
<script src="{{ $CDN_PATH.'resources/pages/scripts/sharer-validations.js' }}" type="text/javascript"></script>


@if(Auth::user()->hasRole('user_account'))
<script type="text/javascript">
    $(document).ready(function () {
        setInterval(function () {
            $('.checker').closest("td").hide();
            $('.checker').closest("th").hide();
        }, 800);
    });
    var moduleName = 'blogs';</script>
@endif

@endsection