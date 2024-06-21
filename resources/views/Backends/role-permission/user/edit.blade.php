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
                    <h3>{{ __('Edit User') }}</h3>
                </div>
                <div class="col-sm-6" style="text-align: right">
                </div>
            </div>
        </div>
    </section>
    <div class="container-fluid">
        <div class="card">
            <div class="card-header" style="background-color:  rgba(173, 72, 0, 1)">
                User Information
            </div>
            <div class="card-body">
                <form class="row" action="{{ url('users/' . $user->id) }}" method="POST"
                    onsubmit="return validatePassword()" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group col-md-6">
                        <label for="name">User Name</label>
                        <input type="text" name="name" value="{{ $user->name }}" class="form-control" required />
                    </div>
                    <div class="form-group col-md-6">
                        <label for="email">Email</label>
                        <input type="email" name="email" value="{{ $user->email }}" class="form-control" required />
                    </div>
                    @if ($user->hasRole('super-admin'))
                       
                        {{-- <div class="form-group col-md-6">
                            <input type="checkbox" id="agree-checkbox" onchange="togglePasswordField()">
                            <label for="agree-checkbox">I agree to update my password</label>
                            <label for="password">Password</label>
                            <div class="input-group">
                                <input type="password" name="password" class="form-control" id="password" minlength="8"
                                    maxlength="20" pattern=".{8,20}" title="Password must be between 8 and 20 characters"
                                    disabled />
                                <button type="button" class="btn btn-outline-secondary toggle-password"
                                    onclick="togglePasswordVisibility()">
                                    <i class="fas fa-eye-slash"></i>
                                </button>
                            </div>
                            <small id="password-error" class="text-danger mt-2" style="display: none;">Password must be
                                between 8 and 20 characters</small>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="confirm_password">Confirm Password</label>
                            <input type="password" name="confirm_password" class="form-control" id="confirm_password" />
                        </div>
                        <div class="form-group col-md-6">
                            <label for="roles">Role</label>
                            <select class="form-control select2" name="roles[]" id="roles" multiple required>
                                <option value="">Select Role</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role }}" {{ $user->hasRole($role) ? 'selected' : '' }}>
                                        {{ $role }}
                                    </option>
                                @endforeach
                            </select>
                        </div> --}}
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <input type="checkbox" id="agree-checkbox" onchange="togglePasswordField()">
                                <label for="agree-checkbox">I agree to update my password</label>
                                <label for="password">Password</label>
                                <div class="input-group">
                                    <input type="password" name="password" class="form-control" id="password"
                                        minlength="8" maxlength="20" pattern=".{8,20}"
                                        title="Password must be between 8 and 20 characters" disabled />
                                    <button type="button" class="btn btn-outline-secondary toggle-password"
                                        onclick="togglePasswordVisibility()">
                                        <i class="fas fa-eye-slash"></i>
                                    </button>
                                </div>
                                <small id="password-error" class="text-danger mt-2" style="display: none;">
                                    Password must be between 8 and 20 characters
                                </small>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="confirm_password">Confirm Password</label>
                                <input type="password" name="confirm_password" class="form-control" id="confirm_password" />
                            </div>
                            <div class="form-group col-md-6">
                                <label for="roles">Role</label>
                                <select class="form-control select2" name="roles[]" id="roles" multiple required>
                                    <option value="">Select Role</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role }}" {{ $user->hasRole($role) ? 'selected' : '' }}>
                                            {{ $role }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @endif

                    <div class="form-group col-md-6">
                        <label for="BookImage">New Profile</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input user-file-input" name="profile"
                                    id="exampleInputFile" accept="image/*" onchange="previewImage(event)">
                                <label class="custom-file-label" id="fileLabel" for="exampleInputFile">Choose
                                    Profile</label>
                            </div>
                        </div>
                        <div class="preview text-center border rounded mt-2"
                            style="height: 150px; display: flex; justify-content: center; align-items: center;">
                            <img id="preview"
                                src="
                                        @if ($user->profile && file_exists(public_path('P_images/' . $user->profile))) {{ asset('P_images/' . $user->profile) }}
                                        @else
                                            {{ asset('P_images/default.png') }} @endif
                                    "
                                alt="Preview"
                                style="max-width: 100%; max-height: 100%; display: {{ $user->profile ? 'block' : 'none' }};">
                        </div>
                    </div>
                    <div class="form-group col-md-6"></div>
                    <div class="form-group">
                        <button type="submit" onclick="validatePasswordUpdate()" class="btn btn-primary float-right"> <i
                                class="fa fa-save"></i> {{ __('Save') }}</button>
                    </div>
                </form>
            </div>
        </div>
        <a href="{{ url('users') }}" class="back"><i class="fa-solid fa-arrow-left mr-2"></i>back to
            list</a>

    </div>
    {{-- //show and hide pass --}}
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

        function validatePassword() {
            var password = document.getElementById("password").value;
            var confirmPassword = document.getElementById("confirm_password").value;

            if (password !== confirmPassword) {
                alert("Password and confirm password do not match");
                return false;
            }
            return true;
        }
    </script>
    {{-- //button agree --}}
    <script>
        function togglePasswordField() {
            var agreeCheckbox = document.getElementById("agree-checkbox");
            var passwordField = document.getElementById("password");

            if (agreeCheckbox.checked) {
                passwordField.removeAttribute("disabled");
            } else {
                passwordField.setAttribute("disabled", "disabled");
            }
        }

        document.getElementById("password").addEventListener("click", function() {
            var agreeCheckbox = document.getElementById("agree-checkbox");

            if (!agreeCheckbox.checked) {
                alert("Please agree to update your password before proceeding.");
            }
        });
    </script>
    <script>
        document.querySelector('.user-file-input').addEventListener('change', function(e) {
            var reader = new FileReader();
            var preview = document.getElementById('preview');
            var fileLabel = document.getElementById('fileLabel');

            // Update the preview image
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            }
            reader.readAsDataURL(this.files[0]);

            // Update the file label
            var fileName = this.files[0].name;
            fileLabel.textContent = fileName;
        });
    </script>
@endsection
