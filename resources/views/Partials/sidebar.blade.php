<aside class="main-sidebar sidebar-dark-primary elevation-4" >
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link" style="background-color: #994C00;">
      <img src="{{ asset('AdminLTE') }}/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('AdminLTE') }}/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">ChanthaIT</a>
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
          <li class="nav-item menu-open {{ request()->routeIs('front.home') ? 'menu-open' : '' }}">
            <a href="{{route('front.home')}}" class="nav-link {{ request()->routeIs('front.home') ? 'active' : '' }}">
                <i class="nav-icon fa-solid fa-house"></i>
              <p>
                   Home
              </p>
            </a>
          </li>
          <li class="nav-item {{ request()->routeIs('customer.*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ request()->routeIs('customer.*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Manage Customer
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('customer.index')}}" class="nav-link {{ request()->routeIs('customer.index') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>CustomerList</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('customertype.index')}}" class="nav-link {{ request()->routeIs('customertype.index') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>CutomerType</p>
                </a>
              </li>

            </ul>
          </li>
          <li class="nav-item">
            <a href="{{route('librarian.index')}}" class="nav-link {{ request()->routeIs('librarian.index') ? 'active' : '' }}">
                <i class="fa-solid fa-user-tie nav-icon"></i>
              <p>
                Librarian
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('book.index')}}" class="nav-link {{ request()->routeIs('book.index') ? 'active' : '' }}">
                <i class="nav-icon fa-solid fa-book"></i>
              <p>
                Book
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('catalog.index')}}" class="nav-link {{ request()->routeIs('catalog.index') ? 'active' : '' }}">
                <i class="fa-solid fa-book-bookmark nav-icon"></i>
              <p>
                Catalog
              </p>
            </a>
          </li>
          <li class="nav-item {{ request()->routeIs('borrow.*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ request()->routeIs('borrow.*') ? 'active' : '' }}">
                <i class="fa-solid fa-hand-holding nav-icon"></i>
              <p>
                Manage Borrow
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('borrow.index')}}" class="nav-link {{ request()->routeIs('borrow.index') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>BorrowList</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link {{ request()->routeIs('borrowdetail.index') ? 'active' : '' }}"">
                  <i class="far fa-circle nav-icon"></i>
                  <p>BorrowDetail</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ asset('AdminLTE') }}/pages/mailbox/read-mail.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Read</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-header">Profile</li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="fa-solid fa-user nav-icon"></i>
              <p>Profile</p>
            </a>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
