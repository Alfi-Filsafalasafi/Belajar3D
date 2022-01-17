<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <link rel="stylesheet" href="{{ asset ('css/style.css')}}">
    <title>@yield('title')</title>
    
</head>
<body style="background:#f5f5f5">
<div class="wrapper d-flex align-items-stretch">
			<nav id="sidebar"  style="background:#1f1f1f">
				<div class="custom-menu">
					<button type="button" id="sidebarCollapse" class="btn btn-primary">
	          <i class="fa fa-bars"></i>
	          <span class="sr-only">Toggle Menu</span>
	        </button>
        </div>
				<div class="p-4 pt-5">
		  		<h2><a href="index.html" class="logo">Belajar3D</a></h2>
	        <ul class="list-unstyled components mb-5">
	          <li class="@yield('home')">
	              <a href="{{route('superAdmin.index')}}">Home</a>
	          </li>
	          <li class="@yield('siswa')">
              <a href="{{route('siswa.index')}}" class="mt-2">Pengaturan Siswa</a>
	          </li>
	          <li class="@yield('panduan')">
              <a href="{{route('superAdmin.panduan')}}" class="mt-2">Panduan</a>
	          </li>

            <li>
	        	<a href="{{ route('logout') }}" onclick="return logout(event);" class="mt-5">Log Out</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
            </form>  
          </li>

	        </ul>
            
	      </div>
    	</nav>

        <!-- Page Content  -->
      <div id="content" class="p-4 p-md-5 m-2 pt-5">
        @yield('contentku')
		</div>
</div>

@yield('modal')




<script type="text/javascript">
    function logout(event){
            event.preventDefault();
            var check = confirm("Apakah anda yakin akan keluar ?");
            if(check){ 
               document.getElementById('logout-form').submit();
            }
     }
</script>

<script src="jsku/jquery.min.js"></script>
    <script src="jsku/popper.js"></script>
    <script src="jsku/bootstrap.min.js"></script>
    <script src="jsku/main.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
@yield('scripts')
</body>
</html>