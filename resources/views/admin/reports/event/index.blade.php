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
      <form id="report_form" method="POST">
        @csrf
        <div class="row">
          <div class="col-lg-6">
              <div class="card card-secondary">
                  <div class="card-header">
                      <h3 class="card-title">
                          Get Event By Month & Year
                      </h3>
                  </div>
                  <div class="card-body">
                      <div class="form-group">
                          <label>From</label>
                          <div class="input-group date" id="from_date" data-target-input="nearest">
                              <input type="text" class="form-control datetimepicker-input" data-target="#from_date" name="from_date" value="{{ old('from_date') }}" />
                              <div class="input-group-append" data-target="#from_date" data-toggle="datetimepicker">
                                  <div class="input-group-text">
                                      <i class="fa fa-calendar"></i>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="form-group">
                          <label>To</label>
                          <div class="input-group date" id="to_date" data-target-input="nearest">
                              <input type="text" class="form-control datetimepicker-input" data-target="#to_date" name="to_date" value="{{ old('to_date') }}" />
                              <div class="input-group-append" data-target="#to_date" data-toggle="datetimepicker">
                                  <div class="input-group-text">
                                      <i class="fa fa-calendar"></i>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <button class="btn btn-outline-danger mr-2" type="submit" name="export" value="export"><i class="fas fa-file-pdf"></i> Export</button>
                      <button class="btn btn-outline-warning mr-2" type="submit" name="preview" value="preview"><i class="fas fa-eye"></i> Preview</button>
                    </div>
              </div>
          </div>
        </div>
      </form>
    </div>
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

      // Datepicker initialization
      $('#from_date').datetimepicker({
          format: 'MM/YYYY',
          useCurrent: false,
          timeZone: 'Asia/Jakarta'
      });

      $('#to_date').datetimepicker({
          format: 'MM/YYYY',
          useCurrent: false,
          timeZone: 'Asia/Jakarta'
      });
  });
</script>
<script>
  document.addEventListener("DOMContentLoaded", function () {
      const form = document.getElementById("report_form");

      form.addEventListener("submit", function (event) {
          const submitAction = event.submitter.getAttribute("name");
          if (submitAction === "export") {
              form.action = "{{ route('admin.report.print_event_report') }}";
          } else if (submitAction === "preview") {
              form.action = "{{ route('admin.report.preview_pdf') }}";
          }
      });
  });
</script>
@endsection