<style>
    a {
        text-decoration: none;
        color: gray;
    }
</style>
<!-- Modal -->
<div class="modal fade" id="BorrowModal{{ $item->BorrowId}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color:  rgba(173, 72, 0, 1)">
                <h4 class="modal-title fs-5" id="exampleModalLabel">Borrow Details</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row justify-content-center">
                    <div class="col-lg-12 d-flex justify-content-center align-items-center ml-5">
                        <div class="col-lg-6 ml-2">
                            <p class="card-text">Customer Name:</p>
                            <p class="card-text">Librarian Name:</p>
                            <p class="card-text">Borrow Date: </p>
                            <p class="card-text">Borrow Code:</p>
                            <p class="card-text">Depositamount:</p>
                            <p class="card-text">FineAmount:</p>
                            <p class="card-text">Duedate:</p>
                            <p class="card-text">Emmo:</p>
                            <p class="card-text">Hidden:</p>
                        </div>
                        <div class="col-lg-6">
                            <p class="card-text">{{ $item->customer->CustomerName ?? 'Null' }}</p>
                            <p class="card-text">{{ $item->librarian->LibrarianName ?? 'Null' }}</p>
                            <p class="card-text">{{ $item->BorrowDate ?? 'Null' }}</p>
                            <p class="card-text">{{ $item->BorrowCode ?? 'Null' }}</p>
                            <p class="card-text">{{ $item->Depositamount ?? 'Null' }}</p>
                            <p class="card-text">{{ $item->FineAmount ?? 'Null' }}</p>
                            <p class="card-text">{{ $item->Duedate ?? 'Null' }}</p>
                            <p class="card-text">{{ $item->Emmo ?? 'Null' }}</p>
                            <p class="card-text">
                                @if ($item->IsHidden == 0)
                                    <span class="badge bg-danger">Hided</span>
                                @else
                                    <span class="badge bg-success">Shown</span>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close Tap</button>
            </div>
        </div>
    </div>
</div>
