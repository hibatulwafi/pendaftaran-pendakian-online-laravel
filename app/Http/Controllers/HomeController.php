<?php

namespace App\Http\Controllers;

use App\Produk;
use App\User;
use Spatie\Permission\Models\Role;
// use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
       
        $users = User::all();
        $rolesCount = Role::count();
        $mendaki = DB::table('tb_pendakian')
        ->where('status_naik',2)->count();
        $bulanini = DB::table('tb_pendakian')
        ->where('status_izin',1)->count();
        return view('home', compact('mendaki','bulanini','users', 'rolesCount'));
    }
}
