@extends('Dashboard')

@section('content')
    <style>
        /* Style for the circular profile picture */
        #preview {
            display: block;
            width: 100px;
            height: 100px;
            margin-top: 10px;
            border-radius: 50%;
            object-fit: cover;
            /* justify-content: center; */
        }
    </style>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- Adjust the column width as needed -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center">Create User</h3>
                        <a href="{{ url('users') }}" class="btn btn-success">Back</a>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('users') }}" method="POST" onsubmit="return validatePassword()" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-2">
                                <label for="name">User Name</label>
                                <input type="text" name="name" class="form-control" required />
                            </div>
                            <div class="mb-2">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control" required />
                            </div>
                            <div class="mb-2">
                                <label for="password">Password</label>
                                <div class="input-group">
                                    <input type="password" name="password" class="form-control" id="password" required
                                        minlength="8" maxlength="20" pattern=".{8,20}"
                                        title="Password must be between 8 and 20 characters" />
                                    <button type="button" class="btn btn-outline-secondary toggle-password"
                                        onclick="togglePasswordVisibility()">
                                        <i class="fas fa-eye-slash"></i>
                                    </button>
                                </div>
                                <small id="password-error" class="text-danger" style="display: none;">Password must be
                                    between 8 and 20 characters</small>
                            </div>
                            <div class="form-group">
                                <label for="Profile"> Profile</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="profile" id="exampleInputFile"
                                            accept="image/*" onchange="previewImage(event)" required>
                                        <label class="custom-file-label" id="fileLabel" for="exampleInputFile">Choose
                                            Profile</label>
                                    </div>
                                </div>
                                <img id="preview" class="rounded-circle" src="#" alt="Preview"
                                    style="display: none;">
                            </div>
                            <div class="mb-2">
                                <label for="confirm_password">Confirm Password</label>
                                <input type="password" name="confirm_password" class="form-control" id="confirm_password"
                                    required />
                            </div>
                            <div class="mb-2">
                                <label for="roles">Role</label>
                                <select class="form-control" name="roles[]" id="roles" required>
                                    <option value="select_role">Select Role</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role }}">{{ $role }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
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
