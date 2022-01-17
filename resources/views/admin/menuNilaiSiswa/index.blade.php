@extends('admin.layout.header')
@section('title','Nilai Siswa')
@section('judul','Nilai Siswa')
@section('menuNilai','active')

@section('content')
<div class="content-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="card p-4">
        <div class="card-header " style="background-color:#ab47bc;color:white">
          <h5>Tabel Nilai Siswa</h5>Data Progress Siswa dalam melakukan pembelajaran
        </div>
        <div class="card-body">
        <div class="table-responsive">
        <table class="table table-hover">
            <thead style="color:#ab47bc">
              <tr>
                <th scope="col" class="align-middle text-center" style="width:10%">Peringkat</th>
                <th scope="col">Nama Siswa</th>
                <th scope="col" style="width:15%">Jenis Kelamin</th>
                <th scope="col"  class="align-middle text-center" >Point</th>
                <th scope="col"  class="align-middle text-center" >Status</th>
                <th scope="col"  class="align-middle text-center" >Tugas</th>
                <th scope="col"  class="align-middle text-center" >Nilai</th>
              </tr>
            </thead>
            <tbody>
              @forelse($siswas as $siswa)
              <tr>
                <th scope="row" class="align-middle text-center">{{$loop->iteration}}</th>
                <td>{{$siswa->name}}</td>
                <td>{{$siswa->jenis_kelamin == 'P'?'Perempuan':'Laki-laki'}}</td>
                <td  class="align-middle text-center">{{$siswa->point}}</td>
                <td  class="align-middle text-center">{{$siswa->status}}</td>
                <td  class="align-middle text-center">
                  <a href="{{route('nilai.tugasSiswa',['siswa' => $siswa->id ]) }}" type="button" class="btn btn-primary btn-sm">Detail</a>
                </td>
                <td  class="align-middle text-center">
                  <a href="{{route('nilai.tugasSiswa.nilai',['siswa' => $siswa->id ]) }}" type="button" class="btn btn-primary btn-sm">Detail</a>
                </td>
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
  </div>
</div>
@endsection