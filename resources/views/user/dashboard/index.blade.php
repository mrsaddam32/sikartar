@extends('templates.layouts.main')

@section('container')  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard User</h1>
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
            <!-- fix for small devices only -->
            <div class="clearfix hidden-md-up"></div>
            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-solid fa-list"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Total Events</span>
                  <span class="info-box-number">{{ $activities }}</span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-clock"></i></span>
                @isset($activity)
                  <div class="info-box-content">
                    <span class="info-box-text">In {{ $remainingDays }} Days</span>
                    <span class="info-box-number">{{ $activity->activity_name }}</span>
                  </div>
                @else
                  <div class="info-box-content">
                    <span class="info-box-text">No Activity</span>
                    <span class="info-box-number">No activity found.</span>
                  </div>
                @endisset
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
          </div>
        <!-- /.row -->
        <div class="row">
          <div class="col-lg-6">
            <div class="card card-info">
              <div class="card-body">
                <div class="chart">
                  <canvas id="myChart"></canvas>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="info-box mb-3 bg-info">
              <span class="info-box-icon"><i class="fas fa-list"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">On Progress Events</span>
                <span class="info-box-number">{{ $activityStatus['onProgressActivity'] }}</span>
              </div>
            </div>
            <div class="info-box mb-3 bg-success">
              <span class="info-box-icon"><i class="fas fa-list"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Completed Events</span>
                <span class="info-box-number">{{ $activityStatus['completedActivity'] }}</span>
              </div>
            </div>
            <div class="info-box mb-3 bg-warning">
              <span class="info-box-icon"><i class="fas fa-list"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Pending Events</span>
                <span class="info-box-number">{{ $activityStatus['pendingActivity'] }}</span>
              </div>
            </div>
          </div>
        </div>
      </div><!--/. container-fluid -->
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