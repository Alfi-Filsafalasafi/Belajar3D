<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index(){
        $siswas = DB::select('select * from users where hak_akses = 3');
        return view('admin.dashboard',['siswas' => $siswas]);
    }

    public function MenuNilaiSiswa(){
        return view('admin.MenuNilaiSiswa');
    }
    
    public function menuDaftarSiswa(){
        return view('admin.menuDaftarSiswa.index');
    }
    public function tugasSiswa(){
        return view('admin.tugasSiswa');
    }

    public function pengaturanMateri(){
        return view('admin.pengaturanMateri');
    }

    public function nilaiIndividu(){
        return view('admin.nilaiIndividu');
    }

    public function tugasMateri(){
        return view('admin.tugasMateri');
    }

    public function kuisMateri(){
        return view('admin.menuMateriSiswa.kuisMateri');
    }

    public function tambahMateri(){
        return view('admin.tambahMateri');
    }



}
