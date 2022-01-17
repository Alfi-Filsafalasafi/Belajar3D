<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\DB;


class DaftarSiswaController extends Controller
{
    public function index(){
        // $siswas = User::all();
        $siswas = DB::select('select * from v_reff_pass where hak_akses = 3');

        return view('superAdmin.menuDaftarSiswa.index', ['siswas' => $siswas]);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'nis'=>'required|size:9|unique:users',
            'name'=>'required|min:3|max:50',
            'jenis_kelamin'=>'required|in:P,L',
            'email'=>'required|unique:users',
        ]);   
        if($validator->fails()){
            return response()->json([
                'status'=>400,
                'errors'=>$validator->messages(),
            ]);
        }else{
            $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            // Output: 54esmdr0qf
            
            $pass = substr(str_shuffle($permitted_chars), 0, 6);

            $siswa = new User;
            $siswa->nis = $request->input('nis');
            $siswa->name = $request->input('name');
            $siswa->jenis_kelamin = $request->input('jenis_kelamin');
            $siswa->email = $request->input('email');
            // $siswa->password = Hash::make($request->input('password'));
            $siswa->password = Hash::make($pass);
            $siswa->hak_akses = 3;
            $siswa->id_status = 1;
            $siswa->point = 10;
            $siswa->save();

            $nis = $request->nis;
            $id_users = DB::table('users')->select('id')->where('nis', $nis)->first()->id;

            $reff = DB::table('ref_pass')->insert([
                "id_users" => $id_users,
                "ref_password" => $pass,
                "nis" => $request->input('nis')
            ]);
            
            return response()->json([
                'status'=>200,
                'message'=>'Data Siswa Berhasil di tambah, silahkan refresh ',
            ]);
            
        }
    }

    public function edit(User $user)
    {
        return view('superAdmin.menuDaftarSiswa.edit', ['siswa' => $user]);
    }

    public function update(Request $request, User $user)
    {
        $validateData = $request->validate([
            'nis' => 'required|size:9|unique:users,nis,'.$user->id,
            'name' => 'required|min:3|max:50',
            'jenis_kelamin'=>'required|in:P,L',
            'email'=>'required|unique:users,email,'.$user->id,
        ]);
    
        // User::where('id',$user->id)->update($validateData);
        if($request->input('password')==""){
            $reff = DB::table('ref_pass')->where('id_users',$user->id)->update([
                "nis" => $request->input('nis'),
            ]);
            $siswa = User::where('id',$user->id)->first();
            $siswa->nis = $request->input('nis');
            $siswa->name = $request->input('name');
            $siswa->jenis_kelamin = $request->input('jenis_kelamin');
            $siswa->email = $request->input('email');
            $siswa->hak_akses = 3;
            $siswa->id_status = 1;
            $siswa->save();
        }else{
            $reff = DB::table('ref_pass')->where('id_users',$user->id)->update([
                "ref_password" => $request->input('password'),
                "nis" => $request->input('nis'),
            ]);
    
            $siswa = User::where('id',$user->id)->first()   ;
            $siswa->nis = $request->input('nis');
            $siswa->name = $request->input('name');
            $siswa->jenis_kelamin = $request->input('jenis_kelamin');
            $siswa->email = $request->input('email');
            $siswa->password = Hash::make($request->input('password'));
            $siswa->hak_akses = 3;
            $siswa->id_status = 1;
            $siswa->save();
        }
        
        return redirect()->route('siswa.index')->with('update',"update data {$validateData['name']} berhasil");
        
    }

    public function destroy(User $user){
        $user->delete();
        return redirect()->route('siswa.index')->with('hapus',"hapus data $user->name berhasil");

    }
}
