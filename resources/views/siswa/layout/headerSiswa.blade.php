<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/style.css')}}">
    <title>@yield('title')</title>
    
</head>
<body style="background:#f5f5f5">
<nav class="navbar navbar-expand-lg bg-white navbar-dark py-4 ">
  <div class="container">
  <a class="navbar-brand" href="#" style="color:#353885; font-size:25px">Belajar3D</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item @yield('menuBeranda')">
        <a class="nav-link " href="/berandaSiswa" style="color:#353885; font-size:18px">
        Beranda <span class="sr-only">(current)</span></a>
      </li>
    </ul>
    <div class="nav-item dropdown">
      <a id="navbarDropdown" class="nav-link dropdown-toggle" style="color:#353885; font-size:18px" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
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

<div class="container pt-4">
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
    @yield('content')
</div>
<div class="container mt-4" id="materi">
  @yield('utama')
</div>


<div id="tambah" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
      <form action="{{route('profil.update',['user' => Auth::user()->id ]) }}" method="post">
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
              <input type="text" class="form-control border-top-0 border-right-0 border-left-0 rounded-0" name="name" id="name" value="{{ Auth::user()->name }}" required>
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
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>

</body>
</html>