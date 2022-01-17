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
          <div class="row">
            <div class="col-6">
            <p style="font-size:20px">Hasil Tugas Siswa dari <b>{{$user->name}}</b></p>
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
                <th scope="col" class="align-middle text-center" style="width:15%">KD</th>
                <th scope="col" >Judul Materi</th>
                <th scope="col" class="align-middle text-center" style="width:20%">Nilai</th>
                <th scope="col" class="align-middle text-center" style="width:20%">Aksi</th>

              </tr>
            </thead>
            <tbody>
            @forelse($tugas as $tuga_s)
              <tr>
                <th scope="row" class="align-middle text-center">{{$tuga_s->kd}}</th>
                <td>{{$tuga_s->judul_materi}}</td>
                <td class="align-middle text-center">{{$tuga_s->nilai}}</td>
                <td  class="align-middle text-center">
                    <a id="detail" href="#ubah" type="button" class="btn btn-warning btn-sm" data-toggle="modal"
                      data-nilai="{{$tuga_s->nilai}}"
                      data-id="{{$tuga_s->id}}"
                      data-kd="{{$tuga_s->kd}}"
                      data-judul="{{$tuga_s->judul_materi}}"
                      data-iduser="{{$tuga_s->id_user}}">Ubah NIlai</a>
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
<div id="ubah" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
      <form action="{{route('nilai.tugasSiswa.nilai.update')}}" method="post">
        @method('PATCH')
        @csrf
				<div class="modal-header">						
					<h4 class="modal-title">Ubah Nilai</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">	
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                            <label>KD</label>
                            <input type="text" class="form-control border-top-0 border-right-0 border-left-0 rounded-0" name="" id="kd" placeholder="" value="" disabled>
                            </div>	
                        </div>
                        <div class="col-md-9">
                            <div class="form-group"> 
                            <label>Judul Materi</label>
                            <input type="text" class="form-control border-top-0 border-right-0 border-left-0 rounded-0" name="" id="judul_materi"  disabled>
                            </div>	
                        </div>
                    </div>	
                    <div class="form-group"> 
                        <label>Nilai</label>
                        <input id="id" type="hidden" class="form-control border-top-0 border-right-0 border-left-0 rounded-0" name="id" placeholder="" visibility="false">
                        <input id="iduser" type="hidden" class="form-control border-top-0 border-right-0 border-left-0 rounded-0" name="iduser" placeholder="" visibility="false">
           
                        <input type="hidden" class="form-control border-top-0 border-right-0 border-left-0 rounded-0" name="nilai_awal" id="nilai_awal" >
                        <input type="number" class="form-control border-top-0 border-right-0 border-left-0 rounded-0" name="nilai" id="nilai" >
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
        var nilai = $(this).data('nilai');
        $('#nilai').val(nilai);
        $('#nilai_awal').val(nilai);
        var id = $(this).data('id');
        $('#id').val(id);
        var iduser = $(this).data('iduser');
        $('#iduser').val(iduser);
        var kd = $(this).data('kd');
        $('#kd').val(kd);
        var judul = $(this).data('judul');
        $('#judul_materi').val(judul);
        var iduser = $(this).data('iduser');
        $('#iduser').val(iduser);
      })
    })
</script>
@endsection