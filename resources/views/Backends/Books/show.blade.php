<style>
    a {
        text-decoration: none;
        color: gray;
    }

    img {
        border-radius: 10px;
    }
</style>
<div class="modal fade scrollable" id="BookModal{{ $item->BookId }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color:  rgba(173, 72, 0, 1)">
                <h4 class="modal-title fs-5" id="exampleModalLabel">Book Details</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card card-primary">
                    <div class="card-body">
                        <div class="text-center">
                            <img src="{{ asset('images/' . $item->BookImage) }}" alt="No Image"
                                class="rounded shadow-lg" width="250">
                        </div>
                        <h3 class="profile-username text-center mt-2 mb-2">
                            {{ $item->catalog->CatalogName ?? 'Null' }}
                        </h3>
                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b class="ml-5">Book Code:</b> <p class="float-right mr-3">{{ $item->BookCode ?? 'Null' }}</p>
                            </li>
                            <li class="list-group-item">
                                <b class="ml-5">Catalog Name: </b> <b
                                    class="float-right mr-4">{{ $item->catalog->CatalogName ?? 'Null' }}</b>
                            </li>
                            <li class="list-group-item">
                                <b class="ml-5">Description: </b> <b class="float-right mr-5">{{ $item->BookDescription ?? 'Null' }}</b>
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

