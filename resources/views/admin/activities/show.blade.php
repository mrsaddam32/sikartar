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
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Projects Detail</h3>
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
                                        <span class="info-box-text text-center text-muted">Estimated project duration</span>
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
                        <div class="row">
                            <div class="col-12">
                                <h4>Recent Activity</h4>
                                <div class="post">
                                    <div class="user-block">
                                        <img class="img-circle img-bordered-sm" src="../../dist/img/user1-128x128.jpg" alt="user image">
                                        <span class="username">
                                            <a href="#">Jonathan Burke Jr.</a>
                                        </span>
                                        <span class="description">Shared publicly - 7:45 PM today</span>
                                    </div>
                                    <p>
                                    Lorem ipsum represents a long-held tradition for designers,
                                    typographers and the like. Some people hate it and argue for
                                    its demise, but others ignore.
                                    </p>
                                    <p>
                                    </p>
                                </div>
                            </div>
                        </div>
                        </div>
                        <div class="col-12 col-md-12 col-lg-4 order-1 order-md-2">
                            <h3 class="text-primary"><i class="fas fa-paint-brush"></i> {{ $activity->activity_name }}</h3>
                            <p class="text-muted">{{ $activity->activity_description }}</p>
                            <br>
                            <div class="text-muted">
                                <p class="text-sm">Project Location
                                <b class="d-block">{{ $activity->activity_location }}</b>
                                </p>
                                <p class="text-sm">Project Leader
                                <b class="d-block">{{ $activity->responsible_person }}</b>
                                </p>
                                <p class="text-sm">Project Status
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
                            <h5 class="mt-5 text-muted">Project files</h5>
                            <ul class="list-unstyled">
                                <li>
                                    <a href="" class="btn-link text-white"><i class="far fa-fw fa-file-word"></i> Functional-requirements.docx</a>
                                </li>
                                <li>
                                    <a href="" class="btn-link text-white"><i class="far fa-fw fa-file-pdf"></i> UAT.pdf</a>
                                </li>
                                <li>
                                    <a href="" class="btn-link text-white"><i class="far fa-fw fa-envelope"></i> Email-from-flatbal.mln</a>
                                </li>
                                <li>
                                    <a href="" class="btn-link text-white"><i class="far fa-fw fa-image "></i> Logo.png</a>
                                </li>
                                <li>
                                    <a href="" class="btn-link text-white"><i class="far fa-fw fa-file-word"></i> Contract-10_12_2014.docx</a>
                                </li>
                            </ul>
                            <div class="text-center mt-5 mb-3">
                                <a href="#" class="btn btn-sm btn-primary">Add files</a>
                                <a href="{{ route('admin.activity.index') }}" class="btn btn-sm btn-info text-white">Back to list Activity</a>
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
@endsection
