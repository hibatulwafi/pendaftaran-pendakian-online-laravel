@extends('layouts.master')

@section('content')
<div class="container">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Manajemen Fasilitas</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item active">Data Fasilitas</li>
                    </ol>
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
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('fasilitas.create') }}" class="btn btn-primary">
                                <i class="fas fa-user-plus    "></i>
                                Tambah Data
                            </a>
                            <div class="">
                                <a href="" class="btn btn-default btn-flat " data-toggle="modal" data-target="#importModal" title="Import File">
                                    <i class="fas fa-file-import    "></i>
                                </a>
                                <a href="{{ route('fasilitas.pdf') }}" target="blank" class="btn btn-default btn-flat" title="Cetak PDF">
                                    <i class="fas fa-file-pdf    "></i>
                                </a>
                                <a href="{{ route('fasilitas.export') }}" class="btn btn-default btn-flat" title="Export Excel">
                                    <i class="fas fa-file-excel    "></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        
                        <div class="table-responsive">
                            <table class="table table-head-fixed text-nowrap table-hover " id="myTable">
                                <thead>
                                    <tr class="text-center">
                                        <th>#</th>
                                        <th>No</th>
                                        <th>Gambar</th>
                                        <th>Fasilitas</th>
                                        <!-- <th>Gunung</th> -->
                                        <th>Stok</th>
                                        <th>Harga Sewa</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @php
                                $i=1;
                                @endphp
                                    @forelse($fasilitas as $row)
                                        <tr>
                                            <td style="width: 20px">
                                                <div class="btn-group">
                                                    <button type="button" class="btn" data-toggle="dropdown">
                                                        <i class="fas fa-ellipsis-v    "></i>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <a class="dropdown-item"
                                                                href="{{ route('fasilitas.edit', $row->id_fasilitas) }}">
                                                                <i class="fas fa-edit    "></i>
                                                                Edit
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="#"
                                                                onclick="handleDelete ({{ $row->id_fasilitas }})">
                                                                <i class="fas fa-trash    "></i>
                                                                Delete
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                            <td style="width: 50px" class="text-center">{{ $i++ }}</td>
                                            <td class="text-center">
                                                <a href="{{asset('/img/gambar').'/'.$row->gambar}}" data-fancybox data-caption="{{ $row->nama_fasilitas}}">
                                                    <img width="64px" height="64px" src="{{asset('/img/gambar').'/'. $row->gambar}}" alt="">
                                                </a>
                                            </td>
                                            <td>{{$row->nama_fasilitas }}</td>
                                            <!-- <td>{{$row->nama_gunung }}</td> -->
                                            <td class="text-center">{{$row->stok }}</td>
                                            <td class="text-right">Rp. {{number_format($row->harga) }}</td>
                                            <td class="text-center">
                                              @if($row->status == 0)
                                                <span class="badge badge-danger"> Not Ready </span>
                                              @elseif($row->status == 1)
                                                <span class="badge badge-success"> Ready</span>
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
                <h5 class="modal-title" id="deleteModalLabel">Hapus Data Fasilitas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="mt-3">Apakah kamu yakin menghapus Data Fasilitas ?</p>
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

<!-- Modal Import File-->
<div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Import Data Fasilitas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('fasilitas.import')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                      <label for="import_fasilitas">Import File</label>
                      <input type="file" class="form-control-file" name="import_fasilitas" id="import_fasilitas" placeholder="" aria-describedby="fileHelpId" required>
                      <small id="fileHelpId" class="form-text text-muted">Tipe file : xls, xlsx</small>
                      <small id="fileHelpId" class="form-text text-muted">Pastikan file upload sesuai format. <br> <a href="{{ url('template/fasilitas_template.xlsx') }}">Download contoh format file xlsx <i class="fas fa-download ml-1   "></i></a></small>
                    </div>
                
            </div>
            <div class="modal-footer">
                {{-- <form action="" method="POST" id="deleteForm">
                    @method('DELETE')
                    @csrf --}}
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                {{-- </form> --}}
            </div>
        </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function handleDelete(id) {
        let form = document.getElementById('deleteForm')
        form.action = `./fasilitas/${id}`
        console.log(form)
        $('#deleteModal').modal('show')
    }

</script>

@error('import_fasilitas')
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
