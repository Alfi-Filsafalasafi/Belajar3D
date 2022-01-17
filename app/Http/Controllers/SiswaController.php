<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Materi;


class SiswaController extends Controller
{
    public function berandaSiswa(){
        $siswas = DB::select("select * from v_nilaiSiswa");
        $materi = Materi::all();
        return view('siswa.dashboardSiswa',['siswas' => $siswas])->with('materis', $materi);
    }

    public function kuis(){
        return view('siswa.kuis');
    }

    public function materi(){
        return view('siswa.materi');
    }

    public function tugas(){
        return view('siswa.tugas');
    }

}
