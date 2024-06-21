@extends('Backends.master')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h3>{{ __('All Customers List') }}</h3>
                </div>
                <div class="col-sm-6" style="text-align: right">
                </div>
            </div>
        </div>
    </section>
    <div class="card ">
        <div class="card-header" style="background-color:  rgba(173, 72, 0, 1)">
            <h3 class="card-title">Customers </h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="customerTable" class="table table-hover">
                @can('create customer')
                    <a href="{{ route('customer.create') }}" class="btn btn-info float-right"> <i class="fa fa-plus-circle"></i>
                        New</a>
                @endcan
                {{-- @can('show hide')
                    <button type="button" id="showAllBtn" class="btn btn-sm bg-gradient-success float-end">Show All
                    </button>
                @endcan --}}
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Code</th>
                        <th>Type Name</th>
                        <th>CustomerName</th>
                        <th>Sex</th>
                        <th>Dob</th>
                        <th>Pob</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($customers as $item)
                        <tr class="customerRow" @if ($item->IsHidden == 0)  @endif>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->CustomerCode }}</td>
                            <td>
                                @if ($item->customerType)
                                    {{ $item->customerType->CustomerTypeName }}
                                @else
                                    Null
                                @endif
                            </td>

                            <td>{{ $item->CustomerName }}</td>
                            <td>{{ $item->Sex }}</td>
                            <td>{{ $item->Dob }}</td>
                            <td>{{ $item->Pob }}</td>
                            <td>{{ $item->Phone }}</td>
                            <td>{{ $item->Address }}</td>
                            @can('hide data')
                                <td>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input switcher_input IsHidden"
                                            id="IsHidden_{{ $item->CustomerId }}" data-id="{{ $item->CustomerId }}"
                                            {{ $item->IsHidden == 1 ? 'checked' : '' }} name="IsHidden">
                                        <label class="custom-control-label" for="IsHidden_{{ $item->CustomerId }}"></label>
                                    </div>
                                </td>
                            @endcan
                            <td>
                                @can('view customer')
                                    <a href="{{ route('customer.show', $item->CustomerId) }}" class="btn btn-sm"
                                        data-bs-toggle="modal" data-bs-target="#CustomerModal{{ $item->CustomerId }}"><i
                                            class="fa-solid fa-eye fa-xl" style="color: #2363d1;"></i></a>
                                @endcan
                                @can('update customer')
                                    <a href="{{ route('customer.edit', $item->CustomerId) }}" class="btn  btn-sm"><i
                                            class="fa-solid fa-pen-to-square fa-xl" style="color: #63E6BE;"></i></a>
                                @endcan
                                @can('delete customer')
                                    <form action="{{ route('customer.destroy', $item->CustomerId) }}" method="POST"
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
                        @include('Backends.Customers.show')
                    @endforeach

                </tbody>

            </table>
        </div>
        <!-- /.card-body -->
    </div>

    <!-- /.card -->
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script> --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {{-- <script>
        $(document).ready(function() {
            let showAll = false; // Flag to track the state of the button

            // Initially hide rows where IsHidden is 0
            $('.customerRow').each(function() {
                if (!$(this).find('input.IsHidden').prop('checked')) {
                    $(this).hide();
                }
            });

            $('#showAllBtn').click(function() {
                showAll = !showAll; // Toggle the flag

                if (showAll) {
                    // Show all rows
                    $('.customerRow').show();
                } else {
                    // Hide rows where IsHidden is 0
                    $('.customerRow').each(function() {
                        if (!$(this).find('input.IsHidden').prop('checked')) {
                            $(this).hide();
                        }
                    });
                }
            });
        });
    </script> --}}
    {{-- <script>
        $(document).ready(function() {
            $('#customerTable').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": false,
                "info": true,
                "autoWidth": false,
                "responsive": true
            });
        });
    </script> --}}
    <script>
        $(document).ready(function() {
            $('#customerTable').DataTable({
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
    <script>
        $(document).ready(function() {
            $('input.IsHidden').on('change', function() {
                let isChecked = $(this).is(':checked');
                let token = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    type: "PUT",
                    url: "{{ route('customer.update_IsHidden') }}",
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
                        //  location.reload();
                    },
                    error: function(error) {
                        console.log(error);
                        toastr.error('Something went wrong.');
                    }
                });
            });
        });
    </script>
@endsection
