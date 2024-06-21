@extends('Backends.master')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h3>{{ __('All Librarians List') }}</h3>
                </div>
                <div class="col-sm-6" style="text-align: right">
                </div>
            </div>
        </div>
    </section>
    <div class="container-fluid">
        <!-- /.card -->
        <div class="card ">
            <div class="card-header" style="background-color:  rgba(173, 72, 0, 1)">
                <h3 class="card-title text-white">Librarians</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="librarianTable" class="table  table-hover">
                    @can('create librarian')
                        <a href="{{ route('librarian.create') }}" class="btn btn-info float-right">
                            <i class="fa fa-plus-circle"></i>
                            New
                        </a>
                    @endcan
                    {{-- @can('show hide')
                        <button type="button" id="showAllBtn" class="btn btn-sm bg-gradient-success float-end">Show All
                        </button>
                    @endcan --}}
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Librarian Name</th>
                            <th>Sex</th>
                            <th>Date of Birth</th>
                            <th>Place of Birth</th>
                            <th>Phone</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($librarians as $item)
                            <tr class="librarianRow" @if ($item->IsHidden == 0) style="display:none;" @endif>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->LibrarianName }}</td>
                                <td>{{ $item->Sex }}</td>
                                <td>{{ $item->Dob }}</td>
                                <td>{{ $item->Pob }}</td>
                                <td>{{ $item->Phone }}</td>
                                {{-- <td>
                                @if ($item->IsHidden == 1)
                                    <span class="badge bg-danger">Hided</span>
                                @else
                                    <span class="badge bg-success">showed</span>
                                @endif
                            </td> --}}
                                @can('hide data')
                                    <td>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input switcher_input IsHidden"
                                                id="IsHidden_{{ $item->LibrarianId }}" data-id="{{ $item->LibrarianId }}"
                                                {{ $item->IsHidden == 1 ? 'checked' : '' }} name="IsHidden">
                                            <label class="custom-control-label"
                                                for="IsHidden_{{ $item->LibrarianId }}"></label>
                                        </div>
                                    </td>
                                @endcan
                                <td>
                                    @can('view librarian')
                                        <a href="{{ route('librarian.show', $item->LibrarianId) }}" class="btn btn-sm"
                                            data-bs-toggle="modal" data-bs-target="#LibrarianModal{{ $item->LibrarianId }}"><i
                                                class="fa-solid fa-eye fa-xl" style="color: #2363d1;"></i></a>
                                    @endcan
                                    @can('update librarian')
                                        <a href="{{ route('librarian.edit', $item->LibrarianId) }}" class="btn  btn-sm"><i
                                                class="fa-solid fa-pen-to-square fa-xl" style="color: #63E6BE;"></i></a>
                                    @endcan
                                    @can('delete librarian')
                                        <form action="{{ route('librarian.destroy', $item->LibrarianId) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-delete"><i
                                                    class="fa-solid fa-trash fa-xl " style="color: red;"></i>
                                            </button>
                                        </form>
                                    @endcan
                                </td>
                            </tr>
                            @include('Backends.Librarians.show')
                        @endforeach
                    </tbody>
                </table>

            </div>
            <!-- /.card-body -->
        </div>
    </div>
    <!-- /.card -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            let showAll = false; // Flag to track the state of the button

            // Initially hide rows where IsHidden is 0
            $('.librarianRow').each(function() {
                if (!$(this).find('input.IsHidden').prop('checked')) {
                    $(this).hide();
                }
            });

            $('#showAllBtn').click(function() {
                showAll = !showAll; // Toggle the flag

                if (showAll) {
                    // Show all rows
                    $('.librarianRow').show();
                } else {
                    // Hide rows where IsHidden is 0
                    $('.librarianRow').each(function() {
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
                    url: "{{ route('librarian.update_IsHidden') }}",
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
    {{-- <script>
        $(document).ready(function() {
            $('#librarianTable').DataTable({
                "paging": true,
                "lengthChange": true,
                "language": {
                    "search": "",
                    "searchPlaceholder": "    Search for something...",
                },
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true
            });

        });
    </script> --}}
    <script>
        $(document).ready(function() {
            $('#librarianTable').DataTable({
                "paging": true,
                "lengthChange": true,
                "language": {
                    "search": "",
                    "searchPlaceholder": "    Search for something...",
                },
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true
            });

            // Center the search input
            var searchInput = $('div.dataTables_filter input');
            var searchInputParent = searchInput.parent();
            searchInputParent.css({
                'width': '100%',
                'text-align': 'left'
            });
            searchInput.css({
                'display': 'inline-block',
                'width': '10cm',
                'height': '1cm'
            });
        });
    </script>
@endsection
