<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use PDF;

class UserController extends Controller
{
    public function index()
    {
        return view('user_ui.index');
    }

	public function anggota()
    {
    	$anggota = DB::table ('tb_anggota')
        ->where('id_pendaki',auth()->guard('pendaki')->id())
        ->get();

        $jumlah = DB::table ('tb_anggota')
        ->where('id_pendaki',auth()->guard('pendaki')->id())
        ->count();

        $data=array(
            'anggota' => $anggota,
            'jumlah' => $jumlah
        );

        return view ('user_ui.anggota.index',$data);
    }

  	public function tambahanggota()                      
    {
  	  $leader = DB::table('tb_pendaki')
      ->where('id_pendaki',auth()->guard('pendaki')->id())
      ->first();

		$data=array(
            'leader' => $leader->nama_pendaki,
            'id_leader' => $leader->id_pendaki
        );

        return view('user_ui.anggota.create',$data);
    }

    public function simpananggota(Request $request)                      
    {
        DB::table('tb_anggota')->insert([
            'nama_anggota' => $request->nama_anggota,
            'id_pendaki' => $request->id_pendaki,
            'no_identitas' => $request->no_identitas
        ]);

        session()->flash('success', 'Data Berhasil Ditambahkan');
        return redirect(route('pendaki.anggota'));
    }

    public function edit($id)
    {
        $anggota = DB::table ('tb_anggota')
        ->where('id_anggota',$id)
        ->get();

        $data=array(
            'anggota'=> $anggota
        );

        return view('user_ui.anggota.edit',$data);
    }
    

    public function hapusanggota($id)
    {
        $hapus = DB::table('tb_anggota')->where('id_anggota',$id)->delete();
        session()->flash('success','Sukses hapus data!');
        return redirect()->back();
    }

    public function pendaftaran()                      
    {
      $jumlah = DB::table ('tb_anggota')
        ->where('id_pendaki',auth()->guard('pendaki')->id())
        ->count();

        $data=array(
            'jumlah' => $jumlah
        );

        return view('user_ui.pendaftaran.create',$data);
    }

    public function simpanpendaftaran(Request $request)                      
    {   

        $jumlah = $request->jumlah;
        $date = $request->tanggal;
        $timestamp = strtotime($date);
        $weekday= date("l", $timestamp );
        $normalized_weekday = strtolower($weekday);
        if (($normalized_weekday == "saturday") || ($normalized_weekday == "sunday")) {
            $harga = 34000 * $jumlah;
        } else {
            $harga = 29000 * $jumlah;
        }

        $q=DB::table('tb_pendakian')->select(DB::raw('MAX(id_pendakian) as kd_max'));
        if($q->count()>0){foreach($q->get() as $k){$id_pendakian = $k->kd_max+1;}
        }else{$id_pendakian = "1";}

        $r=DB::table('tb_transaksi')->select(DB::raw('MAX(id_transaksi) as kd_max'));
        if($q->count()>0){foreach($q->get() as $k){$id_transaksi = $k->kd_max+1;}
        }else{$id_transaksi = "1";}


        DB::table('tb_pendakian')->insert([
            'id_pendakian' => $id_pendakian,
            'id_pendaki' => auth()->guard('pendaki')->id(),
            'jumlah' => $jumlah,
            'tanggal_pendakian' => $date,
            'status_naik' => 0,
            'status_turun' => 0,
            'status_izin' => 0
        ]);

        DB::table('tb_transaksi')->insert([
            'id_transaksi' => $id_transaksi,
            'id_pendakian' => $id_pendakian,
            'total_bayar' => $harga,
            'status_transaksi' => 0
        ]);

        session()->flash('success', 'Data Berhasil Ditambahkan');
        return redirect(route('pendaki.dashboard'));
    }

    public function statuspendakian()
    {
        $status = DB::table ('tb_pendakian')
        ->join('tb_transaksi','tb_pendakian.id_pendakian','tb_transaksi.id_pendakian')
        ->where('tb_pendakian.id_pendaki',auth()->guard('pendaki')->id())
        ->get();


        $data=array(
            'status' => $status
        );

        return view ('user_ui.pendakian.index',$data);
    }

    public function tambahfasilitas($id)                      
    {
      $fasilitas = DB::table('tb_detail_transaksi')
      ->join('tb_fasilitas','tb_fasilitas.id_fasilitas','tb_detail_transaksi.id_fasilitas')
      ->join('tb_transaksi','tb_transaksi.id_transaksi','tb_detail_transaksi.id_transaksi')
      ->where('tb_detail_transaksi.id_transaksi',$id)
      ->get();

      $master = DB::table('tb_fasilitas')
      ->get();


      $sum = DB::table('tb_detail_transaksi')
      ->where('id_transaksi',$id)
      ->sum('harga_sewa');

        $data=array(
            'fasilitas' => $fasilitas,
            'master' => $master,
            'id_transaksi' => $id,
            'sum' => $sum
        );

        return view('user_ui.fasilitas.create',$data);
    }

    public function simpanfasilitas(Request $request)                      
    {   
        $q=DB::table('tb_fasilitas')
        ->where('id_fasilitas',$request->id_fasilitas)
        ->first();

        if ($q->stok < $request->jumlah) {
            session()->flash('success', 'Stok Habis Atau Tidak Cukup');
            return redirect(route('pendaki.fasilitas.create',$request->id_transaksi));
        } else {
            $harga = $q->harga * $request->jumlah;
            $sisa = $q->stok - $request->jumlah;


            $updatestok = DB::table('tb_fasilitas')
            ->where('id_fasilitas',$request->id_fasilitas)
            ->update([ 'stok' =>   $sisa ]);

            $simpan = DB::table('tb_detail_transaksi')->insert([
            'id_transaksi' => $request->id_transaksi,
            'id_fasilitas' => $request->id_fasilitas,
            'harga_sewa' => $harga,
            'qty' => $request->jumlah ]);     

            session()->flash('success', 'Data Berhasil Ditambahkan');
            return redirect(route('pendaki.fasilitas.create',$request->id_transaksi));     
       
        }

     
    }

     public function cetak_pdf($id)
    { 

      $leader = DB::table('tb_pendaki')
      ->where('id_pendaki',auth()->guard('pendaki')->id())
      ->first();

      $fasilitas = DB::table('tb_detail_transaksi')
      ->join('tb_fasilitas','tb_fasilitas.id_fasilitas','tb_detail_transaksi.id_fasilitas')
      ->join('tb_transaksi','tb_transaksi.id_transaksi','tb_detail_transaksi.id_transaksi')
      ->where('tb_detail_transaksi.id_transaksi',$id)
      ->get();

      $pendakian = DB::table('tb_pendakian')
      ->join('tb_transaksi','tb_transaksi.id_pendakian','tb_pendakian.id_pendakian')
      ->where('tb_transaksi.id_transaksi',$id)
      ->first();

      $sum = DB::table('tb_detail_transaksi')
      ->where('id_transaksi',$id)
      ->sum('harga_sewa');

        $data=array(
            'fasilitas' => $fasilitas,
            'pendakian' => $pendakian,
            'id' => $id,
            'sum' => $sum,
            'leader' => $leader->nama_pendaki,
            'id_leader' => $leader->id_pendaki
        );

        $pdf = PDF::loadview('user_ui.cetakpendakian',$data);
        return $pdf->download('cetak_transaksi');
    }

    public function riwayat()
    {
        $status = DB::table ('tb_pendakian')
        ->join('tb_transaksi','tb_pendakian.id_pendakian','tb_transaksi.id_pendakian')
        ->where('tb_pendakian.id_pendaki',auth()->guard('pendaki')->id())
        ->get();


        $data=array(
            'status' => $status
        );

        return view ('user_ui.pendakian.riwayat',$data);
    }

}
