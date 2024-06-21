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
                <div class="card card-primary">
                    <div class="card-body">
                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b class="ml-5">Customer Name:</b> <b
                                    class="float-right mr-5">{{ $borrow->customer->CustomerName ?? 'Null' }}</b>
                            </li>
                            <li class="list-group-item">
                                <b class="ml-5">Librarian Name:</b> <b
                                    class="float-right mr-5 ">{{ $borrow->user->name ?? 'Null' }}</b>
                            </li>
                            <li class="list-group-item">
                                <b class="ml-5">Borrow Date: </b> <b
                                    class="float-right mr-5">{{ $borrow->BorrowDate ?? 'Null' }}</b>
                            </li>
                            <li class="list-group-item">
                                <b class="ml-5">Borrow Code: </b> <b
                                    class="float-right mr-5">{{ $borrow->BorrowCode ?? 'Null' }}</b>
                            </li>
                            <li class="list-group-item">
                                <b class="ml-5">Depositamount:</b> <b
                                    class="float-right mr-5">{{ $borrow->Depositamount ?? 'Null' }}</b>
                            </li>
                            <li class="list-group-item">
                                <b class="ml-5">FineAmount:</b> <b
                                    class="float-right mr-5">{{ $borrow->FineAmount ?? 'Null' }}</b>
                            </li>
                            <li class="list-group-item">
                                <b class="ml-5">Duedate:</b> <b
                                    class="float-right mr-5">{{ $borrow->Duedate ?? 'Null' }}</b>
                            </li>
                            <li class="list-group-item">
                                <b class="ml-5">Book Name:</b> <b class="float-right mr-5">
                                    <ul class="list-unstyled ml-3">
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
                                                            {{ $book->BookCode }} - {{ $book->catalog->CatalogName }}
                                                        </li>
                                                    @endif
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </ul>
                                </b>
                            </li>
                            <li class="list-group-item">
                                <b class="ml-5">Return:</b> <b class="float-right mr-5">
                                    @if ($borrow->IsReturn)
                                        <span class="badge bg-success">Yes</span>
                                    @else
                                        <span class="badge bg-danger">No</span>
                                    @endif
                                </b>
                            </li>
                            <li class="list-group-item">
                                <b class="ml-5">Return Date:</b> <b
                                    class="float-right mr-5">{{ $borrow->ReturnDate ?? 'Null' }}</b>
                            </li>
                            <li class="list-group-item">
                                <b class="ml-5">Emmo:</b> <b
                                    class="float-right mr-5">{{ $borrow->Emmo ?? 'Null' }}</b>
                            </li>
                        </ul>
                    </div>
                    <!-- /.card-body -->
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
