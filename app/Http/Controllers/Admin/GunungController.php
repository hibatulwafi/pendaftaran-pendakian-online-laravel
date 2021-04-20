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

class GunungController extends Controller
{
    public $keyword = '';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $gunung = DB::table ('tb_gunung')
        ->get();

        if (!empty($request->keyword)) {
            $this->keyword = $request->keyword;
            
		$gunung = DB::table ('tb_gunung')
		->where('nama_gunung','like',"%".$this->keyword."%")
        ->get();
            
        }

        $data=array(
            'gunung' => $gunung
        );

        return view ('gunung.index',$data);

    }
}
