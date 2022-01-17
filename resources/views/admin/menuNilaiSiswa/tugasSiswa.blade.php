@extends('admin.layout.header')
@section('title','Tugas Siswa')
@section('judul','Tugas Siswa')
@section('menuNilai','active')

@section('content')
<div class="content-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="card p-4">
        <div class="card-header " style="background-color:#ab47bc;color:white">
          <div class="row">
            <div class="col-6">
            <p style="font-size:20px">Hasil Tugas Siswa dari <b> {{$user->name}}</b></p>
            </div>
          </div>
        </div>
        <div class="card-body">
        @if(session()->has('pesan'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session()->get('pesan') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          @endif
        <div class="table-responsive">
        <table class="table table-hover">
            <thead style="color:#ab47bc">
              <tr>
                <th scope="col" class="align-middle text-center" style="width:5%">KD</th>
                <th scope="col" style="width:35%">Judul Materi</th>
                <th scope="col" class="align-middle text-center" style="width:25%">Waktu Pengumpulan</th>
                <th scope="col"  class="align-middle text-center" >File Tugas</th>
                <th scope="col"  class="align-middle text-center" >Aksi</th>
              </tr>
            </thead>
            <tbody>
              @forelse($tugas as $tuga_s)
              <tr>
                <th scope="row" class="align-middle text-center">{{$tuga_s->kd}}</th>
                <td>{{$tuga_s->judul_materi}}</td>
                <td class="align-middle text-center">{{$tuga_s->created_at}}</td>
                <td  class="align-middle text-center">
                    <a href="{{ asset('tugas/'. $tuga_s->link_file_tugas) }} " type="button" class="btn btn-primary btn-sm">Lihat</a>
                </td>
                <td  class="align-middle text-center">
                    <a id="detail" href="#komen" type="button" class="btn btn-warning btn-sm" data-toggle="modal"
                      data-komentar="{{$tuga_s->komentar}}"
                      data-id="{{$tuga_s->id}}"
                      data-iduser="{{$tuga_s->id_user}}">Komentar</a>
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
<div id="komen" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
    <form action="{{route('nilai.tugasSiswa.komentar.update')}}" method="post">
        @method('PATCH')
        @csrf
				<div class="modal-header">						
					<h4 class="modal-title">Komentar</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">	
            <div class="form-group">
              <label for="validationTextarea">Mengenai Tugas 1</label>
              <textarea class="form-control" id="komentar" name="komentar" rows="3" ></textarea>
              <input id="id" type="hidden" class="form-control border-top-0 border-right-0 border-left-0 rounded-0" name="id" placeholder="" visibility="false">
              <input id="iduser" type="hidden" class="form-control border-top-0 border-right-0 border-left-0 rounded-0" name="id_user" placeholder="" visibility="false">
            </div>
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


@section('scripts')
<script>
    $(document).ready(function() {
      $(document).on('click', "#detail", function() {
        var komentar = $(this).data('komentar');
        $('#komentar').val(komentar);
        var id = $(this).data('id');
        $('#id').val(id);
        var iduser = $(this).data('iduser');
        $('#iduser').val(iduser);
      })
    })
</script>
@endsection