@extends('superAdmin.header')
@section('siswa','active')
@section('title','pengaturan Siswa')
@section('contentku')
<div class="content-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="card p-4">
      <div class="card-header " style="background-color:#ab47bc;color:white">
          <div class="row">
            <div class="col-6">
              <h5>Daftar Siswa</h5>Mengatur Siswa yang ada di kelas ini
            </div>
            <div class="col-6 text-right my-auto">
              <a href="#tambahSiswa" type="button" class="btn btn-success" data-toggle="modal">Tambah Siswa</a>
            </div>
          </div>
        </div>
        <div class="card-body">
        @if(session()->has('update'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
          {{ session()->get('update') }}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        @endif
        @if(session()->has('hapus'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          {{ session()->get('hapus') }}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        @endif
        <div id="success_message" role="alert">
          
        </div>
        <div class="table-responsive">
        <table class="table table-hover">
            <thead style="color:#ab47bc">
              <tr>
                <th scope="col" class="align-middle text-center" style="width:10%">No</th>
                <th scope="col">NIS</th>
                <th scope="col">Nama Siswa</th>
                <th scope="col">Jenis Kelamin</th>
                <th scope="col">Email</th>
                <th scope="col">Password</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
                @forelse ($siswas as $siswa)
              <tr>
                <th scope="row" class="align-middle text-center">{{$loop->iteration}}</th>
                <td class="align-middle">{{$siswa->nis}}</td>
                <td class="align-middle">{{$siswa->name}}</td>
                <td class="align-middle">{{$siswa->jenis_kelamin == 'P'?'Perempuan':'Laki-laki'}}</td>
                <td class="align-middle">{{$siswa->email}}</td>
                <td class="align-middle">{{$siswa->ref_password}}</td>
                <td class="btn-group-vertical btn-group-sm">
                  <a href="{{route('siswa.edit',['user'=>$siswa->id])}}" class="btn btn-warning mb-2">Edit</a>
                  <a href="{{route('siswa.delete',['user'=>$siswa->id])}}" class="btn btn-danger" onclick="return confirm('Anda yakin mau menghapus siswa {{$siswa->name}} ini ?')">Hapus</a>
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

@section('modal')
<div id="tambahSiswa" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<!-- <form action="" method="post"> -->
				<div class="modal-header">						
					<h4 class="modal-title">Tambah Siswa </h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">
          <ul id="saveform_errlist"></ul>	
          <div class="form-group">
            <label for="validationTextarea">NIS</label>
            <input type="number" name="nis" id="nis" class="nis form-control border-top-0 border-right-0 border-left-0 rounded-0">
            <div class="text-danger" id="err_nis"></div>
          </div>
          <div class="form-group">
            <label for="validationTextarea">Nama</label>
            <input type="text" name="name" id="name" class="name form-control border-top-0 border-right-0 border-left-0 rounded-0">
            <div class="text-danger" id="err_name"></div>
          </div>
          <div class="form-group">
          <label>Jenis Kelamin</label>
          <div>
            <div class="form-check form-check-inline">
              <input class="jenis_kelamin form-check-input" type="radio" name="jenis_kelamin"
              id="laki_laki" value="L" checked>
              <label class="form-check-label" for="laki_laki">Laki-laki</label>
            </div>
            <div class="jenis_kelamin form-check form-check-inline">
              <input class="form-check-input" type="radio" name="jenis_kelamin"
              id="perempuan" value="P" >
              <label class="form-check-label" for="perempuan">Perempuan</label>
            </div>
            <div class="text-danger" id="err_jenis_kelamin"></div>
          </div>
        </div>
          <div class="form-group">
            <label for="validationTextarea">Email</label>
            <input type="email" name="email" id="email" class="email form-control border-top-0 border-right-0 border-left-0 rounded-0">
            <div class="text-danger" id="err_email"></div>
          </div>
        </div>        	
				<div class="modal-footer">
					<button type="button" class="btn btn-default cancelTambah" data-dismiss="modal" value="Cancel"> Cancel </button>
					<button type="submit" class="btn btn-primary tambahSiswa" value="Tambah" name="tambah"> Tambah </button>
				</div>
			<!-- </form> -->
		</div>
	</div>
</div>
@endsection

@section('scripts')
<script>
   $(document).ready(function () {
     $(document).on('click', '.tambahSiswa', function(e) {
      e.preventDefault();
      // console.log('hello');
      var data = {
        'nis' : $('.nis').val(),
        'name' : $('.name').val(),
        'jenis_kelamin' : $('input[type="radio"]:checked').val(),
        'email' : $('.email').val(),
      }
      // console.log(data);

      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });

      $.ajax({
        type:"POST",
        url:"/daftarSiswa",
        data: data,
        dataType: "json",
        success: function (response){
          if(response.status == 400)
          {
            $('.text-danger').html("");
            $.each(response.errors.name, function (key, err_values){
              $('#err_name').append('<li>'+err_values+'</li>');
            });
            $.each(response.errors.nis, function (key, err_values){
              $('#err_nis').append('<li>'+err_values+'</li>');
            });
            $.each(response.errors.jenis_kelamin, function (key, err_values){
              $('#err_jenis_kelamin').append('<li>'+err_values+'</li>');
            });
            $.each(response.errors.email, function (key, err_values){
              $('#err_email').append('<li>'+err_values+'</li>');
            });
          }
          else {
            $('.text-danger').html("");
            $('#success_message').addClass('alert alert-success alert-dismissible fade show');
            $('#success_message').text(response.message);
            $('#success_message').append('<a href="/daftarSiswa">Refresh</a>');
            $('#success_message').append('<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span></button>')
            $('#tambahSiswa').modal('hide');
            $('#tambahSiswa').find('input').val("");

          }
        }
      });
     });
     $(document).on('click', 'cancelTambah', function(e){
      $('.text-danger').html("");
     });
   });
</script>
@endsection