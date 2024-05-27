<style>
    a {
        text-decoration: none;
        color: gray;
    }
</style>


<!-- Modal -->
<div class="modal fade" id="BorrowDetailModal{{ $item->BorrowDetailId }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" >
            <div class="modal-header" style="background-color:  rgba(173, 72, 0, 1)">
                <h4 class="modal-title fs-5" id="exampleModalLabel">BorrowDetails</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="BorrowDetail">
                <div class="row justify-content-center">
                    <div class="col-lg-12 d-flex justify-content-center align-items-center ml-5">
                        <div class="col-lg-6 ml-2">
                            <p class="card-text">Borrow Code :</p>
                            <p class="card-text">Book Names :</p>
                            <p class="card-text">Note :</p>
                            <p class="card-text">Return Date : </p>
                            <p class="card-text">Return : </p>
                            </p>
                        </div>
                        <div class="col-lg-6 ml-2">
                            <p class="card-text">{{ $item->borrow->BorrowCode ?? 'Null' }}</p>
                            <p class="card-text">
                                @if ($books->isNotEmpty())

                                    @foreach ($books as $book)
                                        <li>{{ $book->catalog->CatalogName }}</li>
                                    @endforeach
                                @else
                                    <span>Null</span>
                                @endif
                            </p>
                            <p class="card-text">{{ $item->Note ?? 'Null' }}</p>
                            <p class="card-text">{{ $item->ReturnDate ?? 'Null' }}</p>
                            <p class="card-text">
                                @if ($item->IsReturn)
                                    <span class="badge bg-success">Yes</span>
                                @else
                                    <span class="badge bg-danger">No</span>
                                @endif
                            </p>

                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary print" onclick="printBorrowDetail()">Print</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close Tap</button>
            </div>
        </div>
    </div>
</div>
<script>
    function printBorrowDetail() {
        var printContents = document.getElementById('BorrowDetail').innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
        window.location.reload();
    }
</script>
