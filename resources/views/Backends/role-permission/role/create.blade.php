@extends('Backends.master')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h3>{{ __('Add New Role') }}</h3>
            </div>
            <div class="col-sm-6" style="text-align: right">
            </div>
        </div>
    </div>
</section>
<div class="container">
    <div class="row justify-centent-center">
        <div class="col-md-12 mt-5">

            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">Role</h3>
                    <a href="{{url('roles')}}" class="btn btn-success">Back</a>
                </div>
                <div class="card-body">
                    <form action="{{url('roles')}}" method="POST">
                        @csrf
                        <div class="mb-2">
                            <label for="name">Role Name</label>
                            <input type="text" name="name" class="form-control"/>
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
@endsection

