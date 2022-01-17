@extends('siswa.layout.headerSiswa')
@section('title','Tugas')
@section('judul','Tugas')
<!-- @section('menuSiswa','active') -->

@section('content')
  <div class="row justify-content-center">
    <div class="col-lg-12 bg-white mx-auto px-5 pt-4 pb-2 ">
        <center>
            <h3 style="color:#4c51bf;">{{$materi->judul_tugas}}</h3>
            <div class="embed-responsive embed-responsive-16by9 mt-4">
                <iframe class="embed-responsive-item" src="{{$materi->link_video_tugas}}" allowfullscreen></iframe>
            </div>
        </center>    
        <h4 class="pt-4">Kerjakan Tugas Berikut !</h4>
        <p>{{$materi->deskripsi_tugas}}</p>
    </div>

    <div class="col-lg-12 bg-white mx-auto mt-3 px-5 py-4 pb-2">
        <form action="{{route('tugas.selesai',['user'=> Auth::user()->id, 'materi' => $materi->id]) }}" method="post" enctype="multipart/form-data">
            @csrf
            <!-- <div class="dropzone-wrapper">
                <div class="dropzone-desc">
                <i class="glyphicon glyphicon-download-alt"></i>
                <p>Choose an image file or drag it here.</p>
                </div>
                <input type="file" name="img_logo" class="dropzone">
            </div> -->
            @if($cekTugas >= 1)
                <p class="text-center">Anda Selesai Mengerjakan Tugas ini</p>
                <center>
                <a href="{{route('berandaSiswa.index')}}" class="btn btn-primary">Kembali ke Menu Utama</a>
                </center>
            @else
                <div class="form-group"> 
                    <label>Link Berkas</label>
                    <input type="file" name="link_berkas" id="link_berkas" class="form-control-file border-top-0 border-right-0 border-left-0 rounded-0" >
                    @error('link_berkas')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <center>
                    <input type="submit" class="btn btn-header" value="Kumpulkan Tugas" name="tambah">
                </center>
            @endif
                
            
        </form>
        
    </div>
  </div>
@endsection