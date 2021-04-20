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

class FasilitasController extends Controller
{
    public $keyword = '';
    public function index(Request $request)
    {
        $fasilitas = DB::table ('tb_fasilitas')
        ->join('tb_gunung','tb_gunung.id_gunung','tb_fasilitas.id_gunung')
        ->get();

        if (!empty($request->keyword)) {
            $this->keyword = $request->keyword;
            
		$fasilitas = DB::table ('tb_fasilitas')
        ->join('tb_gunung','tb_gunung.id_gunung','tb_fasilitas.id_gunung')
		->where('tb_fasilitas.nama_fasilitas','like',"%".$this->keyword."%")
        ->get();
            
        }

        $data=array(
            'fasilitas' => $fasilitas
        );

        return view ('fasilitas.index',$data);

    }

    public function create()
    {
        $gunung = DB::table('tb_gunung')->get();
        return view('fasilitas.create')->with('gunung', $gunung);
    }


    public function store(Request $request)
    {
        $gambar = '';
        if($request->hasFile('gambar')){
            $gambar = $this->uploadGambar($request);
        }else{
            $gambar = "tent.jpg";
        }
      

        DB::table('tb_fasilitas')->insert([
            'nama_fasilitas' => $request->nama_fasilitas,
            'id_gunung' => $request->id_gunung,
            'stok' => $request->stok,
            'harga' => $request->harga,
            'status' => 1,
            'gambar' => $gambar
        ]);

        session()->flash('success', 'Data Berhasil Ditambahkan');

        return redirect(route('fasilitas.index'));
    }

     public function uploadGambar($request)
    {
        $namaFile = Str::slug($request->nama_fasilitas);
        $ext = explode('/', $request->gambar->getClientMimeType())[1];
        $uniq = uniqid();
        $gambar = "$namaFile-$uniq.$ext";
        $request->gambar->move(public_path('img/gambar'), $gambar);

        return $gambar;
    }

    public function edit($id)
    {
        $gunung = DB::table('tb_gunung')->get();
	    $fasilitas = DB::table ('tb_fasilitas')
        ->join('tb_gunung','tb_gunung.id_gunung','tb_fasilitas.id_gunung')
		->where('id_fasilitas',$id)
		->get();

        $data=array(
            'fasilitas' => $fasilitas,
            'gunung'=> $gunung
        );
        return view('fasilitas.edit',$data);

    }

    public function update(Request $request)
    {

    	$cek = DB::table ('tb_fasilitas')
        ->join('tb_gunung','tb_gunung.id_gunung','tb_fasilitas.id_gunung')
        ->where('id_fasilitas',$request->id_fasilitas)
        ->first();


    	if($request->hasFile('gambar')){
            $gambar = $this->uploadGambar($request);

            if($cek->gambar !== "produk_default.jpg"){
                File::delete('img/gambar/'.$cek->gambar);
            }

  		  $data = DB::table('tb_fasilitas')
         ->where('id_fasilitas',$request->id_fasilitas)
         ->update([
                'nama_fasilitas' => $request->nama_fasilitas,
                'id_gunung' =>   $request->id_gunung,
                'harga' =>   $request->harga,
                'stok' =>   $request->stok,
                'gambar' => $gambar,
                'updated_at' => now() ]);
        }else{

         $data = DB::table('tb_fasilitas')
         ->where('id_fasilitas',$request->id_fasilitas)
         ->update([
                'nama_fasilitas' => $request->nama_fasilitas,
                'id_gunung' =>   $request->id_gunung,
                'harga' =>   $request->harga,
                'stok' =>   $request->stok,
                'updated_at' => now() ]);
        }

       

        session()->flash('success','Sukses ubah data !');
        return redirect()->route('fasilitas.index');
    }

    public function destroy($id)
    {
      	$hapus = DB::table('tb_fasilitas')->where('id_fasilitas',$id)->delete();
        session()->flash('success','Sukses hapus data!');
        return redirect()->back();
    }
}
