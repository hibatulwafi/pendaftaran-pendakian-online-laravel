<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use PDF;

class LaporanController extends Controller
{
    public function laporan()
    {
        $status = DB::table ('tb_pendakian')
        ->join('tb_transaksi','tb_pendakian.id_pendakian','tb_transaksi.id_pendakian')
        ->where('tb_transaksi.status_transaksi',1)
        ->get();


        $data=array(
            'status' => $status
        );

        return view ('laporan.index',$data);
    }

    public function cetak_pdf($id)
    { 

      $leader = DB::table('tb_transaksi')
      ->join('tb_pendakian','tb_pendakian.id_pendakian','tb_transaksi.id_pendakian')
      ->join('tb_pendaki','tb_pendakian.id_pendaki','tb_pendaki.id_pendaki')
      ->where('tb_transaksi.id_transaksi',$id)
      ->select('tb_pendaki.id_pendaki','tb_pendaki.nama_pendaki')
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
    
}
