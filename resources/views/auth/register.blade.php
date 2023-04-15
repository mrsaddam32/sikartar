@extends('auth.layouts.main')

@section('container')
<div class="register-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <h2><b>{{ config('app.name') }}</b></h2>
    </div>
    <div class="card-body">
      <form action="{{ route('auth.register') }}" method="post">
        @csrf
        <div class="input-group mb-3">
          <input type="text" class="form-control @error('name') is-invalid
          @enderror" name="name" placeholder="Full name" value="{{ old('name') }}">
          @error('name')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        </div>
        <div class="input-group mb-3">
          <input type="email" class="form-control @error('email') is-invalid
          @enderror" name="email" placeholder="Email" value="{{ old('email') }}">
          @error('email')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control @error('password') is-invalid
          @enderror" name="password" placeholder="Password">
          @error('password')
            <div class="invalid-feedback">
              {{ $message }}
            </div>  
          @enderror
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block mb-3">Register</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <a href="{{ route('auth.login') }}" class="text-center">
        Already have an account? Sign in.
      </a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->
@endsection