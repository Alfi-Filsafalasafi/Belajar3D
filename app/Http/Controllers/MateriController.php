<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Materi;
use Illuminate\Support\Facades\DB;

use File;

class MateriController extends Controller
{
    public function index(){
        $materis = Materi::all();
        return view('admin.menuMateriSiswa.pengaturanMateri', ['materis' => $materis]);
    }
    public function showTugas(Materi $materi){
        return view('admin.menuMateriSiswa.tugasMateri', ['materi' => $materi]);
    }

    public function create(){
        return view('admin.menuMateriSiswa.tambahMateri');
    }

    public function updateTugas(Request $request, Materi $materi)
    {
        $validateData = $request->validate([
                'link_video_tugas'    => 'required',
                'judul_tugas'    => 'required',
                'deskripsi_tugas'    => 'required',
            ]);
    
        Materi::where('id',$materi->id)->update($validateData);
        return redirect()->route('materi.tugas.index', ['materi' => $materi])->with('update',"update tugas dari Materi $materi->judul_materi berhasil");
        
    }

    public function updateMateri(Request $request, Materi $materi)
    {
        if($request->link_berkas ==""){
            $validateData = $request->validate([
                'kd'    => 'required',
                'judul_materi'    => 'required',
                'deskripsi_materi'    => 'required',
            ]);
            $materi = Materi::find($request->id);
            $materi->kd = $validateData['kd'];
            $materi->judul_materi = $validateData['judul_materi'];
            $materi->deskripsi_materi = $validateData['deskripsi_materi'];
            $materi->save();
        }else{
            $validateData = $request->validate([
                'kd'    => 'required',
                'judul_materi'    => 'required',
                'link_berkas' => 'file|mimes:pdf|max:1500',
                'deskripsi_materi'    => 'required',
            ]);

            //hapus file 
            $gambar = Materi::where('id',$request->id)->first();
	        File::delete('materi/'.$gambar->link_berkas);

            $extFile = $request->link_berkas->getClientOriginalName();
            $namaFile = time()."-".$extFile;
            $path = $request->link_berkas->move('materi',$namaFile);

            $materi = Materi::find($request->id);
            $materi->kd = $validateData['kd'];
            $materi->judul_materi = $validateData['judul_materi'];
            $materi->deskripsi_materi = $validateData['deskripsi_materi'];
            $materi->link_berkas = $namaFile;
            $materi->save();
        }

        return redirect()->route('materi.index', ['materi' => $materi])->with('update',"update tugas dari Materi $materi->judul_materi berhasil");
        
    }

    public function store(Request $request)
    {
        $validateData = $request->validate(
            [
                'kd'   => 'required|unique:materis',
                'judul_materi'  => 'required|min:3',
                'deskripsi_materi' => 'required',
                'link_berkas'   => 'required|file|mimes:pdf|max:1500',
                'link_video_tugas'    => 'required',
                'judul_tugas'    => 'required',
                'deskripsi_tugas'    => 'required',
            ]);
        $extFile = $request->link_berkas->getClientOriginalName();
        $namaFile = time()."-".$extFile;
        $path = $request->link_berkas->move('materi',$namaFile);

        $materi = new materi();
        $materi->kd = $validateData['kd'];
        $materi->judul_materi = $validateData['judul_materi'];
        $materi->deskripsi_materi = $validateData['deskripsi_materi'];
        $materi->link_berkas = $namaFile;
        $materi->link_video_tugas = $validateData['link_video_tugas'];
        $materi->judul_tugas = $validateData['judul_tugas'];
        $materi->deskripsi_tugas = $validateData['deskripsi_tugas'];
        $materi->save();

        return redirect()->route('materi.index')
                ->with('tambah',"penambahan data {$validateData['judul_materi']} berhasil");
    }

    public function destroy(Materi $materi){
        //hapus file 
        $kuisHapus = DB::table('kuis')->where('id_materi', $materi->id)->delete();
        $gambar = Materi::where('id',$materi->id)->first();
        File::delete('materi/'.$gambar->link_berkas);
        $materi->delete();
        return redirect()->route('materi.index')->with('hapus',"hapus data $materi->judul_materi berhasil");

    }
}
