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
                        {{__('How Its Work')}}
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
                                <a class="active" href="{{ route('front.faq') }}">{{__('How Its Work')}}</a>
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
            @foreach($faqList as $key=>$faq)
            <div class="col-lg-4 col-md-6">
                <div class="single-faq-item">
                    <!-- single faq item -->
                    <div class="number">
                        {{ $key+1 }}
                    </div>
                    <div class="content">
                        <h4 class="title">{{ $faq->question }}</h4>
                        <p>{{ $faq->answer }}</p>
                    </div>
                </div><!-- //. single faq item -->
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- faq page content area end -->


<script type="text/javascript">
    $("#home").removeClass("active");
    $("#aboutus").removeClass("active");
    $("#faq").addClass("active");
</script>
@endsection