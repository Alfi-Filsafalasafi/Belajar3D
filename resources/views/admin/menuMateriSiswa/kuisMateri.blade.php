@extends('admin.layout.header')
@section('title','Kuis Materi')
@section('judul','Kuis')
@section('menuMateri','active')

@section('content')
<div class="content-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="card p-4">
        <div class="card-header " style="background-color:#ab47bc;color:white">
            <div class="row">
                <div class="col-6">
                <h5>Kuis Materi</h5>
                <div class="row">
                    <div class="col-sm-4">
                    <b>{{$materi->kd}}</b>
                    </div>
                    <div class="col-sm-6 ">
                    {{$materi->judul_materi}}
                    </div>
               </div>
                </div>
                <div class="col-6 text-right my-auto">
                 @if($jumlah >= 5)
                <a href="#tambahKuis" id="tambah" type="button" class="btn btn-success" data-toggle="modal" 
                data-idmateriku="{{$materi->id}}"
                style="pointer-events: none; background-color:#6cab7a;">Tambah Kuis</a>
                @else
                <a href="#tambahKuis" id="tambah" type="button" class="btn btn-success" data-toggle="modal" 
                data-idmateriku="{{$materi->id}}"
                style="">Tambah Kuis</a>
                @endif

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
        <div class="table-responsive">
        <table class="table table-hover">
            <thead style="color:#ab47bc;">
              <tr>
                <th scope="col"  style="">Pertanyaan</th>
                <th scope="col" class="align-middle text-center" style="width:12%" >A</th>
                <th scope="col" class="align-middle text-center" style="width:12%" >B</th>
                <th scope="col" class="align-middle text-center" style="width:12%" >C</th>
                <th scope="col" class="align-middle text-center" style="width:12%" >D</th>
                <th scope="col" class="align-middle text-center" style="width:12%">E</th>
                <th scope="col" class="align-middle text-center" style="width:5%">Kunci Jawaban</th>
                <th scope="col" class="align-middle text-center" style="width:8%">Aksi</th>

              </tr>
            </thead>
            <tbody style="font-size:14px">
            @forelse($kuis as $kui_s)
              <tr>
                <td class="align-middle">{{$kui_s->pertanyaan}}</td>
                <td class="align-middle text-center">{{$kui_s->jawaban_A}}</td>
                <td class="align-middle text-center">{{$kui_s->jawaban_B}}</td>
                <td class="align-middle text-center">{{$kui_s->jawaban_C}}</td>
                <td class="align-middle text-center">{{$kui_s->jawaban_D}}</td>
                <td class="align-middle text-center">{{$kui_s->jawaban_E}}</td>
                <td class="align-middle text-center"><b>{{$kui_s->kunci_jawaban}}</b></td>                
                <td  class="align-middle text-center">
                    <div class="btn-group-vertical">
                        <a href="#ubah" id="detail" type="button" class="btn btn-warning btn-sm mb-2" data-toggle="modal"
                          data-id_kuis="{{$kui_s->id_kuis}}"
                          data-idmateri="{{$kui_s->id_materi}}"
                          data-pertanyaan="{{$kui_s->pertanyaan}}"
                          data-jawaban_a="{{$kui_s->jawaban_A}}"
                          data-jawaban_b="{{$kui_s->jawaban_B}}"
                          data-jawaban_c="{{$kui_s->jawaban_C}}"
                          data-jawaban_d="{{$kui_s->jawaban_D}}"
                          data-jawaban_e="{{$kui_s->jawaban_E}}"
                          data-kunci_jawaban="{{$kui_s->kunci_jawaban}}">Edit</a>
                        <a href="{{route('kuis.delete',['kuis'=>$kui_s->id_kuis])}}" type="button" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin mau menghapus kuis ini ?')">Hapus</a>
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
<div id="ubah" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
      <form action="{{route('kuis.update') }}" method="post">
        @method('PATCH')
        @csrf
				<div class="modal-header">						
					<h4 class="modal-title">Edit Kuis No 1</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">	
                    <div class="form-group">
                        <label for="validationTextarea">Pertanyaan</label>
                        <textarea class="form-control border-top-0 border-right-0 border-left-0 rounded-0" id="pertanyaan" rows="3" name="pertanyaan" required></textarea>
                        <input value="" id="idmateri" type="hidden" class="form-control border-top-0 border-right-0 border-left-0 rounded-0" name="idmateri" placeholder="" visibility="false">
                        <input id="id_kuis" type="hidden" value=""  class="form-control border-top-0 border-right-0 border-left-0 rounded-0" name="id_kuis" placeholder="" visibility="false">
                    </div>
                    <div class="form-group">
                        <label for="validationTextarea">Jawaban A</label>
                        <textarea class="form-control border-top-0 border-right-0 border-left-0 rounded-0" id="jawaban_a" rows="2" name="jawaban_A" required ></textarea>
                    </div>
                    <div class="form-group">
                        <label for="validationTextarea">Jawaban B</label>
                        <textarea class="form-control border-top-0 border-right-0 border-left-0 rounded-0" id="jawaban_b" rows="2" name="jawaban_B" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="validationTextarea">Jawaban C</label>
                        <textarea class="form-control border-top-0 border-right-0 border-left-0 rounded-0" id="jawaban_c" rows="2" name="jawaban_C" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="validationTextarea">Jawaban D</label>
                        <textarea class="form-control border-top-0 border-right-0 border-left-0 rounded-0" id="jawaban_d" rows="2" name="jawaban_D" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="validationTextarea">Jawaban E</label>
                        <textarea class="form-control border-top-0 border-right-0 border-left-0 rounded-0" id="jawaban_e" rows="2" name="jawaban_E" required></textarea>
                    </div>
                    <div class="form-group">
                        <label><b>  Kunci Jawaban</b></label>
                        <select name="kunci_jawaban" id="option" class=" form-control custom-select border-top-0 border-right-0 border-left-0 rounded-0">
                            
                        </select>    
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
<div id="tambahKuis" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
    <form action="{{ route('kuis.store') }}" method="post">
      @csrf
				<div class="modal-header">						
					<h4 class="modal-title">Tambah Kuis </h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">	
                    <div class="form-group">
                        <label for="validationTextarea">Pertanyaan</label>
                        <input value="" id="idmateriku" type="hidden" class="form-control border-top-0 border-right-0 border-left-0 rounded-0" name="idmateri" placeholder="" visibility="false">
                        <textarea class="form-control border-top-0 border-right-0 border-left-0 rounded-0" id="exampleFormControlTextarea1" rows="3" name="pertanyaan" required ></textarea>
                    </div>
                    <div class="form-group">
                        <label for="validationTextarea">Jawaban A</label>
                        <textarea class="form-control border-top-0 border-right-0 border-left-0 rounded-0" id="exampleFormControlTextarea1" rows="3" name="jawaban_A" required ></textarea>
                    </div>
                    <div class="form-group">
                        <label for="validationTextarea">Jawaban B</label>
                        <textarea class="form-control border-top-0 border-right-0 border-left-0 rounded-0" id="exampleFormControlTextarea1" rows="3" name="jawaban_B" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="validationTextarea">Jawaban C</label>
                        <textarea class="form-control border-top-0 border-right-0 border-left-0 rounded-0" id="exampleFormControlTextarea1" rows="3" name="jawaban_C" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="validationTextarea">Jawaban D</label>
                        <textarea class="form-control border-top-0 border-right-0 border-left-0 rounded-0" id="exampleFormControlTextarea1" rows="3" name="jawaban_D" required ></textarea>
                    </div>
                    <div class="form-group">
                        <label for="validationTextarea">Jawaban E</label>
                        <textarea class="form-control border-top-0 border-right-0 border-left-0 rounded-0" id="exampleFormControlTextarea1" rows="3" name="jawaban_E" required ></textarea>
                    </div>
                    <div class="form-group">
                        <label><b>  Kunci Jawaban</b></label>
                        <select name="kunci_jawaban" class=" form-control custom-select border-top-0 border-right-0 border-left-0 rounded-0" id="inputGroupSelect01">
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                            <option value="D">D</option>
                            <option value="D">E</option>
                        </select>    
                    </div>
                </div>

                	
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
					<input type="submit" class="btn btn-primary" value="Tambah Kuis" name="tambah">
				</div>
			</form>
		</div>
	</div>
</div>
@endsection

@section('scripts')
<script>
      $(document).ready(function() {
      $(document).on('click', "#tambah", function() {
        var idmateriku = $(this).data('idmateriku');
        $('#idmateriku').val(idmateriku);
      })
    })
    $(document).ready(function() {
      $(document).on('click', "#detail", function() {
        var pertanyaan = $(this).data('pertanyaan');
        $('#pertanyaan').val(pertanyaan);

        var id = $(this).data('id_kuis');
        $('#id_kuis').val(id);

        var idmateri = $(this).data('idmateri');
        $('#idmateri').val(idmateri);

        var jawaban_a = $(this).data('jawaban_a');
        $('#jawaban_a').val(jawaban_a);

        var jawaban_b = $(this).data('jawaban_b');
        $('#jawaban_b').val(jawaban_b);

        var jawaban_c = $(this).data('jawaban_c');
        $('#jawaban_c').val(jawaban_c);

        var jawaban_d = $(this).data('jawaban_d');
        $('#jawaban_d').val(jawaban_d);

        var jawaban_e = $(this).data('jawaban_e');
        $('#jawaban_e').val(jawaban_e);

        var kunci_jawaban = $(this).data('kunci_jawaban');
        if(kunci_jawaban == 'A'){
        $('#option').append('<option value="A" selected>A</option> <option value="B">B</option> <option value="C">C</option><option value="D">D</option><option value="E">E</option>');
        }
        if(kunci_jawaban == 'B'){
        $('#option').append('<option value="A">A</option> <option value="B" selected>B</option> <option value="C">C</option><option value="D">D</option><option value="E">E</option>');
        }
        if(kunci_jawaban == 'C'){
        $('#option').append('<option value="A">A</option> <option value="B">B</option> <option value="C" selected>C</option><option value="D">D</option><option value="E">E</option>');
        }
        if(kunci_jawaban == 'D'){
        $('#option').append('<option value="A">A</option> <option value="B">B</option> <option value="C">C</option><option value="D" selected>D</option><option value="E">E</option>');
        }
        if(kunci_jawaban == 'E'){
        $('#option').append('<option value="A">A</option> <option value="B">B</option> <option value="C">C</option><option value="D">D</option><option value="E"  selected>E</option>');
        }
      })
    })
</script>
@endsection