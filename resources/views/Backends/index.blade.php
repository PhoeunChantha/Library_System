@extends('Backends.master')
@section('content')
    <div class="row ">
        <div class="col-sm-6">
            <h2 id="greeting">Hello, @auth {{ Auth::user()->name }} @endauth
            </h2>
            <p>
                @php
                    $currentTime = now()->format('l, F j, Y h:i A');
                @endphp
                {{ $currentTime }}
            </p>
        </div><!-- /.col -->
        <div class="banner mt-2 mb-5 d-flex justify-content-center">
            <img src="/Login_images/banner.jpg" width="90%" height="250px" alt="image">
        </div>
    </div><!-- /.row -->
    <!-- Small boxes (Stat box) -->
    <div class="row  justify-content-center">
        <div class="col-lg-3 ">
            <!-- small box -->
            <div class="small-box bg-white">
                <div class="inner pl-4">
                    <h3>{{ $totalBorrows }}</h3>
                    <p>Total Borrows</p>
                </div>
                <div class="icon">
                    <i class="fa-solid fa-book-open-reader pt-1 mr-4"></i>
                </div>
                <a href="{{ route('borrow.index') }}" class="small-box-footer">More info <i
                        class="fas fa-arrow-circle-right"></i></a>

            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 ">
            <!-- small box -->
            <div class="small-box bg-white">
                <div class="inner pl-4">
                    <h3>{{ $totalReturns }}</h3>

                    <p>Total Return</p>
                </div>
                <div class="icon">
                    <i class="fa-solid fa-right-left p-1 mr-4"></i>
                </div>
                <a href="{{ route('borrowdetail.index') }}" class="small-box-footer">More info <i
                        class="fas fa-arrow-circle-right"></i></a>

            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 ">
            <!-- small box -->
            <div class="small-box bg-white ">
                <div class="inner pl-4">
                    <h3>{{ $totalBooks }}</h3>
                    <p>Total Books</p>
                </div>
                <div class="icon">
                    <i class="fa-solid fa-book p-1 mr-4"></i>
                </div>
                <a href="{{ route('book.index') }}" class="small-box-footer">More info <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 ">
            <!-- small box -->
            <div class="small-box bg-white ">
                <div class="inner pl-4">
                    <h3>{{ $totalCustomers }}</h3>
                    <p>Total Customers</p>
                </div>
                <div class="icon">
                    <i class="fa-solid fa-address-book p-1 mr-4"></i>
                </div>
                <a href="{{ route('customer.index') }}" class="small-box-footer">More info <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
    </div>
    <!-- AREA CHART -->
    <div class="card card-white">
        <div class="card-header">
            <h3 class="card-title">Area Chart</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        <div class="card-body" style="display: block;">
            <div class="chart">
                <div class="chartjs-size-monitor">
                    <div class="chartjs-size-monitor-expand">
                        <div class=""></div>
                    </div>
                    <div class="chartjs-size-monitor-shrink">
                        <div class=""></div>
                    </div>
                </div>
                <canvas id="areaChart"
                    style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%; display: block; width: 580px;"
                    width="725" height="312" class="chartjs-render-monitor"></canvas>
            </div>
        </div>
        <!-- /.card-body -->
    </div>

    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">ALL List Book</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                {{-- <div class="row mt-4">
                    @foreach ($books as $book)
                        <div class="col-sm-3 mb-2">
                            <div class="position-relative">
                                <img src="
                                @if ($book->BookImage && file_exists(public_path('images/' . $book->BookImage))) {{ asset('images/' . $book->BookImage) }}
                                @else
                                    {{ asset('uploads/image/noimage.png') }} @endif
                                "
                                    alt="Book Image" class="img-fluid">
                                <div class="ribbon-wrapper ribbon-xl">
                                    <div class="ribbon bg-warning text-lg">
                                        {{ $book->BookName }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div> --}}
                <div class="direct-chat-messages" style="height: 10cm;">
                    <div class="row mt-4">
                        @foreach ($books as $book)
                            @php
                                $borrowDetail = $book->borrowDetail; // Assuming the relationship is defined in the Book model
                                $isReturned = $borrowDetail ? $borrowDetail->return : null;
                            @endphp

                            <div class="col-sm-3 mb-2">
                                <div class="position-relative">
                                    <img src="{{ $book->BookImage && file_exists(public_path('images/' . $book->BookImage)) ? asset('images/' . $book->BookImage) : asset('uploads/image/noimage.png') }}"
                                        alt="Book Image" class="img-fluid">
                                    <div class="ribbon-wrapper ribbon-xl">
                                        <div class="ribbon {{ $isReturned == 1 ? 'bg-primary' : 'bg-success' }} text-sm">
                                            {{ $book->catalog->CatalogName}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
@endsection

