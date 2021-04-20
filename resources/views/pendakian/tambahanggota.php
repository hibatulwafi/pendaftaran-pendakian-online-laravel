@extends('layouts.master')

@section('content')
<div class="container">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Pendaftaran Baru {{$id_pendaki}} a</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('pendaki.index') }}">Pendaki</a></li>
                        <li class="breadcrumb-item active">Daftar Baru</li>
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
                            
                            <a href="{{ route('pendaki.index')}}" class="btn">
                                <i class="fas fa-arrow-left  text-purple  "></i>
                            </a>
                            
                            <span>Form Tambah Pendaki</span>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body" >
                        <form method="POST" action="{{ route('postdaftar') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-5 px-5">
                                <div class="form-group">
                                    <label for="gambar">Foto Pendaki</label>
                                    <input type="file" class="form-control logo @error('gambar') is-invalid @enderror" name="gambar" id="gambar" value="{{ old('gambar') }}" data-default-file="{{ old('gambar') }}"  data-height="282">
                                    @error('gambar')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <!-- /.col-md -->

                            <div class="col-md-5 px-3">
                                <div class="form-group">
                                    <label for="nama_pendaki">Identitas Pendaki</label>
                                    <input type="text" class="form-control @error('nama_pendaki') is-invalid @enderror" name="nama_pendaki" id="nama_pendaki" value="{{ old('nama_pendaki') }}"  placeholder="Nama" autofocus>
                                    @error('nama_pendaki')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                              

                                <div class="form-group">
                                    <input type="text" class="form-control @error('no_identitas') is-invalid @enderror" name="no_identitas" id="no_identitas" value="{{ old('no_identitas') }}"  placeholder="No Identitas" autofocus>
                                    @error('no_identitas')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                 <div class="form-group">
                                    <select name="keterangan" id="keterangan" class="form-control @error('keterangan') is-invalid @enderror">
                                        <option value="">-Keterangan-</option>
                                       
                                        <option value="KTP"> KTP </option>
                                        <option value="No Pelajar"> No Pelajar </option>
                                        <option value="SIM"> SIM </option>

                                    </select>
                                    @error('id_gunung')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <select name="jk" id="jk" class="form-control @error('jk') is-invalid @enderror">
                                        <option value="">-Jenis Kelamin-</option>
                                       
                                        <option value="L"> Pria </option>
                                        <option value="P"> Wanita </option>

                                    </select>
                                    @error('nama_pendaki')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="nama_pendaki">Alamat</label>
                                    <textarea class="form-control @error('alamat') is-invalid @enderror" name="alamat" id="alamat" value="{{ old('alamat') }}" autofocus></textarea> 
                                    @error('alamat')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                 <div class="form-group d-flex justify-content-end">
                                    <a class="btn btn-default " href="{{ route('formpendaftaran1') }}">Batal</a>
                                    <button type="submit" class="btn btn-primary ml-2">
                                        Simpan
                                    </button>
                                </div>

                            </div>
                            <!-- /.col-md -->
                            <div class="col-md-1"></div>
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
            $('#keterangan').select2()
            $('#jk').select2()

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
