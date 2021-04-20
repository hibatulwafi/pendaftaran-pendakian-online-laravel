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

class PendakiController extends Controller
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
        return view('pendaki.pendaftaran');
    }

    public function create()
    {
        $gunung = DB::table('tb_gunung')->get();
        return view('pendaki.create')->with('gunung', $gunung);
    }


    public function store(Request $request)
    {

         $q=DB::table('tb_pendaki')->select(DB::raw('MAX(id_pendaki) as kd_max'));
            if($q->count()>0){foreach($q->get() as $k){$id = $k->kd_max+1;}
            }else{$id = "1";}

        DB::table('tb_pendaki')->insert([
            'nama_pendaki' => $request->nama_pendaki,
            'id_pendaki' => $id,
            'no_identitas' => $request->no_identitas,
            'alamat' => $request->alamat,
            'keterangan' => $request->keterangan,
            'jk' =>  $request->jk,
            'status' => 1
        ]);

        DB::table('tb_pendaki_login')->insert([
            'username' => $request->email,
            'password' => bcrypt('password'),
            'id_pendaki' => $id,
            'created_at' => now()
        ]);

        session()->flash('success', 'Data Berhasil Ditambahkan');
        return redirect(route('pendaki.index'));
    }

     public function uploadGambar($request)
    {
        $namaFile = Str::slug($request->nama_produk);
        $ext = explode('/', $request->gambar->getClientMimeType())[1];
        $uniq = uniqid();
        $gambar = "$namaFile-$uniq.$ext";
        $request->gambar->move(public_path('img/gambar'), $gambar);

        return $gambar;
    }

    public function edit($id)
    {
        $gunung = DB::table('tb_gunung')->get();
	    $pendaki = DB::table ('tb_pendaki')
        ->join('tb_gunung','tb_gunung.id_gunung','tb_pendaki.id_gunung')
		->where('id_pendaki',$id)
		->get();

        $data=array(
            'pendaki' => $pendaki,
            'gunung'=> $gunung
        );
        return view('pendaki.edit',$data);

    }

    public function update(Request $request)
    {

    	$cek = DB::table ('tb_pendaki')
        ->join('tb_gunung','tb_gunung.id_gunung','tb_pendaki.id_gunung')
        ->where('id_pendaki',$request->id_pendaki)
        ->first();


    	if($request->hasFile('gambar')){
            $gambar = $this->uploadGambar($request);

            if($cek->gambar !== "produk_default.jpg"){
                File::delete('img/gambar/'.$cek->gambar);
            }

  		  $data = DB::table('tb_pendaki')
         ->where('id_pendaki',$request->id_pendaki)
         ->update([
                'nama_pendaki' => $request->nama_pendaki,
                'id_gunung' =>   $request->id_gunung,
                'harga' =>   $request->harga,
                'stok' =>   $request->stok,
                'gambar' => $gambar,
                'updated_at' => now() ]);
        }else{

         $data = DB::table('tb_pendaki')
         ->where('id_pendaki',$request->id_pendaki)
         ->update([
                'nama_pendaki' => $request->nama_pendaki,
                'id_gunung' =>   $request->id_gunung,
                'harga' =>   $request->harga,
                'stok' =>   $request->stok,
                'updated_at' => now() ]);
        }

       

        session()->flash('success','Sukses ubah data !');
        return redirect()->route('pendaki.index');
    }

    public function destroy($id)
    {
      	$hapus = DB::table('tb_pendaki')->where('id_pendaki',$id)->delete();
        session()->flash('success','Sukses hapus data!');
        return redirect()->back();
    }
}
