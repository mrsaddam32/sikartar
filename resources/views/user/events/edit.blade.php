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
    <section class="content">
        <form action="{{ route('user.event.update', ['activities_id' => $activity->activity_id]) }}" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="activities_id" value="{{ $activity->activity_id }}">
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">General</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="inputName">Event Name</label>
                                <input type="text" id="inputName" name="activity_name" class="form-control" value="{{ $activity->activity_name }}">
                            </div>
                            <div class="form-group">
                                <label for="inputDescription">Event Description</label>
                                <textarea id="inputDescription" name="activity_description" class="form-control" rows="4">
                                    {{ $activity->activity_description }}
                                </textarea>
                            </div>
                            <div class="form-group">
                                <label for="inputStatus">Responsible Person</label>
                                <select id="inputStatus" name="responsible_person" class="form-control custom-select">
                                    <option selected disabled>Select One</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->name }}" {{ $user->name == $activity->responsible_person ? 'selected' : '' }}>
                                            {{ $user->name }}
                                        </option>
                                    @endforeach
                                </select>                                
                            </div>
                            <div class="form-group">
                                <label for="inputStatus">Event Status</label>
                                <select id="inputStatus" name="activity_status" class="form-control custom-select">
                                    <option selected disabled>Select one</option>
                                    <option value="PENDING" {{ $activity->activity_status == 'PENDING' ? 'selected' : '' }}>PENDING</option>
                                    <option value="REJECTED" {{ $activity->activity_status == 'REJECTED' ? 'selected' : '' }}>REJECTED</option>
                                    <option value="APPROVED" {{ $activity->activity_status == 'APPROVED' ? 'selected' : '' }}>APPROVED</option>
                                    <option value="COMPLETED" {{ $activity->activity_status == 'COMPLETED' ? 'selected' : '' }}>COMPLETED</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="inputClientCompany">Location</label>
                                <input type="text" id="inputClientCompany" name="activity_location" value="{{ $activity->activity_location }}" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Budget</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="activity_budget">Estimated budget</label>
                                <input type="number" id="activity_budget" name="activity_budget" class="form-control" value="{{ $activity->activity_budget }}">
                            </div>
                            <div class="form-group">
                                <label>Start Date</label>
                                <div class="input-group date" id="activity_start_date" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" data-target="#activity_start_date" name="activity_start_date" value="{{ $activity->activity_start_date }}" />
                                    <div class="input-group-append" data-target="#activity_start_date" data-toggle="datetimepicker">
                                        <div class="input-group-text">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>End Date</label>
                                <div class="input-group date" id="activity_end_date" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" data-target="#activity_end_date" name="activity_end_date" value="{{ $activity->activity_end_date }}" />
                                    <div class="input-group-append" data-target="#activity_end_date" data-toggle="datetimepicker">
                                        <div class="input-group-text">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <a href="{{ route('user.event.index') }}" class="btn btn-secondary mr-2 my-3">Cancel</a>
                    <button class="btn btn-info" type="submit">Edit Event</button>
                </div>
            </div>
        </form>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<!-- jQuery -->
{{-- <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
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
</script> --}}
@endsection
