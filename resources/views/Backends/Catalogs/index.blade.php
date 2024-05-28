@extends('Backends.master')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h3>{{ __('All Catalog List') }}</h3>
                </div>
                <div class="col-sm-6" style="text-align: right">
                </div>
            </div>
        </div>
    </section>
    <!-- /.card -->
    <div class="card ">
        <div class="card-header">
            <h3 class="card-title">Catalog</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="catalogTable" class="table  table-hover">
                @can('create catalog')
                    <a href="{{ route('catalog.create') }}" class="btn btn-info btn-sm mb-2"><i class="fa-solid fa-plus fa-xl"
                            style="color: #1567f4;"></i>Add</a>
                @endcan

                @can('show hide')
                    <button type="button" id="showAllBtn" class="btn btn-sm bg-gradient-success float-end">Show All
                    </button>
                @endcan
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
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($catalogs as $item)
                        <tr class="catalogRow" @if ($item->IsHidden == 0) style="display:none;" @endif>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->CatalogCode }}</td>
                            <td>{{ $item->CatalogName }}</td>
                            <td>{{ $item->Isbn }}</td>
                            <td>{{ $item->AuthorName }}</td>
                            <td>{{ $item->PubliSher }}</td>
                            <td>{{ $item->PublishYear }}</td>
                            <td>{{ $item->PublisheDition }}</td>
                            @can('hide data')
                                <td>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input switcher_input IsHidden"
                                            id="IsHidden_{{ $item->CatalogId }}" data-id="{{ $item->CatalogId }}"
                                            {{ $item->IsHidden == 1 ? 'checked' : '' }} name="IsHidden">
                                        <label class="custom-control-label" for="IsHidden_{{ $item->CatalogId }}"></label>
                                    </div>
                                </td>
                            @endcan
                            <td>
                                @can('view catalog')
                                    <a href="{{ route('catalog.show', $item->CatalogId) }}" class="btn  btn-sm"
                                        data-bs-toggle="modal" data-bs-target="#CatalogModal{{ $item->CatalogId }}"> <i
                                            class="fa-solid fa-eye fa-xl" style="color: #2363d1;"></i></a>
                                @endcan
                                @can('update catalog')
                                    <a href="{{ route('catalog.edit', $item->CatalogId) }}" class="btn  btn-sm"><i
                                            class="fa-solid fa-pen-to-square fa-xl" style="color: #63E6BE;"></i></a>
                                @endcan
                                @can('delete catalog')
                                    <form action="{{ route('catalog.destroy', $item->CatalogId) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-delete">
                                            <i class="fa-solid fa-trash fa-xl " style="color: red;"></i>
                                        </button>

                                    </form>
                                @endcan

                            </td>
                        </tr>
                        @include('Backends.Catalogs.show')
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            let showAll = false; // Flag to track the state of the button

            // Initially hide rows where IsHidden is 0
            $('.catalogRow').each(function() {
                if (!$(this).find('input.IsHidden').prop('checked')) {
                    $(this).hide();
                }
            });

            $('#showAllBtn').click(function() {
                showAll = !showAll; // Toggle the flag

                if (showAll) {
                    // Show all rows
                    $('.catalogRow').show();
                } else {
                    // Hide rows where IsHidden is 0
                    $('.catalogRow').each(function() {
                        if (!$(this).find('input.IsHidden').prop('checked')) {
                            $(this).hide();
                        }
                    });
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('input.IsHidden').on('change', function() {
                let isChecked = $(this).is(':checked');
                let token = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    type: "PUT",
                    url: "{{ route('catalog.update_IsHidden') }}",
                    data: {
                        _token: token,
                        id: $(this).data('id'),
                        IsHidden: isChecked ? 1 : 0
                    },
                    dataType: "json",
                    success: function(response) {
                        console.log(response);
                        if (response.IsHidden == 1) {
                            toastr.success(response.msg);
                        } else {
                            toastr.error(response.msg);
                        }
                        //   location.reload();
                    },
                    error: function(error) {
                        console.log(error);
                        toastr.error('Something went wrong.');
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#catalogTable').DataTable({
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
@endsection
