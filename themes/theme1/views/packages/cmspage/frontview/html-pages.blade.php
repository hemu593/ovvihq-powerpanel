@extends('layouts.app')
@section('content')
    @include('layouts.inner_banner')

    @if($pageName == 'about-us')
        @include('cmspage::frontview.html-pages.about-us')
    @elseif($pageName == 'who-we-are')
        @include('cmspage::frontview.html-pages.who-we-are')
    @elseif($pageName == 'legislation-regulation')
        @include('cmspage::frontview.html-pages.legislation-regulation')
    @elseif($pageName == 'board-of-directors-meetings')
        @include('cmspage::frontview.html-pages.board-of-directors-meetings')
    @elseif($pageName == 'industry-statistics')
        @include('cmspage::frontview.html-pages.industry-statistics')
    @elseif($pageName == 'strategic-plan')
        @include('cmspage::frontview.html-pages.strategic-plan')
    @elseif($pageName == 'annual-plan')
        @include('cmspage::frontview.html-pages.annual-plan')
    @elseif($pageName == 'budget')
        @include('cmspage::frontview.html-pages.budget')
    @elseif($pageName == 'foi')
        @include('cmspage::frontview.html-pages.foi')
    @elseif($pageName == 'consumer')
        @include('cmspage::frontview.html-pages.consumer')
    @elseif($pageName == 'how-to-make-a-complaint')
        @include('cmspage::frontview.html-pages.how-to-make-a-complaint')
    @elseif($pageName == 'on-line-complaint-form')
        @include('cmspage::frontview.html-pages.on-line-complaint-form')
    @elseif($pageName == 'introduction')
        @include('cmspage::frontview.html-pages.about-ict-introduction')
    @elseif($pageName == 'licensing')
        @include('cmspage::frontview.html-pages.ict-licensing') 
    @elseif($pageName == 'types-of-licenses')
        @include('cmspage::frontview.html-pages.ict-types-of-licenses')
    @elseif($pageName == 'register-of-applications-detail')
        @include('cmspage::frontview.html-pages.register-of-applications-detail') 
    @elseif($pageName == 'legislation-regulations' || $pageName == 'gazette-notices')
        @include('cmspage::frontview.html-pages.ict-legislation-regulations')
    @elseif($pageName == 'reports-guidelines')
        @include('cmspage::frontview.html-pages.ict-reports-guidelines-rules')
    @elseif($pageName == 'terms-of-use')
        @include('cmspage::frontview.html-pages.ict-terms-of-use')
    @elseif($pageName == 'dispute-resolution-decisions')
        @include('cmspage::frontview.html-pages.ict-dispute-resolution-decisions')
    @elseif($pageName == 'others')
        @include('cmspage::frontview.html-pages.ict-others')
    @elseif($pageName == 'icta-forms-pole-attachment-working-group')
        @include('cmspage::frontview.html-pages.icta-forms-pole-attachment-working-group')
    @elseif($pageName == 'the-risks-of-text-messages-for-user-authentication-paper')
        @include('cmspage::frontview.html-pages.ict-the-risks-of-text-messages-for-user-authentication-paper')
    @elseif($pageName == 'ict-decisions')
        @include('cmspage::frontview.html-pages.ict-decisions')
    @elseif($pageName == 'determination-requests')
        @include('cmspage::frontview.html-pages.ict-determination-requests')
    @elseif($pageName == 'domain-policies')
        @include('cmspage::frontview.html-pages.ict-domain-policies')
    @elseif($pageName == 'dispute-resolution-policy')
        @include('cmspage::frontview.html-pages.ict-dispute-resolution-policy')
    @elseif($pageName == 'registering-a-domain-name')
        @include('cmspage::frontview.html-pages.ict-registering-a-domain-name')
    @elseif($pageName == 'whois-information')
        @include('cmspage::frontview.html-pages.ict-whois-information')
    @elseif($pageName == 'broadcasting-introduction')
        @include('cmspage::frontview.html-pages.ict-broadcasting-introduction')
    @elseif($pageName == 'broadcasting-regulations')
        @include('cmspage::frontview.html-pages.ict-broadcasting-regulations')
    @elseif($pageName == 'tv-broadcasting-stations')
        @include('cmspage::frontview.html-pages.tv-broadcasting-stations')
    @elseif($pageName == 'spectrum-map')
        @include('cmspage::frontview.html-pages.spectrum-map')
    @elseif($pageName == 'number-nxx-allocations')
        @include('cmspage::frontview.html-pages.number-nxx-allocations')
    @elseif($pageName == 'licence-register-detail')
        @include('cmspage::frontview.html-pages.licence-register-detail')
    @elseif($pageName == 'radio-introduction')
        @include('cmspage::frontview.html-pages.radio-introduction')
    @elseif($pageName == 'radio-regulations')
        @include('cmspage::frontview.html-pages.radio-regulations')
    @elseif($pageName == 'radio-type-approval')
        @include('cmspage::frontview.html-pages.radio-type-approval')
    @elseif($pageName == 'amateur-radio')
        @include('cmspage::frontview.html-pages.amateur-radio')
    @elseif($pageName == 'aircraft-radio')
        @include('cmspage::frontview.html-pages.aircraft-radio')
    @elseif($pageName == 'radio-land-mobile')
        @include('cmspage::frontview.html-pages.radio-land-mobile')
    @elseif($pageName == 'radio-dealer')
        @include('cmspage::frontview.html-pages.radio-dealer')
    @elseif($pageName == 'ship-radio')
        @include('cmspage::frontview.html-pages.ship-radio')
    @elseif($pageName == 'numbering-policy')
        @include('cmspage::frontview.html-pages.ict-numbering-policy')
    @elseif($pageName == 'cw-tariffs')
        @include('cmspage::frontview.html-pages.ict-cw-tariffs')
    @elseif($pageName == 'compliance1')
        @include('cmspage::frontview.html-pages.ict-compliance')
    @elseif($pageName == 'telecoms-introduction')
        @include('cmspage::frontview.html-pages.telecoms-introduction')
    @elseif($pageName == 'telecoms-regulations')
        @include('cmspage::frontview.html-pages.telecoms-regulations')
    @elseif($pageName == 'ky-domain-introduction')
        @include('cmspage::frontview.html-pages.ky-domain-introduction')
    @elseif($pageName == 'ict-1')
        @include('cmspage::frontview.html-pages.ict-1')
    @elseif($pageName == 'ky-domain-dispute-decisions')
        @include('cmspage::frontview.html-pages.ky-domain-dispute-decisions')
    @elseif($pageName == 'application-forms-and-fees')
        @include('cmspage::frontview.html-pages.application-forms-and-fees')
    @elseif($pageName == 'retail-fuel-prices')
        @include('cmspage::frontview.html-pages.retail-fuel-prices')
    @elseif($pageName == 'poll')
        @include('cmspage::frontview.html-pages.poll')
    @elseif($pageName == 'pay')
        @include('cmspage::frontview.html-pages.pay')
    @elseif($pageName == 'search')
        @include('cmspage::frontview.html-pages.search')
    @else 
        <section class="inner-page-gap">
            @include('layouts.share-email-print')

            <div class="container">
                <div class="row">
                    <div class="col-12 text-center" data-aos="fade-up">
                        <div class="nqtitle n-fw-800 n-lh-110 text-uppercase">Coming Soon...</div>
                        <div class="desc n-fs-20 n-fw-500 n-lh-130">We are currently working on a new super awesome page.</div>
                    </div>  
                </div>
            </div>  
        </section>
    @endif
@endsection

@section('footer_scripts')
    <script src="{{ $CDN_PATH.'assets/libraries/bootstrap-select-master/1.13.14/js/bootstrap-select.min.js' }}" defer></script>
@endsection

