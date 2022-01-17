@extends('superAdmin.header')
@section('siswa','active')

@section('contentku')
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card p-4">
        <div class="card-header " style="background-color:#ab47bc;color:white">
              <h5 class="mt-1">Edit Siswa  {{$siswa->name}} </h5>
        </div>
        <div class="card-body">
            <form action="{{route('siswa.update',['user' => $siswa->id]) }}" method="post">
                @method('PATCH')
                @csrf
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="validationTextarea">NIS</label>
                            <input type="number" name="nis" id="nis" value="{{old('nis') ?? $siswa->nis}}" class="nis form-control border-top-0 border-right-0 border-left-0 rounded-0">
                            @error('nis')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="form-group">
                            <label for="validationTextarea">Nama</label>
                            <input type="text" name="name" id="name" value="{{old('name') ?? $siswa->name}}" class="name form-control border-top-0 border-right-0 border-left-0 rounded-0">
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Jenis Kelamin</label>
                    <div>
                        <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="jenis_kelamin"
                        id="laki_laki" value="L"
                        {{ (old('jenis_kelamin') ?? $siswa->jenis_kelamin)
                        == 'L' ? 'checked': '' }} >
                        <label class="form-check-label" for="laki_laki">Laki-laki</label>
                        </div>
                        <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="jenis_kelamin"
                        id="perempuan" value="P"
                        {{ (old('jenis_kelamin') ?? $siswa->jenis_kelamin)
                        == 'P' ? 'checked': '' }} >
                        <label class="form-check-label" for="perempuan">Perempuan</label>
                        </div>
                        @error('jenis_kelamin')
                                <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8">
                        <div class="form-group">
                            <label for="validationTextarea">Email</label>
                            <input type="email" name="email" id="email" value="{{old('email') ?? $siswa->email}}" class="email form-control border-top-0 border-right-0 border-left-0 rounded-0">
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="validationTextarea">Password</label>
                            <input type="text" name="password" id="password" value="{{old('password') ?? $siswa->ref_password}}" class="password form-control border-top-0 border-right-0 border-left-0 rounded-0">
                            <p style="font-size:10px">*kosongi jika password tidak mau di rubah</p>
                        </div>
                    </div>
                </div>
                <div class="text-right">
					<!-- <input type="button" class="btn btn-default cancelTambah" data-dismiss="modal" value="Cancel">  -->
					<button type="submit" class="btn btn-primary mb-2">Update</button>
				</div>
            </form>
        </div>
      </div>
    </div>
  </div>
@endsection