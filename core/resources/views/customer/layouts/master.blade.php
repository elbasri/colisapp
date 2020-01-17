@include('customer/layouts/header')
<div class="d-flex">
    @include('customer/layouts/sidebar')
    @yield('content')
</div>
@include('customer/layouts/footer')