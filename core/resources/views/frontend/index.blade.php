@extends('frontend.layouts.master')
@section('content')
<!-- banner Area Start -->
<section id="banner" class="banner">
    <div class="sectionOverlay"></div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="content">
                    <h1>
                        {{ $gs->header_title }}
                    </h1>
                    <p class="tagline">
                        {{ $gs->header_subtitle }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Welcome Area End -->

<!-- Qurrier Search Section Start -->
<section id="colis-search" class="yogaclasses">
    <div class="container">
        <div class="row justify-content-center mb-4 pb-4">
            <div class="col-md-10 col-xl-8">
                <div class="sectionTheading">
                    <h2>
                        {{ $gs->search_colis_title }}
                    </h2>
                    <p>
                        {{ $gs->search_colis_details }}
                    </p>
                </div>
            </div>
        </div>
        <form action="{{ route('search.colis') }}" method="POST">
            @csrf
            <div class="row SelectArea">
                <div class="col-md-6 col-lg-6 offset-1 offset-md-1">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1" style="color: #EE005F;">
                                <i class="fa fa-truck" aria-hidden="true"></i>
                            </span>
                        </div>
                        <input type="text" name="colis_invoice" class="form-control form-control-lg invoice-search" aria-describedby="basic-addon1" value="{{request()->colis_invoice}}" placeholder="{{__('Enter Parcel Code/Invoice')}}">
                    </div>
                </div>
                <div class="col-md-4 col-lg-4 d-flex align-self-end">
                    <div class="submitBtnWrapper">
                        <button type="submit">{{__('Search')}}</button>
                    </div>
                </div>
            </div>
        </form>
        @if(!empty(Session::get('colisInfo')))
        @php
        $list = Session::get('colisInfo')
        @endphp
        <div class="col-md-10 col-lg-10 offset-1 p-0">
            <div class="table-responsive table-bordered">
                <table class="table colis-result">
                    <thead>
                        <tr>
                            <th>{{__('Invoice No')}}</th>
                            <th>{{__('Parcel Date')}}</th>
                            <th>{{__('Sender Name')}}</th>
                            <th>{{__('Recipient Branch')}}</th>
                            <th>{{__('Recipient Name')}}</th>
                            <th>{{__('Status')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="paddingTop">
                                {{ $list->invoice_id }}
                            </td>
                            <td>
                                <p>
                                    {{ $list->created_at->toDateString() }}
                                </p>
                            </td>
                            <td>
                                <p>
                                    {{ $list->sender_name }}
                                </p>
                            </td>
                            <td>
                                <p>
                                    {{ $list->branch->name }}
                                </p>
                            </td>
                            <td>
                                <p>
                                    {{ $list->receiver_name }}
                                </p>
                            </td>
                            <td>
                                @if($list->status  == 'Delivered')
                                <span class="btn btn-sm btn-danger text-uppercase">{{__('Delivered')}}</span>
                                @else
                                <span class="btn btn-sm btn-success text-uppercase">{{__('Received')}}</span>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        @endif
    </div>
</section>
<!-- Qurrier Search Section End -->
<!-- service page content area start-->
<section class="faq-page-content-area service-colis">
    <div class="container">
        <div class="row justify-content-center mb-4 pb-4">
            <div class="col-md-10 col-xl-8">
                <div class="sectionTheading">
                    <h2>
                        {{ $gs->service_title }}
                    </h2>
                    <p>
                        {{ $gs->service_details }}
                    </p>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach($serviceList as $key=>$service)
            <div class="col-lg-4 col-md-4">
                <div class="single-faq-item">
                    <!-- single faq item -->
                    <div class="number">
                        {!! $service->icon !!}
                    </div>
                    <div class="content">
                        <h4 class="title">{{ $service->title }}</h4>
                        <p>{!! $service->details !!}</p>
                    </div>
                </div><!-- //. single faq item -->
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- service page content area end -->

<!-- price page content area start-->
<section class="faq-page-content-area service-colis">
    <div class="container">
        <div class="row justify-content-center mb-4 pb-4">
            <div class="col-md-10 col-xl-8">
                <div class="sectionTheading">
                    <h2>
                        {{ $gs->price_title }}
                    </h2>
                    <p>
                        {{ $gs->price_details }}
                    </p>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach($priceList as $key=>$price)
            <div class="col-lg-3 col-md-3">
                <div class="single-faq-item">
                    <!-- single faq item -->
                    <div class="number">
                        {!! $price->price !!} {{__('DH')}}
                    </div>
                    <div class="content">
                        <h4 class="title">{{ $price->city }}</h4>
                        <p>{!! $price->details !!}</p>
                    </div>
                </div><!-- //. single faq item -->
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- price page content area end -->
<!-- Counter Area Start -->
<section id="counter" class="counter">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-lg-4">
                <div class="c-box">
                    <p class="count">{{ $gs->departure_colis }}</p><span>+</span>
                    <h3>{{__('Parcels Departure')}}</h3>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="c-box">
                    <p class="count">{{ $gs->upcoming_colis }}</p><span>+</span>
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
    $(document).ready(function () {
    @if (Session::has('search'))
            $("#replace").addClass("active");
            @endif

            if (window.location.hash == "#colis-search") {
    $(".nav-link").removeClass("active");
            $("#qurrierSearch").addClass("active");
    }
    ;
            if (window.location.hash == "#topClasses") {
    $(".nav-link").removeClass("active");
            $("#gallery").addClass("active");
    }
    ;
            if (window.location.hash == "#testimonial") {
    $(".nav-link").removeClass("active");
            $("#testimonial2").addClass("active");
    }
    ;
    });
</script>
@endsection

