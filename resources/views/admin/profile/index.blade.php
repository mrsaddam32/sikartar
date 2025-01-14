@extends('templates.layouts.main')

@section('container')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Profile</h1>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-3">
          <!-- Profile Image -->
          <div class="card card-primary card-outline">
            <div class="card-body box-profile">
              <div class="text-center">
                @if($user->photo_path)
                  <img class="profile-user-img img-circle border-primary object-fit-cover"
                    src="{{ asset($user->photo_path) }}"
                    alt="{{ $user->name }}" height="100" width="100" style="background-position: center;">
                @else
                  <img class="profile-user-img img-fluid img-circle"
                    src="https://ui-avatars.com/api/?name={{ $user->name }}&background=random"
                    alt="{{ $user->name }}">
                @endif
              </div>
              <h3 class="profile-username text-center">{{ $user->name }}</h3>
              @if($user->role_id == 1)
                <p class="text-muted text-center text-uppercase">{{ $user->role->role_name }}</p>
              @else
                <p class="text-muted text-center text-uppercase">{{ $user->role->role_name }}</p>
              @endif
              <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item">
                  <b>Email</b> <span class="float-right text-white">{{ $user->email }}</span>
                </li>
                <li class="list-group-item">
                  <b>Account Since</b> <span class="float-right text-white">{{ $user->created_at->format('d F Y')}}</span>
                </li>
              </ul>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="card card-primary card-outline">
            <div class="card-header p-2">
              <ul class="nav nav-pills">
                <li class="nav-item"><a class="nav-link active text-white" href="#update_profile" data-toggle="tab">Update Profile</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="#change_password" data-toggle="tab">Change Password</a></li>
              </ul>
            </div><!-- /.card-header -->
            <div class="card-body">
              <div class="tab-content">
                <div class="tab-pane fade" id="change_password">
                  <form action="{{ route('admin.profile.updatePassword', $user->id) }}" method="POST">
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
                        <button type="submit" class="btn bg-primary w-100 mt-4 mb-0">Save</button>
                      </div>
                    </div>
                  </form>
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane fade show active" id="update_profile">
                  <form action="{{ route('admin.profile.update', $user->id) }}" method="POST"enctype="multipart/form-data">
                    @method('patch')
                    @csrf
                    <div class="row">
                      <div class="col-md-12">
                        <div class="mb-3">
                          <label for="image" class="form-label">Image</label>
                          <div class="d-flex align-items-center">
                            <img class="img-thumbnail img-fluid float-left" 
                            src="
                            @if($user->photo_path)
                              {{ asset($user->photo_path) }}
                            @else
                            https://ui-avatars.com/api/?name={{ $user->name }}&background=random
                            @endif
                            " 
                            id="img" style="margin-right:10px;" width="200" height="200">
                            <input type="file" class="form-control @error('image') is-invalid @enderror border-0" id="image" name="image" value="{{ old('image', $user->image) }}">
                          </div>
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
                          <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name) }}" autocomplete="off">
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
                          <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}" autocomplete="off">
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
                        <button type="submit" class="btn bg-primary w-100 mt-4 mb-0">Save</button>
                      </div>
                    </div>
                  </form>
                </div>
                <!-- /.tab-pane -->
              </div>
              <!-- /.tab-content -->
            </div><!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
<script>
  $(document).ready(function() {
      // Set toastr options
      toastr.options = {
          "positionClass": "toast-top-right",
      }

      // Show success message
      @if (session()->has('success'))
          toastr.success('{{ session('success') }}');
      @endif

      // Show error message
      @if (session()->has('error'))
          toastr.error('{{ session('error') }}');
      @endif
  });
</script>
@endsection