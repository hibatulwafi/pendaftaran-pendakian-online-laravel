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
                        <li class="breadcrumb-item active">Edit Jalur</li>
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
                            
                            <span>Form Edit Jalur</span>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body" >

                     @foreach($jalur as $jalur)
                        <form method="POST" action="{{ route('jalur.update', $jalur->id_jalur) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                            <div class="row">
                                <div class="col-md-1"></div>
                                <div class="col-md-5 px-5">
                                    <div class="form-group">
                                        <label for="peta">Gambar Jalur</label>
                                        <input type="file" class="form-control logo @error('peta') is-invalid @enderror" name="gambar" id="peta" value="{{ old('peta') }}" data-default-file="{{ asset('/peta/'.$jalur->peta) }}"  data-height="282">
                                        @error('peta')
                                            <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <!-- /.col-md -->

                                <div class="col-md-5 px-3">
                                    <div class="form-group">
                                        <label for="nama_jalur">Nama Jalur</label>
                                        <input type="hidden" class="form-control @error('id_jalur') is-invalid @enderror" name="id_jalur" id="id_jalur" value="{{ $jalur->id_jalur }}"  placeholder="id_jalur" autofocus>
                                        <input type="text" class="form-control @error('nama_jalur') is-invalid @enderror" name="nama_jalur" id="nama_jalur" value="{{ $jalur->nama_jalur }}"  placeholder="nama_jalur" autofocus>
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
                                                    @if ($item->id_gunung == $jalur->id_gunung)
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
                                        <label for="keterangan">Keterangan</label>
                                        <input type="text" class="form-control @error('keterangan') is-invalid @enderror" name="keterangan" id="keterangan" value="{{ $jalur->keterangan }}"  placeholder="keterangan">
                                        @error('keterangan')
                                            <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                

                                   

                                    <div class="form-group d-flex justify-content-end">
                                        <a class="btn btn-default " href="{{ route('jalur.index') }}">Batal</a>
                                        <button type="submit" class="btn btn-primary ml-2">
                                            Simpan
                                        </button>
                                    </div>
                                </div>
                                <!-- /.col-md -->
                                <div class="col-md-1"></div>
                            </div>
                        </form>
                        @endforeach
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
