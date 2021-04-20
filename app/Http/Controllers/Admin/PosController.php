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

class PosController extends Controller
{
    public function index(Request $request)
    {
        $pos = DB::table ('tb_pos')
        ->join('tb_jalur','tb_jalur.id_jalur','tb_pos.id_jalur')
        ->get();


        $data=array(
            'pos' => $pos
        );

        return view ('pos.index',$data);

    }

       public function create()
    {
        $gunung = DB::table('tb_gunung')->get();
        $jalur = DB::table('tb_jalur')->get();
        return view('pos.create')->with('gunung', $gunung)->with('jalur', $jalur);
    }


    public function store(Request $request)
    {

        DB::table('tb_pos')->insert([
            'nama_pos' => $request->nama_pos,
            'id_gunung' => 1,
            'id_jalur' => $request->id_jalur,
            'mdpl' => $request->mdpl,
        ]);

        session()->flash('success', 'Data Berhasil Ditambahkan');

        return redirect(route('pos.index'));
    }

 

    public function edit($id)
    {
        $jalur = DB::table('tb_jalur')->get();
        $pos = DB::table ('tb_pos')
        ->join('tb_jalur','tb_jalur.id_jalur','tb_pos.id_jalur')
        ->where('tb_pos.id_pos',$id)
        ->get();

        $data=array(
            'pos' => $pos,
            'jalur'=> $jalur
        );
        return view('pos.edit',$data);

    }

    public function update(Request $request)
    {

        $cek = DB::table ('tb_pos')
        ->join('tb_jalur','tb_jalur.id_jalur','tb_pos.id_jalur')
        ->where('tb_pos.id_pos',$request->id_pos)
        ->first();


         $data = DB::table('tb_pos')
         ->where('id_pos',$request->id_pos)
         ->update([
                'nama_pos' => $request->nama_pos,
                'id_jalur' =>   $request->id_jalur,
                'mdpl' =>   $request->mdpl,
                'updated_at' => now() ]);
     

        session()->flash('success','Sukses ubah data !');
        return redirect()->route('pos.index');
    }

    public function destroy($id)
    {
        $hapus = DB::table('tb_pos')->where('id_pos',$id)->delete();
        session()->flash('success','Sukses hapus data!');
        return redirect()->back();
    }
}
