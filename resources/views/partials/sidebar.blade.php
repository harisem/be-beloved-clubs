<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">Beloved Clubs</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html"><i class="fas fa-heart"></i></a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="{{ request()->routeIs('dashboard') ? 'active' : '' }}"><a href="{{ route('dashboard') }}" class="nav-link"><i class="fas fa-fire"></i> <span>Dashboard</span></a></li>

            <li class="menu-header">Menu</li>

            @can('read catalogs')
                <li class="{{ request()->routeIs('catalogs.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('catalogs.index') }}"><i class="fas fa-layer-group"></i> <span>Catalogs</span></a></li>
            @endcan

            @can('read customers')
                <li><a class="nav-link" href="credits.html"><i class="fas fa-id-card-alt"></i> <span>Customers</span></a></li>
            @endcan

            @can('read users')
                <li class="{{ request()->routeIs('users.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('users.index') }}"><i class="fas fa-user-tie"></i> <span>Employees</span></a></li>
            @endcan

            @can('read invoices')
                <li><a class="nav-link" href="credits.html"><i class="fas fa-file-invoice"></i> <span>Invoices</span></a></li>
            @endcan

            @can('read orders')
                <li class="{{ request()->routeIs('orders.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('orders.index') }}"><i class="fas fa-receipt"></i> <span>Orders</span></a></li>
            @endcan

            @can('read products')
                <li class="{{ request()->routeIs('products.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('products.index') }}"><i class="fas fa-tshirt"></i> <span>Products</span></a></li>
            @endcan

            @can('read sliders')
                <li class="{{ request()->routeIs('sliders.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('sliders.index') }}"><i class="fas fa-columns"></i> <span>Sliders</span></a></li>
            @endcan

            @can('read warehouses')
                <li class="{{ request()->routeIs('warehouses.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('warehouses.index') }}"><i class="fas fa-cubes"></i> <span>Warehouses</span></a></li>
            @endcan
            
            <li class="menu-header">User</li>
            <li><a class="nav-link" href="credits.html"><i class="fas fa-user"></i> <span>Profile</span></a></li>
        </ul>
        
        <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <a href="https://getstisla.com/docs" class="btn btn-primary btn-lg btn-block btn-icon-split">
                <i class="fas fa-globe"></i> E-Commerce
            </a>
        </div>
    </aside>
</div>