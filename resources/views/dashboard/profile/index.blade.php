@extends('dashboard.layouts.main')

@section('container')
<div class="container-fluid">
    <div class="page-header min-height-300 border-radius-xl mt-3" style="background-image: url('{{ asset('img/curved-images/') }}curved0.jpg'); background-position-y: 50%;">
      <span class="mask bg-gradient-primary opacity-6"></span>
    </div>
    <div class="card card-body blur shadow-blur mx-4 mt-n6 overflow-hidden">
      <div class="row gx-4">
        <div class="col-auto">
          <div class="avatar avatar-xl position-relative">
            @if ($user->photo_path)
              <img src="{{ asset($user->photo_path) }}" alt="profile_image" class="w-100 h-100 border-radius-lg shadow-sm">
            @else
              <img src="https://ui-avatars.com/api/?name={{ $user->name }}&background=random" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
            @endif
          </div>
        </div>
        <div class="col-auto my-auto">
          <div class="h-100">
            <h5 class="mb-1">
              {{ $user->name }}
            </h5>
            @if ($user->role_id == 1)
              <span class="badge badge-sm bg-gradient-danger">
                {{ $user->role->role_name }}
              </span>
            @else
              <span class="badge badge-sm bg-gradient-info">
                {{ $user->role->role_name }}
              </span>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="container pt-4">
    @if (session()->has('success'))
      <div class="alert alert-success alert-dismissible fade show fw-bold text-white" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif
    @if (session()->has('error'))
      <div class="alert alert-danger alert-dismissible fade show fw-bold text-white" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif
  </div>
  <div class="container-fluid py-4">
    <div class="row">
      <div class="col-12 col-xl-4 mb-3">
        <div class="card h-100">
          <div class="card-header pb-0 p-3">
            <div class="row">
              <div class="col-md-8 d-flex align-items-center">
                <h6 class="mb-0">Profile Detail</h6>
              </div>
            </div>
          </div>
          <div class="card-body p-3">
            <p class="text-sm">
              Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repudiandae non iure laudantium laboriosam. Perspiciatis, molestiae!
            </p>
            <hr class="horizontal gray-light my-4">
            <ul class="list-group">
              <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Full Name:</strong> &nbsp; {{ $user->name }}</li>
              <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Mobile:</strong> &nbsp; (44) 123 1234 123</li>
              <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Email:</strong> &nbsp; {{ $user->email }}</li>
              <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Account Since:</strong> &nbsp; {{ $user->created_at->format('d F Y') }}
              </li>
              <li class="list-group-item border-0 ps-0 pb-0">
                <strong class="text-dark text-sm">Social:</strong> &nbsp;
                <a class="btn btn-facebook btn-simple mb-0 ps-1 pe-2 py-0" href="javascript:;">
                  <i class="fab fa-facebook fa-lg"></i>
                </a>
                <a class="btn btn-twitter btn-simple mb-0 ps-1 pe-2 py-0" href="javascript:;">
                  <i class="fab fa-twitter fa-lg"></i>
                </a>
                <a class="btn btn-instagram btn-simple mb-0 ps-1 pe-2 py-0" href="javascript:;">
                  <i class="fab fa-instagram fa-lg"></i>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="col-12 col-xl-8 mb-3">
        <div class="card h-100">
          <div class="card-header pb-0 p-3">
            <div class="row">
              <div class="col-md-8 d-flex align-items-center">
                <h6 class="mb-0">Edit Profile</h6>
              </div>
            </div>
          </div>
          <div class="card-body p-3">
            <form action="{{ route('dashboard.profile.update', $user->id) }}" method="POST"enctype="multipart/form-data">
              @method('patch')
              @csrf
              <div class="row">
                <div class="col-md-12">
                  <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" value="{{ old('image', $user->image) }}">
                    @error('image')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name) }}">
                    @error('name')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}">
                    @error('email')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <button type="submit" class="btn bg-gradient-info w-100 mt-4 mb-0">Save</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12 col-xl-6">
        <div class="card h-100">
          <div class="card-header pb-0 p-3">
            <div class="row">
              <div class="col-md-8 d-flex align-items-center">
                <h6 class="mb-0">Change Password</h6>
              </div>
            </div>
          </div>
          <div class="card-body p-3">
            <form action="{{ route('dashboard.profile.updatePassword', $user->id) }}" method="POST">
              @method('patch')
              @csrf
              <div class="row">
                <div class="col-md-12">
                  <div class="mb-3">
                    <label for="current_password" class="form-label">Current Password</label>
                    <input type="password" class="form-control @error('current_password') is-invalid @enderror" id="current_password" name="current_password" value="{{ old('current_password') }}">
                    @error('current_password')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="mb-3">
                    <label for="new_password" class="form-label">New Password</label>
                    <input type="password" class="form-control @error('new_password') is-invalid @enderror" id="new_password" name="new_password" value="{{ old('new_password') }}">
                    @error('new_password')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="mb-3">
                    <label for="new_password_confirmation" class="form-label">New Password Confirmation</label>
                    <input type="password" class="form-control @error('new_password_confirmation') is-invalid @enderror" id="new_password_confirmation" name="new_password_confirmation" value="{{ old('new_password_confirmation') }}">
                    @error('new_password_confirmation')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <button type="submit" class="btn bg-gradient-info w-100 mt-4 mb-0">Save</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection