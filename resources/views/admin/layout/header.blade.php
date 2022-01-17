<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <style>
        .table-hover tbody tr:hover td, .table-hover tbody tr:hover th {
        background-color: #eedaf1;
        }
        .form-control:focus{
          background-image : linear-gradient(to top, #9c27b0 1px, rgba(156, 39, 176, 0) 1px), linear-gradient(to top, #d2d2d2 1px, rgba(210, 210, 210, 0) 1px);
          box-shadow : none;
        }
        .form-check-input.active{
          background-color:#ff27f0;
        }
    </style>
    <title>@yield('title')</title>
    
</head>
<body style="background:#f5f5f5">
<nav class="navbar navbar-expand-lg navbar-dark  p-3 " style="background-color:#ab47bc;color:white">
  <div class="container">
  <a class="navbar-brand" href="#">Belajar3D</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item @yield('menuDashboard')">
        <a class="nav-link " href="/berandaAdmin">Beranda <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item @yield('menuNilai')">
        <a class="nav-link " href="/MenuNilaiSiswa">Nilai Siswa</a>
      </li>
      <li class="nav-item @yield('menuMateri')">
        <a class="nav-link " href="/pengaturanMateri">Materi</a>
      </li>
    </ul>

    <div class="nav-item dropdown">
      <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
        {{ Auth::user()->name }}
      </a>

      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
      <a class="dropdown-item" href="#tambah" data-toggle="modal">Profil</a>
        <a class="dropdown-item" href="{{ route('logout') }}"
        onclick="return logout(event);">
          Keluar
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
          @csrf
        </form>
      </div>
    </div>
  </div>
</nav>
</div>

<div class="container pt-5">
@if(session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          {{ session()->get('error') }}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        @endif
        @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ session()->get('success') }}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        @endif
    <h5 class="pb-3" style="color:#8c8c8c">@yield('judul')</h5>
    @yield('content')
</div>

@yield('modal')

<div id="tambah" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
      <form action="{{route('profilGuru.update',['user' => Auth::user()->id ]) }}" method="post">
          @method('PATCH')
          @csrf
				<div class="modal-header">						
					<h4 class="modal-title">Profil Pengguna</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">	
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Nama Lengkap</label>
              <input type="text" class="form-control border-top-0 border-right-0 border-left-0 rounded-0" name="nama" id="nama" value="{{ Auth::user()->name }}" required>
            </div>	
          </div>
          <div class="col-md-6">
            <div class="form-group"> 
              <label>Email</label>
              <input type="text" class="form-control border-top-0 border-right-0 border-left-0 rounded-0" name="email" value="{{ Auth::user()->email }}" required >
            </div>	
          </div>
        </div>	
        <div class="form-group"> 
						<label>Jenis Kelamin</label> <br>
					  <div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="jenis_kelamin"
                  id="laki_laki" value="L"
                  {{ (old('jenis_kelamin') ?? Auth::user()->jenis_kelamin)
                  == 'L' ? 'checked': '' }} >
                <label class="form-check-label" for="laki_laki">Laki-laki</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="jenis_kelamin"
                  id="perempuan" value="P"
                  {{ (old('jenis_kelamin') ?? Auth::user()->jenis_kelamin)
                  == 'P' ? 'checked': '' }} >
                <label class="form-check-label" for="perempuan">Perempuan</label>
              </div>
            </div>
        </div>						
        <div class="row">
          <div class="col-md-6">
            <div class="form-group"> 
                <label>Kata Sandi Baru</label>
                <input type="password" class="form-control border-top-0 border-right-0 border-left-0 rounded-0" name="sandi_baru" value="">
            </div>	
          </div>
          <div class="col-md-6">
            <div class="form-group"> 
                <label>Ulangi Kata Sandi Baru</label>
                <input type="password" class="form-control border-top-0 border-right-0 border-left-0 rounded-0" name="sandi_baru_fix" value="">
            </div>
          </div>
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

<script type="text/javascript">
    function logout(event){
            event.preventDefault();
            var check = confirm("Apakah anda yakin akan keluar ?");
            if(check){ 
               document.getElementById('logout-form').submit();
            }
     }
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
@yield('scripts')
</body>
</html>