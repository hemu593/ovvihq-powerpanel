@if (!Request::ajax())
@extends('layouts.app')
@section('content')
    @include('layouts.inner_banner')
@endif
    <section class="inner-page-gap news-detail">
        <!-- This design also used on the consultation-detail -->
        @include('layouts.share-email-print')

        <div class="container">
            <div class="row">
                <div class="col-xl-3 order-xl-0 order-2 n-mt-xl-0 n-mt-40 left-panel" data-aos="fade-up">
                    <div class="row n-mr-xl-15">
                        <div class="col-xl-12">
                            <article>
                                <div class="nqtitle-small lp-title text-uppercase n-mb-25">Latest News</div>
                                <div class="row">
                                    @foreach ($latestNews as $latest_news)
                                        @php
                                            if (isset(App\Helpers\MyLibrary::getFront_Uri('news')['uri'])) {
                                                $moduelFrontPageUrl = App\Helpers\MyLibrary::getFront_Uri('news')['uri'];
                                                $moduleFrontWithCatUrl = $latest_news->varAlias != false ? $moduelFrontPageUrl . '/' . $latest_news->varAlias : $moduelFrontPageUrl;
                                                $categoryRecordAlias = App\Helpers\Mylibrary::getRecordAliasByModuleNameRecordId('news', $latest_news->txtCategories);
                                                $recordLinkUrl = $moduleFrontWithCatUrl . '/' . $latest_news->alias->varAlias;
                                            } else {
                                                $recordLinkUrl = '';
                                            }
                                        @endphp
                                        <div class="col-xl-12 col-lg-6 -border">
                                            <ul class="nqul justify-content-between -tag d-flex align-items-center n-ff-2">
                                                @php $colourclass = '';@endphp
                            @if(strtolower($latest_news->varSector) == 'ofreg')
                            @php
                            $colourclass = 'ofreg-tag';
                            @endphp
                            @elseif(strtolower($latest_news->varSector) == 'ict')
                            @php $colourclass = 'ict-tag'; @endphp
                            @elseif(strtolower($latest_news->varSector) == 'water')
                            @php $colourclass = 'water-tag'; @endphp
                            @elseif(strtolower($latest_news->varSector) == 'fuel')
                            @php $colourclass = 'fuel-tag'; @endphp
                            @elseif(strtolower($latest_news->varSector) == 'energy')
                            @php $colourclass = 'energy-tag'; @endphp
                            @endif
                            <li class="{{$colourclass}}">
                                                    <div class="-nimg">
                                                        <img src="{{ $CDN_PATH . 'assets/images/logo.png' }}"
                                                            alt="{{ $latest_news->varSector }}"
                                                            title="{{ $latest_news->varSector }}">
                                                    </div>
                                                    <div class="-nlabel n-fc-white-500 n-fs-16 n-fw-800 text-uppercase">
                                                        {{ $latest_news->varSector }}</div>
                                                </li>
                                                <li class="nq-svg n-fs-14 n-fw-500 n-fc-gray-500 n-ff-2">
                                                    <i class="n-icon" data-icon="s-calendar"></i>
                                                    {{ date('M d, Y', strtotime($latest_news->dtDateTime)) }}
                                                </li>
                                            </ul>
                                            <a class="d-inline-block n-mt-15 n-fs-16 n-ff-2 n-fw-600 n-lh-130 n-fc-black-500 n-ah-a-500"
                                                href="{{ $recordLinkUrl }}"
                                                title="{{ $latest_news->varTitle }}">{{ $latest_news->varTitle }}</a>
                                        </div>
                                    @endforeach
                                </div>
                            </article>
                        </div>
                        <div class="col-xl-12">
                            @if (isset($tags) && !empty($tags))
                                <article class="n-mt-xl-50 n-mt-md-0 n-mt-25">
                                    <div class="nqtitle-small lp-title text-uppercase n-mb-25">Tags</div>
                                    <div class="s-tags">
                                        <ul class="nqul d-flex flex-wrap n-fs-14 n-ff-2 n-fw-600 n-fc-white-500">
                                            @foreach ($tags as $tag)
                                                <li><a href="javascript:void(0)" class="text-uppercase"
                                                        title="{{ $tag }}">{{ $tag }}</a></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </article>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-xl-9" data-aos="fade-up">
                    <ul
                        class="nqul justify-content-between -tag d-flex align-items-center n-fs-16 n-fw-600 n-fc-black-500 n-ff-2">
                            @php $colourclass = '';@endphp
                            @if(strtolower($latest_news->varSector) == 'ofreg')
                            @php
                            $colourclass = 'ofreg-tag';
                            @endphp
                            @elseif(strtolower($latest_news->varSector) == 'ict')
                            @php $colourclass = 'ict-tag'; @endphp
                            @elseif(strtolower($latest_news->varSector) == 'water')
                            @php $colourclass = 'water-tag'; @endphp
                            @elseif(strtolower($latest_news->varSector) == 'fuel')
                            @php $colourclass = 'fuel-tag'; @endphp
                            @elseif(strtolower($latest_news->varSector) == 'energy')
                            @php $colourclass = 'energy-tag'; @endphp
                            @endif
                            <li class="{{$colourclass}}">
                            <div class="-nimg">
                                <img src="{{ $CDN_PATH . 'assets/images/logo.png' }}" alt="{{ $news->varSector }}"
                                    title="{{ $news->varSector }}">
                            </div>
                            <div class="-nlabel n-fc-white-500 n-fs-16 n-fw-800 text-uppercase">{{ $news->varSector }}
                            </div>
                        </li>
                        <li class="nq-svg n-fs-14 n-fw-500 n-fc-gray-500 n-ff-2">
                            <i class="n-icon" data-icon="s-calendar"></i>
                            {{ date('M d, Y', strtotime($news->dtDateTime)) }}
                        </li>
                    </ul>

                    <h2 class="nqtitle-small n-fc-black-500 n-fw-600 n-lh-140 n-mv-25">{{ $news->varTitle }}</h2>
                    @if (isset($news->fkIntImgId) && !empty($news->fkIntImgId) && $news->fkIntImgId > 0)
                        <div class="-img">
                            <div class="thumbnail-container">
                                <div class="thumbnail">
                                    @php $itemImg = App\Helpers\resize_image::resize($news->fkIntImgId) @endphp
                                    <img src="{{ $itemImg }}" alt="{{ $news->varTitle }}">
                                    <br /><br />
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="-img">
                            <div class="thumbnail-container">
                                <div class="thumbnail">
                                    <img src="{{ $CDN_PATH . 'assets/images/default.png' }}"
                                        alt="{{ $news->varSector }}" title="{{ $news->varSector }}">
                                    <br /><br />
                                </div>
                            </div>
                        </div>
                    @endif
                    @if (isset($txtDescription) && !empty($txtDescription))
                        <div class="cms n-mt-25">
                            {!! htmlspecialchars_decode($txtDescription) !!}
                        </div>
                    @else
                        <div class="cms n-mt-25">
                            {!! htmlspecialchars_decode($news->varShortDescription) !!}
                        </div>
                    @endif
                    @if (isset($news->fkIntDocId) && !empty($news->fkIntDocId))
                        @php
                            $docsAray = explode(',', $news->fkIntDocId);
                            $docObj = App\Document::getDocDataByIds($docsAray);
                        @endphp
                        @if (count($docObj) > 0)
                            <div class="cms">
                                <h2>Documents</h2>
                                <div class="row">
                                    @foreach ($docObj as $key => $val)
                                        @php
                                            $CDN_PATH = Config::get('Constant.CDN_PATH');
                                            if ($val->fk_folder > 0 && !empty($val->foldername)) {
                                                if ($val->varDocumentExtension == 'pdf' || $val->varDocumentExtension == 'PDF') {
                                                    $docURL = route('viewFolderPDF', ['dir' => 'documents', 'foldername' => $val->foldername, 'filename' => $val->txtSrcDocumentName . '.' . $val->varDocumentExtension]);
                                                } else {
                                                    $docURL = $CDN_PATH . 'documents/' . $val->foldername . '/' . $val->txtSrcDocumentName . '.' . $val->varDocumentExtension;
                                                }
                                            } else {
                                                if ($val->varDocumentExtension == 'pdf' || $val->varDocumentExtension == 'PDF') {
                                                    $docURL = route('viewPDF', ['dir' => 'documents', 'filename' => $val->txtSrcDocumentName . '.' . $val->varDocumentExtension]);
                                                } else {
                                                    $docURL = $CDN_PATH . 'documents/' . $val->txtSrcDocumentName . '.' . $val->varDocumentExtension;
                                                }
                                            }
                                        @endphp
                                        <div class="documents col-6">
                                            @if ($val->varDocumentExtension == 'pdf' || $val->varDocumentExtension == 'PDF')
                                                <div class="-doct-img">
                                                    <i class="n-icon" data-icon="s-pdf"></i>
                                                    <i class="n-icon" data-icon="s-download"></i>
                                                </div>
                                            @elseif($val->varDocumentExtension == 'doc' || $val->varDocumentExtension ==
                                                'docx')
                                                <div class="-doct-img">
                                                    <i class="n-icon" data-icon="s-doc"></i>
                                                    <i class="n-icon" data-icon="s-download"></i>
                                                </div>
                                            @elseif($val->varDocumentExtension == 'xls' || $val->varDocumentExtension ==
                                                'xlsx')
                                                <div class="-doct-img">
                                                    <i class="n-icon" data-icon="s-xls"></i>
                                                    <i class="n-icon" data-icon="s-download"></i>
                                                </div>
                                            @else
                                                <div class="-doct-img">
                                                    <i class="n-icon" data-icon="s-pdf"></i>
                                                    <i class="n-icon" data-icon="s-download"></i>
                                                </div>
                                            @endif
                                            <div>
                                                <a class="-link n-ah-a-500 docHitClick" href="{{ $docURL }}" download
                                                    title="{{ $val->txtDocumentName }}">{{ $val->txtDocumentName }}</a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </section>
@if (!Request::ajax())
    @endsection
@endif