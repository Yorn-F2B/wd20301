@extends('layouts.user')

@section('content')
<div class="row justify-content-center">
<div class="col-md-5">
    <h4 class="mb-3">Đăng nhập</h4>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                   value="{{ old('email') }}">
            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Mật khẩu</label>
            <input type="password" name="password" class="form-control">
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" name="remember" class="form-check-input" id="remember">
            <label class="form-check-label" for="remember">Ghi nhớ đăng nhập</label>
        </div>
        <button class="btn btn-primary w-100">Đăng nhập</button>
        <p class="mt-3 text-center">Chưa có tài khoản? <a href="{{ route('register') }}">Đăng ký</a></p>
    </form>
</div>
</div>
@endsection
