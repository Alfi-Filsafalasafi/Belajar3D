<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use File;


class superAdminController extends Controller
{
    public function index(){
        $jumlahSiswa = DB::table('users')->where('hak_akses','3')->count();
        $jumlahMateri = DB::table('materis')->count();
        return view('superAdmin.index',['jumlahMateri' => $jumlahMateri])->with('jumlahSiswa',$jumlahSiswa);
    } 

    public function panduan(){
        return view('superAdmin.panduan');
    }

    public function ganti(Request $request){


        $request->validate(
            [
                'link_berkas'   => 'required|file|mimes:pdf|max:1500',
            ]);
        File::delete('panduan/panduanuser.pdf');

        $extFile = $request->link_berkas->getClientOriginalName();
        $namaFile = time()."-".$extFile;
        $path = $request->link_berkas->move('panduan','panduanuser.pdf');

        return redirect()->route('superAdmin.panduan')->with('berhasil', "Berhasil mengganti panduan");
    }
}
