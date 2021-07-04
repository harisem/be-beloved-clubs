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

            @can('is-admin')
            <li><a class="nav-link" href="credits.html"><i class="fas fa-id-card-alt"></i> <span>Customers</span></a></li>
            @endcan

            <li><a class="nav-link" href="credits.html"><i class="fas fa-file-invoice"></i> <span>Invoices</span></a></li>
            <li><a class="nav-link" href="credits.html"><i class="fas fa-receipt"></i> <span>Orders</span></a></li>

            @can('is-marketing')
            <li><a class="nav-link" href="credits.html"><i class="fas fa-folder"></i> <span>Posts</span></a></li>
            @endcan

            <li><a class="nav-link" href="credits.html"><i class="fas fa-archive"></i> <span>Products</span></a></li>

            @can('is-owner')
            <li class="{{ request()->routeIs('users.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('users.index') }}"><i class="fas fa-user-tie"></i> <span>Employees</span></a></li>
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