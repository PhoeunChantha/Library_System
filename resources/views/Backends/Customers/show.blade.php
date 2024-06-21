<!-- Modal -->
<div class="modal fade" id="CustomerModal{{ $item->CustomerId }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color:  rgba(173, 72, 0, 1)">
                <h4 class="modal-title fs-5 text-white" id="exampleModalLabel">Customer Details</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card card-primary">
                    <div class="card-body">
                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b class="ml-5">Customer Code:</b> <b
                                    class="float-right mr-5">{{ $item->CustomerCode ?? 'Null' }}</b>
                            </li>
                            <li class="list-group-item">
                                <b class="ml-5">Customer Type:</b> <b
                                    class="float-right mr-5 ">{{ $item->customerType->CustomerTypeName ?? 'Null' }}</b>
                            </li>
                            <li class="list-group-item">
                                <b class="ml-5">Customer Name: </b> <b
                                    class="float-right mr-5">{{ $item->CustomerName ?? 'Null' }}</b>
                            </li>
                            <li class="list-group-item">
                                <b class="ml-5">Sex: </b> <b class="float-right mr-5">{{ $item->Sex ?? 'Null' }}</b>
                            </li>
                            <li class="list-group-item">
                                <b class="ml-5">Date of Birth: </b> <b
                                    class="float-right mr-5">{{ $item->Dob ?? 'Null' }}</b>
                            </li>
                            <li class="list-group-item">
                                <b class="ml-5">Place of Birth:</b> <b
                                    class="float-right mr-5">{{ $item->Pob ?? 'Null' }}</b>
                            </li>
                            <li class="list-group-item">
                                <b class="ml-5">Phone: </b> <b
                                    class="float-right mr-5">{{ $item->Phone ?? 'Null' }}</b>
                            </li>
                            <li class="list-group-item">
                                <b class="ml-5">Address:</b> <b
                                    class="float-right mr-5">{{ $item->Address ?? 'Null' }}</b>
                            </li>
                        </ul>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close Tap</button>
            </div>
        </div>
    </div>
</div>
