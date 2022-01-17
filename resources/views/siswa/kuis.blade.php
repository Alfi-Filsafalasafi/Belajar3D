@extends('siswa.layout.headerSiswa')
@section('title','Kuis Materi 1')
@section('judul','Kuis Materi 1')
<!-- @section('menuSiswa','active') -->

@section('content')
  <div class="row justify-content-center">
    <div class="col-lg-9 text-white px-5 pt-4 pb-2 " style="background-color:#4c51bf;">
    <center>
    <h3 style="font-family:Times New Roman">Kerjakan Kuis {{$materi->judul_materi}} Berikut !</h3>
      <p>Jawablah dengan benar dan dapatkan point untuk bisa menjadi nomer satu. Selamat mengerjakan!</p>
      
    </center>  
    </div>
  </div>
@endsection

@section('utama')

<div class="row justify-content-center ">
  
  <div class="col-lg-9 mb-3 bg-white py-4 px-5" >

  @forelse($kuis as $kui_s)
  <form action="{{route('kuis.selesai',['kuis' => $kui_s->id_kuis])}}" method="POST" class="w-100">
  @csrf
      <p>{{$kui_s->pertanyaan}}</p>
      <input type="hidden" name="id_user" id="" value="{{Auth::user()->id}}">
      <input type="hidden" name="id_materi" id="" value="{{$kui_s->id_materi}}">
      <div class="form-check mt-2">
        <input class="form-check-input" type="radio" name="jawaban" id="jawaban1" value="A">
        <label class="form-check-label" for="jawaban1">
          {{$kui_s->jawaban_A}}
        </label>
      </div>
      <div class="form-check mt-2">
        <input class="form-check-input" type="radio" name="jawaban" id="jawaban2" value="B">
        <label class="form-check-label" for="jawaban2">
          {{$kui_s->jawaban_B}}
        </label>
      </div>
      <div class="form-check mt-2">
        <input class="form-check-input" type="radio" name="jawaban" id="jawaban2" value="C">
        <label class="form-check-label" for="jawaban2">
          {{$kui_s->jawaban_C}}
        </label>
      </div>
      <div class="form-check mt-2">
        <input class="form-check-input" type="radio" name="jawaban" id="jawaban2" value="D">
        <label class="form-check-label" for="jawaban2">
          {{$kui_s->jawaban_D}}
        </label>
      </div>
      <div class="form-check mt-2">
        <input class="form-check-input" type="radio" name="jawaban" id="jawaban2" value="E">
        <label class="form-check-label" for="jawaban2">
          {{$kui_s->jawaban_E}}
        </label>
      </div>
      @error('jawaban')
                                <div class="text-danger">{{ $message }}</div>
                        @enderror
      <button type="submit" class="btn btn-header mt-2" style="float:right; width:80px">Next</button>
      @empty
        <p class="text-center">Anda Selesai Mengerjakan Kuis ini</p>
        <center>
        <a href="{{route('berandaSiswa.index')}}" class="btn btn-primary">Kembali ke Menu Utama</a>
        </center>
      @endforelse  
      </form>
    </div>
        


  
</div>
@endsection
