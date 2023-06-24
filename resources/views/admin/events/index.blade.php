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
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">All Events</h3>
            </div>
            <div class="card-body p-0">
                @if($activities->isEmpty())
                    <p class="text-center p-4">There's no event data.</p>
                @else
                    <table class="table table-responsive table-striped projects">
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
                            @foreach($activities as $activity)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <a>{{ $activity->activity_name }}</a>
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
                                    @if($activity->activity_status == 'PENDING')
                                        <span class="badge badge-warning">{{ $activity->activity_status }}</span>
                                    @elseif($activity->activity_status == 'APPROVED')
                                        <span class="badge badge-info">{{ $activity->activity_status }}</span>
                                    @elseif($activity->activity_status == 'COMPLETED')
                                        <span class="badge badge-success">{{ $activity->activity_status }}</span>
                                    @elseif($activity->activity_status == 'REJECTED')
                                        <span class="badge badge-danger">{{ $activity->activity_status }}</span>
                                    @endif
    
                                    @if($activity->activity_start_date == date('Y-m-d'))
                                        @php
                                            $activity->activity_status = 'APPROVED';
                                            $activity->save();
                                        @endphp
                                    @elseif($activity->activity_end_date <= date('Y-m-d'))
                                        @php
                                            $activity->activity_status = 'COMPLETED';
                                            $activity->save();
                                        @endphp
                                    @endif
                                </td>
                                <td class="project-actions text-right">
                                    <a class="btn btn-primary btn-sm" href="{{ route('admin.event.show', ['activities_id' => $activity->activity_id]) }}">
                                        <i class="fas fa-folder"></i> View
                                    </a>
                                    <a class="btn btn-info btn-sm" href="{{ route('admin.event.edit', ['activities_id' => $activity->activity_id]) }}">
                                        <i class="fas fa-pencil-alt"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.event.destroy', ['id' => $activity->activity_id]) }}" method="POST" class="mx-1 d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="activity_id" value="{{ $activity->activity_id }}">
                                        <a href="#" class="btn btn-sm btn-danger btn-delete" onclick="deleteConfirmation(event)"><i class="fas fa-trash"></i> Delete</a>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </section>    
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.all.min.js" integrity="sha256-2Dbg51yxfa7qZ8CSKqsNxHtph8UHdgbzxXF9ANtyJHo=" crossorigin="anonymous"></script>
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

    function deleteConfirmation(event) {
        event.preventDefault();
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger mr-1'
            },
            buttonsStyling: false
        });

        swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                // Submit the form after confirmation
                event.target.closest('form').submit();
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                swalWithBootstrapButtons.fire(
                    'Cancelled',
                    'Your data is safe :)',
                    'error'
                )
            }
        });
    }
</script>
@endsection
