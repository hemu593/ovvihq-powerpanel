@if(!empty($bannerData) && count($bannerData)>0)
    <section class="home-banner">
        <div id="home-banner" class="carousel slide carousel-fade" data-ride="carousel" data-interval="5000" data-pause="hover" data-wrap="true">
            <div class="carousel-inner">
                @foreach($bannerData as $key => $banner)
                    <div class="carousel-item @if($key == 0) active @endif">

                        @if($banner->chrDisplayVideo == "N")

                            <div class="fill" style="background-image: url('{!! App\Helpers\resize_image::thumbImage($banner->image,1920,853) !!}');" >
                            </div>

                            <div class="carousel-caption">
                                <div class="nq-table">
                                    <div class="nq-center">
                                        <div class="container">
                                            <div class="banner-content">
                                                <h2 class="title">{{ $banner->varTitle }}</h2>
                                                <p>{{ $banner->varShortDescription }}</p>
                                                @if(isset($banner->varLink))
                                                    @if($banner->chrDisplayLink == "N")
                                                        <div class="more-btn"><a class="ac-btn ac-btn-primary" href="{{ $banner->varLink }}" title="Read More">Read More</a></div>
                                                    @else
                                                        <div class="more-btn"><a class="ac-btn ac-btn-primary" href="{{ $banner->varLink }}" title="Read More" target="_blank">Read More</a></div>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        @elseif($banner->chrDisplayVideo == "Y")

                            @if(str_contains($banner->varVideoLink, 'youtube.com'))

                                @if(str_contains($banner->varVideoLink, 'embed'))
                                    <div class="fill iframe">
                                        <iframe class="fill" src="{{ $banner->varVideoLink }}" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>
                                    </div>
                                @else
                                    @php
                                        $link = $banner->varVideoLink;
                                        $video_id = explode("?v=", $link);
                                        if (empty($video_id[1]))
                                            $video_id = explode("/v/", $link);

                                        $video_id = explode("&", $video_id[1]);
                                        $video_id = $video_id[0];
                                    @endphp
                                    <div class="fill iframe">
                                        <iframe class="fill" src="//www.youtube.com/embed/{{ $video_id }}?rel=0" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>
                                    </div>
                                @endif

                            @elseif(str_contains($banner->varVideoLink, 'vimeo.com'))
                                @php $video_id = substr(parse_url($banner->varVideoLink, PHP_URL_PATH), 1) @endphp
                                <div class="fill iframe">
                                    @if(str_contains($banner->varVideoLink, 'player.vimeo.com'))
                                        <iframe class="fill" src="{{ $banner->varVideoLink }}"></iframe>
                                    @else
                                        <iframe class="fill" src="//player.vimeo.com/video/{{ $video_id }}"></iframe>
                                    @endif
                                </div>
                            @else
                                <iframe class="fill" src="{{ $banner->varVideoLink }}"></iframe>
                            @endif

                        @endif

                    </div>
                @endforeach
            </div>

            @if(count($bannerData) > 1)
                <!-- Left and right controls S -->
                <a class="slider-control left btn btn-primary" href="#home-banner" data-slide="prev" title="Previous"><i class="fa fa-angle-left"></i></a>
                <a class="slider-control right btn btn-primary" href="#home-banner" data-slide="next" title="Next"><i class="fa fa-angle-right"></i></a>
                <!-- Left and right controls E -->
            @endif
        </div>
    </section>
@else
    <section class="home-banner">
        <div class="slider slider-for">
            <div class="item">
                <div class="thumbnail-container">
                    <div class="thumbnail">
                        <img src="{{ $CDN_PATH.'assets/images/banner/ICT-c.jpg' }}" alt="ICT" title="ICT" />
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif




