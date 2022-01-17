@extends('siswa.layout.headerSiswa')
@section('title','Kuis Materi 1')
@section('judul','Kuis Materi 1')
<!-- @section('menuSiswa','active') -->

@section('utama')
<h5 style="color:#4c51bf;">Materi 1</h5>
    <div class="row">
        <div class="col-lg-7 p-3 m-3 bg-white rounded">
            <iframe src="{{ asset ('materi/'.$materi->link_berkas)}}" width="100%" height="500px"></iframe>
            @if($cekBaca == 1)
              <p class="text-center">Anda Selesai Membaca Materi ini</p>
                <center>
                <a href="{{route('berandaSiswa.index')}}" class="btn btn-primary">Kembali ke Menu Utama</a>
                </center>
            @else
            <a href="{{route('materi.selesai', ['user'=> Auth::user()->id , 'id_materi' => $materi->id])}}" type="button" class="btn btn-primary" style="background-color: #4c51bf; border-color: rgb(130, 99, 143); float: right ;">Selesai & Lanjut Tugas</a>
            
            @endif
        </div>
        <div class="col-lg-4 ">
            <div class="row">
                <div class="col-lg-12 p-3 m-3 bg-white rounded">
                    <h5 style="color:#4c51bf;">Judul :</h5>
                    <p>{{$materi->judul_materi}}</p>
                    <h5 style="color:#4c51bf;">Deskripsi :</h5>
                    <p>{{$materi->deskripsi_materi}}</p>
                </div>
                <div class="col-lg-12 p-3 m-3 bg-white rounded">
                <table class="table table-hover  bg-white">
            <thead style="color:#4c51bf;">
              <tr>
                <th scope="col" class="align-middle text-center" style="width:10%">No</th>
                <th scope="col">Nama Siswa</th>
                <th scope="col"  class="align-middle text-center" style="width:20%">Point</th>
              </tr>
            </thead>
            <tbody>
              @forelse($siswas as $siswa)
              <tr>
                <th scope="row" class="align-middle text-center">{{$loop->iteration}}</th>
                <td>{{$siswa->name}}</td>
                <td  class="align-middle text-center">{{$siswa->point}}</td>
              </tr>
              @empty
                <td colspan="6" class="text-center">Tidak ada data...</td>
              @endforelse
            </tbody>
          </table>
                </div>
            </div>
        </div>
    </div>
@endsection