@extends('superAdmin.header')
@section('title','Home Admin')
@section('home','active')

@section('contentku')
    <div class="row">
        <div class="col m-2  py-4 bg-success text-white">
            <div class="px-3">
                <h4 class="text-white mb-4" style="font-weight:500;">Siswa</h4>
                <h4 class="text-right text-white" style="margin-top: -50px;font-weight:700;">{{$jumlahSiswa}}</h4>
            </div>
            <a href="{{route('siswa.index')}}" class="px-3" style="color:#e8e8e8">Lihat Selengkapnya</a>
        </div>
        <div class="col m-2 py-4 bg-danger text-white">
            <div class="px-3">
                <h4 class="text-white mb-4" style="font-weight:500;">Panduan</h4>
                <h4 class="text-right text-white" style="margin-top: -50px;font-weight:700;">Ada</h4>
            </div>
            <a href="{{route('superAdmin.panduan')}}" class="px-3" style="color:#e8e8e8">Lihat Selengkapnya</a>
        </div>
        <div class="col m-2 py-4 bg-info text-white">
            <div class="px-3">
                <h4 class="text-white mb-4" style="font-weight:500;">Materi</h4>
                <h4 class="text-right text-white" style="margin-top: -50px;font-weight:700;">{{$jumlahMateri}}</h4>
            </div>
            <div class="px-3" style="color:#e8e8e8">Guru yang dapat mengatur</div>
        </div>
    </div>
@endsection