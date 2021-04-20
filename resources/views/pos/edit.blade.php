@extends('layouts.master')

@section('content')
<div class="container">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Manajemen Pos</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('pos.index') }}">Pos</a></li>
                        <li class="breadcrumb-item active">Edit Pos</li>
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
                            
                            <a href="{{ route('pos.index')}}" class="btn">
                                <i class="fas fa-arrow-left  text-purple  "></i>
                            </a>
                            
                            <span>Form Edit Pos</span>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body" >

                     @foreach($pos as $pos)
                        <form method="POST" action="{{ route('pos.update', $pos->id_pos) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                            <div class="row">
                                <div class="col-md-2"></div>
                              
                                <!-- /.col-md -->

                                <div class="col-md-8 px-3">
                                    <div class="form-group">
                                        <label for="nama_pos">Nama Pos</label>
                                        <input type="hidden" class="form-control @error('id_pos') is-invalid @enderror" name="id_pos" id="id_pos" value="{{ $pos->id_pos }}"  placeholder="id_pos" autofocus>
                                        <input type="text" class="form-control @error('nama_pos') is-invalid @enderror" name="nama_pos" id="nama_pos" value="{{ $pos->nama_pos }}"  placeholder="nama_pos" autofocus>
                                        @error('nama_pos')
                                            <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="id_jalur">Jalur</label>
                                        <select name="id_jalur" id="id_jalur" class="form-control @error('id_jalur') is-invalid @enderror">
                                            <option value="">-Pilih jalur-</option>
                                            @foreach ($jalur as $item)
                                            <option value="{{ $item->id_jalur  }}"
                                                    @if ($item->id_jalur == $pos->id_jalur)
                                                        selected
                                                    @endif    
                                                >
                                                
                                                {{ $item->nama_jalur }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('id_jalur')
                                            <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="mdpl">MDPL</label>
                                        <input type="number" class="form-control @error('mdpl') is-invalid @enderror" name="mdpl" id="mdpl" value="{{ $pos->mdpl }}"  placeholder="mdpl">
                                        @error('mdpl')
                                            <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                

                                    <div class="form-group d-flex justify-content-end">
                                        <a class="btn btn-default " href="{{ route('pos.index') }}">Batal</a>
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
            $('#id_jalur').select2()

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
