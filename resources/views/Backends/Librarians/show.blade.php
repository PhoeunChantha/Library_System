<style>
    a {
        text-decoration: none;
        color: gray;

    }
</style>

<!-- Modal -->
<div class="modal fade" id="LibrarianModal{{ $item->LibrarianId }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color:  rgba(173, 72, 0, 1)">
                <h4 class="modal-title fs-5 text-white" id="exampleModalLabel">Librarian Details</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row justify-content-center">
                    <div class="col-lg-12 d-flex ml-5">
                        <div class="col-lg-6 ml-2">
                            <p class="card-text">Librarian Name:</p>
                            <p class="card-text">Sex:</p>
                            <p class="card-text">Date of Birth:</p>
                            <p class="card-text">Place of Birth:</p>
                            <p class="card-text">Phone:</p>
                            <p class="card-text">Hidden:</p>
                        </div>
                        <div class="col-lg-6 ml-2">
                            <p class="card-text">{{ $item->LibrarianName ?? 'Null'  }}</p>
                            <p class="card-text">{{ $item->Sex  ?? 'Null'  }}</p>
                            <p class="card-text">{{ $item->Dob  ?? 'Null'  }}</p>
                            <p class="card-text">{{ $item->Pob  ?? 'Null'  }}</p>
                            <p class="card-text">{{ $item->Phone  ?? 'Null'  }}</p>
                            <p class="card-text">
                                @if ($item->IsHidden == 0)
                                    <span class="badge bg-danger">Hidden</span>
                                @else
                                    <span class="badge bg-success">Show</span>
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
