@extends('dashboard.layouts.main')

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
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <table id="yajra-datatables" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Roles</th>
                      <th>Account Since</th>
                      <th>Action</th>
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
        <!-- Modal -->
        <div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="userModalLabel">Edit User</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                      <div class="container">
                        <div class="row">
                          <div class="col-lg-4">
                            <!-- Profile Image -->
                            <div class="card card-primary card-outline">
                              <div class="card-body box-profile">
                                <div class="text-center">
                                  {{-- @if($user->photo_path)
                                  <img class="profile-user-img img-fluid img-circle border-primary"
                                      src="{{ asset($user->photo_path) }}"
                                      alt="{{ $user->name }}">
                                  @else
                                  <img class="profile-user-img img-fluid img-circle"
                                      src="{{ asset('dist/img/user4-128x128.jpg') }}"
                                      alt="{{ $user->name }}">
                                      @endif --}}
                                    <img class="profile-user-img img-fluid img-circle"
                                          src="{{ asset('dist/img/user4-128x128.jpg') }}">
                                </div>
                                <h3 class="profile-username text-center" id="user-name"></h3>
                                <ul class="list-group list-group-unbordered mb-3">
                                  <li class="list-group-item">
                                    <b>Email</b> <span class="float-right" id="user-email"></span>
                                  </li>
                                  <li class="list-group-item">
                                    <b>Account Since</b> <span class="float-right" id="user-created-at"></span>
                                  </li>
                                </ul>
                                <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
                              </div>
                              <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                          </div>
                          <div class="col-lg-8">
                            <form action="#" method="POST">
                              @csrf
                              @method('PATCH')
                              <input type="hidden" name="id" id="id">
                              <div class="form-group mb-3">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name">
                              </div>
                              <div class="form-group mb-3">
                                <label for="email">Email address</label>
                                <input type="email" class="form-control" id="email" name="email">
                              </div>
                              <div class="form-group mb-3">
                                <label for="role">Role</label>
                                <select class="form-control" id="role" name="role"></select>
                              </div>
                              <button type="submit" class="btn btn-primary">Save</button>
                            </form>
                          </div>
                        </div>
                      </div>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
              </div>
          </div>
      </div>      
      </section>
      <!-- /.content -->
  </div>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
<script type="text/javascript">
    $(function () {
        var table = $('#yajra-datatables').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('users.index') }}",
            columns: [
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'role', name: 'role'},
                {data: 'created_at', name: 'created_at'},
                {data: 'action', name: 'action', orderable: false, searchable: false,}
            ],
            columnDefs: [
                {
                    targets: 2,
                    className: 'text-center'
                },
                {
                    targets: 3,
                    className: 'text-center',
                    render: function (data, type, row) {
                        return moment(data).format('DD MMMM YYYY');
                    }
                },
                {
                    targets: 4,
                    className: 'text-center'
                }
            ]
        });

        $('#yajra-datatables').on('click', '.btn-detail', function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            $.ajax({
                url: "{{ route('users.index') }}" + '/detail/' + id,
                type: "GET",
                dataType: "JSON",
                success: function (data) {
                    $('#id').val(data.id);
                    $('#user-name').text(data.name);
                    $('#user-email').text(data.email);
                    $('#user-created-at').text(moment(data.created_at).format('DD MMMM YYYY'));
                    $('#userModal').modal('show');
                },
                error: function () {
                    alert("Nothing Data");
                }
            });
        });

        // Menangkap data user dari card profile dan mengisi ke form input
        $('#userModal').on('show.bs.modal', function (event) {
            let roles = [
              {id: 1, name: 'admin'},
              {id: 2, name: 'user'},
            ];

            let role_id = 2;

            let select = $('#role');
            $.each(roles, function(index, role) {
                select.append($('<option></option>').val(role.id).text(role.name));
            });

            // Memilih option yang memiliki value sama dengan role_id
            select.val(role_id);

            // Memberikan class selected pada option yang dipilih
            select.find('option[value="' + role_id + '"]').addClass('selected');

            $('#name').val($('#user-name').text());
            $('#email').val($('#user-email').text());
        });
    });
</script>
@endsection