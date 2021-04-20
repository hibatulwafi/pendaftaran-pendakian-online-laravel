@extends('layouts.master')

@section('content')
<div class="container">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Manajemen Jalur</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('jalur.index') }}">Jalur</a></li>
                        <li class="breadcrumb-item active">Create Jalur</li>
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
                            
                            <a href="{{ route('jalur.index')}}" class="btn">
                                <i class="fas fa-arrow-left  text-purple  "></i>
                            </a>
                            
                            <span>Form Tambah Jalur</span>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body" >
                        <form method="POST" action="{{ route('jalur.store') }}" enctype="multipart/form-data">
                            @csrf
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-5 px-5">
                                <div class="form-group">
                                    <label for="gambar">Peta Jalur</label>
                                    <input type="file" class="form-control logo @error('gambar') is-invalid @enderror" name="gambar" id="gambar" value="{{ old('gambar') }}" data-default-file="{{ old('gambar') }}"  data-height="282">
                                    @error('gambar')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <!-- /.col-md -->

                            <div class="col-md-5 px-3">
                                <div class="form-group">
                                    <label for="nama_jalur">Nama Jalur</label>
                                    <input type="text" class="form-control @error('nama_jalur') is-invalid @enderror" name="nama_jalur" id="nama_jalur" value="{{ old('nama_jalur') }}"  placeholder="nama_jalur" autofocus>
                                    @error('nama_jalur')
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
                                    <label for="nama_pendaki">Keterangan</label>
                                    <textarea class="form-control @error('keterangan') is-invalid @enderror" name="keterangan" id="keterangan" value="{{ old('keterangan') }}" autofocus></textarea> 
                                    @error('keterangan')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                  <div class="form-group d-flex justify-content-end">
                                    <a class="btn btn-default " href="{{ route('users.index') }}">Batal</a>
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
