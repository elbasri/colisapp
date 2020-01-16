<div class="sidebar sidebar-dark bg-dark" id="siddebar">
    <ul class="list-unstyled">
        <li id="home"><a href="{{ route('staff.dashboard') }}"><i class="fa fa-fw fa-tachometer-alt"></i>{{__('Dashboard')}} </a></li>       
        <li id="home"><a href="{{ route('staff.add') }}"><i class="fa fa-fw fa-tachometer-alt"></i>{{__('Add')}} </a></li>       
        <li id="deliver"><a href="{{ route('currier.deliver.search') }}"><i class="fa fa-fw fa-cart-arrow-down"></i>{{__('Courier')}} </a></li>
        <li id="notify"><a href="{{ route('currier.deliver.notify') }}"><i class="fa fa-fw fa-envelope"></i>{{__('Send Deliver Notification')}} </a></li>
        <li id="branchIncome"><a href="{{ route('staff.cashe.collection') }}"><i class="fa fa-fw fa-money-bill-alt"></i>{{__('Cash Collection')}} </a></li>
    </ul>
</div>