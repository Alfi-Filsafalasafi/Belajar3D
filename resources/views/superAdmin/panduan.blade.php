@extends('superAdmin.header')
@section('title', 'Panduan')
@section('panduan','active')

@section('contentku')
		@error('link_berkas')
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            Gagal Mengubah Panduan karena {{ $message }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          @enderror
		  @if(session()->has('pesan'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session()->get('pesan') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          @endif
		
<a href="#GantiPanduan" type="button" class="btn btn-warning mb-2" style="float:right" data-toggle="modal">Ganti Panduan</a>

<iframe src="{{ asset ('panduan/panduanuser.pdf')}}" width="100%" height="560px"></iframe>
@endsection

@section('modal')
<div id="GantiPanduan" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action="{{route('superAdmin.panduan.ganti')}}" method="POST" enctype="multipart/form-data">
				@csrf
				<div class="modal-header">						
					<h4 class="modal-title">Ganti Panduan </h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">
          <ul id="saveform_errlist"></ul>	
          <div class="form-group">
            <label for="validationTextarea">Upload File</label>
            <input type="file" name="link_berkas" id="link_berkas" class="form-control-file border-top-0 border-right-0 border-left-0 rounded-0" >
		  </div>   	
				<div class="modal-footer">
					<button type="button" class="btn btn-default cancelTambah" data-dismiss="modal" value="Cancel"> Cancel </button>
					<button type="submit" class="btn btn-primary tambahSiswa" value="Tambah" name="tambah"> Ganti </button>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection

