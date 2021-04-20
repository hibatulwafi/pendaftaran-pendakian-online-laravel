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
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('fasilitas.index') }}">Fasilitas</a></li>
                        <li class="breadcrumb-item active">Create Fasilitas</li>
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
                        <div class=" d-flex align-items-center justify-content-between">
                            
                            <a href="{{ route('fasilitas.index')}}" class="btn">
                                <i class="fas fa-arrow-left  text-purple  "></i>
                            </a>
                            
                            <span>Form Tambah Fasilitas</span>
                            
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body" >
                        <form method="POST" action="{{ route('fasilitas.store') }}" enctype="multipart/form-data">
                            @csrf
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-5 px-5">
                                <div class="form-group">
                                    <label for="gambar">Gambar Fasilitas</label>
                                    <input type="file" class="form-control logo @error('gambar') is-invalid @enderror" name="gambar" id="gambar" value="{{ old('gambar') }}" data-default-file="{{ old('gambar') }}"  data-height="282">
                                    @error('gambar')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <!-- /.col-md -->

                            <div class="col-md-5 px-3">
                                <div class="form-group">
                                    <label for="nama_fasilitas">Nama Fasilitas</label>
                                    <input type="text" class="form-control @error('nama_fasilitas') is-invalid @enderror" name="nama_fasilitas" id="nama_fasilitas" value="{{ old('nama_fasilitas') }}"  placeholder="nama_fasilitas" autofocus>
                                    @error('nama_fasilitas')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="id_gunung">Gunung</label>
                                    <select name="id_gunung" id="id_gunung" class="form-control @error('id_gunung') is-invalid @enderror">
                                        <option value="">-Pilih gunung-</option>
                                        @foreach ($gunung as $item)
                                        <option value="{{ $item->id_gunung  }}"
                                                @if ($item->id_gunung == old('id_gunung'))
                                                    selected
                                                @endif    
                                            >
                                            
                                            {{ $item->nama_gunung }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('id_gunung')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="harga">Harga Sewa</label>
                                    <input type="text" class="form-control @error('harga') is-invalid @enderror" name="harga" id="harga" value="{{ old('harga') }}"  placeholder="harga">
                                    @error('harga')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>


                                <div class="form-group">
                                    <label for="stok">Stok</label>
                                    <input type="number" class="form-control @error('stok') is-invalid @enderror" name="stok" id="stok" value="{{ old('stok') }}"  placeholder="stok">
                                    @error('stok')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                  <div class="form-group d-flex justify-content-end">
                                    <a class="btn btn-default " href="{{ route('fasilitas.index') }}">Batal</a>
                                    <button type="submit" class="btn btn-primary ml-2">
                                        Simpan
                                    </button>
                                </div>
                            </div>
                            <!-- /.col-md -->
                            <div class="col-md-1"></div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                

                            </div>
                        </div>
                    </form>
                    </div>
                    <!-- /.card-body -->
                    {{-- <div class="card-footer clearfix">
                        tes
                    </div> --}}
                </div>
                <!-- /.card -->
            </div>
        </div>

    </section>
    <!-- /.content -->
</div>
@endsection

@section('scripts')
<script>
    
        $(document).ready(function () {
            $('#id_gunung').select2()

            $('.logo').dropify({
                messages: {
                    'default': '',
                    'replace': 'Drag and drop or click to replace',
                    'remove':  'Remove',
                    'error':   'Ooops, something wrong happended.'
                }
            });

        });

</script>



@endsection
