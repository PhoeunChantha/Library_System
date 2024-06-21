@extends('Backends.master')

@section('content')
    <style>
        /* Style for the circular profile picture */
        #preview {
            display: block;
            width: 120px;
            height: 120px;
            margin-top: 10px;
            border-radius: 50%;
            object-fit: cover;

        }

        a {
            text-decoration: none;
            color: gray;
        }
    </style>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h3>{{ __('Add New User') }}</h3>
                </div>
                <div class="col-sm-6" style="text-align: right">
                </div>
            </div>
        </div>
    </section>
    <div class="container-fluid">
        <!-- Adjust the column width as needed -->
        <div class="card">
            <div class="card-header" style="background-color:  rgba(173, 72, 0, 1)">
                User Information
            </div>
            <div class="card-body">
                <form class="row" action="{{ url('users') }}" method="POST" onsubmit="return validatePassword()"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-group col-md-6">
                        <label for="name" class="required">User Name</label>
                        <input type="text" name="name" class="form-control  @error('name') is-invalid @enderror"  />
                        @error('name')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="email" class="required">Email</label>
                        <input type="email" name="email" class="form-control  @error('email') is-invalid @enderror" />
                        @error('email')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="password" class="required">Password</label>
                        <div class="input-group">
                            <input type="password" name="password" class="form-control  @error('password') is-invalid @enderror" id="password" minlength="8"
                                maxlength="20" pattern=".{8,20}" title="Password must be between 8 and 20 characters" />
                            <button type="button" class="btn btn-outline-secondary toggle-password"
                                onclick="togglePasswordVisibility()">
                                <i class="fas fa-eye-slash"></i>
                            </button>
                            @error('password')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                        <small id="password-error" class="text-danger" style="display: none;">Password must be
                            between 8 and 20 characters</small>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="confirm_password" class="required">Confirm Password</label>
                        <input type="password" name="confirm_password"  class="form-control  @error('confirm_password') is-invalid @enderror" id="confirm_password" required />
                        @error('confirm_password')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="roles" class="required">Role</label>
                        <select class="form-control select2  @error('roles') is-invalid @enderror" name="roles[]" id="roles" required>
                            <option value="select_role">Select Role</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role }}">{{ $role }}</option>
                            @endforeach
                        </select>
                        @error('roles')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="Profile"> Profile</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="profile" id="exampleInputFile"
                                    accept="image/*" onchange="previewImage(event)">
                                <label class="custom-file-label" id="fileLabel" for="exampleInputFile">Choose
                                    Profile</label>
                            </div>
                        </div>
                        <div class="preview text-center border rounded mt-2"
                            style="height: 150px; display: flex; justify-content: center; align-items: center;">
                            <img id="preview" src="#" alt="Preview"
                                style="display: none; max-width: 200px; max-height: 200px; margin: auto; margin-top: 10px;">
                        </div>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary float-right"> <i class="fa fa-save"></i>
                            {{ __('Save') }}</button>
                    </div>
                </form>
            </div>
        </div>
        <a href="{{ url('users') }}" class="back"><i class="fa-solid fa-arrow-left mr-2"></i>back to
            list</a>

    </div>
    <script>
        function togglePasswordVisibility() {
            var passwordField = document.getElementById("password");
            var toggleButton = document.querySelector(".toggle-password");

            if (passwordField.type === "password") {
                passwordField.type = "text";
                toggleButton.innerHTML = '<i class="fas fa-eye"></i>';
            } else {
                passwordField.type = "password";
                toggleButton.innerHTML = '<i class="fas fa-eye-slash"></i>';
            }
        }

        document.getElementById("password").addEventListener("input", function() {
            var password = this.value;
            var passwordError = document.getElementById("password-error");

            if (password.length < 8 || password.length > 20) {
                passwordError.style.display = "block";
                this.classList.add("is-invalid");
            } else {
                passwordError.style.display = "none";
                this.classList.remove("is-invalid");
            }
        });
    </script>

    <script>
        function validatePassword() {
            var password = document.getElementById("password").value;
            var confirmPassword = document.getElementById("confirm_password").value;

            if (password != confirmPassword) {
                alert("Password and confirm password do not match");
                return false;
            }
            return true;
        }
    </script>
    <script>
        function previewImage(event) {
            const input = event.target;
            const file = input.files[0];
            const label = input.nextElementSibling;
            const preview = document.getElementById('preview');

            label.innerText = file.name;

            const reader = new FileReader();
            reader.onload = function() {
                preview.src = reader.result;
                preview.style.display = 'block';
            };
            reader.readAsDataURL(file);
        }
    </script>
@endsection
