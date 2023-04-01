<div class="sidebar sidebar-dark sidebar-fixed" id="sidebar">
    <div class="sidebar-brand d-none d-md-flex">
        <!-- <svg class="sidebar-brand-full" width="118" height="46" alt="CoreUI Logo">
            <use xlink:href="{{asset('admin/coreui/assets/brand/coreui.svg#full')}}"></use>
        </svg> -->
        <span> <img src="{{asset('admin/coreui/assets/img/baf_logo.png')}}"  height="60" width="50"></span> 
        <svg class="sidebar-brand-narrow" width="46" height="46" alt="CoreUI Logo">
            <use xlink:href="{{asset('admin/coreui/assets/brand/coreui.svg#signet')}}"></use>
        </svg>
    </div>

    <ul class="sidebar-nav" data-coreui="navigation" data-simplebar>
            <li class="nav-item">
                <a class="nav-link" href="{{route('dashboard')}}" style="color:white; font-weight:bold;">
                  &nbsp;&nbsp;<i class="fa fa-dashboard" style="font-size:20px;color:white"></i>
                  &nbsp;&nbsp;&nbsp;&nbsp;{{__('Dashboard')}} 
                </a>
            </li>

            <li class="nav-title" style="color:white;">&nbsp;&nbsp;&nbsp;Components</li>

            <li class="nav-group ">
                @can('administration-menu')
                <a class="nav-link nav-group-toggle" href="#" style="color:white; font-weight:bold;">
                  &nbsp;&nbsp;<i class="fa fa-user-circle" style="font-size:20px;color:white"></i>
                  &nbsp;&nbsp;&nbsp;&nbsp;{{__('Administration')}} 
                </a>
                @endcan

                <ul class="nav-group-items">
                 @can('user-sub-menu')
                 <li class="nav-item"><a class="nav-link" href="{{ route('users.index') }}" style="color:white;">Manage Users</a></li>
                 @endcan
                </ul>

                <ul class="nav-group-items">
                 @can('role-sub-menu')
                 <li class="nav-item"><a class="nav-link" href="{{ route('roles.index') }}" style="color:white;">Manage Role</a></li>
                 @endcan
                </ul>
            </li>

            <li class="nav-group ">
                @can('product-category-menu')
                <a class="nav-link nav-group-toggle" href="#" style="color:white; font-weight:bold;">
                  &nbsp;&nbsp;<i class="fa fa-database" style="font-size:20px;color:white"></i>
                  &nbsp;&nbsp;&nbsp;&nbsp;{{__('Product Category')}} 
                </a>
                @endcan

                <ul class="nav-group-items">
                 @can('product-category-sub-menu')
                 <li class="nav-item"><a class="nav-link" href="{{ route('medicineCategories.index') }}" style="color:white;">Product Category</a></li>
                 @endcan
                </ul>
            </li>

            <li class="nav-group ">
                @can('product-master-menu')
                <a class="nav-link nav-group-toggle" href="#" style="color:white; font-weight:bold;">
                  &nbsp;&nbsp;<i class="fa fa-cubes" style="font-size:20px;color:white"></i>
                  &nbsp;&nbsp;&nbsp;&nbsp;{{__('Product Master')}} 
                </a>
                @endcan

                <ul class="nav-group-items">
                 @can('product-list-sub-menu')
                 <li class="nav-item"><a class="nav-link" href="{{ route('products.index') }}" style="color:white;">Product List</a></li>
                 @endcan
                </ul>

                <ul class="nav-group-items">
                 @can('product-price-sub-menu')
                 <li class="nav-item"><a class="nav-link" href="{{ route('prices.index') }}" style="color:white;">Price List</a></li>
                 @endcan
                </ul>
            </li>

            <li class="nav-group ">
                @can('stock-master-menu')
                <a class="nav-link nav-group-toggle" href="#" style="color:white; font-weight:bold;">
                 &nbsp;&nbsp;<i class="fa fa-bars" style="font-size:20px;color:white"></i>
                 &nbsp;&nbsp;&nbsp;&nbsp;{{__('Stock Master')}} 
                </a>
                @endcan

                <ul class="nav-group-items">
                 @can('stock-list-sub-menu')
                 <li class="nav-item"><a class="nav-link" href="{{ route('inventories.index') }}" style="color:white;">Stock List</a></li>
                 @endcan
                </ul>
            </li>

            <li class="nav-group ">
                 @can('transaction-pos-menu')
                <a class="nav-link nav-group-toggle" href="#" style="color:white; font-weight:bold;">
                 &nbsp;&nbsp;<i class="fa fa-barcode" style="font-size:20px;color:white"></i>
                 &nbsp;&nbsp;&nbsp;&nbsp;{{__('Transaction / POS')}} 
                </a>
                @endcan

                <ul class="nav-group-items">
                 @can('pos-sub-menu')
                 <li class="nav-item"><a class="nav-link" href="{{ route('sales.index') }}" style="color:white;">Sales</a></li>
                 @endcan
                </ul>
            </li>


            <li class="nav-group ">
                 @can('miscExpenditure-menu')
                <a class="nav-link nav-group-toggle" href="#" style="color:white; font-weight:bold;">
                 &nbsp;&nbsp; <i class="fa fa-money" style="font-size:20px;color:white"></i>
                 &nbsp;&nbsp;&nbsp;&nbsp;{{__('Misc Expenditure')}} 
                </a>
                @endcan

                <ul class="nav-group-items">
                 @can('miscExpenditure-menu')
                 <li class="nav-item"><a class="nav-link" href="{{ route('miscExpenditures.index') }}" style="color:white;">Miscellaneous Expense</a></li>
                 @endcan
                </ul>
            </li>

            <li class="nav-group ">
                @can('report-menu')
                <a class="nav-link nav-group-toggle" href="#" style="color:white; font-weight:bold;">
                 &nbsp;&nbsp;<i class="fa fa-registered" style="font-size:20px;color:white"></i>
                 &nbsp;&nbsp;&nbsp;&nbsp;{{__('Reports')}} 
                </a>
                @endcan

                <ul class="nav-group-items">
                 <li class="nav-item"><a class="nav-link" href="{{ url('/stock_available_report') }}" style="color:white;">Stock Available Rpt</a></li>
                </ul>
                
                <ul class="nav-group-items">
                 <li class="nav-item"><a class="nav-link" href="{{ url('/stock_unavailable_report') }}" style="color:white;">Stock Unavailable Rpt</a></li>
                </ul>

                <ul class="nav-group-items">
                 <li class="nav-item"><a class="nav-link" href="{{ url('/date_expired_report') }}" style="color:white;">Date Expired Rpt</a></li>
                </ul>

                <ul class="nav-group-items">
                 <li class="nav-item"><a class="nav-link" href="{{ url('/datewise_sales_report') }}" style="color:white;">Date Wise Sales Rpt</a></li>
                </ul>

                <ul class="nav-group-items">
                 <li class="nav-item"><a class="nav-link" href="{{ url('/datewise_purchase_report') }}" style="color:white;">Date Wise Purchase Rpt</a></li>
                </ul>
            </li>

            

    </ul>

    <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button>

</div>
