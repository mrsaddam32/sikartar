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
      <div class="container-fluid">
        <!-- Info boxes -->
          <div class="row">
            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-dollar-sign"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Total Income</span>
                  <span class="info-box-number">
                    Rp. {{ number_format($totalIncome, 0, ',', '.') }}
                  </span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">New Members</span>
                  <span class="info-box-number num" data-val="{{ $users }}">000</span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-solid fa-list"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Total Activites (Kegiatan)</span>
                  <span class="info-box-number">{{ $activities }}</span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
              <div class="small-box bg-info">
                <div class="inner">
                  @isset($activity)
                    <h3>In {{ $remainingDays }} Days</h3>
                    <p>{{ $activity->activity_name }}</p>
                  @else
                    <h3>No Activity</h3>
                    <p>No activity found.</p>
                  @endisset
                </div>
                <div class="icon">
                  <i class="fas fa-list"></i>
                </div>
              </div>
            </div>            
          </div>
        <!-- /.row -->
      </div><!--/. container-fluid -->
      <div class="card card-info">
        <div class="card-body">
          <div class="chart">
            <canvas id="myChart" style="height: 30vh; max-width: 100%;"></canvas>
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    const ctx = document.getElementById('myChart');

    new Chart(ctx, {
      type: 'line',
      data: @json($data),
      options: {
        responsive: true,
        scales: {
          y: {
            beginAtZero: true,
            ticks: {
              callback: function(value, index, values) {
                return 'Rp. ' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
              },
              color: 'white'
            }
          },
          x: {
            ticks: {
              color: 'white'
            }
          },
        },
      }
    });
  </script>
@endsection