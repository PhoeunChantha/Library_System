{{-- @extends('Backends.master')
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
@endsection --}}
<div class="modal fade" id="RoleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title fs-5" id="exampleModalLabel">Create Role</h4>
        </div>
        <div class="modal-body">
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
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>


