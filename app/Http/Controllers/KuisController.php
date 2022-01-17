<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Kuis;
use App\Models\Materi;

class KuisController extends Controller
{
    public function index($id_materi){
        $kuis = DB::select('select * from v_kuis where id_materi = '.$id_materi.'');
        // $kuis = DB::table('kuis')->where('id_materi','=',$id_materi)->paginate(1);
        $materi = Materi::findorFail($id_materi);
        $jumlahkuis = DB::table('kuis')->where('id_materi',$id_materi)->count();
        // dump($jumlahkuis);
        // $kuis = Kuis::all();
            return view('admin.menuMateriSiswa.kuisMateri', ['kuis' => $kuis], ['materi' => $materi ])->with('jumlah',$jumlahkuis);

    }
    public function store(Request $request){
        $kuis = new Kuis;
        $kuis->pertanyaan = $request->pertanyaan;
        $kuis->jawaban_A = $request->jawaban_A;
        $kuis->jawaban_B = $request->jawaban_B;
        $kuis->jawaban_C = $request->jawaban_C;
        $kuis->jawaban_D = $request->jawaban_D;
        $kuis->jawaban_E = $request->jawaban_E;
        $kuis->kunci_jawaban = $request->kunci_jawaban;
        $kuis->id_materi = $request->idmateri;
        $kuis->save();
        $materi = Materi::find($request->idmateri);

        return redirect()->route('kuis.index',['kuis' => $request->idmateri])->with('tambah','tambah Data Berhasil','materi', $materi );
    }

    public function update(Request $request){
        $kuis = kuis::find($request->id_kuis);
        $kuis->pertanyaan = $request->pertanyaan;
        $kuis->jawaban_A = $request->jawaban_A;
        $kuis->jawaban_B = $request->jawaban_B;
        $kuis->jawaban_C = $request->jawaban_C;
        $kuis->jawaban_D = $request->jawaban_D;
        $kuis->jawaban_E = $request->jawaban_E;
        $kuis->kunci_jawaban = $request->kunci_jawaban;
        $kuis->save();

        $materi = Materi::find($request->idmateri);

        return redirect()->route('kuis.index',['kuis' => $request->idmateri])->with('update','Perubahan data Berhasil', 'materi', $materi);

    }

    public function destroy(Kuis $kuis){
        $idmateru = DB::table('v_kuis')->select('id_materi')->where('id_kuis', $kuis->id)->first()->id_materi;
        // dump($idmateru);
        $kuis->delete();
        return redirect()->route('kuis.index',['kuis' => $idmateru])->with('hapus','hapus data berhasil');

    }
}
