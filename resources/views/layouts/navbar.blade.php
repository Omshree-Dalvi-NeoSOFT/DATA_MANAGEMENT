
<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{route('home')}}" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>

         <!-- Extend Screen -->
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="javascript:void(0)" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      @guest
          @if (Route::has('login'))
              <li class="nav-item">
                  <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
              </li>
          @endif

      @else
        <li class="navbar-nav ml-auto">
            <div class="nav-item" >
                <a class="nav-link" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i> {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </li>
      @endguest
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('home')}}" class="brand-link">
      <img src="{{asset('dist/img/shopinglogo.jpg')}}" alt="ShopingKart Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Data Management</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('dist/img/user8-128x128.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="javascript:void(0)" class="d-block">{{ Auth::user()->firstname}}</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          <!-- User Management -->
          <li class="nav-item {{ request()->is('adduser') || request()->is('showuser') || request()->is('showuser/trash') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ request()->is('adduser') || request()->is('showuser') || request()->is('showuser/trash') ? 'active' : '' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p class="{{ request()->is('adduser') || request()->is('showuser') || request()->is('showuser/trash') ? 'text-white' : '' }}">
                User Management
                <i class="fas fa-angle-left right "></i>
                <span class="badge badge-info right"></span>
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2 )
                <li class="nav-item">
                  <a href="{{route('user.index')}}" class="nav-link {{ request()->is('adduser') ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p class=" {{ request()->is('adduser') ? 'text-dark' : '' }}">Add User</p>
                  </a>
                </li>
              @endif
              <li class="nav-item">
                <a href="{{route('user.show')}}" class="nav-link {{ request()->is('showuser') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p class="{{ request()->is('showuser') ? 'text-dark' : '' }}">View User</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('user.showtrash')}}" class="nav-link {{ request()->is('showuser/trash') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p class="{{ request()->is('showuser/trash') ? 'text-dark' : '' }}">Trash User</p>
                </a>
              </li>
            </ul>
          </li>

          @if (Auth::user()->role_id == 1)
            <!-- Role -->
            <li class="nav-item">
              <a href="{{route('role.show')}}" class="nav-link {{ request()->is('cms') || request()->is('displaycms')  ? 'active' : '' }}">
              <i class="nav-icon fas fa-columns"></i>
              <p class="{{ request()->is('cms') || request()->is('displaycms')  ? 'text-white' : '' }}">
                Role
              </p>
            </a>
          </li>
          @endif
          
        </ul>
      
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>