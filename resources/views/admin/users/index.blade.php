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
                                    <img class="profile-user-img img-fluid img-circle" src="" alt="User profile picture"
                                    id="user-photo">
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
                              </div>
                              <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                          </div>
                          <div class="col-lg-8">
                            <form id="user-form">
                              @csrf
                              @method('patch')
                              <input type="hidden" name="id" id="id">
                              <div class="form-group mb-3">
                                  <label for="name">Name</label>
                                  <input type="text" class="form-control" id="name" name="name">
                                  <span class="invalid-feedback"></span>
                                </div>
                                <div class="form-group mb-3">
                                  <label for="email">Email address</label>
                                  <input type="email" class="form-control" id="email" name="email">
                                  <span class="invalid-feedback"></span>
                                </div>
                                <div class="form-group mb-3">
                                  <label for="role">Role</label>
                                  <select class="form-control" id="role" name="role"></select>
                                  <span class="invalid-feedback"></span>
                              </div>
                              <button type="submit" class="btn btn-primary btn-update">Save</button>
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
<!-- Toastr -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript">
    $(function () {
        let table = $('#yajra-datatables').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: "{{ route('admin.users.index') }}",
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
            let id = $(this).data('id');
            $.ajax({
                url: "{{ route('admin.users.index') }}" + '/detail/' + id,
                type: "GET",
                dataType: "JSON",
                success: function (data) {
                    $('#id').val(data.id);
                    data.photo_path ? $('#user-photo').attr('src', '{{ asset('') }}' + data.photo_path) : $('#user-photo').attr('src', '{{ asset('dist/img/user4-128x128.jpg') }}');
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

        $('#user-form').on('submit', function (e) {
            e.preventDefault();
            let form = $(this);
            let id = $('#id').val();
            $.ajax({
                url: "{{ route('admin.users.update', ':id') }}".replace(':id', id),
                type: "POST",
                data: form.serialize(),
                dataType: "JSON",
                success: function (data) {
                    $('#userModal').modal('hide');
                    table.draw();
                    toastr.success(data.message, 'Success!');
                },
                error: function (data) {
                    let errors = data.responseJSON.errors;
                    $.each(errors, function (key, value) {
                        $('#' + key)
                            .closest('.form-group')
                            .find('.invalid-feedback')
                            .addClass('d-block')
                            .text(value);
                    });
                }
            });
        });
    });

    @if(Session::has('success'))
      toastr.success("{{ Session::get('success') }}");
    @endif
</script>
@endsection