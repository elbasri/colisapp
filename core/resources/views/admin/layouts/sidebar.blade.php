<div class="sidebar sidebar-dark bg-dark">
    <ul class="list-unstyled">
        <li class="active"><a href="{{ route('admin.dashboard') }}"><i class="fa fa-fw fa-tachometer-alt"></i> {{__('Dashboard')}}</a></li>
        <li>
            <a href="#settings" data-toggle="collapse">
                <i class="fa fa-fw fa-globe"></i> {{__('Website Setting')}}
            </a>
            <ul id="settings" class="list-unstyled collapse">
                <li><a href="{{ route('admin.basicSetting') }}"><i class="fa fa-cog"></i> {{__('Basic Settings')}}</a></li>
                <li><a href="{{ route('admin.smsSetting') }}"><i class="fa fa-phone"></i> {{__('SMS Settings')}}</a></li>
                <li><a href="{{ route('admin.emailSetting') }}"><i class="fa fa-envelope"></i> {{__('Email Settings')}}</a></li>
            </ul>
        </li>
        <li>
            <a href="#colisSetting" data-toggle="collapse">
                <i class="fa fa-fw fa-cog"></i> {{__('Colis Setting')}}
            </a>
            <ul id="colisSetting" class="list-unstyled collapse">
                <li><a href="{{ route('unit.index') }}"><i class="far fa-circle"></i>&nbsp;{{__('Manage Unit')}}</a></li>
                <li><a href="{{ route('type.index') }}"><i class="far fa-circle"></i>&nbsp;{{__('Manage Type')}}</a></li>
            </ul>
        </li>
        <li>
            <a href="#branch" data-toggle="collapse">
                <i class="fa fa-fw fa-address-card"></i> {{__('Branch Info')}}
            </a>
            <ul id="branch" class="list-unstyled collapse">
                <li><a href="{{ route('branch.create') }}"><i class="far fa-circle"></i> {{__('Add New Branch')}}</a></li>
                <li><a href="{{ route('branch.index') }}"><i class="far fa-circle"></i> {{__('Manage Branch')}}</a></li>
            </ul>
        </li>
        <li>
            <a href="#branchManager" data-toggle="collapse"> 
                <i class="fa fa-fw fa-users"></i> {{__('Branch Manager Info')}}
            </a>
            <ul id="branchManager" class="list-unstyled collapse">
                <li><a href="{{ route('branchmanager.create') }}"><i class="far fa-circle"></i> {{__('Add Manager')}}</a></li>
                <li><a href="{{ route('branchmanager.index') }}"><i class="far fa-circle"></i> {{__('Manage Manager')}}</a></li>
            </ul>
        </li>
        
        <li id="companyIncomeList"><a href="{{ route('admin.company.income') }}"><i class="fa fa-fw fa-money-bill-alt"></i>&nbsp;{{__('Company Income')}}</a></li>
        <li>
            <a href="#frontend" data-toggle="collapse">
                <i class="fa fa-fw fa-list"></i> {{__('Frontend Setting')}}
            </a>
            <ul id="frontend" class="list-unstyled collapse ">
                <li><a href="{{ route('frontend.logoicon') }}"><i class="far fa-circle"></i>&nbsp;{{__('Logo+icon')}}</a></li>
                <li><a href="{{ route('frontend.social') }}"><i class="far fa-circle"></i>&nbsp;{{__('Social Link')}}</a></li>
                <li><a href="{{ route('frontend.background') }}"><i class="far fa-circle"></i>&nbsp;{{__('Background Image')}}</a></li>
                <li><a href="{{ route('frontend.headertext') }}"><i class="far fa-circle"></i> {{__('Banner Text')}}</a></li>
                <li><a href="{{ route('frontend.coliscount') }}"><i class="far fa-circle"></i> {{__('Colis Count Info')}}</a></li>
                <li><a href="{{ route('frontend.services') }}"><i class="far fa-circle"></i> {{__('Service Setting')}}</a></li>
                <li><a href="{{ route('frontend.prices') }}"><i class="far fa-circle"></i> {{__('Prices List')}}</a></li>
                <li><a href="{{ route('frontend.aboutus') }}"><i class="far fa-circle"></i> {{__('About Us')}}</a></li>
                <li><a href="{{ route('frontend.contactus') }}"><i class="far fa-circle"></i> {{__('Contact')}}</a></li>
                <li><a href="{{ route('frontend.searchcolis') }}"><i class="far fa-circle"></i> {{__('Search Colis')}}</a></li>
                <li><a href="{{ route('frontend.footer') }}"><i class="far fa-circle"></i> {{__('Footer')}}</a></li>
                <li><a href="{{ route('frontend.faq') }}"><i class="far fa-circle"></i> {{__('Faq')}}</a></li>
            </ul>
        </li>
        <li id="visitorMessage"><a href="{{ route('frontend.visitorMessage') }}"><i class="fa fa-fw fa-tachometer-alt"></i> {{__('Messages')}}</a></li>
    </ul>
</div>