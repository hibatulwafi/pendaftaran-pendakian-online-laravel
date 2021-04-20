@extends('user_ui.layouts.master')

@section('content')
<div class="container">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Pendakian</h1>
                </div>
               
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        
                        <div class="table-responsive">
                            <table class="table table-head-fixed text-nowrap table-hover " id="myTable">
                                <thead>
                                    <tr class="text-center">
                                        <th>#</th>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Jumlah</th>
                                        <th>Total Bayar</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @php
                                $i=1;
                                @endphp
                                    @forelse($status as $row)
                                        <tr>
                                            <td style="width: 20px">
                                                <div class="btn-group">
                                                    <button type="button" class="btn" data-toggle="dropdown">
                                                        <i class="fas fa-ellipsis-v    "></i>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <a class="dropdown-item" href="#"
                                                                onclick="handleDelete ({{ $row->id_pendakian }})">
                                                                <i class="fas fa-trash    "></i>
                                                                Delete
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                            <td style="width: 50px" class="text-center">{{ $i++ }}</td>
                                            
                                            <td class="text-center">{{ date_format(date_create($row->tanggal_pendakian),"d F - Y") }}</td>
                                            <td class="text-center">{{$row->jumlah }}</td>

                                            @php
                                              $sum = DB::table('tb_detail_transaksi')
                                              ->where('id_transaksi',$row->id_pendakian)
                                              ->sum('harga_sewa');
                                            @endphp
                                            <td>
                                            <center>
                                                <table class="table borderless">
                                                <tr>
                                                    <td>HTM </td><td>:</td><td class="text-right"> Rp.{{number_format($row->total_bayar)}}<td>
                                                </tr>
                                                <tr>
                                                    <td>Sewa Fasilitas </td><td>:</td><td class="text-right"> Rp.{{number_format($sum)}}<td>
                                                </tr>
                                                <tr>
                                                    <td>Total </td><td>:</td><td class="text-right"> Rp.{{number_format($row->total_bayar + $sum)}}<td>
                                                </tr>
                                                </table>
                                            </center>
                                            </td>
                                            <td class="text-center">
                                              @if($row->status_transaksi == 0)
                                                <span class="badge badge-danger"> Menunggu</span>
                                              @elseif($row->status_transaksi == 1)
                                                <span class="badge badge-success"> Disetujui</span>
                                                @elseif($row->status_transaksi == 2)
                                                <span class="badge badge-success"> Selesai</span>
                                                @elseif($row->status_transaksi == 3)
                                                <span class="badge badge-danger"> Dibatalkan</span>
                                              @endif
                                            </td>
                                             <td class="text-center" width="15%">
                                             @if($row->status_transaksi == 0 || $row->status_transaksi ==1 )
                                               <a class="badge badge-success" href="{{route('pendaki.fasilitas.create',$row->id_pendakian)}}">
                                                <i class="fas fa-plus"></i> Sewa Fasilitas
                                               </a>

                                               <a class="badge badge-info" href="{{route('pendaki.cetak_pdf',$row->id_transaksi)}}">
                                                <i class="fas fa-print"></i> Print
                                             </a>
                                             @endif
                                             
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center">Data Tidak Ada</td>
                                        </tr>
                                    @endforelse
    
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div>

    </section>
    <!-- /.content -->
</div>

<!-- Modal Delete-->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Hapus Data Jalur</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="mt-3">Apakah kamu yakin menghapus Data Jalur ?</p>
            </div>
            <div class="modal-footer">
                <form action="" method="POST" id="deleteForm">
                    @method('DELETE')
                    @csrf
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak, Kembali</button>
                    <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>

 @endsection

@section('scripts')
<script>
    function handleDelete(id) {
        let form = document.getElementById('deleteForm')
        form.action = `./hapus/anggota/${id}`
        console.log(form)
        $('#deleteModal').modal('show')
    }

</script>

@error('import_anggota')
    {{-- <div class="text-danger small mt-1">{{ $message }}</div> --}}
    <script>
        $(document).ready(function () {
            toastr["error"]('{{ $message }}')
        });
    </script>
@enderror

@if(session()->has('success'))
    <script>
        $(document).ready(function () {
            toastr["success"]('{{ session()->get('success') }}')
        });

    </script>
@endif

@if(session()->has('error'))
    <script>
        $(document).ready(function () {
            toastr["info"]('{{ session()->get('error') }}')
        });

    </script>
@endif

@endsection
