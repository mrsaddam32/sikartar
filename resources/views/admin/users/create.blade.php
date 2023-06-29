@extends('templates.layouts.main')

@section('container')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">{{ $title }}</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content ml-2">
        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">General</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Fullname</label>
                                <input type="text" id="name" name="name" class="form-control @error('name') is-invalid
                                @enderror" value="{{ old('name') }}" autofocus autocomplete="off">
                                @error('name')
                                    <div class="invalid-feedback">
                                    {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" class="form-control @error('email') is-invalid
                                @enderror" value="{{ old('email') }}" autocomplete="off">
                                @error('email')
                                    <div class="invalid-feedback">
                                    {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" id="password" name="password" class="form-control @error('password') is-invalid
                                @enderror">
                                @error('password')
                                    <div class="invalid-feedback">
                                    {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="confirm_password">Confirmation Password</label>
                                <input type="password" id="confirm_password" name="confirm_password" class="form-control @error('confirm_password') is-invalid
                                @enderror">
                                @error('confirm_password')
                                    <div class="invalid-feedback">
                                    {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary mr-2 my-3">Cancel</a>
                    <button class="btn btn-info" type="submit">Save</button>
                </div>
            </div>
        </form>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
@endsection
