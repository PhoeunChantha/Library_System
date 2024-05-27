<style>
    a {
        text-decoration: none;
        color: gray;
    }
</style>

<!-- Modal -->
<div class="modal fade" id="BookModal{{ $item->BookId }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color:  rgba(173, 72, 0, 1)">
                <h4 class="modal-title fs-5" id="exampleModalLabel">Book Details</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="row justify-content-center">
                    <div class="col-lg-12 d-flex justify-content-center align-items-center ml-5">
                        <div class="col-lg-6 ml-2">
                            <p class="card-text">Book Code:</p>
                            <p class="card-text">Catalog Name: </p>
                            <p class="card-text">BookImage:</p>
                            <p class="card-text">Description: </p>
                            <p class="card-text">Status</p>
                            </p>
                        </div>
                        <div class="col-lg-6 ml-2">
                            <p class="card-text">{{ $item->BookCode ?? 'Null' }}</p>
                            <p class="card-text">{{ $item->catalog->CatalogName ?? 'Null' }}</p>
                            <p class="card-text"><img  src="{{ asset('images/' . $item->BookImage) }}"
                                    alt="No Image" width="70"></p>
                            <p class="card-text">{{ $item->BookDescription ?? 'Null' }}</p>
                            <p class="card-text"> @if ($item->IsHidden == 1)
                                {{-- <i class="fas fa-check ml-2" style="color: green;"></i> --}}
                                <span class="badge bg-success">showed</span>
                                <!-- Green color for checked state -->
                            @else
                                {{-- <i class="fas fa-times ml-2" style="color: red;"></i>  --}}
                                <span class="badge bg-danger">Hided</span>
                            @endif</p>
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
