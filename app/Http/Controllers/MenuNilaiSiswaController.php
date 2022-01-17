<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class MenuNilaiSiswaController extends Controller
{
    public function index(){
        $siswas = DB::select("select * from v_nilaiSiswa");
        return view('admin.menuNilaiSiswa.index',['siswas' => $siswas]);
    }

    public function showTugas($id){
        $tugas = DB::select("select * from v_pengumpulan_tugas where id_user = $id");
        $user = User::findorFail($id);
        // $kuis = Kuis::all();
        return view('admin.menuNilaiSiswa.tugasSiswa',['tugas' => $tugas])->with('user', $user);
    }

    public function showNilai($id){
        $tugas = DB::select("select * from v_pengumpulan_tugas where id_user = $id");
        $user = User::findorFail($id);
        // $kuis = Kuis::all();
        return view('admin.menuNilaiSiswa.nilaiIndividu',['tugas' => $tugas])->with('user', $user);
    }

    public function editKomentarTugas(Request $request){
        $komentar = DB::table('pengumpulan_tugas')
        ->where('id',$request->id)
        ->update(
            [
                'komentar' => $request->komentar
            ]
        );

        return redirect()->route('nilai.tugasSiswa',['siswa' => $request->id_user])->with('pesan','komentar berhasil di perbarui');
    }

    public function editNilaiTugas(Request $request){
        $nilai = DB::table('pengumpulan_tugas')
        ->where('id',$request->id)
        ->update(
            [
                'nilai' => $request->nilai
            ]
        );

        $point = DB::table('users')->select('point')->where('id', $request->iduser)->first()->point;
        $reff = DB::table('users')->where('id',$request->iduser)->update([
            "point" => $point + $request->nilai - $request->nilai_awal,
        ]);

        return redirect()->route('nilai.tugasSiswa.nilai',['siswa' => $request->iduser])->with('pesan','komentar berhasil di perbarui');
    }

}
