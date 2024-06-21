<style>
    .dropdown-menu {
        display: none;
        transition: none;
        /* Disable transitions */
        animation: none;
        /* Disable animations */

    }
    .user-menu:hover .dropdown-menu {
        display: block;
    }
    .user-header{
        border-radius: 20px !important;
    }
    .dropdown-menu{
        border-radius: 20px !important;
    }
    .user-body{
        border-radius: 20px !important;
    }
    .user-footer{
        border-radius: 20px !important;
    }
    .user-footer button:hover{
       font-size: 20px;
       text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
    }
</style>
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>

    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        {{-- <li class="nav-item">
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
      </li> --}}

        <li class="nav-item dropdown user-menu" id="userDropdown">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                {{-- User Image --}}
                @auth
                    @if (Auth::check())
                        @if (Auth::user()->profile)
                            <img src="{{ asset('P_images/' . Auth::user()->profile) }}" alt="User Profile"
                                class="user-image img-circle elevation-2" width="70px">
                        @else
                            <img src="{{ asset('AdminLTE/dist/img/avatar5.png') }}" alt="User Profile"
                                class="user-image img-circle elevation-4" width="70px">
                        @endif
                    @endif
                @endauth
                {{-- User Name --}}
                <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;"
                id="userDropdown">
                <!-- User header -->
                <li class="user-header bg-primary">
                    <img src="{{ asset('P_images/' . Auth::user()->profile) }}" class="img-circle elevation-2"
                        alt="User Image">
                    <p>
                        {{ Auth::user()->name }}
                        <small>
                            @php
                                $user = Auth::user();
                                $roleNames = !empty($user) ? $user->getRoleNames()->toArray() : [];
                            @endphp
                            @if (!empty($roleNames))
                                {{ implode(', ', $roleNames) }}
                            @else
                                {{ __('No Roles') }}
                            @endif
                            since {{ Auth::user()->created_at->format('Y-m-d') }}
                        </small>
                    </p>
                </li>
                <!-- Menu Body -->
                <li class="user-body">
                    <div class="row">
                        <div class="col-4 text-center">
                            <a href="#">Followers</a>
                        </div>
                        <div class="col-4 text-center">
                            <a href="#">Sales</a>
                        </div>
                        <div class="col-4 text-center">
                            <a href="#">Friends</a>
                        </div>
                    </div>
                    <!-- /.row -->
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-default btn-flat float-right">Sign out</button>
                    </form>
                </li>
            </ul>
        </li>

        <li class="nav-item mr-4">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
        {{-- <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li> --}}
        {{-- <li class="nav-item">
            @auth
                @if (Auth::check())
                    @if (Auth::user()->profile)
                        <img src="{{ asset('P_images/' . Auth::user()->profile) }}" alt="User Profile"
                            class="rounded-circle" width="40px">
                    @else
                        <img src="{{ asset('AdminLTE') }}/dist/img/avatar5.png" alt="User Profile" class="rounded-circle"
                            width="40px">
                    @endif
                @endif
            @endauth
        </li> --}}
        {{-- <li class="nav-item">
            <ul class="navbar-nav ms-auto mr-2">
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            @php
                                $user = Auth::user();
                                $roleNames = !empty($user) ? $user->getRoleNames()->toArray() : [];
                            @endphp
                            @if (!empty($roleNames))
                                {{ implode(', ', $roleNames) }}
                            @else
                                {{ __('No Roles') }}
                            @endif
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </li> --}}
    </ul>

</nav>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
