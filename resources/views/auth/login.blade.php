@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">メールアドレス</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">パスワード</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        記憶する
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    ログイン
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        パスワードを忘れた方
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                    </form>

                    <hr>

                    <div class="row mb-0">
                        <div class="col-md-8 offset-md-4 d-flex flex-column gap-2">

                            {{-- Googleログイン --}}
                            <a href="{{ route('google.login') }}" 
                            class="btn btn-light border d-flex align-items-center justify-content-center" 
                            style="width: 250px;">
                                <img src="https://developers.google.com/identity/images/g-logo.png"
                                    alt="Google" style="width:20px; height:20px; margin-right:8px;">

                                Googleでログイン
                            </a>

                            {{-- LINEログイン --}}
                            <a href="{{ route('line.login') }}" 
                            class="btn btn-success d-flex align-items-center justify-content-center" 
                            style="width: 250px; color:white;">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/4/41/LINE_logo.svg"
                                    alt="LINE" style="width:20px; height:20px; margin-right:8px;">
                                LINEでログイン
                            </a>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
