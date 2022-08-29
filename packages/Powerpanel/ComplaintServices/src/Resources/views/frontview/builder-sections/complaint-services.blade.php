@php
$complaintservicesurl = '';
@endphp



@if(isset($data['complaintservices']) && !empty($data['complaintservices']) && count($data['complaintservices']) > 0)
@php 
$cols = 'col-md-4 col-sm-4 col-xs-12';
$grid = '3';
if($data['cols'] == 'grid_2_col'){
$cols = 'col-xl-6';
$grid = '2';
}elseif ($data['cols'] == 'grid_3_col') {
$cols = 'col-xl-4';
$grid = '3';
}elseif ($data['cols'] == 'grid_4_col') {
$cols = 'col-xl-3';
$grid = '4';
}

if(isset($data['class'])){
$class = $data['class'];
}
if(isset($data['paginatehrml']) && $data['paginatehrml'] == true){
$pcol = $cols;
}else{
$pcol = 'item';
}
@endphp

@if(isset($data['desc']) && $data['desc'] != '')
<div class="row">
    <div class="col-12 cms n-mb-30">
        <p>{!! $data['desc'] !!}</p>
    </div>
</div>
@endif

<div class="col-xl-12">
    <div class="row justify-content-center">
        @foreach($data['complaintservices'] as $key =>  $complaintservices)


        @if(isset($complaintservices->fkIntImgId))
        @php                          
        $itemImg = App\Helpers\resize_image::resize($complaintservices->fkIntImgId);
        @endphp
        @else 
        @php
        $itemImg = $CDN_PATH.'assets/images/directors.png';
        @endphp
        @endif

        @if(isset($complaintservices->varShortDescription))
        @php
        $description = $complaintservices->varShortDescription;
        @endphp

        @endif


        <div class="col-lg-3 col-md-4 col-6 n-gapp-lg-5 n-gapm-lg-4 n-gapm-md-3 d-flex" data-aos="zoom-in" data-aos-delay="{{$key}}00">
            <article class="n-bs-1 n-bgc-white-500 w-100 d-flex flex-column">
                <div class="thumbnail-container ac-webp" data-thumb="66.66%">
                    <div class="thumbnail">
                        <img src="{{$itemImg}}">
                    </div>
                </div>
                <div class="n-pa-md-20 n-pa-15 d-flex flex-column flex-auto">
                    <div class="n-fs-22-lg n-fs-18 n-fc-dark-500 n-lh-120">{{$complaintservices->varTitle}}</div>
                    @php
                    $lower = strtolower($complaintservices->varTitle);
                    $title= str_replace(" ","-",$lower);
                    $id= $complaintservices->id;
                    @endphp
                    <div class="mt-auto n-pt-15">
                        <a href="{{ url('on-line-complaint-form').'?type='.strip_tags($title).'&r_id='.strip_tags((int)$id) }}" title="File Complaint" class="ac-btn ac-btn-primary ac-small">File Complaint</a>
                    </div>
                </div>
            </article>
        </div>

        @endforeach

    </div>
</div>




@endif