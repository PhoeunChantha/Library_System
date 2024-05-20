@extends('layouts.app')

@push('css')
    <style>
        .profile {
            display: flex;
            justify-content: center;
            align-items: center;

        }

        .banner img {
            width: 100%;
            height: auto;
            margin: 0.5cm;
            /* margin-top: 0.5cm; */

        }
    </style>
@endpush
@section('content')
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script> --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card d-flex">
                    <div class="row">
                        <!-- Profile Image Column -->
                        <div class="col-7">
                            <div class="banner float-start mr-4">
                                <img width="100%" src="/Login_images/banner4.jpg" alt="not found">
                            </div>
                        </div>
                        <!-- Form Column -->
                        <div class="col-5">
                            <div class="title  p-3" style="text-align: center;">
                                <img width="40%" src="/Login_images/BookClub.jpg" class="img-fluid" alt=" not found">
                                {{-- <h3 class="text" style="font-size: 2rem;">Login</h3> --}}
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form id="loginForm" method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name">{{ __('Username') }}</label>
                                        <div class="input-group mb-3">
                                            <input id="name" type="text"
                                                class="form-control @error('name') is-invalid @enderror {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                                name="name" value="{{ old('name') }}" required autocomplete="name"
                                                autofocus>
                                            <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                                        </div>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="email">{{ __('Email') }}</label>
                                        <div class="input-group mb-3">
                                            <input id="email" type="email"
                                                class="form-control @error('email') is-invalid @enderror {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                                name="email" value="{{ old('email') }}" required autocomplete="email">
                                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                        </div>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="password">{{ __('Password') }}</label>
                                        <div class="input-group mb-3">
                                            <input id="password" type="password"
                                                class="form-control @error('password') is-invalid @enderror {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                                name="password" required autocomplete="current-password">
                                                <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                        {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember">{{ __('Remember Me') }}</label>
                                </div>

                                <div class="footer p-3 d-flex">
                                    <button type="submit" class="btn btn-primary">{{ __('Login') }}</button>

                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link"
                                            href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a>
                                    @endif
                                </div>
                            </form>



                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.col-8 -->
            </div>
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col-lg-8 -->
@endsection
