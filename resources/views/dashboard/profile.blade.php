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
            <img src="{{ asset('img/bruce-mars.jpg') }}" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
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
  <div class="container-fluid py-4">
    <div class="row">
      <div class="col-12 col-xl-4">
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
    </div>
  </div>
@endsection