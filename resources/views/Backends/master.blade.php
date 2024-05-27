<!DOCTYPE html>
<html lang="en">
@include('Backends.Partials.Link')

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        {{-- <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{asset('AdminLTE')}}/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
        </div> --}}

        <!-- Navbar -->
        @include('Backends.Partials.Navbar')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        @include('Backends.Partials.Sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            {{-- <div class="content-header">
                <div class="container-fluid">
                    <div class="row ">
                        <div class="col-sm-6">
                            <h1 id="greeting">Hello, @auth {{ Auth::user()->name }} @endauth
                            </h1>
                            @if (Session::has('login_time'))
                                {{ \Carbon\Carbon::parse(Session::get('login_time'))->format('l, F j, Y h:i A') }}
                            @endif
                        </div><!-- /.col -->
                        <div class="banner p-3 d-flex justify-content-center">
                            <img src="/Login_images/banner.jpg" width="90%" height="80%" alt="image">
                        </div>
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div> --}}
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    @yield('content')
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2014-2021 <a
                    href="https://scontent.fpnh12-1.fna.fbcdn.net/v/t39.30808-1/439527011_1488001912096247_5090112580082370867_n.jpg?stp=dst-jpg_p200x200&_nc_cat=103&ccb=1-7&_nc_sid=5f2048&_nc_eui2=AeFLD94v2KWoymh1IJOxA8N0q0hPhTf6fnKrSE-FN_p-co0yX6wJPrmv1Zrv5yzstTkVj8FQIyYpHqdbymYaE3R-&_nc_ohc=Sn1HZZO-nZAQ7kNvgEMuel-&_nc_ht=scontent.fpnh12-1.fna&oh=00_AYC6UNIfUihj7Httfp51WDnrP00_7N__Ga6Y2lrVyLjDgg&oe=664CA062">ChanthaIT</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 3.2.0
            </div>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    @include('Backends.Partials.Script')
    <script>
        $(document).ready(function() {
            $('#librarianTable').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": false,
                "info": true,
                "autoWidth": false,
                "responsive": true
            });
        });
    </script>
    {{-- <script>
        function updateDateTime() {
            const now = new Date();
            const options = {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit'
            };
            document.getElementById('datetime').innerText = now.toLocaleString('en-US', options);
        }

        setInterval(updateDateTime, 1000);
        updateDateTime(); // initial call to display the time immediately
    </script> --}}

</body>
</html>
