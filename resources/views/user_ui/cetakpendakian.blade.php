<html>
<head>
	<title> Cetak Transaksi</title>
	    <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">

</head>
<body>


<section class="content">
        <div class="row">
            <div>
                <div class="span12">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td><h4><strong>No Transaksi : </strong>#{{date("Ymd")}}-{{$id}}</h4></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

          <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
              Ketua Pendaki
              <address>
                <strong>{{$leader}}</strong><br>
                Jumlah Pendaki : {{$pendakian->jumlah+1}} <br>
                HTM : Rp.{{number_format($pendakian->total_bayar)}}
              </address>
            </div>
           
          </div>
          <div class="row">
            <div class="col-xs-12 table-responsive">
              <table class="table table-striped">
                <thead>
                <tr>
		            <th>No</th>
		            <th>Nama Fasilitas</th>
		            <th>Harga Satuan</th>
		            <th>Jumlah</th>
		            <th>Total</th>
                </tr>
                </thead>
                <tbody>
                    @php $i=1 @endphp
                    @forelse($fasilitas as $row)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{$row->nama_fasilitas }}</td>
                        <td class="text-right">Rp.{{number_format($row->harga) }}</td>
                        <td class="text-right">{{$row->qty }} Unit</td>
                        <td class="text-right">Rp.{{number_format($row->harga_sewa) }}</td>
                    </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Tidak Sewa Alat Pendakian</td>
                        </tr>
                    @endforelse
                    <tr>
                        <td colspan="3"></td>
                        <td><b>Total</b></td>
                        <td><b>Rp.{{number_format($sum)}}</b></td>
                    </tr>
                    <tr>
                        <td colspan="3"></td>
                        <td><b>Total Bayar</b></td>
                        <td><b>Rp.{{number_format($sum+$pendakian->total_bayar)}}</b></td>
                    </tr>
                </tbody>
            </table>
          </div>
      </section>
    </div>

</body>
</html>