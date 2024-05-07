@extends('Dashboard')
@section('content')

<div class="container">
    <div class="row justify-centent-center">
        <div class="col-md-12 mt-5">

            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">Update Role</h3>
                    <a href="{{url('roles')}}" class="btn btn-success">Back</a>
                </div>
                <div class="card-body">
                    <form action="{{url('roles/'.$role->id)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-2">
                            <label for="name">role Name</label>
                            <input type="text" name="name" class="form-control" value="{{$role->name}}"/>
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
@endsection

