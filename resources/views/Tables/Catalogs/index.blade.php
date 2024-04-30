@extends('Dashboard')
@section('content')
@if (Session('status'))
{{-- <div class="alert alert-success" id="statusAlert">{{ session('status') }}</div> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
    integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    // Set Toastr options
    toastr.options = {
        progressBar: true,
        closeButton: false,
        timeOut: 5000
    };
    // Display success message
    toastr.success("{{ session('status') }}", 'Success!');

</script>
@endif
<!-- /.card -->
<div class="card ">
    <div class="card-header">
        <h3 class="card-title">Catalog</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="" class="table table-bordered table-hover">
            <a href="{{route('catalog.create')}}" class="btn btn-info btn-sm mb-2"><i class="fa-solid fa-plus fa-xl" style="color: #1567f4;"></i>Add</a>
            <thead>
                <tr>
                    <th>#</th>
                    <th>CatalogCode</th>
                    <th>CatalogName</th>
                    <th>Isbn</th>
                    <th>AuthorName</th>
                    <th>PubliSher</th>
                    <th>PublishYear</th>
                    <th>PublisheDition</th>
                    <th>IsHidden</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($catalogs as $item)
                    <tr>
                        <td>{{$item->CatalogId}}</td>
                        <td>{{$item->CatalogCode}}</td>
                        <td>{{ $item->CatalogName}}</td>
                        <td>{{$item->Isbn}}</td>
                        <td>{{$item->AuthorName}}</td>
                        <td>{{$item->PubliSher}}</td>
                        <td>{{$item->PublishYear}}</td>
                        <td>{{$item->PublisheDition}}</td>
                        <td>
                            @if($item->IsHidden == 1)
                                <i class="fas fa-check " style="color:Green;"></i> <!-- Icon for checked state -->
                            @else
                                <i class="fas fa-times" style="color:red;"></i> <!-- Icon for unchecked state -->
                            @endif
                        </td>
                        <td>
                            {{-- <button type="button" class="btn btn-sm" data-bs-toggle="modal" data-bs-target="#CatalogModal">
                                <i class="fa-solid fa-eye fa-xl" style="color: #2363d1;"></i>
                            </button> --}}
                            <a href="{{route('catalog.show',$item->CatalogId)}}" class="btn  btn-sm"> <i class="fa-solid fa-eye fa-xl" style="color: #2363d1;"></i></a>
                            <a href="{{route('catalog.edit',$item->CatalogId)}}" class="btn  btn-sm"><i class="fa-solid fa-pen-to-square fa-xl" style="color: #63E6BE;"></i></a>
                            <form action="{{ route('catalog.destroy', $item->CatalogId) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm" onclick="return confirm('Are you sure?')">
                                    <i class="fa-solid fa-trash fa-xl " style="color: red;"></i>
                                </button>

                            </form>
                        </td>
                    </tr>
                @endforeach

            </tbody>

        </table>
    </div>
    <!-- /.card-body -->
</div>
<script>
    // Close the alert after 5 seconds (5000 milliseconds)
    setTimeout(function() {
        document.getElementById('statusAlert').style.display = 'none';
    }, 5000); // Adjust the time as needed (5 seconds in this case)
</script>
@endsection
