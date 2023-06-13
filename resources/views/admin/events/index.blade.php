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
        <div class="row mb-2">
            <div class="col-sm-6">
                <a href="{{ route('admin.event.create') }}" class="btn btn-info">
                    <i class="fas fa-solid fa-plus mr-1"></i>Add New Event
                </a>
            </div>
        </div>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <section class="content">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Projects</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped projects">
                        <thead>
                            <tr>
                                <th style="width: 1%">#</th>
                                <th style="width: 20%">Event Name</th>
                                <th style="width: 30%">Responsible Member</th>
                                <th>Location</th>
                                <th style="width: 8%" class="text-center">Status</th>
                                <th style="width: 20%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ( $activities as $activity )
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><a>{{ $activity->activity_name }}</a>
                                        <br />
                                        <small>Created at {{ $activity->created_at->diffForHumans() }}</small>
                                    </td>
                                    <td>
                                        <span class="fw-bold">{{ $activity->responsible_person }}</span>
                                    </td>
                                    <td class="project_progress">
                                        {{ $activity->activity_location }}
                                    </td>
                                    <td class="project-state">
                                        @if ($activity->activity_status == 'PENDING')
                                            <span class="badge badge-warning">{{ $activity->activity_status }}</span>
                                        @elseif ($activity->activity_status == 'APPROVED')
                                            <span class="badge badge-info">{{ $activity->activity_status }}</span>
                                        @elseif ($activity->activity_status == 'COMPLETED')
                                            <span class="badge badge-success">{{ $activity->activity_status }}</span>
                                        @elseif ($activity->activity_status == 'REJECTED')
                                            <span class="badge badge-danger">{{ $activity->activity_status }}</span>
                                        @endif
                                    
                                        @if ($activity->activity_start_date == date('Y-m-d'))
                                            @php
                                                $activity->activity_status = 'APPROVED';
                                                $activity->save();
                                            @endphp
                                        @elseif ($activity->activity_end_date < date('Y-m-d'))
                                            @php
                                                $activity->activity_status = 'COMPLETED';
                                                $activity->save();
                                            @endphp
                                        @endif
                                    </td>                                    
                                    <td class="project-actions text-right">
                                        <a class="btn btn-primary btn-sm" href="{{ route('admin.event.show', ['activities_id' => $activity->activity_id]) }}">
                                            <i class="fas fa-folder"></i>
                                            View
                                        </a>
                                        <a class="btn btn-info btn-sm" href="{{ route('admin.event.edit', ['activities_id' => $activity->activity_id]) }}">
                                            <i class="fas fa-pencil-alt"></i>
                                            Edit
                                        </a>
                                        <form action="{{ route('admin.event.destroy', ['id' => $activity->activity_id]) }}" method="POST" class="mx-1 d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="activity_id" value="{{ $activity->activity_id }}">
                                            <button type="submit" name="name" class="btn btn-sm btn-danger btn-delete"><i class="fas fa-trash"></i> Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
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
