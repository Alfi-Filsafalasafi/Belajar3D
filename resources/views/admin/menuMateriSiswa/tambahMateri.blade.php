@extends('admin.layout.header')
@section('title','Materi Siswa')
@section('judul','Materi Siswa')
@section('menuMateri','active')

@section('content')
<div class="content-fluid">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card p-4">
        <div class="card-header " style="background-color:#ab47bc;color:white">
        Data Materi
        </div>
        <div class="card-body">
        <form action="{{ route('materi.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label>KD</label>
                        <input type="text" id="kd" name="kd" value="{{old('kd')}}" class="form-control border-top-0 border-right-0 border-left-0 rounded-0" name="nilai" placeholder="" value="">
                        @error('kd')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>	
                    </div>
                    <div class="col-md-9">
                        <div class="form-group"> 
                            <label>Judul Materi</label>
                            <input type="text" name="judul_materi" value="{{old('judul_materi')}}" class="form-control border-top-0 border-right-0 border-left-0 rounded-0" name="" placeholder="">
                            @error('judul_materi')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>	
                    </div>
            </div>	
            <div class="form-group"> 
                <label>Link Berkas</label>
                <input type="file" name="link_berkas" id="link_berkas" class="form-control-file border-top-0 border-right-0 border-left-0 rounded-0" >
                @error('link_berkas')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="validationTextarea">Deskripsi Materi</label>
                <textarea name="deskripsi_materi" class="form-control border-top-0 border-right-0 border-left-0 rounded-0" id="exampleFormControlTextarea1" rows="3" >{{old('deskripsi_materi')}}</textarea>
                @error('deskripsi_materi')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="row">
                <div class="col-md-12 mt-4 py-2 mb-4" style="background-color:#ab47bc;color:white">
                    Data Tugas
                </div>
            </div>
            <div class="form-group"> 
                <label>Link Video</label>
                <input type="text" name="link_video_tugas" value="{{old('link_video_tugas')}}" class="form-control border-top-0 border-right-0 border-left-0 rounded-0" name="" placeholder="URL">
                @error('link_video_tugas')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>	
            <div class="form-group"> 
                <label>Judul Tugas</label>
                <input type="text" name="judul_tugas" value="{{old('judul_tugas')}}" class="form-control border-top-0 border-right-0 border-left-0 rounded-0" name="" placeholder="">
                @error('judul_tugas')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="validationTextarea">Deskripsi Tugas</label>
                <textarea name="deskripsi_tugas" class="form-control border-top-0 border-right-0 border-left-0 rounded-0" id="exampleFormControlTextarea1" rows="3" >{{old('deskripsi_tugas')}}</textarea>
                @error('deskripsi_tugas')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>	
            <div class="text-right">
                <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
				<input type="submit" class="btn btn-primary" value="Tambah Materi" name="tambah">
            </div>
        </form>
        </div>

        
      </div>
    </div>
  </div>
</div>
@endsection