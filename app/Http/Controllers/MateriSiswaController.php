<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Materi;

class MateriSiswaController extends Controller
{
    public function index(Materi $materi, $iduser){
        $siswas = DB::select("select * from v_nilaiSiswa");
        $cekBaca = DB::table('membaca_materi')->where([['id_materi',$materi->id], ['id_user',$iduser]])->count();
        return view('siswa.materi', ['materi' => $materi], [ 'cekBaca' => $cekBaca])->with('siswas' , $siswas);
    }

    public function selesai($id_user,$id_materi){
        // $id_status = DB::select("select id_status from users where id = $id_user");
        $id_status = DB::table('users')->select('id_status')->where('id', $id_user)->first()->id_status;
        $point = DB::table('users')->select('point')->where('id', $id_user)->first()->point;
        $reff = DB::table('users')->where('id',$id_user)->update([
            "id_status" => $id_status + 1,
            "point" => $point + 100
            
        ]);

        $result = DB::table('membaca_materi')->insert(
            [
                "id_user" => $id_user,
                "id_materi" => $id_materi,
                "created_at" => now(),
                "updated_at" => now()
            ]
        );
        return redirect()->route('berandaSiswa.index')->with('success','membaca materi telah di laksanakan, yuk lanjut kerjakan tugas');

    }
}
