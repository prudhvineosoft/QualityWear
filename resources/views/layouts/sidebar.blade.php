<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
</head>

<body>
  <aside class="main-sidebar sidebar-dark-primary bg-color elevation-4 ">



    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <div class="image pl-1">
        <img src="{{ asset('images/logo.png') }}" alt="logo" width="50">
        <span class="brand-text font-weight-light brand-name">Quality Wear</span>
      </div>
    </a>

    <!-- Sidebar -->
    <div class="fix-sidebar">
      <div class="sidebar fixed">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel d-flex align-items-center  name">
          <div class="image pl-3">
            <i class="fas fa-user"></i>
          </div>
          <div class="info  ml-3">
            <a href="/dashboard" class="name">{{ Auth::user()->name }}</a>
          </div>
        </div>

        <!-- SidebarSearch Form -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                 with font-awesome or any other icon font library -->
            @if(Auth::user()->hasRole('admin|superadmin'))
            <li class="nav-item mt-2">
              <a href="/dashboard/users" class="nav-link {{ (request()->is('dashboard/users*'))  ? 'active' : '' }}">
                <i class="fas fa-users nav-icon"></i>
                <p>
                  User Management
                  <span class="right badge badge-danger">New</span>
                </p>
              </a>
            </li>
            @endif
            @if(Auth::user()->hasRole('admin|superadmin|inventory manager'))
            <li class="nav-item menu-open mt-2">
              <a href="#" class="nav-link ">
                <i class="fas fa-warehouse nav-icon"></i>
                <p>
                  Inventry Management
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="/dashboard/category "
                    class="nav-link {{ (request()->is('dashboard/category*'))  ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Category Management</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/dashboard/product "
                    class="nav-link {{ (request()->is('dashboard/product*'))  ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Product Management</p>
                  </a>
                </li>
              </ul>
            </li>
            @endif
            @if(Auth::user()->hasRole('admin|superadmin|order manager') )
            <li class="nav-item mt-2">
              <a href="/dashboard/orderManagement"
                class="nav-link {{ (request()->is('dashboard/orderManagement*'))  ? 'active' : '' }}">
                <i class="fas fa-boxes nav-icon"></i>
                <p>
                  Order Management
                </p>
              </a>
            </li>
            @endif
            @if(Auth::user()->hasRole('admin|superadmin|order manager'))
            <li class="nav-item mt-2">
              <a href="/dashboard/banner" class="nav-link {{ (request()->is('dashboard/banner*'))  ? 'active' : '' }}">
                <i class=" fas fa-bullhorn nav-icon"></i>
                <p>
                  Banner Management
                </p>
              </a>
            </li>
            @endif
            @if(Auth::user()->hasRole('admin|superadmin'))
            <li class="nav-item mt-2">
              <a href="/dashboard/coupon" class="nav-link {{ (request()->is('dashboard/coupon*'))  ? 'active' : '' }}">
                <i class="fas fa-ticket-alt nav-icon"></i>
                <p>
                  Coupon Management
                </p>
              </a>
            </li>
            @endif
            @if(Auth::user()->hasRole('admin|superadmin'))
            <li class="nav-item mt-2">
              <a href="/dashboard/contacts"
                class="nav-link {{ (request()->is('dashboard/contacts*'))  ? 'active' : '' }}">
                <i class="far fa-id-badge nav-icon"></i>
                <p>
                  Contact Us
                </p>
              </a>
            </li>
            @endif
            @if(Auth::user()->hasRole('admin|superadmin'))
            <li class="nav-item mt-2">
              <a href="/dashboard/config" class="nav-link {{ (request()->is('dashboard/config*'))  ? 'active' : '' }}">

                <i class="fab fa-airbnb nav-icon"></i>
                <p>
                  Config Management
                </p>
              </a>
            </li>
            @endif
            @if(Auth::user()->hasRole('admin|superadmin'))
            <li class="nav-item mt-2">
              <a href="/dashboard/cms" class="nav-link {{ (request()->is('dashboard/cms*'))  ? 'active' : '' }}">
                <i class="fab fa-staylinked nav-icon"></i>
                <p>
                  CMS
                </p>
              </a>
            </li>
            @endif
            @if(Auth::user()->hasRole('admin|superadmin'))
            <li class="nav-item mt-2">
              <a href="/dashboard/reports"
                class="nav-link {{ (request()->is('dashboard/reports*'))  ? 'active' : '' }}">
                <i class="fas fa-bug nav-icon"></i>
                <p>
                  Reports
                </p>
              </a>
            </li>
            @endif
          </ul>

        </nav>


        <!-- /.sidebar-menu -->
      </div>
    </div>
    <!-- /.sidebar -->
  </aside>
</body>

</html>