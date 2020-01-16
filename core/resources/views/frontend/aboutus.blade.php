@extends('frontend.layouts.master')
@section('content')
<!-- banner Area Start -->
<section id="yogabreadcrumb" class="yogabreadcrumb">
    <div class="bcoverlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="Content">
                    <h2>
                        About Us
                    </h2>
                    <div class="links">
                        <ul>
                            <li>
                                <a href="{{ route('front.index') }}">{{__('Home')}}</a>
                            </li>
                            <li>
                                <span>/</span>
                            </li>
                            <li>
                                <a class="active" href="{{ route('front.aboutus') }}">{{__('About Us')}}</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Welcome Area End -->

<!-- faq page content area start-->
<section class="faq-page-content-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="single-faq-item">
                    <!-- single faq item -->
                    <div class="content">
                        <h4 class="title">{{ $gs->about_us_quote_one }}</h4>
                    </div>
                </div><!-- //. single faq item -->
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="single-faq-item">
                    <!-- single faq item -->
                    <div class="content">
                        <h4 class="title">{{ $gs->about_us_quote_two }}</h4>
                    </div>
                </div><!-- //. single faq item -->
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="single-faq-item">
                    <!-- single faq item -->
                    <div class="content">
                        <h4 class="title">{{ $gs->about_us_quote_three }}</h4>
                    </div>
                </div><!-- //. single faq item -->
            </div>
        </div>
    </div>
</section>
<!-- faq page content area end -->
<!-- error 404 page content area start -->
<div class="error-404-content-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="right-content-area">
                    <div class="details-text" style="text-align: left;">
                        <p>{!! $gs->aboutus_details !!}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="left-content-area">
                    <!-- left content area -->
                    <div class="img-wrapper">
                        <img class="img-fluid" src="{{asset('assets/frontend/images/aboutus.jpg')}}" alt="">
                    </div>
                </div><!-- //. left content area -->
            </div>
        </div>
    </div>
</div>
<!-- error 404 page content area end -->
<!-- Counter Area Start -->
<section id="counter" class="counter">
    <div class="container">
        <div class="row">
        <div class="col-md-6 col-lg-4">
                <div class="c-box">
                    <p class="count">{{ $gs->departure_currier }}</p><span>+</span>
                    <h3>{{__('Parcels Departure')}}</h3>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="c-box">
                    <p class="count">{{ $gs->upcoming_currier }}</p><span>+</span>
                    <h3>{{__('Upcoming Parcels')}}</h3>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="c-box">
                    <p class="count">{{ $gs->total_deliver }}</p><span>+</span>
                    <h3>{{__('Total Deliver')}}</h3>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Counter Area End -->

<script type="text/javascript">
    $("#home").removeClass("active");
    $("#aboutus").addClass("active");
</script>
@endsection

