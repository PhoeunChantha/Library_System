@extends('Backends.master')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h3>{{ __('Add Permission') }}</h3>
            </div>
            <div class="col-sm-6" style="text-align: right">
            </div>
        </div>
    </div>
</section>
<div class="container">
    <div class="row justify-centent-center">
        <div class="col-md-12 mt-5">
            @if (session('status'))
                <div class="alert alert-success">{{session('status')}}</div>
            @endif
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">Role : {{$role->name}}</h3>
                    <a href="{{url('roles')}}" class="btn btn-success">Back</a>
                </div>
                <div class="card-body">
                    <button type="button" class="btn btn-secondary float-end" id="checkAllBtn">Check All</button>
                    <form action="{{url('roles/'.$role->id.'/give-permissions')}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            @error('permission')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                            <label for="name">Permission</label>
                            <div class="row ">
                                @foreach ($permissions as $permission)
                                <div class="col-md-3  ">
                                    <label class="form-switch">
                                        <input
                                        class="form-check-input"
                                        type="checkbox"
                                        role="switch"
                                        name="permission[]"
                                        value="{{ $permission->name }}"
                                        {{in_array($permission->id, $rolepermissions ) ? 'checked' : '' }}
                                        />
                                        {{ $permission->name }}
                                    </label>
                                    <span class="custom-switch-indicator"></span>
                                </div>
                            @endforeach
                            </div>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-secondary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Get the button element
        var checkAllBtn = document.getElementById("checkAllBtn");

        // Add click event listener to the button
        checkAllBtn.addEventListener("click", function() {
            // Get all checkboxes
            var checkboxes = document.querySelectorAll('input[type="checkbox"]');

            // Loop through checkboxes and toggle checked state
            checkboxes.forEach(function(checkbox) {
                checkbox.checked = true;
            });
        });
    });
</script>

@endsection

