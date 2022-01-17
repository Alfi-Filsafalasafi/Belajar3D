@extends('layouts.app')

@section('content')
<div class="container">
    
    <div class="row justify-content-center">
        <div class="col-md-5 pt-4 mt-4">
        @if(session()->has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session()->get('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
            @endif
            <div class="card">
                <div class="card-header py-3 text-white text-center" style="background:#25275d; font-size:24px;">{{ __('Login') }}</div>

                <div class="card-body" style="background:#353885;">
                    <form method="POST" class="mt-3" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row justify-content-center">

                            <div class="col-md-10">
                                <input id="email" style="background:#353885;outline: none;color: #fff;font-size: 16px;" type="email" placeholder="Username" class="loginn w-100 pb-2 border-top-0 border-right-0 border-left-0 border-white rounded-0 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row justify-content-center mt-4">
                            <div class="col-md-10">
                                <input id="password" style="background:#353885;outline: none;color: #fff;font-size: 16px;" type="password" placeholder="Password" class="loginn w-100 pb-2 border-top-0 border-right-0 border-left-0 border-white rounded-0  @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>  
                        <div class="form-group row">
                            <div class="col-md-11">
                                <a class="text-white" style="float:right" href="" onClick="alert('Silahkan hubungi Admin untuk mengetahui password anda')">Lupa Password ?</a>
                            </div>
                        </div>
                        <div class="form-group row justify-content-center">
                            <div class="col-md-10 text-center">
                                <button type="submit" class="btn butlog px-5">
                                    {{ __('Login') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
