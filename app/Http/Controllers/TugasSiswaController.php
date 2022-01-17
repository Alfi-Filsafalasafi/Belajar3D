<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Materi;
use Illuminate\Support\Facades\DB;


class TugasSiswaController extends Controller
{
    public function index(Materi $materi, $iduser){
        $cekTugas = DB::table('pengumpulan_tugas')->where([['id_materi',$materi->id], ['id_user',$iduser]])->count();
        return view('siswa.tugas', ['materi' => $materi])->with('cekTugas',$cekTugas);
    }
    public function selesai(Request $request, $iduser, $id_materi){
        $validateData = $request->validate([
            'link_berkas' => 'required|file|mimes:pdf|max:1500',
        ]);


        $extFile = $request->link_berkas->getClientOriginalName();
            $namaFile = time()."-".$extFile;
            $path = $request->link_berkas->move('tugas',$namaFile);

        $result = DB::table('pengumpulan_tugas')->insert(
            [
                "id_user" => $iduser,
                "id_materi" => $id_materi,
                "link_file_tugas" => $namaFile,
                "created_at" => now(),
                "updated_at" => now(),
                "nilai" => 80,
                "komentar" => "bagus"
            ]
        );

        $id_status = DB::table('users')->select('id_status')->where('id', $iduser)->first()->id_status;
        $point = DB::table('users')->select('point')->where('id', $iduser)->first()->point;
        $reff = DB::table('users')->where('id',$iduser)->update([
            "id_status" => $id_status + 1,
            "point" => $point + 80,
        ]);

        return redirect()->route('berandaSiswa.index')->with('success','Tugas Berhasil di kumpulkan, yuk lanjut kerjakan kuis');

    }
}
