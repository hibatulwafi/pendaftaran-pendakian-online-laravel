@extends('user_ui.layouts.master')

@section('content')
<div class="container">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Sewa Alat Pendakian</h1>
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
                          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                            Sewa Fasilitas
                          </button>
                          <h3 class="text-right text-success">Rp.{{number_format($sum)}}</h3>
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
                                        <th>Nama</th>
                                        <th>Harga Satuan</th>
                                        <th>Jumlah</th>
                                        <th>Total</th>
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
                                                            <a class="dropdown-item" href="#"
                                                                onclick="handleDelete ({{ $row->id_detail }})">
                                                                <i class="fas fa-trash    "></i>
                                                                Delete
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                            <td style="width: 50px" class="text-center">{{ $i++ }}</td>
                                            
                                            <td>{{$row->nama_fasilitas }}</td>
                                            <td class="text-right">Rp.{{number_format($row->harga) }}</td>
                                            <td class="text-right">{{$row->qty }} Unit</td>
                                            <td class="text-right">Rp.{{number_format($row->harga_sewa) }}</td>
                                           
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">Data Tidak Ada</td>
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

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Sewa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
     <form method="POST" action="{{ route('pendaki.fasilitas.store') }}" enctype="multipart/form-data">
      <div class="modal-body">
           @csrf
            <div class="row">
                <div class="col-md-12 px-12">
                    <div class="form-group">
                        <label for="id_fasilitas">Gunung</label>
                        <select name="id_fasilitas" id="id_fasilitas" class="form-control @error('id_fasilitas') is-invalid @enderror">
                            <option value="" selected="" disabled="">-Pilih Fasilitas-</option>
                            @foreach ($master as $item)
                            <option value="{{ $item->id_fasilitas  }}"
                             @if ($item->stok <= 0)
                                disabled class="text-danger"
                             @endif >
                                {{$item->nama_fasilitas}}  | Stok : ({{$item->stok}})
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="nama_pendaki.anggota">Jumlah</label>
                        <input type="hidden" name="id_transaksi" id="id_transaksi" value="{{$id_transaksi}}">
                        <input type="number" class="form-control @error('jumlah') is-invalid @enderror" name="jumlah" id="jumlah">
                    </div>
                </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
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
