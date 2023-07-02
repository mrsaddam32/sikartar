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
                    {{-- <a href="{{ route('admin.keuangan.create') }}" class="btn btn-info">
                        <i class="fas fa-solid fa-plus mr-1"></i>Add New Roles
                    </a> --}}
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModal">
                        <i class="fas fa-solid fa-plus mr-1"></i>
                        Add New Roles
                    </button> 
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add New Roles</h1>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin.roles.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="role_id">Role Id</label>
                                <input type="number" class="form-control" id="role_id" name="role_id">
                            </div>
                            <div class="form-group">
                                <label for="role_name">Role Name</label>
                                <input type="text" class="form-control" id="role_name" name="role_name">
                            </div>
                            <div class="form-group">
                                <label for="role_description">Role Description</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="role_description"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
                </div>
            </div>
          </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                <div class="card">
                    <div class="card-body">
                    <table id="yajra-datatables" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Role Name</th>
                            <th>Role Description</th>
                            <th>Created At</th>
                        </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
      <!-- /.content -->
  </div>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
<script type="text/javascript">
    $(document).ready(function() {
        var table = $('#yajra-datatables').DataTable({
            searching: false,
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.roles.index') }}",
            columns: [
                {data: 'role_name', name: 'role_name'},
                {data: 'role_description', name: 'role_description'},
                {data: 'created_at', name: 'created_at'},
            ]
        });

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