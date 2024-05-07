@extends('Dashboard')
@section('content')
 <!-- Small boxes (Stat box) -->
 <div class="row gap-4 justify-content-center">

    <div class="col-lg-3 ">
        <!-- small box -->
        <div class="small-box bg-info p-2">
            <div class="inner">
                <h3>{{ $totalBorrows }}</h3>

                <p>Total Borrows</p>
            </div>
            <div class="icon">
                <i class="fa-solid fa-book-open-reader pt-1"></i>
            </div>

        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 ">
        <!-- small box -->
        <div class="small-box bg-success p-2">
            <div class="inner">
                <h3>{{ $totalReturns}}</h3>

                <p>Total Return</p>
            </div>
            <div class="icon">
                <i class="fa-solid fa-right-left p-1"></i>
            </div>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 ">
        <!-- small box -->
        <div class="small-box bg-warning p-2">
            <div class="inner">
                <h3>{{ $totalBooks}}</h3>

                <p>Total Books</p>
            </div>
            <div class="icon">
                <i class="fa-solid fa-book p-1"></i>
            </div>
        </div>
    </div>
    <!-- ./col -->
    {{-- <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>65</h3>

                <p>Unique Visitors</p>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div> --}}
    <!-- ./col -->
</div>

<div class="row">
    <div class="col-md-3 col-sm-6 col-12">
      <div class="info-box shadow-lg">
        <span class="info-box-icon bg-info"><i class="fa-solid fa-user-tie"></i></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Total Librarian</span>
          <span class="info-box-number">{{$totalLibrarians}}</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-12">
      <div class="info-box shadow-lg">
        <span class="info-box-icon bg-success"><i class="fa-solid fa-users"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Total Customer</span>
          <span class="info-box-number">{{$totalCustomers}}</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-12">
      <div class="info-box shadow-lg">
        <span class="info-box-icon bg-warning"><i class="fa-solid fa-user"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Total User</span>
          <span class="info-box-number">{{$totalUsers}}</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-12">
      <div class="info-box shadow-lg">
        <span class="info-box-icon bg-danger"><i class="far fa-star"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Shadows</span>
          <span class="info-box-number">Large</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
  </div>
@endsection
