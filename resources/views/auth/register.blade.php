@extends('auth.layouts.main')

@section('container')
  <main class="main-content  mt-0">
    <section class="min-vh-100 mb-8">
      <div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg" style="background-image: url('{{ 
        asset('img/curved-images/curved0.jpg')
        }}');">
        <span class="mask bg-gradient-dark opacity-6"></span>
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-5 text-center mx-auto">
              <h1 class="text-white mb-2 mt-5">
                Register Here
              </h1>
            </div>
          </div>
        </div>
      </div>
      <div class="container">
        <div class="row mt-lg-n10 mt-md-n11 mt-n10">
          <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
            <div class="card z-index-0">
              <div class="card-header text-center pt-4">
                <h5>Register Here</h5>
              </div>
              <div class="card-body">
                <form action="{{ route('auth.register') }}" role="form text-left" method="post">
                    @csrf
                  <div class="mb-3">
                    <input type="text" class="form-control @error('name') is-invalid
                    @enderror" placeholder="Fullname" aria-label="Name" name="name" value="{{ old('name') }}">
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                  </div>
                  <div class="mb-3">
                    <input type="email" class="form-control @error('email') is-invalid
                    @enderror" placeholder="Email" aria-label="Email" name="email" value="{{ old('email') }}">
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                  </div>
                  <div class="mb-3">
                    <input type="password" class="form-control @error('password') is-invalid
                    @enderror" placeholder="Password" aria-label="Password"  name="password">
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                  </div>
                  <div class="text-center">
                    <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2">Register</button>
                  </div>
                  <p class="text-sm mt-3 mb-0">Already have an account? <a href="{{ route('auth.login') }}" class="text-dark font-weight-bolder">Login</a></p>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
@endsection