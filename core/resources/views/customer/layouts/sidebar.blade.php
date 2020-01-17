<div class="sidebar sidebar-dark bg-dark" id="siddebar">
    <ul class="list-unstyled">
        <li id="home"><a href="{{ route('customer.dashboard') }}"><i class="fa fa-fw fa-tachometer-alt"></i>{{__('Dashboard')}} </a></li>       
        <li id="home"><a href="{{ route('customer.add') }}"><i class="fa fa-fw fa-tachometer-alt"></i>{{__('Add')}} </a></li>       
        <li id="deliver"><a href="{{ route('colis.deliver.search') }}"><i class="fa fa-fw fa-cart-arrow-down"></i>{{__('Colis')}} </a></li>
        <li id="notify"><a href="{{ route('colis.deliver.notify') }}"><i class="fa fa-fw fa-envelope"></i>{{__('Send Deliver Notification')}} </a></li>
        <li id="branchIncome"><a href="{{ route('customer.cashe.collection') }}"><i class="fa fa-fw fa-money-bill-alt"></i>{{__('Cash Collection')}} </a></li>
    </ul>
</div>