@extends('layouts.master')

@section('content')
<div class="container">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Manajemen Pendaki</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item active">Data Pendaki</li>
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
                   
                    <!-- /.card-header -->
                    <div class="card-body">
                      <div class="col-12">
                      <div class="row">
 						 <div class="col-lg-6 col-md-6" data-aos="zoom-in" data-aos-delay="100">
				            <div class="box">
				                <a href="{{route('formpendaftaran1')}}" >
				              <center>
				              	<img src="{{asset('img/plan3.png')}}" width="80%" class="img-fluid" alt="">
				             	<h3 style="color: #07d5c0;">Pendaki Baru</h3>
							 </center>
				            </a>
				            </div>
				          </div>

				          <div class="col-lg-6 col-md-6" data-aos="zoom-in" data-aos-delay="200">
				            <div class="box">
				              <a href="{{route('formpendaftaran2')}}" class="btn-buy">
				              <center>
				              <img src="{{asset('img/plan2.png')}}" width="80%" class="img-fluid" alt="">
				              	
									<h3 style="color: #65c600;">Member</h3>
							   </center>
				               </a>
				            </div>
				          </div>
				          </div>       
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
                <h5 class="modal-title" id="deleteModalLabel">Hapus Data Pendaki</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="mt-3">Apakah kamu yakin menghapus Data Pendaki ?</p>
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
                <h5 class="modal-title" id="deleteModalLabel">Import Data Pendaki</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('pendaki.import')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                      <label for="import_pendaki">Import File</label>
                      <input type="file" class="form-control-file" name="import_pendaki" id="import_pendaki" placeholder="" aria-describedby="fileHelpId" required>
                      <small id="fileHelpId" class="form-text text-muted">Tipe file : xls, xlsx</small>
                      <small id="fileHelpId" class="form-text text-muted">Pastikan file upload sesuai format. <br> <a href="{{ url('template/pendaki_template.xlsx') }}">Download contoh format file xlsx <i class="fas fa-download ml-1   "></i></a></small>
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


<style>
.img-fluid:hover {
  transform: scale(1.1);
 
  /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
}
</style>


@endsection

@section('scripts')
<script>
    function handleDelete(id) {
        let form = document.getElementById('deleteForm')
        form.action = `./pendaki/${id}`
        console.log(form)
        $('#deleteModal').modal('show')
    }

</script>

@error('import_pendaki')
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
