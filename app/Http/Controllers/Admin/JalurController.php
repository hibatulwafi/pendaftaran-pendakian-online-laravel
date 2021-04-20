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


class JalurController extends Controller
{
    public function index(Request $request)
    {
        $jalur = DB::table ('tb_jalur')
        ->join('tb_gunung','tb_gunung.id_gunung','tb_jalur.id_gunung')
        ->get();


        $data=array(
            'jalur' => $jalur
        );

        return view ('jalur.index',$data);

    }

    public function create()
    {
        $gunung = DB::table('tb_gunung')->get();
        return view('jalur.create')->with('gunung', $gunung);
    }


    public function store(Request $request)
    {
        $gambar = '';
        if($request->hasFile('gambar')){
            $gambar = $this->uploadGambar($request);
        }else{
            $gambar = "peta.pdf";
        }
      

        DB::table('tb_jalur')->insert([
            'nama_jalur' => $request->nama_jalur,
            'id_gunung' => $request->id_gunung,
            'keterangan' => $request->keterangan,
            'peta' => $gambar
        ]);

        session()->flash('success', 'Data Berhasil Ditambahkan');

        return redirect(route('jalur.index'));
    }

     public function uploadGambar($request)
    {
        $namaFile = Str::slug($request->nama_produk);
        $ext = explode('/', $request->gambar->getClientMimeType())[1];
        $uniq = uniqid();
        $gambar = "$namaFile-$uniq.$ext";
        $request->gambar->move(public_path('peta'), $gambar);

        return $gambar;
    }

    public function edit($id)
    {
        $gunung = DB::table('tb_gunung')->get();
        $jalur = DB::table ('tb_jalur')
        ->join('tb_gunung','tb_gunung.id_gunung','tb_jalur.id_gunung')
        ->where('tb_jalur.id_jalur',$id)
        ->get();

        $data=array(
            'jalur' => $jalur,
            'gunung'=> $gunung
        );
        return view('jalur.edit',$data);

    }

    public function update(Request $request)
    {

        $cek = DB::table ('tb_jalur')
        ->join('tb_gunung','tb_gunung.id_gunung','tb_jalur.id_gunung')
        ->where('tb_jalur.id_jalur',$request->id_jalur)
        ->first();


        if($request->hasFile('gambar')){
            $gambar = $this->uploadGambar($request);

            if($cek->peta !== "peta.pdf"){
                File::delete('img/gambar/'.$cek->peta);
            }

          $data = DB::table('tb_jalur')
         ->where('id_jalur',$request->id_jalur)
         ->update([
                'nama_jalur' => $request->nama_jalur,
                'id_gunung' =>   $request->id_gunung,
                'keterangan' =>   $request->keterangan,
                'peta' => $gambar,
                'updated_at' => now() ]);
        }else{

         $data = DB::table('tb_jalur')
         ->where('id_jalur',$request->id_jalur)
         ->update([
                'nama_jalur' => $request->nama_jalur,
                'id_gunung' =>   $request->id_gunung,
                'keterangan' =>   $request->keterangan,
                'updated_at' => now() ]);
        }

       

        session()->flash('success','Sukses ubah data !');
        return redirect()->route('jalur.index');
    }

    public function destroy($id)
    {
        $hapus = DB::table('tb_jalur')->where('id_jalur',$id)->delete();
        session()->flash('success','Sukses hapus data!');
        return redirect()->back();
    }
}
