@extends('user_ui.layouts.master')

@section('content')
<div class="container">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tambah Anggota</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('pendaki.anggota') }}">Anggota</a></li>
                        <li class="breadcrumb-item active">Tambah Anggota</li>
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
                            
                            <a href="{{ route('pendaki.anggota')}}" class="btn">
                                <i class="fas fa-arrow-left  text-purple  "></i>
                            </a>
                            
                            <span>Form Tambah Anggota</span>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body" >
                        <form method="POST" action="{{ route('pendaki.anggota.store') }}" enctype="multipart/form-data">
                            @csrf
                        <div class="row">
                            <div class="col-md-2"></div>
                          

                            <div class="col-md-8 px-8">
                                <div class="form-group">
                                    <label for="nama_pendaki.anggota">Nama Anggota</label>
                                    <input type="hidden" class="form-control @error('id_pendaki') is-invalid @enderror" name="id_pendaki" id="id_pendaki"   placeholder="id_pendaki" value="{{$id_leader}}" autofocus>
                                    <input type="text" class="form-control @error('nama_anggota') is-invalid @enderror" name="nama_anggota" id="nama_anggota" value="{{ old('nama_anggota') }}"  placeholder="nama_anggota" autofocus>
                                    @error('nama_anggota')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="nama_pendaki.anggota">No Identitas</label>
                                    <input type="number" class="form-control @error('no_identitas') is-invalid @enderror" name="no_identitas" id="no_identitas" value="{{ old('no_identitas') }}"  placeholder="no_identitas" autofocus>
                                    @error('no_identitas')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            

                                  <div class="form-group d-flex justify-content-end">
                                    <a class="btn btn-default " href="{{ route('pendaki.anggota') }}">Batal</a>
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
