<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class profilController extends Controller
{
    public function updateProfil(Request $request, User $user){
        if($request->sandi_baru_fix == "" && $request->sandi_baru ==""){
            $siswa = User::where('id',$user->id)->first()   ;
                $siswa->name = $request->name;
                $siswa->email = $request->email;
                $siswa->jenis_kelamin = $request->jenis_kelamin;
                $siswa->save();
                return redirect()->route('berandaSiswa.index')->with('success','profil berhasil di perbarui');
        }else{
            if($request->sandi_baru_fix == $request->sandi_baru){
                $siswa = User::where('id',$user->id)->first()   ;
                $siswa->name = $request->name;
                $siswa->email = $request->email;
                $siswa->jenis_kelamin = $request->jenis_kelamin;
                $siswa->password =  Hash::make($request->sandi_baru_fix);
                $siswa->save();

                $reff = DB::table('ref_pass')->where('id_users',$user->id)->update([
                    "ref_password" => $request->sandi_baru_fix,
                ]);
                return redirect()->route('berandaSiswa.index')->with('success','profil berhasil di perbarui');
            }else{
                return redirect()->route('berandaSiswa.index')->with('error','pengetikan ulang sandi baru tidak sesuai, lakukan lagi');
            }
        }

    }

    public function updateGuru(Request $request, User $user){
        if($request->sandi_baru_fix == "" && $request->sandi_baru ==""){
            $siswa = User::where('id',$user->id)->first()   ;
                $siswa->name = $request->nama;
                $siswa->email = $request->email;
                $siswa->jenis_kelamin = $request->jenis_kelamin;
                $siswa->save();
                return redirect()->route('berandaGuru.index')->with('success','profil berhasil di perbarui');
        }else{
            if($request->sandi_baru_fix == $request->sandi_baru){
                $siswa = User::where('id',$user->id)->first()   ;
                $siswa->name = $request->nama;
                $siswa->email = $request->email;
                $siswa->jenis_kelamin = $request->jenis_kelamin;
                $siswa->password =  Hash::make($request->sandi_baru_fix);
                $siswa->save();

                $reff = DB::table('ref_pass')->where('id_users',$user->id)->update([
                    "ref_password" => $request->sandi_baru_fix,
                ]);
                return redirect()->route('berandaGuru.index')->with('success','profil berhasil di perbarui');
            }else{
                return redirect()->route('berandaGuru.index')->with('error','pengetikan ulang sandi baru tidak sesuai, lakukan lagi');
            }
        }

    }

    public function kembali(){
        return redirect()->back();
    }
}
