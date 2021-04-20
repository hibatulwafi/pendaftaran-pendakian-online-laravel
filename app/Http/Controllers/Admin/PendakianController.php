<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use PDF;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Exports\ProdukExport;
use App\Imports\ProdukImport;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class PendakianController extends Controller
{
    public $keyword = '';
    public function index(Request $request)
    {
        $pendaki = DB::table ('tb_pendaki')
        ->get();
        $data=array(
            'pendaki' => $pendaki
        );

        return view ('pendaki.index',$data);

    }

    public function pendaftaran()
    {
        return view('pendakian.pendaftaran');
    }

    public function formpendaftaran1()
    {
        return view('pendakian.daftarbaru');
    }

    public function formpendaftaran2()
    {
        return view('pendakian.member');
    }

    public function postdaftar(Request $request)
    {
        $q=DB::table('tb_pendaki')->select(DB::raw('MAX(id_pendaki) as kd_max'));
        if($q->count()>0){foreach($q->get() as $k){$id_pendaki = $k->kd_max+1;}
        }else{$id_pendaki = "1";}

        $gambar = '';
        if($request->hasFile('gambar')){
            $gambar = $this->uploadGambar($request);
        }else{
            $gambar = "profile.jpg";
        }
      

        DB::table('tb_pendaki')->insert([
            'id_pendaki' => $id_pendaki,
            'foto' => $gambar,
            'nama_pendaki' => $request->nama_pendaki,
            'no_identitas' => $request->no_identitas,
            'alamat' => $request->alamat,
            'keterangan' => $request->keterangan,
            'jk' => $request->jk,
            'status' => 1,
        ]);

        session()->flash('success', 'Data Berhasil Ditambahkan');
        return redirect(route('pendakian.tambahanggota',['id_pendaki' => $id_pendaki]));
    }

    public function tambahanggota (Request $request)
    {
       
        return view('pendakian.tambahanggota');
    }

    public function postanggota (Request $request)
    {

        echo "a";
       /*if($request->ajax())
         {
          $rules = array(
           'nama_anggota.*'  => 'required',
           'noid_anggota.*'  => 'required'
          );
          $error = Validator::make($request->all(), $rules);
          if($error->fails())
          {
           return response()->json([
            'error'  => $error->errors()->all()
           ]);
          }

          $nama_anggota = $request->nama_anggota;
          $noid_anggota = $request->noid_anggota;
          for($count = 0; $count < count($nama_anggota); $count++)
          {
           $data = array(
            'id_pendaki' => $request->id_pendaki,
            'nama_anggota' => $nama_anggota[$count],
            'noid_anggota'  => $noid_anggota[$count]
           );
           $insert_data[] = $data; 
          }

          DB::table('tb_anggota')->insert($insert_data);

          return response()->json([
           'success'  => 'Data Added successfully.'
          ]);
         }*/

    }

    

    public function uploadGambar($request)
    {
        $namaFile = Str::slug($request->nama_pendaki);
        $ext = explode('/', $request->gambar->getClientMimeType())[1];
        $uniq = uniqid();
        $gambar = "$namaFile-$uniq.$ext";
        $request->gambar->move(public_path('img/pendaki'), $gambar);

        return $gambar;
    }

    public function permohonan()
    {
        $status = DB::table ('tb_pendakian')
        ->join('tb_transaksi','tb_pendakian.id_pendakian','tb_transaksi.id_pendakian')
        ->get();


        $data=array(
            'status' => $status
        );

        return view ('pendakian.permohonan',$data);
    }

    public function terima($id)
    {
        $terima = DB::table('tb_pendakian')
        ->where('id_pendakian',$id)
        ->update([ 'status_izin' => 1 ]);

        $transaksi = DB::table('tb_transaksi')
        ->where('id_pendakian',$id)
        ->update([ 'status_transaksi' => 1 ]);


        if ($terima && $transaksi) {
          session()->flash('success','Sukses!');
          return redirect()->route('permohonan');        
        }else{
          session()->flash('errpr','Gagal !');
          return redirect()->route('permohonan');     
        }
       
    }

    public function tolak($id)
    {
        $terima = DB::table('tb_pendakian')
        ->where('id_pendakian',$id)
        ->update([ 'status_izin' => 2 ]);

        $transaksi = DB::table('tb_transaksi')
        ->where('id_pendakian',$id)
        ->update([ 'status_transaksi' => 3 ]);


        if ($terima && $transaksi) {
          session()->flash('success','Sukses!');
          return redirect()->route('permohonan');        
        }else{
          session()->flash('errpr','Gagal !');
          return redirect()->route('permohonan');     
        }
       
    }

    public function statuspendakian(Request $request)
    {
        $pendakian = DB::table ('tb_pendaki')
        ->join('tb_pendakian','tb_pendakian.id_pendaki','tb_pendaki.id_pendaki')
        ->where('status_izin',1)
        ->get();

        $data=array(
            'status' => $pendakian
        );

        return view ('pendakian.statuspendakian',$data);

    }

    public function statuspendakianedit($id)                      
    {
      $fasilitas = DB::table('tb_detail_transaksi')
      ->join('tb_fasilitas','tb_fasilitas.id_fasilitas','tb_detail_transaksi.id_fasilitas')
      ->join('tb_transaksi','tb_transaksi.id_transaksi','tb_detail_transaksi.id_transaksi')
      ->join('tb_pendakian','tb_pendakian.id_pendakian','tb_transaksi.id_pendakian')
      ->where('tb_transaksi.id_pendakian',$id)
      ->get();


      $pendakian = $id;


      $sum = DB::table('tb_detail_transaksi')
      ->join('tb_transaksi','tb_transaksi.id_transaksi','tb_detail_transaksi.id_transaksi')
      ->where('tb_transaksi.id_pendakian',$id)
      ->sum('tb_detail_transaksi.harga_sewa');


      $sum2 = DB::table('tb_transaksi')
      ->where('id_pendakian',$id)
      ->sum('total_bayar');

        $data=array(
            'fasilitas' => $fasilitas,
            'id_transaksi' => $id,
            'sum' => $sum + $sum2,
            'pendakian' => $pendakian
        );

        return view ('pendakian.statuspendakianedit',$data);
    }

    public function naik($id){

         $data = DB::table('tb_pendakian')
         ->where('id_pendakian',$id)
         ->update([
                'status_naik' => 1,
                'updated_at' => now() ]);

        session()->flash('success','Pendaki Sudah Naik!');
        return redirect()->route('statuspendakian.index');
    }

    public function turun($id){

         $data = DB::table('tb_pendakian')
         ->where('id_pendakian',$id)
         ->update([
                'status_turun' => 1,
                'status_naik' => 2,
                'updated_at' => now() ]);

        session()->flash('success','Pendaki Sudah Turun!');
        return redirect()->route('statuspendakian.index');
    }

    

}
