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
        <form action="{{ route('admin.keuangan.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">General</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="sumber_dana">Sumber Dana</label>
                                <input type="text" id="sumber_dana" name="sumber_dana" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="jumlah_nominal">Nominal</label>
                                <input type="number" id="jumlah_nominal" name="jumlah_nominal" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Tanggal Pemasukkan</label>
                                <div class="input-group date" id="tanggal_pemasukkan" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" data-target="#tanggal_pemasukkan" name="tanggal_pemasukkan" />
                                    <div class="input-group-append" data-target="#tanggal_pemasukkan" data-toggle="datetimepicker">
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
                    <a href="{{ route('admin.keuangan.index') }}" class="btn btn-secondary mr-2 my-3">Cancel</a>
                    <button class="btn btn-info" type="submit">Add New Data</button>
                </div>
            </div>
        </form>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
<script>
    $(function () {
        $('#tanggal_pemasukkan').datetimepicker({
            format: 'L',
            useCurrent: false,
            timeZone: 'Asia/Jakarta'
        });
    })
</script>
@endsection
