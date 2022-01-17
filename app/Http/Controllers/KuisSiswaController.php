<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Materi;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class KuisSiswaController extends Controller
{
    public function index($id_materi){
        // $kuis = DB::select('select * from v_kuis where id_materi = '.$id_materi.'')->paginate(1);
        $kuis = DB::select('select * from v_pengumpulan_kuis where id_materi = '.$id_materi.' and id_user is NULL LIMIT 1'); 
        $materi = Materi::findorFail($id_materi);
        // $kuis = Kuis::all();
        return view('siswa.kuis', ['kuis' => $kuis])->with('materi', $materi);
    }

    public function selesai(Request $request, $id_kuis){
        $validateData = $request->validate([
            'jawaban'=>'required',
        ]);
        // $cekjawaban = DB::select('select kunci_jawaban from kuis where id = '.$id_kuis.' ')->first()->id;
        $cekjawaban = DB::table('kuis')->select('kunci_jawaban')->where('id', $id_kuis)->first()->kunci_jawaban;

        if($request->jawaban == $cekjawaban){
            $nilai = 10;
            $keterangan = "benar";
        }else{
            $nilai = 0;
            $keterangan = "salah";
        }

        $result = DB::table('pengumpulan_kuis')->insert(
            [
                "id_kuis" => $id_kuis,
                "id_user" => $request->id_user,
                "jawaban" => $request->jawaban,
                "created_at" => now(),
                "updated_at" => now(),
                "keterangan" => $keterangan,
                "nilai" => $nilai
            ]
        );
        $iduser = $request->id_user;
        $id_status = DB::table('users')->select('id_status')->where('id', $iduser)->first()->id_status;
        $point = DB::table('users')->select('point')->where('id', $iduser)->first()->point;
        $reff = DB::table('users')->where('id',$iduser)->update([
            "id_status" => $id_status + 1,
            "point" => $point + $nilai,
        ]);

        return redirect()->route('kuisSiswa.index', ['materi' => $request->id_materi])->with('success','Jawaban Anda Berhasil tersimpan');

    }
}
