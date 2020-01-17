<div class="sidebar sidebar-dark bg-dark">
    <ul class="list-unstyled">
        <li class="active"><a href="{{ url('home') }}"><i class="fa fa-fw fa-tachometer-alt"></i> {{__('Dashboard')}}</a></li>
        <li id="allbranch"><a href="{{ route('manager.branchlist') }}"><i class="fa fa-fw fa-plus"></i> {{__('All Branch')}}</a></li>
        <li>
            <a href="#branchCustomer" data-toggle="collapse">
                <i class="fa fa-fw fa-user"></i> {{__('Branch Customer Info')}}
            </a>
            <ul id="branchCustomer" class="list-unstyled collapse">
                <li><a href="{{ route('branchcustomer.create') }}"><i class="far fa-circle"></i> {{__('Add New Customer')}}</a></li>
                <li><a href="{{ route('branchcustomer.index') }}"><i class="far fa-circle"></i> {{__('Manage Customer')}}</a></li>
            </ul>
        </li>
        <li>
            <a href="#colisInfo" data-toggle="collapse">
                <i class="fa fa-fw fas fa-list"></i> {{__('Colis Info')}}
            </a>
            <ul id="colisInfo" class="list-unstyled collapse">
                <li><a href="{{ route('departure.manager') }}"><i class="far fa-circle"></i> {{__('Departure Colis')}}</a></li>
                <li><a href="{{ route('upcoming.manager') }}"><i class="far fa-circle"></i> {{__('Upcoming Colis')}}</a></li>
            </ul>
        </li>

        <li id="branchIncome"><a href="{{ route('manager.branch.income') }}"><i class="fa fa-fw fa-money-bill-alt"></i>{{__('Branch Income')}} </a></li>
        <li>
            <a href="#zz" data-toggle="collapse">
                <i class="fa fa-fw fas fa-user"></i>{{__('Driver')}} 
            </a>
            <ul id="zz" class="list-unstyled collapse">
                <li><a href="{{ route('drivers.list') }}"><i class="far fa-circle"></i> {{__('Drivers List')}}</a></li>
                <li><a href="{{ route('drivers.create') }}"><i class="far fa-circle"></i> {{__('Create New Driver')}}</a></li>
            </ul>
        </li>
    </ul>
</div>