@extends('layouts.master')

@section('content')
<div class="container">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Dashboard</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        {{-- <li class="breadcrumb-item"><a href="#">Home</a></li> --}}
                        {{-- <li class="breadcrumb-item active">Blank Page</li> --}}
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{$mendaki}}</h3>

                        <p>Sedang Mendaki</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-blind" aria-hidden="true"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $bulanini}}</h3>

                        <p>Pendaki Bulan ini</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-users    "></i>
                    </div>
                    <a href="{{ route('roles.index') }}" class="small-box-footer">More info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-6 col-12">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>Rp 1,207,000</h3>

                        <p>Pendapatan Bulanan</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="{{ route('users.index') }}" class="small-box-footer">More info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
           
            <!-- ./col -->
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Permohonan Pendakian</h3>

                        <div class="card-tools small">
                            <a href="{{ route('produk.index') }}">Selengkapnya</a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0" style="height: 235px;">
                        <table class="table table-head-fixed text-nowrap small">
                            <thead>
                                <tr>
                                    <th>Nama Pendaki</th>
                                    <th>Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                    <tr>
                                        <td>Rival Zulkarnaen</td>
                                        <td> 17 February 2021 </td>
                                    </tr> 
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <!-- /.col-md -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Log Aktifitas</h3>

                        <div class="card-tools small">
                            <a href="{{ route('users.index') }}">Selengkapnya</a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0" style="height: 235px;">
                        <table class="table table-head-fixed text-nowrap small">
                            <thead>
                                <tr>
                                    <th>Log</th>
                                    <th>Tanggal</th>
                                    <th>Tipe</th>
                                </tr>
                            </thead>
                            <tbody>
                                    <tr>
                                        <td>Rival Login Ke aplikasi</td>
                                        <td> 17 February 2021 </td>
                                        <td> Login </td>
                                    </tr> 
                                    <tr>
                                        <td>Admin Login Ke aplikasi</td>
                                        <td> 17 February 2021 </td>
                                        <td> Login </td>
                                    </tr> 
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <!-- /.col-md -->
        </div>

    </section>
    <!-- /.content -->
</div>
@endsection
