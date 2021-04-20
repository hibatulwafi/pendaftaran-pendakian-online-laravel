<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class HomeController extends Controller
{
     public function index()
    {
        return view('user_ui.index');
    }
     public function dashboard()
    {
    	$cek = DB::table('tb_pendaki')
    	->where('id_pendaki',auth()->guard('pendaki')->id())
        ->first();

        $jumlah = DB::table('tb_pendakian')
        ->where('id_pendaki',auth()->guard('pendaki')->id())
        ->count();


        $data=array(
            'cek' => $cek,
            'jumlah' => $jumlah
        );

        return view('user_ui.home',$data);

    }
}
