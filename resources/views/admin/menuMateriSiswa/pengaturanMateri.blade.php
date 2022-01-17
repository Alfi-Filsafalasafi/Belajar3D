@extends('admin.layout.header')
@section('title','Materi Siswa')
@section('judul','Materi Siswa')
@section('menuMateri','active')

@section('content')
<div class="content-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="card p-4">
        <div class="card-header " style="background-color:#ab47bc;color:white">
          <div class="row">
            <div class="col-6">
            <h5>Materi Siswa</h5>Mengatur Materi yang nanti dipelajari siswa
            </div>
            <div class="col-6 text-right my-auto">
            <a href="/tambahMateri" type="button" class="btn btn-success">Tambah Materi</a>
            </div>
          </div>
        </div>
        <div class="card-body">
        @if(session()->has('tambah'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session()->get('tambah') }}
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
          @if(session()->has('update'))
          <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{ session()->get('update') }}
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
                <th scope="col" style="width:15%">Judul Materi</th>
                <th scope="col" style="width:45%">Deskripsi Materi</th>
                <th scope="col"  class="align-middle text-center" >Berkas</th>
                <th scope="col"  class="align-middle text-center" >Tugas</th>
                <th scope="col"  class="align-middle text-center" >Kuis</th>
                <th scope="col"  class="align-middle text-center" >Aksi</th>
              </tr>
            </thead>
            <tbody>
              @forelse($materis as $materi)
              <tr>
                <th scope="row" class="align-middle text-center">{{$materi->kd}}</th>
                <td class="align-middle">{{$materi->judul_materi}}</td>
                <td class="align-middle">{{$materi->deskripsi_materi}}</td>
                <td  class="align-middle text-center">
                    <a href="{{ asset('materi/'. $materi->link_berkas) }} " type="button" class="btn btn-primary btn-sm">Lihat</a>
                </td>
                <td  class="align-middle text-center">
                    <a href="{{route('materi.tugas.index', ['materi' => $materi->id])}}" type="button" class="btn btn-primary btn-sm">Lihat</a>
                </td>
                <td  class="align-middle text-center">
                    <a href="{{route('kuis.index', ['kuis' => $materi->id])}}" type="button" class="btn btn-primary btn-sm">Lihat</a>
                </td>
                <td  class="align-middle text-center">
                    <div class="btn-group-vertical">
                        <a id="detail" href="#ubahMateri" type="button" class="btn btn-warning btn-sm mb-2" data-toggle="modal"
                          data-kd="{{$materi->kd}}"
                          data-id="{{$materi->id}}"
                          data-judul_materi = "{{$materi->judul_materi}}"
                          data-deskripsi_materi = "{{$materi->deskripsi_materi}}">
                        Edit</a>
                        <a href="{{route('materi.delete',['materi'=>$materi->id])}}" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin mau menghapus materi {{$materi->judul_materi}} ini ?')">Hapus</a>
                    </div>
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
<div id="ubahMateri" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
      <form action="{{route('materi.update',['materi' => $materi->id ?? 0]) }}" method="post" enctype="multipart/form-data">
        @method('PATCH')
        @csrf
				<div class="modal-header">						
					<h4 class="modal-title">Ubah Materi</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">	
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                            <label>KD</label>
                            <input id="kd" type="text" class="form-control border-top-0 border-right-0 border-left-0 rounded-0" name="kd" placeholder="" value="" required>
                            <input id="id" type="hidden" class="form-control border-top-0 border-right-0 border-left-0 rounded-0" name="id" placeholder="" visibility="false">

                          </div>	
                        </div>
                        <div class="col-md-9">
                            <div class="form-group"> 
                            <label>Judul Materi</label>
                            <input id="judul_materi" type="text" class="form-control border-top-0 border-right-0 border-left-0 rounded-0" name="judul_materi" required>
                            </div>	
                        </div>
                    </div>	
                    <div class="form-group"> 
                        <label>Link Berkas</label>
                        <input type="file" class="form-control pb-5 border-top-0 border-right-0 border-left-0 rounded-0" name="link_berkas" value="">
                        <p style="font-size:10px;">*Kosongi jika tidak mau di ubah</p>
                      </div>
                    <div class="form-group">
                        <label for="validationTextarea">Deskripsi Materi</label>
                        <textarea class="form-control border-top-0 border-right-0 border-left-0 rounded-0" id="deskripsi_materi" rows="3" name="deskripsi_materi" required ></textarea>
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
        var kd = $(this).data('kd');
        $('#kd').val(kd);
        var id = $(this).data('id');
        $('#id').val(id);
        var judul_materi = $(this).data('judul_materi');
        $('#judul_materi').val(judul_materi);
        var deskripsi_materi = $(this).data('deskripsi_materi');
        $('#deskripsi_materi').text(deskripsi_materi);
      })
    })
</script>
@endsection