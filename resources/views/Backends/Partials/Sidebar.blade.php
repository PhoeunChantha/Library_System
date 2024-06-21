<style>
    /* Set the background color for active main menu links */
    .nav-sidebar .nav-link.active {
        background-color: rgba(173, 72, 0, 1) !important;
        color: #fff !important;
        /* Optional: to ensure text color is readable */
    }

    /* Set the font color for active child menu links without changing their background */
    .nav-sidebar .nav-treeview .nav-link.active {
        color: rgba(255, 212, 58, 1) !important;
        background-color: transparent !important;
        /* Ensure no background color is set */
    }

    /* Optional: Default color for non-active child menu links */
    .nav-sidebar .nav-treeview .nav-link {
        color: rgba(255, 255, 255, 0.7);
        /* Adjust this color as needed */
    }

    /* Optional: Default color for non-active main menu links */
    .nav-sidebar .nav-link {
        color: rgba(255, 255, 255, 1);
        /* Adjust this color as needed */
    }

    .user-panel .image {
        display: flex;
        justify-content: center !important;

    }

    .brand-image {
        width: 100px !important;
        display: flex;
        justify-content: center !important;
        object-fit: contain;
        margin: 0 auto;

    }

    .info a {
        text-decoration: none;
        text-align: center !important;
        font-family: sans-serif !important;
        text-shadow: 2px 2px 4px beige;
    }
</style>
{{-- <style>
    .navbar-nav .nav-item .nav-link {
        display: flex;
        align-items: center;
    }

    .brand-link {
        display: flex;
        justify-content: center;
        align-items: center;
        text-align: center;
        flex-direction: column;
    }

    .brand-imag {
        width: 50% !important;
        /* Increased width */
        object-fit: contain;
        margin: 0 auto;
    }

    .brand-text {
        margin-top: 10px;
        font-weight: bold;
    }
</style> --}}

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <div class="user-panel text-center">
        <div class="image">
            <img src="/Login_images/BookClub.png" alt="User Image" class="brand-image">

        </div>
        <div class="info">
            <a href="{{ route('front.home') }}" class="d-block">
                <h3 class="text-white brand-text font-weight-bold text-center">Book Club</h3>
            </a>
        </div>
    </div>
    {{-- <div class="user-panel text-center">
        <a href="{{ route('front.home') }}" class="brand-link d-flex justify-content-center align-items-center">
            <img src="/Login_images/BookClub.png" alt="User Image" class="brand-imag">
            <span class="brand-text font-weight-bold text-center">Book Club</span>
        </a>
    </div> --}}
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-1">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item menu-open">
                    <a href="{{ route('front.home') }}"
                        class="nav-link @if (request()->routeIs('front.home')) active @endif">
                        <i class="nav-icon fa-solid fa-house"></i>
                        <p>
                            Dashboard

                        </p>
                    </a>

                </li>
                <li class="nav-item">
                    <a href="{{ route('librarian.index') }}"
                        class="nav-link @if (request()->routeIs('librarian.index') ||
                                request()->routeIs('librarian.create') ||
                                request()->routeIs('librarian.edit') ||
                                request()->routeIs('librarian.show')) active @endif">
                        <i class="nav-icon fa-solid fa-user-tie"></i>
                        <p>
                            Librarian
                            {{-- <span class="right badge badge-danger">New</span> --}}
                        </p>
                    </a>
                </li>
                {{-- <li class="nav-item @if (request()->routeIs('customer.index*') || request()->routeIs('customertype.index*')) menu-is-opening menu-open @endif">
                    <a href="#" class="nav-link @if (request()->routeIs('customer.index*') || request()->routeIs('customertype.index*')) active @endif">
                        <i class="nav-icon fa-solid fa-user-group"></i>
                        <p>
                            Manage Customer
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('customer.index') }}"
                                class="nav-link @if (request()->routeIs('customer.index*')) active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Customer List</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('customertype.index') }}"
                                class="nav-link @if (request()->routeIs('customertype.index*')) active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Customer Type</p>
                            </a>
                        </li>
                    </ul>
                </li> --}}
                <li class="nav-item @if (request()->routeIs('customer.*') || request()->routeIs('customertype.*')) menu-is-opening menu-open @endif">
                    <a href="#" class="nav-link @if (request()->routeIs('customer.*') || request()->routeIs('customertype.*')) active @endif">
                        <i class="nav-icon fa-solid fa-user-group"></i>
                        <p>
                            Manage Customer
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('customer.index') }}"
                                class="nav-link @if (request()->routeIs('customer.*')) active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Customer List</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('customertype.index') }}"
                                class="nav-link @if (request()->routeIs('customertype.*')) active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Customer Type</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="{{ route('book.index') }}"
                        class="nav-link @if (request()->routeIs('book.index') ||
                                request()->routeIs('book.create') ||
                                request()->routeIs('book.edit') ||
                                request()->routeIs('book.show')) active @endif">
                        <i class="nav-icon fa-solid fa-book"></i>
                        <p>
                            Book
                            {{-- <span class="right badge badge-danger">New</span> --}}
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('catalog.index') }}"
                        class="nav-link @if (request()->routeIs('catalog.index') ||
                                request()->routeIs('catalog.create') ||
                                request()->routeIs('catalog.edit') ||
                                request()->routeIs('catalog.show')) active @endif">
                        <i class="nav-icon fa-solid fa-book-bookmark"></i>
                        <p>
                            Catalog
                            {{-- <span class="right badge badge-danger">New</span> --}}
                        </p>
                    </a>
                </li>


                <li class="nav-item">
                    <a href="{{ route('borrow.index') }}"
                        class="nav-link @if (request()->routeIs('borrow.index') ||
                                request()->routeIs('borrow.create') ||
                                request()->routeIs('borrow.edit') ||
                                request()->routeIs('borrow.show')) active @endif">
                        {{-- <i class="nav-icon fa-solid fa-book-bookmark"></i> --}}
                        <i class="nav-icon fa-solid fa-hand-holding"></i>
                        <p>Borrow List</p>
                    </a>
                </li>
                {{-- <li class="nav-item @if (request()->routeIs('borrow.*') || request()->routeIs('borrowdetail.*')) menu-is-opening menu-open @endif">
                    <a href="#" class="nav-link @if (request()->routeIs('borrow.*') || request()->routeIs('borrowdetail.*')) active @endif">
                        <i class="nav-icon fa-solid fa-hand-holding-hand"></i>
                        <p>
                            Manage Borrow
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('borrow.index') }}"
                                class="nav-link @if (request()->routeIs('borrow.*')) active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Borrow List</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('borrowdetail.index') }}"
                                class="nav-link @if (request()->routeIs('borrowdetail.*')) active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Borrow Detail</p>
                            </a>
                        </li>
                    </ul>
                </li> --}}

                {{-- <li class="nav-item @if (request()->routeIs('permission.*') || request()->routeIs('role.*') || request()->routeIs('user.*')) menu-is-opening menu-open @endif">
                    <a href="#" class="nav-link @if (request()->routeIs('permission.*') || request()->routeIs('role.*') || request()->routeIs('user.*')) active @endif">
                        <i class="nav-icon fa-solid fa-user-gear"></i>
                        <p>
                            User Management
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('permissions') }}"
                                class="nav-link @if (request()->routeIs('permissions.index') || request()->routeIs('permissions.create') || request()->routeIs('permissions.edit')) active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Permission</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('roles') }}"
                                class="nav-link @if (request()->routeIs('roles*')) active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Role</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('users') }}"
                                class="nav-link @if (request()->routeIs('users') || request()->routeIs('user.create') || request()->routeIs('user.edit')) active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>User</p>
                            </a>
                        </li>
                    </ul>
                </li> --}}
                <li class="nav-item @if (request()->routeIs('permissions.*') || request()->routeIs('roles.*') || request()->routeIs('users.*')) menu-is-opening menu-open @endif">
                    <a href="#" class="nav-link @if (request()->routeIs('permissions.*') || request()->routeIs('roles.*') || request()->routeIs('users.*')) active @endif">
                        <i class="nav-icon fa-solid fa-user-gear"></i>
                        <p>
                            User Management
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('permissions.index') }}"
                                class="nav-link @if (request()->routeIs('permissions.index') ||
                                        request()->routeIs('permissions.create') ||
                                        request()->routeIs('permissions.edit')) active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Permission</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('roles.index') }}"
                                class="nav-link @if (request()->routeIs('roles.index') || request()->routeIs('roles.create') || request()->routeIs('roles.edit')) active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Role</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('users.index') }}"
                                class="nav-link @if (request()->routeIs('users.index') || request()->routeIs('users.create') || request()->routeIs('users.edit')) active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>User</p>
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
@endpush

