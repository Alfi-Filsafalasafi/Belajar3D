@extends('siswa.layout.headerSiswa')
@section('title','Beranda Siswa')
@section('judul','Beranda Admin')
@section('menuBeranda','active')

@section('content')
  <div class="row">
    <div class="col-lg-12 text-white px-5 py-4" style="background-color:#4c51bf;">
      <h3 >Belajar Seperti Main Game</h3>
      <p style="color:#9cd9eb">Selesaikan setiap tahapan dan kumpulkan badge sebanyak-banyaknya untuk mendapatkan point! jadilah peringkat teratas dikelasmu.</p>
      <a href="#materi" type="button" class="btn btn-header btn-sm">Mulai Belajar</a>
      <a href="{{ asset ('panduan/Panduanuser.pdf')}}" type="button" class="btn btn-header btn-sm">Panduan</a>
    </div>
  </div>
@endsection

@section('utama')

<div class="row">
  <div class="col-lg-8 mb-3" >
  <h4 id="materi">Materi</h4>
    <div class="row justify-content-md-center p-3" style="background:white">
      @forelse($materis as $materi)
      <div class="col-md-5 pt-3 pb-4 mr-3 my-2 materi">
        <h5>{{$materi->judul_materi}}</h5>
        <p class="truncate">{{$materi->deskripsi_materi}}</p>
            <a href="{{route('materiSiswa.index', ['materi' => $materi->id, 'user' => Auth::user()->id])}}" type="button" class="btn btn-sm">Materi</a>
            <a href="{{route('tugasSiswa.index', ['materi' => $materi->id, 'user' => Auth::user()->id])}}" type="button" class="btn btn-sm">Tugas</a>
            <a href="{{route('kuisSiswa.index', ['materi' => $materi->id])}}" type="button" class="btn btn-sm">Kuis</a> 
      </div>
      
      @empty
        <td colspan="6" class="text-center">Tidak ada data...</td>
      @endforelse
    </div>
  </div>
  <div class="col-lg-4">
  <h4>Papan Peringkat</h4>
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
@endsection