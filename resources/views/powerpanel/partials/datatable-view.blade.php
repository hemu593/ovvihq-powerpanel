<div class="tab-content text-muted">
		
    <!-- All Tab -->
    @if(isset($tablearray['DataTableTab']))
    @php
    $alltab = $tablearray['DataTableTab'];
    @endphp
    <div id="menu1" class="tab-pane fade in active show" role="tabpanel">
    		@include('powerpanel.partials.norecordlistsection')
        {{-- <!-- @if(Schema::hasTable('gridsetting'))
        <div class="dropdown pull-right gridsetting">
            <a class="dropdown-toggle" data-toggle="dropdown">
                <i class="icon-settings"></i>
            </a>
            <ul class="dropdown-menu" id="AllTab">
                @php
                foreach($alltab['ColumnSetting'] as $atab){
                    $style = '';
                    if(empty($userIsAdmin)){
                        if($atab['Name'] == 'Order' || $atab['Name'] == 'Publish'){
                            $style = 'style="display:block"';
                        }
                    }
                    $columndata = json_decode($settingarray);
                    $cid = $ModuleName.'_'.$atab['Identity_Name'].'_P_'.$atab['TabIndex'];
                    if(isset($columndata->P)){
                        if(in_array($cid,$columndata->P)){
                            $checked = '';
                        }else{
                            $checked = 'checked="checked"';
                        }
                    }else{
                        $checked = 'checked="checked"';
                    }
                @endphp
                <li {!! $style !!}>
                    <div class="md-checkbox" >
                        <input class="md-checkboxbtn checkbox_P tabclasssetting" type="checkbox" {{ $checked }} name="{{ $ModuleName }}_{{ $atab['Identity_Name'] }}_P_{{ $atab['TabIndex'] }}" id="{{ $ModuleName }}_{{ $atab['Identity_Name'] }}_P_{{ $atab['TabIndex'] }}" data-columnname="{{$atab['Name']}}" data-columnno="{{$atab['TabIndex']}}" data-tabid='P'>
                        <label for="{{ $ModuleName }}_{{ $atab['Identity_Name'] }}_P_{{ $atab['TabIndex'] }}">
                            <span></span>
                            <span class="check"></span>
                            <span class="box"></span>
                            {{ $atab['Name'] }}
                        </label>
                    </div>
                </li>
                @php
                }
                @endphp
            </ul>
        </div>
        @endif --> --}}
        <div class="withrecords">
        <table class="table table-hover align-middle table-nowrap hide-mobile" id="datatable_ajax">
            <thead class="table-light">
                <tr role="row">
                    <th align="center"><input type="checkbox" class="form-check-input multiSelectList"></th>
                    @foreach($alltab['DataTableHead'] as $adtab)
                        <th align="{{ $adtab['Align'] }}">{{ $adtab['Title'] }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody></tbody>
        </table>
        @if((Auth::user()->can($Permission_Delete) && $userIsAdmin) || (Auth::user()->can($Permission_Delete)))
            @if (Config::get('Constant.DEFAULT_TRASH') == 'Y')
                <button href="javascript:;" class="btn btn-danger waves-effect btn-label deleteMass hide-btn-mob" value="P">
                    <div class="d-flex">
                        <div class="flex-shrink-0">
                            <i class="ri-delete-bin-line label-icon align-middle fs-20 me-2"></i>
                        </div>
                        <div class="flex-grow-1">
                            {{ trans('template.common.delete') }}
                        </div>
                    </div>
                </button>
            @else
                <button href="javascript:;" class="btn btn-danger waves-effect btn-label deleteMass hide-btn-mob" value="T">
                    <div class="d-flex">
                        <div class="flex-shrink-0">
                            <i class="ri-delete-bin-line label-icon align-middle fs-20 me-2"></i>
                        </div>
                        <div class="flex-grow-1">
                            {{ trans('template.common.delete') }}
                        </div>
                    </div>
                </button>
            @endif
        @endif
        @php $moduleForExportBtn = ['ContactLead','formbuilderlead','ticketlist','newsletterlead','feedbacklead','errorLog','eventslead','LogManager'] @endphp
        @if(in_array($ModuleName,$moduleForExportBtn))
            <a href="#selectedRecords" class="btn btn-primary bg-gradient waves-effect waves-light btn-label ExportRecord ms-1" data-bs-toggle="modal">
                <div class="d-flex">
                    <div class="flex-shrink-0">
                        <i class="ri-share-box-line label-icon align-middle fs-20 me-2"></i>
                    </div>
                    <div class="flex-grow-1">
                        Export
                    </div>
                </div>
            </a>
        @endif
      </div>
    </div>
    @endif
    <!-- All Tab End -->


    <!-- Favorite Tab -->
    @if(isset($tablearray['DataTableTab']))
    @php
    $favoritetab = $tablearray['DataTableTab'];
    @endphp
    <div id="menu5" class="tab-pane fade" role="tabpanel">
    	@include('powerpanel.partials.norecordlistsection')
        {{-- <!-- @if(Schema::hasTable('gridsetting'))
        <div class="dropdown pull-right gridsetting">
            <a class="dropdown-toggle" data-toggle="dropdown"></a>
            <ul class="dropdown-menu" id="FavoriteTab">
                @php
                foreach($favoritetab['ColumnSetting'] as $favoritectab){
                if(isset($favoritectab['Name']) && $favoritectab['Name'] != 'Order' && $favoritectab['Name'] != 'Publish'){

                $columndata = json_decode($settingarray);
                $cid = $ModuleName.'_'.$favoritectab['Identity_Name'].'_F_'.$favoritectab['TabIndex'];
                if(isset($columndata->F)){
                if(in_array($cid,$columndata->F)){
                $checked = '';
                }else{
                $checked = 'checked="checked"';
                }
                }else{
                $checked = 'checked="checked"';
                }

                @endphp
                <li>
                    <div class="md-checkbox">
                        <input class="md-checkboxbtn checkbox_F tabclasssetting"  {{ $checked}} type="checkbox" name="{{ $ModuleName }}_{{ $favoritectab['Identity_Name'] }}_F_{{ $favoritectab['TabIndex'] }}" id="{{ $ModuleName }}_{{ $favoritectab['Identity_Name'] }}_F_{{ $favoritectab['TabIndex'] }}" data-columnname="{{$favoritectab['Name']}}" data-columnno="{{$favoritectab['TabIndex']}}" data-tabid='F'>
                        <label for="{{ $ModuleName }}_{{ $favoritectab['Identity_Name'] }}_F_{{ $favoritectab['TabIndex'] }}"> 
                            <span></span>
                            <span class="check"></span>
                            <span class="box"></span>
                            {{ $favoritectab['Name'] }}
                        </label>
                    </div>
                </li>
                @php
                }
                }
                @endphp
            </ul>
        </div>
        @endif --> --}}
        <div class="withrecords">
        <table class="table table-hover align-middle table-nowrap hide-mobile" id="datatable_ajax4">
            <thead class="table-light">
                <tr role="row" class="heading">
                    <th align="center"><input type="checkbox" class="form-check-input"></th>
                    @php
                    foreach($favoritetab['DataTableHead'] as $favoritedtab){
                    if(isset($favoritedtab['Title'])){
                    @endphp
                    <th align="{{ $favoritedtab['Align'] }}">{{ $favoritedtab['Title'] }}</th>
                    @php
                    }
                    }
                    @endphp
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
        @if((Auth::user()->can($Permission_Delete) && $userIsAdmin) || (Auth::user()->can($Permission_Delete)))
            <button href="javascript:;" class="btn btn-danger waves-effect btn-label deleteMass hide-btn-mob" value="F">
                <div class="d-flex">
                    <div class="flex-shrink-0">
                        <i class="ri-delete-bin-line label-icon align-middle fs-20 me-2"></i>
                    </div>
                    <div class="flex-grow-1">
                        {{ trans('template.common.delete') }}
                    </div>
                </div>
            </button>
        @endif
      </div>
    </div>
    @endif
    <!-- Favorite Tab End-->


    <!-- Approve Tab -->
    @if(isset($tablearray['DataTableTab']))
    @php
    $approvetab = $tablearray['DataTableTab'];
    @endphp
    <div id="menu2" class="tab-pane fade" role="tabpanel">
    	@include('powerpanel.partials.norecordlistsection')
        {{-- <!-- @if(Schema::hasTable('gridsetting'))
        <div class="dropdown pull-right gridsetting">
            <a class="dropdown-toggle" data-toggle="dropdown">
            </a>
            <ul class="dropdown-menu" id="ApprovalTab">
                @php
                foreach($approvetab['ColumnSetting'] as $apptab){
                if(isset($apptab['Name']) && $apptab['Name'] != 'Publish'){

                $columndata = json_decode($settingarray);
                $cid = $ModuleName.'_'.$apptab['Identity_Name'].'_A_'.$apptab['TabIndex'];
                if(isset($columndata->A)){
                if(in_array($cid,$columndata->A)){
                $checked = '';
                }else{
                $checked = 'checked="checked"';
                }
                }else{
                $checked = 'checked="checked"';
                }
                @endphp
                <li>
                    <div class="md-checkbox">
                        <input class="md-checkboxbtn checkbox_A tabclasssetting" {{ $checked }} type="checkbox" name="{{ $ModuleName }}_{{ $apptab['Identity_Name'] }}_A_{{ $apptab['TabIndex'] }}" id="{{ $ModuleName }}_{{ $apptab['Identity_Name'] }}_A_{{ $apptab['TabIndex'] }}" data-columnname="{{$apptab['Name']}}" data-columnno="{{$apptab['TabIndex']}}" data-tabid='A'>
                        <label for="{{ $ModuleName }}_{{ $apptab['Identity_Name'] }}_A_{{ $apptab['TabIndex'] }}">
                            <span></span>
                            <span class="check"></span>
                            <span class="box"></span>
                            {{ $apptab['Name'] }}
                        </label>
                    </div>
                </li>
                @php
                }
                }
                @endphp
            </ul>
        </div>
        @endif --> --}}
        <div class="withrecords">
        <table class="table table-hover align-middle table-nowrap hide-mobile" id="datatable_ajax_approved">
            <thead class="table-light">
                <tr role="row" class="heading">
                    <th align="center"></th>
                    @php
                    foreach($approvetab['DataTableHead'] as $appdtab){
                    if(isset($appdtab['Title']) && $appdtab['Title'] != 'Order'){
                    @endphp
                    <th align="{{ $appdtab['Align'] }}">{{ $appdtab['Title'] }}</th>
                    @php
                    }
                    }
                    @endphp
                </tr>
            </thead>
            <tbody></tbody>
        </table>
        @if((Auth::user()->can($Permission_Delete) && $userIsAdmin) || (Auth::user()->can($Permission_Delete)))
            <button href="javascript:;" class="btn btn-danger waves-effect btn-label deleteMass hide-btn-mob" value="A">
                <div class="d-flex">
                    <div class="flex-shrink-0">
                        <i class="ri-delete-bin-line label-icon align-middle fs-20 me-2"></i>
                    </div>
                    <div class="flex-grow-1">
                        Delete Permanently
                    </div>
                </div>
            </button>
        @endif
      </div>
    </div>
    @endif
    <!-- Approve Tab End-->


    <!-- Draft Tab -->
    @if(isset($tablearray['DataTableTab']))
    @php
    $drafttab = $tablearray['DataTableTab'];
    @endphp
    <div id="menu3" class="tab-pane fade" role="tabpanel">
    	@include('powerpanel.partials.norecordlistsection')
        {{-- <!-- @if(Schema::hasTable('gridsetting'))
        <div class="dropdown pull-right gridsetting">
            <a class="dropdown-toggle" data-toggle="dropdown">
            </a>
            <ul class="dropdown-menu" id="DarftTab">
                @php
                foreach($drafttab['ColumnSetting'] as $draftctab){
                if(isset($draftctab['Name']) && $draftctab['Name'] != 'Order'){

                $columndata = json_decode($settingarray);
                $cid = $ModuleName.'_'.$draftctab['Identity_Name'].'_D_'.$draftctab['TabIndex'];
                if(isset($columndata->D)){
                if(in_array($cid,$columndata->D)){
                $checked = '';
                }else{
                $checked = 'checked="checked"';
                }
                }else{
                $checked = 'checked="checked"';
                }

                @endphp
                <li>
                    <div class="md-checkbox">
                        <input class="md-checkboxbtn checkbox_D tabclasssetting" {{ $checked }} type="checkbox" name="{{ $ModuleName }}_{{ $draftctab['Identity_Name'] }}_D_{{ $draftctab['TabIndex'] }}" id="{{ $ModuleName }}_{{ $draftctab['Identity_Name'] }}_D_{{ $draftctab['TabIndex'] }}" data-columnname="{{$draftctab['Name']}}" data-columnno="{{$draftctab['TabIndex']}}" data-tabid='D'>
                        <label for="{{ $ModuleName }}_{{ $draftctab['Identity_Name'] }}_D_{{ $draftctab['TabIndex'] }}">
                            <span></span>
                            <span class="check"></span>
                            <span class="box"></span>
                            {{ $draftctab['Name'] }}
                        </label>
                    </div>
                </li>
                @php
                }
                }
                @endphp
            </ul>
        </div>
        @endif --> --}}
        <div class="withrecords">
        <table class="table table-hover align-middle table-nowrap hide-mobile" id="datatable_ajax2">
            <thead class="table-light">
                <tr role="row" class="heading">
                    <th align="center"><input type="checkbox" class="form-check-input"></th>
                    @php
                    foreach($drafttab['DataTableHead'] as $draftdtab){
                    if(isset($draftdtab['Title']) && $draftdtab['Title'] != 'Order'){
                    @endphp
                    <th align="{{ $draftdtab['Align'] }}">{{ $draftdtab['Title'] }}</th>
                    @php
                    }
                    }
                    @endphp
                </tr>
            </thead>
            <tbody></tbody>
        </table>
        @if((Auth::user()->can($Permission_Delete) && $userIsAdmin) || (Auth::user()->can($Permission_Delete)))
            <button href="javascript:;"class="btn btn-danger waves-effect btn-label deleteMass hide-btn-mob" value="D">
                <div class="d-flex">
                    <div class="flex-shrink-0">
                        <i class="ri-delete-bin-line label-icon align-middle fs-20 me-2"></i>
                    </div>
                    <div class="flex-grow-1">
                        {{ trans('template.common.delete') }}
                    </div>
                </div>
            </button>
        @endif
      </div>
    </div>
    @endif
    <!-- Draft Tab End-->


    <!-- Trash Tab -->
    @if(isset($tablearray['DataTableTab']))
    @php
    $trashtab = $tablearray['DataTableTab'];
    @endphp
    <div id="menu4" class="tab-pane fade" role="tabpanel">
    	@include('powerpanel.partials.norecordlistsection')
        {{-- <!-- @if(Schema::hasTable('gridsetting'))
        <div class="dropdown pull-right gridsetting">
            <a class="dropdown-toggle" data-toggle="dropdown">
            </a>
            <ul class="dropdown-menu" id="TrashTab">
                @php
                foreach($trashtab['ColumnSetting'] as $trashctab){
                if(isset($trashctab['Name']) && $trashctab['Name'] != 'Order' && $trashctab['Name'] != 'Publish'){

                $columndata = json_decode($settingarray);
                $cid = $ModuleName.'_'.$trashctab['Identity_Name'].'_T_'.$trashctab['TabIndex'];
                if(isset($columndata->T)){
                if(in_array($cid,$columndata->T)){
                $checked = '';
                }else{
                $checked = 'checked="checked"';
                }
                }else{
                $checked = 'checked="checked"';
                }

                @endphp
                <li>
                    <div class="md-checkbox">
                        <input class="md-checkboxbtn checkbox_T tabclasssetting" {{ $checked }} type="checkbox" name="{{ $ModuleName }}_{{ $trashctab['Identity_Name'] }}_T_{{ $trashctab['TabIndex'] }}" id="{{ $ModuleName }}_{{ $trashctab['Identity_Name'] }}_T_{{ $trashctab['TabIndex'] }}" data-columnname="{{$trashctab['Name']}}" data-columnno="{{$trashctab['TabIndex']}}" data-tabid='T'>
                        <label for="{{ $ModuleName }}_{{ $trashctab['Identity_Name'] }}_T_{{ $trashctab['TabIndex'] }}"> 
                            <span></span>
                            <span class="check"></span>
                            <span class="box"></span>
                            {{ $trashctab['Name'] }}
                        </label>
                    </div>
                </li>
                @php
                }
                }
                @endphp
            </ul>
        </div>
        @endif --> --}}
        <div class="withrecords">
        <table class="table table-hover align-middle table-nowrap hide-mobile" id="datatable_ajax3">
            <thead class="table-light">
                <tr role="row" class="heading">
                    <th align="center"><input type="checkbox" class="form-check-input"></th>
                    @php
                    foreach($trashtab['DataTableHead'] as $trashdtab){
                    if(isset($trashdtab['Title']) && $trashdtab['Title'] != 'Order' && $trashdtab['Title'] != 'Publish'){
                    @endphp
                    <th align="{{ $trashdtab['Align'] }}">{{ $trashdtab['Title'] }}</th>
                    @php
                    }
                    }
                    @endphp
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
        @if((Auth::user()->can($Permission_Delete) && $userIsAdmin) || (Auth::user()->can($Permission_Delete)))
            <button href="javascript:;" class="btn btn-danger waves-effect btn-label deleteMass hide-btn-mob" value="T">
                <div class="d-flex">
                    <div class="flex-shrink-0">
                        <i class="ri-delete-bin-line label-icon align-middle fs-20 me-2"></i>
                    </div>
                    <div class="flex-grow-1">
                        Delete Permanently
                    </div>
                </div>
            </button>
        @endif
      </div>
    </div>
    @endif
    <!-- Trash Tab End-->

</div>