<style>
    a {
        text-decoration: none;
        color: gray;
    }
</style>
<!-- Modal -->
<div class="modal fade" id="CatalogModal{{$item->CatalogId}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color:  rgba(173, 72, 0, 1)">
                <h4 class="modal-title fs-5" id="exampleModalLabel">Catalog Item Details</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row justify-content-center">
                    <div class="col-lg-12 d-flex justify-content-center align-items-center ml-5">
                        <div class="col-lg-6 ml-2">
                            <p class="card-text">Catalog Code:</p>
                            <p class="card-text">Catalog Name:</p>
                            <p class="card-text">ISBN: </p>
                            <p class="card-text">Author Name: </p>
                            <p class="card-text">Publisher: </p>
                            <p class="card-text">Publish Year:</p>
                            <p class="card-text">Published Edition:</p>
                            <p class="card-text">Hidden:
                            </p>
                        </div>
                        <div class="col-lg-6 ">
                            <p class="card-text">{{ $item->CatalogCode  ?? 'Null'  }}</p>
                            <p class="card-text">{{ $item->CatalogName ?? 'Null'  }}</p>
                            <p class="card-text">{{ $item->Isbn  ?? 'Null'  }}</p>
                            <p class="card-text">{{ $item->AuthorName  ?? 'Null'  }}</p>
                            <p class="card-text">{{ $item->PubliSher  ?? 'Null'  }}</p>
                            <p class="card-text">{{ $item->PublishYear  ?? 'Null'  }}</p>
                            <p class="card-text">{{ $item->PublisheDition  ?? 'Null'  }}</p>
                            <p class="card-text">
                                @if ($item->IsHidden == 0)
                                    {{-- <i class="fas fa-check ml-2" style="color: green;"></i> --}}
                                    <span class="badge bg-danger">Hided</span>
                                    <!-- Green color for checked state -->
                                @else
                                    {{-- <i class="fas fa-times ml-2" style="color: red;"></i>  --}}
                                    <span class="badge bg-success">showed</span>
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
