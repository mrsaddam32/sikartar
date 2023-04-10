@extends('dashboard.layouts.main')

@section('container')
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>List of Users</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0 yajra-datatables">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Email</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Roles</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Account Since</th>
                                        <th class="text-secondary opacity-7">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<style>
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        border-radius: 0.25rem !important;
        background-color: #ebebeb !important;
        border: none !important;
        padding: 0.5rem 1rem !important;
        margin-right: 0.25rem !important;
        color: #0d6efd !important;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        background-color: #0d6efd !important;
        color: #fff !important;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background-color: #0d6efd !important;
        color: #fff !important;
    }

    .dataTables_wrapper .dataTables_length select {
        border-radius: 0.25rem !important;
        background-color: #ebebeb !important;
        border: none !important;
        padding: 0.5rem 1rem !important;
        margin-right: 0.25rem !important;
        color: #0d6efd !important;
    }

    .dataTables_wrapper .dataTables_filter input {
        border-radius: 0.25rem !important;
        background-color: #ebebeb !important;
        border: none !important;
        padding: 0.5rem 1rem !important;
        margin-right: 0.25rem !important;
        color: #0d6efd !important;
    }

    .dataTables_wrapper .dataTables_filter input:focus {
        background-color: #fff !important;
    }
</style>
<!-- jQuery library -->
<script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
<!-- Bootstrap JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.1/js/bootstrap.min.js"></script>
<!-- DataTables JavaScript -->
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<!-- DataTables Bootstrap JavaScript -->
<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
<!-- MomentJS library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<!-- DataTables MomentJS plugin -->
<script src="https://cdn.datatables.net/plug-ins/1.11.3/dataRender/datetime.js"></script>
<script type="text/javascript">
    $(function () {
        var table = $('.yajra-datatables').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('users.index') }}",
            columns: [
                {data: 'name', name: 'name',render: function (data, type, row) {
                    let imgSrc = row.photo_path ? row.photo_path : 'https://ui-avatars.com/api/?name=' + row.name + '&background=random';
                    return `
                        <div class="d-flex px-2 py-1">
                            <div>
                                <img src="${imgSrc}" class="avatar avatar-sm me-3" alt="${row.name}">
                            </div>
                            <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm">${row.name}</h6>
                                <p class="text-xs text-secondary mb-0">${row.email}</p>
                            </div>
                        </div>
                        `;
                }},
                {data: 'email', name: 'email'},
                {data: 'role', name: 'role'},
                {data: 'created_at', name: 'created_at'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
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
    });
</script>
@endsection