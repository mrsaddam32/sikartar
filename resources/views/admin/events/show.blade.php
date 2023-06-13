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
    <!-- Modal -->
    <div class="modal fade" id="uploadFilesModal" tabindex="-1" aria-labelledby="uploadFilesModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title fs-5" id="uploadFilesModalLabel">Upload Files</h3>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.event.uploadFiles', ['activity_id' => $activity->activity_id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="activity_id" value="{{ $activity->activity_id }}">
                        <div class="mb-3">
                            <label for="fileInput" class="form-label">Select File(s)</label>
                            <input type="file" class="form-control" id="fileInput" name="files[]" multiple>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Upload</button>
                        </div>
                    </form>                    
                </div>
            </div>
        </div>
    </div>    
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Events Detail</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
                        <div class="row">
                            <div class="col-12 col-sm-4">
                                <div class="info-box bg-light">
                                    <div class="info-box-content">
                                        <span class="info-box-text text-center text-muted">Estimated budget</span>
                                        <span class="info-box-number text-center text-muted mb-0">Rp. {{ number_format($activity->activity_budget, 0, ',', '.') }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-4">
                                <div class="info-box bg-light">
                                    <div class="info-box-content">
                                        <span class="info-box-text text-center text-muted">Estimated Event duration</span>
                                        <span class="info-box-number text-center text-muted mb-0">
                                            @php
                                                $start = new DateTime($activity->activity_start_date);
                                                $end = new DateTime($activity->activity_end_date);
                                                $interval = $start->diff($end);
                                                echo $interval->format('%a days');
                                            @endphp
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                        <div class="col-12 col-md-12 col-lg-4 order-1 order-md-2">
                            <h3 class="text-primary"><i class="fas fa-paint-brush"></i> {{ $activity->activity_name }}</h3>
                            <p class="text-muted">{{ $activity->activity_description }}</p>
                            <div class="text-muted">
                                <p class="text-sm">Event Date
                                <b class="d-block">{{ $activity->activity_start_date }} - {{ $activity->activity_end_date }}</b>
                                </p>
                                <p class="text-sm">Event Location
                                <b class="d-block">{{ $activity->activity_location }}</b>
                                </p>
                                <p class="text-sm">Event Leader
                                <b class="d-block">{{ $activity->responsible_person }}</b>
                                </p>
                                <p class="text-sm">Event Status
                                @if ( $activity->activity_status == 'PENDING' )
                                    <span class="badge d-block w-25 badge-warning">{{ $activity->activity_status }}</span>
                                @elseif ($activity->activity_status == 'APPROVED')
                                    <span class="badge d-block w-25 badge-info">{{ $activity->activity_status }}</span>
                                @elseif ($activity->activity_status == 'COMPLETED')
                                    <span class="badge d-block w-25 badge-success">{{ $activity->activity_status }}</span>
                                @elseif ($activity->activity_status == 'REJECTED')
                                    <span class="badge d-block w-25 badge-danger">{{ $activity->activity_status }}</span>
                                @endif
                                </p>
                            </div>
                            <h5 class="mt-5 text-muted">Event files</h5>
                            <ul class="list-unstyled">
                                <li>
                                    @if ($activity->document_name == null)
                                        <a href="" class="btn-link text-white">No file uploaded</a>
                                    @else
                                        @php
                                            $documentNames = explode(',', $activity->document_name);
                                        @endphp

                                        @foreach ($documentNames as $documentName)
                                            <a href="" class="btn-link text-white d-block">
                                                <i class="far fa-fw fa-file-word"></i> {{ $documentName }}
                                            </a>
                                        @endforeach
                                    @endif
                                </li>
                            </ul>
                            <div class="text-center mt-5 mb-3">
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#uploadFilesModal">
                                    <i class="fas fa-solid fa-plus mr-1"></i>Upload Files
                                </button>
                                <a href="{{ route('admin.event.index') }}" class="btn btn-sm btn-info text-white">Back to All Events</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
