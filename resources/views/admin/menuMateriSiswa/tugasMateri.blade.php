@extends('admin.layout.header')
@section('title','Tugas Materi')
@section('judul','Tugas Materi')
@section('menuMateri','active')

@section('content')
<div class="content-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="card p-4">
        <div class="card-header " style="background-color:#ab47bc;color:white">
          <div class="row">
            <div class="col-8">
              <h5>Tugas Materi</h5>
              <div class="row">
                <div class="col-sm-2">
                  <b>{{$materi->kd}}</b>
                </div>
                <div class="col-sm-8 ">
                  {{$materi->judul_materi}}
                </div>
              </div>
            </div>
            <div class="col-4 text-right my-auto">
              <a href="#edit" type="button" class="btn btn-warning" data-toggle="modal">Edit Tugas</a>
            </div>
          </div>
        </div>
        <div class="card-body">
        @if(session()->has('update'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session()->get('update') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          @endif
        <div class="table-resposive">
            <table class="table table-borderless">
              <tbody>
                <tr>
                  <td style="border: none; width: 15%;" class="table-borderless align-text-top">Judul Tugas</td>
                  <td style="border: none;" class="table-borderless align-text-top">:</td>
                  <td style="border: none;" class="table-borderless align-text-top">{{$materi->judul_tugas}}</td>
                </tr>
                <tr>
                  <td style="border: none; width: 15%;" class="table-borderless align-text-top">Deskripsi Tugas</td>
                  <td style="border: none;" class="table-borderless align-text-top">:</td>
                  <td style="border: none;" class="table-borderless align-text-top">{{$materi->deskripsi_tugas}}</td>
                </tr>
              </tbody>
            </table>
          </div>
          <hr>
          <p><b>Video Pratinjau</b> </p>
          <div class="video-preview">
              <div class="embed-responsive embed-responsive-16by9"  style="">
                <iframe class="embed-responsive-item" style="width:50%;height:50%;" src="{{$materi->link_video_tugas}}" allowfullscreen=""></iframe>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('modal')
<div id="edit" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
      <form action="{{route('materi.tugas.update',['materi' => $materi->id]) }}" method="post">
      @method('PATCH')
      @csrf
				<div class="modal-header">						
					<h4 class="modal-title">Edit Tugas</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">	
          <div class="form-group"> 
            <label>Tautan Video Tugas</label>
            <input type="text" name="link_video_tugas" class="form-control border-top-0 border-right-0 border-left-0 rounded-0" value="{{$materi->link_video_tugas}}" required>
          </div>
          <div class="form-group"> 
            <label>Judul Tugas</label>
            <input type="text" class="form-control border-top-0 border-right-0 border-left-0 rounded-0" name="judul_tugas" value="{{$materi->judul_tugas}}" required>
          </div>
          <div class="form-group">
              <label for="validationTextarea">Deskripsi</label>
              <textarea name="deskripsi_tugas" class="form-control border-top-0 border-right-0 border-left-0 rounded-0" id="exampleFormControlTextarea1" rows="5" required>{{$materi->deskripsi_tugas}}</textarea>
          </div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
					<input type="submit" class="btn btn-success" value="Perbarui" name="tambah">
				</div>
			</form>
		</div>
	</div>
</div>

@endsection