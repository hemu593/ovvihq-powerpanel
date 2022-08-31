@if(Request::segment(1) == '')
<section class="home-testimonial" data-aos="fade-up">
    <div class="container">
        <div class="same_title text-center n-mb-60">
            <h2>Our Testimonial</h2>
        </div>
        <div class="row">
            <div class="col-lg-6 img-column">
                <div class="inner-column">
                    <div class="testi-user">
                        <div class="thumbnail-container">
                            <div class="thumbnail">
                                <img src="{{ $CDN_PATH.'assets/images/team-2.jpg' }}" alt="" title="">
                            </div>
                        </div>
                    </div>
                    <div class="user-two">
                        <img src="{{ $CDN_PATH.'assets/images/tet-1.jpg' }}" alt="" title="">
                    </div>
                    <div class="user-three">
                        <img src="{{ $CDN_PATH.'assets/images/tet-4.png' }}" alt="" title="">
                    </div>
                    <div class="user-four">
                        <img src="{{ $CDN_PATH.'assets/images/tet-5.png' }}" alt="" title="">
                    </div>
                    <div class="user-five">
                        <img src="{{ $CDN_PATH.'assets/images/team1.jpg' }}" alt="" title="">
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="testi-card trust-review owl-carousel">
                    <div class="items">
                        <div class="testi-decri">
                            <div class="review-text cms">
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever, when an unknown printer took a galley of type and scrambled it to make a type.</p>
                            </div>
                        </div>
                        <div class="test-row-set">
                            <div class="media vcenter">
                                <div class="testi-icon-set img-round80"><img src="{{ $CDN_PATH.'assets/images/testi-img1.png' }}" alt="" class="img-fluid"></div>
                                <div class="testi-details-set user-info">
                                    <h5>Mr. Sonji Myles</h5>
                                    <p>App Developer</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="items">
                        <div class="testi-decri">
                            <div class="review-text cms">
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever, when an unknown printer took a galley of type and scrambled it to make a type.</p>
                            </div>
                        </div>
                        <div class="test-row-set">
                            <div class="media vcenter">
                                <div class="testi-icon-set img-round80"><img src="{{ $CDN_PATH.'assets/images/team.jpg' }}" alt="" class="img-fluid"></div>
                                <div class="testi-details-set user-info">
                                    <h5>Anne Fibbiyon</h5>
                                    <p>Web Developer</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="items">
                        <div class="testi-decri">
                            <div class="review-text cms">
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever, when an unknown printer took a galley of type and scrambled it to make a type.</p>
                            </div>
                        </div>
                        <div class="test-row-set">
                            <div class="media vcenter">
                                <div class="testi-icon-set img-round80"><img src="{{ $CDN_PATH.'assets/images/team-4.jpg' }}" alt="" class="img-fluid"></div>
                                <div class="testi-details-set user-info">
                                    <h5>Roxie Swanson</h5>
                                    <p>Ios Developer</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>	

<section class="home-client" data-aos="fade-up">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h2 class="nqtitle text-center">Our Clients</h2>
                <div class="ourclient">
                    <div class="owl-carousel owl-theme">
                        <div class="item">
                            <div class="client-img">
                                <div class="thumbnail-container">
                                    <div class="thumbnail">
                                        <a href="javascript:void(0)" title=""><img src="{{ $CDN_PATH.'assets/images/client-2.png' }}" alt=""></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="client-img">
                                <div class="thumbnail-container">
                                    <div class="thumbnail">
                                        <a href="javascript:void(0)" title=""><img src="{{ $CDN_PATH.'assets/images/client-3.png' }}" alt=""></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="client-img">
                                <div class="thumbnail-container">
                                    <div class="thumbnail">
                                        <a href="javascript:void(0)" title=""><img src="{{ $CDN_PATH.'assets/images/client-4.png' }}" alt=""></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="client-img">
                                <div class="thumbnail-container">
                                    <div class="thumbnail">
                                        <a href="javascript:void(0)" title=""><img src="{{ $CDN_PATH.'assets/images/client-5.png' }}" alt=""></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="client-img">
                                <div class="thumbnail-container">
                                    <div class="thumbnail">
                                        <a href="javascript:void(0)" title=""><img src="{{ $CDN_PATH.'assets/images/client-6.png' }}" alt=""></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="client-img">
                                <div class="thumbnail-container">
                                    <div class="thumbnail">
                                        <a href="javascript:void(0)" title=""><img src="{{ $CDN_PATH.'assets/images/client-7.png' }}" alt=""></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>        
</section>  
	  
@endif
<footer class="footer-main">    
    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-sm-12 leftbar">
                <div class="f-logo">
                    <a href="{{ url('/') }}" title="{{ Config::get('Constant.SITE_NAME') }}">
                        <img src="{{ $CDN_PATH.'assets/images/light-logo.png' }}" alt="{{ Config::get('Constant.SITE_NAME') }}"></a>
                    </a>
                </div>
                <div class="contact-info">
                    <ul>
                        @if(isset($objContactInfo->txtAddress)&&  !empty($objContactInfo->txtAddress))
                            <li class="address">{!! ($objContactInfo->txtAddress) !!}</li>
                        @endif
                        @if(isset($objContactInfo->varPhoneNo) && !empty($objContactInfo->varPhoneNo))
                            <li class="call"><a href="tel:{{$objContactInfo->varPhoneNo}}" title="Call Us On {{$objContactInfo->varPhoneNo}}">{{$objContactInfo->varPhoneNo}}</a></li>
                        @endif
                        @if(isset($objContactInfo->varEmail) && !empty($objContactInfo->varEmail))
                            <li class="mail"><a href="mailto:{{$objContactInfo->varEmail}}" title="Email Us On {{$objContactInfo->varEmail}}">{!! nl2br($objContactInfo->varEmail) !!}</a></li>
                        @endif
                    </ul>
                </div>
            </div>
            <div class="col-lg-7 col-sm-12 rightbar">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="links-info">
                            <h3 class="f-title">Quick Links</h3>
                            @if(isset($QuickLinksMenu))
                                {!! $QuickLinksMenu !!}
                            @endif
                        </div>
                    </div>        
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="newsletter-info">
                            <h3 class="f-title">Subscribe to Our Newsletter</h3>
                            <p>Join our subscribes list to get the latest news, updates and special offers delivered directly in your inbox.</p>
                            <form id="subscription_form" method="POST" action="{{url('news-letter')}}">
                            @csrf
                                <div class="input-group form-info">
        						  <input type="email" class="form-control" name="email" placeholder="Enter your email" />
                                   <div class="input-group-append">
        						     <button class="btn btn-primary" type="submit" title="GO">GO</button>
                                  </div>
                                </div>
                                @if (isset($errors) && $errors->has('email'))
                                    <span class="help-block">{{ $errors->first('email') }}</span>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
                <div class="row defalut-footer">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="f-social">
                            <h3 class="f-title">Connect with us</h3>
                            @php $socialAvailable = false; @endphp
                            @if((null!==Config::get('Constant.SOCIAL_FB_LINK') && strlen(Config::get('Constant.SOCIAL_FB_LINK')) > 0) || (null!==Config::get('Constant.SOCIAL_TWITTER_LINK') && strlen(Config::get('Constant.SOCIAL_TWITTER_LINK')) > 0) || (null!==Config::get('Constant.SOCIAL_LINKEDIN_LINK') && strlen(Config::get('Constant.SOCIAL_LINKEDIN_LINK')) > 0) || (null!==Config::get('Constant.SOCIAL_YOUTUBE_LINK') && strlen(Config::get('Constant.SOCIAL_YOUTUBE_LINK')) > 0))
                            @php $socialAvailable = true; @endphp
                            <ul class="ac-share">
                                @if(null!==(Config::get('Constant.SOCIAL_FB_LINK')) && strlen(Config::get('Constant.SOCIAL_FB_LINK')) > 0)
                                <li><a href="{{ Config::get('Constant.SOCIAL_FB_LINK') }}" title="Follow Us On Facebook" target="_blank"><i class="fa fa-facebook"></i></a></li>
                                @endif
                                @if(null!==(Config::get('Constant.SOCIAL_TWITTER_LINK')) && strlen(Config::get('Constant.SOCIAL_TWITTER_LINK')) > 0)
                                <li><a href="{{ Config::get('Constant.SOCIAL_TWITTER_LINK') }}" title="Follow Us On Twitter"><i class="fa fa-twitter" target="_blank"></i></a></li>
                                @endif
                                @if(null!==(Config::get('Constant.SOCIAL_LINKEDIN_LINK')) && strlen(Config::get('Constant.SOCIAL_LINKEDIN_LINK')) > 0)
                                <li><a href="{{ Config::get('Constant.SOCIAL_LINKEDIN_LINK') }}" title="Follow Us On YouTube"><i class="fa fa-linkedin" target="_blank"></i></a></li>
                                @endif
                                @if(null!==(Config::get('Constant.SOCIAL_YOUTUBE_LINK')) && strlen(Config::get('Constant.SOCIAL_YOUTUBE_LINK')) > 0)
                                <li><a href="{{ Config::get('Constant.SOCIAL_YOUTUBE_LINK') }}" title="Follow Us On YouTube"><i class="fa fa-youtube-play" target="_blank"></i></a></li>
                                @endif
                                @if(null!==(Config::get('Constant.SOCIAL_TRIP_ADVISOR_LINK')) && strlen(Config::get('Constant.SOCIAL_TRIP_ADVISOR_LINK')) > 0)
                                <li><a href="{{ Config::get('Constant.SOCIAL_TRIP_ADVISOR_LINK') }}" title="Follow Us On Tripadvisor"><i class="fa fa-tripadvisor" target="_blank"></i></a></li>
                                @endif
                                @if(null!==(Config::get('Constant.SOCIAL_INSTAGRAM_LINK')) && strlen(Config::get('Constant.SOCIAL_INSTAGRAM_LINK')) > 0)
                                <li><a href="{{ Config::get('Constant.SOCIAL_INSTAGRAM_LINK') }}" title="Follow Us On Instagram"><i class="fa fa-instagram" target="_blank"></i></a></li>
                                @endif
                            </ul>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="n-fw-400 n-lh-130 copyright-text">
                            Copyright &#169; {{ date("Y") }} {{ Config::get("Constant.SITE_NAME") }}. All rights reserved.
                        </div>
                        @if(isset($footerMenu))
                            {!! $footerMenu !!}
                        @endif
                        <div class="crafted">Crafted by: <a href="https://www.netclues.ky/" target="_blank" rel="nofollow" title="Netclues!">
                            <img src="{{ $CDN_PATH.'assets/images/netclues.gif' }}" alt="Netclues!"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>  
    <!-- Scroll To Top S -->
    <div id="back-top" title="Scroll To Top" style="display: none;"><i class="fa fa-angle-up"></i></div>
    <!-- Scroll To Top E -->  
</footer>

<div class="fixed-sidemenu">
    <ul>
        @if(isset($objContactInfo->varPhoneNo) && !empty($objContactInfo->varPhoneNo))
        <li class="f-call">
            <a href="tel:{{$objContactInfo->varPhoneNo}}" title="Call Us On {{$objContactInfo->varPhoneNo}}" class="link">
                <span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="s-phone-call">
                        <path d="M15.05 5A5 5 0 0 1 19 8.95M15.05 1A9 9 0 0 1 23 8.94m-1 7.98v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                    </svg>
                </span>
                <div class="contents">
                    <span class="sm-text d-block">Quick Contact</span>
                    <span class="info d-block">{{$objContactInfo->varPhoneNo}}</span>
                </div>
            </a>
        </li>
        @endif
        @if(isset($objContactInfo->varEmail) && !empty($objContactInfo->varEmail))
        <li class="f-email">
            <a href="mailto:{{$objContactInfo->varEmail}}" title="Email Us On {{$objContactInfo->varEmail}}" class="link">
                <span class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" stroke="currentColor" fill="#f99f1e">
                        <path d="M0 128C0 92.65 28.65 64 64 64H448C483.3 64 512 92.65 512 128V384C512 419.3 483.3 448 448 448H64C28.65 448 0 419.3 0 384V128zM48 128V150.1L220.5 291.7C241.1 308.7 270.9 308.7 291.5 291.7L464 150.1V127.1C464 119.2 456.8 111.1 448 111.1H64C55.16 111.1 48 119.2 48 127.1L48 128zM48 212.2V384C48 392.8 55.16 400 64 400H448C456.8 400 464 392.8 464 384V212.2L322 328.8C283.6 360.3 228.4 360.3 189.1 328.8L48 212.2z" /></svg>
                </span>
                <div class="contents">
                    <span class="sm-text d-block">Email</span>
                    <span class="info d-block">{!! nl2br($objContactInfo->varEmail) !!}</span>
                </div>
            </a>
        </li>
        @endif
    </ul>
</div>

{{-- <div class="content print-footer">
    <div class="row text-center">
        <div class="col-12">
             @if(isset($objContactInfo->txtAddress)&&  !empty($objContactInfo->txtAddress))
            <div class="n-fs-18 n-fw-500 n-fc-black-500 n-lh-130">{!! ($objContactInfo->txtAddress) !!}</div>
            @endif
               @if(isset($objContactInfo->mailingaddress)&&  !empty($objContactInfo->mailingaddress))
            <div class="n-fs-18 n-fw-500 n-fc-black-500 n-lh-130">Mailing Address: <br>{!! ($objContactInfo->mailingaddress) !!}</div>
            @endif
            <div class="n-fs-16 n-fw-500 n-fc-black-500 n-lh-130 n-mt-15">Copyright &#169; {{ date("Y") }} {{ Config::get("Constant.SITE_NAME") }}. All Rights Reserved.</div>
            <div class="n-fs-16 n-fw-500 n-fc-black-500 n-lh-130 -crafted">Crafted by: <a href="https://www.netclues.ky/" target="_blank" rel="nofollow" title="Netclues!" class="n-fc-a-500"><i class="n-icon" data-icon="s-netclues"></i></a></div>
        </div>
    </div>
</div> --}}

<!-- Cookies S -->
@if(Cookie::get('cookiesPopupStore') !="cookiesPopupStore")
    <div class="ac-cookies">
        <div class="ac-c-info">
            This site uses cookies: <a class="ac-c-find" href="{{ url('privacy-policy') }}" title="Find out more">Find out more</a>
            <br><a class="ac-c-btn" id="cookie_policy" href="javascript:void(0)" title="Okay, Thanks">Okay, Thanks</a>
        </div>
    </div>
@endif
<!-- Cookies E -->