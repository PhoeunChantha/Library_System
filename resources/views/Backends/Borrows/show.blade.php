<style>
    a {
        text-decoration: none;
        color: gray;
    }
</style>

<!-- Modal -->
<div class="modal fade" id="BorrowModal{{ $borrow->BorrowId }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" id="Borrow">
        <div class="modal-content" style="
            border:2px solid rgba(173, 72, 0, 1);
            ">
            <div class="modal-header d-flex" style="background-color:  rgba(173, 72, 0, 1)">
                <h4 class="modal-title fs-5" id="exampleModalLabel">Borrow Details</h4>
                <img class="image mb-1" width="70px" src="/Login_images/Booklogo.png" alt="Not Found">
                {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
            </div>
            <div class="modal-body ">
                <div class="row justify-content-center">
                    <div class="col-lg-12 d-flex justify-content-center align-items-center ml-5">
                        <div class="col-lg-6 ml-5">
                            <p style="color: rgba(173, 72, 0, 1)" class="card-text">Customer Name:</p>
                            <p style="color: rgba(173, 72, 0, 1)" class="card-text">Librarian Name:</p>
                            <p style="color: rgba(173, 72, 0, 1)" class="card-text">Borrow Date: </p>
                            <p style="color: rgba(173, 72, 0, 1)" class="card-text">Borrow Code:</p>
                            <p style="color: rgba(173, 72, 0, 1)" class="card-text">Depositamount:</p>
                            <p style="color: rgba(173, 72, 0, 1)" class="card-text">FineAmount:</p>
                            <p style="color: rgba(173, 72, 0, 1)" class="card-text">Duedate:</p>
                            <p style="color: rgba(173, 72, 0, 1)" class="card-text">Book Name:</p>
                            <p style="color: rgba(173, 72, 0, 1)" class="card-text">Return:</p>
                            <p style="color: rgba(173, 72, 0, 1)" class="card-text">Return Date:</p>
                            <p style="color: rgba(173, 72, 0, 1)" class="card-text">Emmo:</p>
                            <p style="color: rgba(173, 72, 0, 1)" class="card-text">Hidden:</p>
                        </div>
                        <div class="col-lg-6 pl-5">
                            <p class="card-text">{{ $borrow->customer->CustomerName ?? 'Null' }}</p>
                            <p class="card-text">{{ $borrow->librarian->LibrarianName ?? 'Null' }}</p>
                            <p class="card-text">{{ $borrow->BorrowDate ?? 'Null' }}</p>
                            <p class="card-text">{{ $borrow->BorrowCode ?? 'Null' }}</p>
                            <p class="card-text">{{ $borrow->Depositamount ?? 'Null' }}</p>
                            <p class="card-text">{{ $borrow->FineAmount ?? 'Null' }}</p>
                            <p class="card-text">{{ $borrow->Duedate ?? 'Null' }}</p>
                            <p class="card-text">

                                {{-- @foreach ($borrow->borrowDetails as $borrowDetail)
                                    @if ($books->isNotEmpty())
                                        @foreach ($books as $book)
                                            <li>{{ $book->catalog->CatalogName }}</li>
                                        @endforeach
                                    @else
                                        <span>Null</span>
                                    @endif
                                @endforeach --}}

                                @foreach ($borrow->borrowDetails as $detail)
                                    @php
                                        $bookIds = json_decode($detail->book_ids, true);
                                    @endphp

                                    {{-- Check if $bookIds is not null and is an array --}}
                                    @if (!is_null($bookIds) && is_array($bookIds))
                                        @foreach ($bookIds as $bookId)
                                            @php
                                                // Find the book with the given ID
                                                $book = \App\Models\Book::find($bookId);
                                            @endphp

                                            {{-- Check if $book is not null --}}
                                            @if (!is_null($book))
                                                <li>
                                                    {{ $book->BookCode }}
                                                    {{ $book->catalog->CatalogName }}
                                                </li>
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach

                            </p>
                            <p class="card-text">
                                @if ($borrow->IsReturn)
                                    <span class="badge bg-success">Yes</span>
                                @else
                                    <span class="badge bg-danger">No</span>
                                @endif
                            </p>
                            <p class="card-text">{{ $borrow->ReturnDate ?? 'Null' }}</p>

                            <p class="card-text">{{ $borrow->Emmo ?? 'Null' }}</p>
                            <p class="card-text">
                                @if ($borrow->IsHidden == 0)
                                    <span class="badge bg-danger">Hided</span>
                                @else
                                    <span class="badge bg-success">Show</span>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                {{-- <button type="button" class="btn btn-primary print" onclick="printBorrow()">Print</button> --}}
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close Tap</button>
            </div>
        </div>
    </div>
</div>
{{-- <script>
    function printBorrow() {
        var originalContents = document.getElementById('Borrow').innerHTML;

        // Create a new window for printing
        var printWindow = window.open('', '_blank');

        // Write the entire document content to the print window
        printWindow.document.write('<html><head><title>Print</title>');
        printWindow.document.write('<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">'); // Include Bootstrap CSS (replace with your CSS)
        printWindow.document.write('</head><body>');
        printWindow.document.write(originalContents);
        printWindow.document.querySelector('.modal-footer').remove();
        printWindow.document.write('</body></html>');

        // Print the content and close the print window
        printWindow.document.close();
        printWindow.print();
    }
</script> --}}
{{-- <script>
    function printBorrow() {
        // Get the modal content
        var originalContents = document.getElementById('Borrow').innerHTML;

        // Create a new window for printing
        var printWindow = window.open('', '_blank');

        // Write the entire document content to the print window
        printWindow.document.write('<html><head><title>Print</title>');
        printWindow.document.write(
            '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">'
        ); // Include Bootstrap CSS (replace with your CSS)
        printWindow.document.write('<style>');
        printWindow.document.write('@media print {');
        printWindow.document.write('  .modal-content { width: 100%; }'); // Adjust modal content width
        printWindow.document.write('  .modal-body { font-size: 12px; }'); // Adjust font size
        // Add more CSS rules as needed to adjust the layout
        printWindow.document.write('}');
        printWindow.document.write('</style>');
        printWindow.document.write('</head><body>');

        // Write the modal content to the print window
        printWindow.document.write(originalContents);

        // Remove the print and close buttons from the modal content in the print window
        printWindow.document.querySelector('.modal-footer').remove();

        // Print the content and close the print window
        printWindow.document.close();
        printWindow.print();
    }
</script> --}}
