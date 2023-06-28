@extends('templates.layouts.main')

@section('container')
<style>
    #keuangan-table {
        border: none;
    }

    .card {
        width: fit-content;
    }
</style>

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
                <a href="{{ route('admin.keuangan.create') }}" class="btn btn-info">
                    <i class="fas fa-solid fa-plus mr-1"></i>Input New Data
                </a>
            </div>
        </div>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content ml-2">
        @if ($funds->isEmpty())
            <p class="text-center p-4">There's no data.</p>
        @else
        <div class="card">
            <div class="card-body p-0">
                <table id="keuangan-table" class="table table-responsive table-borderless table-striped">
                    <thead class="text-center">
                        <tr>
                            <th>No.</th>
                            <th>Sumber Dana</th>
                            <th>Tanggal Pemasukan</th>
                            <th>Nominal</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($funds as $fund)
                        <tr class="text-center">
                            <td>{{ ($funds->currentPage() - 1) * $funds->perPage() + $loop->iteration }}</td>
                            <td>{{ $fund->sumber_dana }}</td>
                            <td>{{ $fund->tanggal_pemasukkan }}</td>
                            <td>Rp. {{ number_format($fund->jumlah_nominal, 0, ',', '.') }}</td>
                            <td>
                                <a href="#" class="btn btn-info btn-sm mr-1">
                                    <i class="fas fa-solid fa-eye mr-1"></i>View
                                </a>
                                <a href="#" class="btn btn-warning btn-sm mr-1">
                                    <i class="fas fa-solid fa-edit mr-1"></i>Edit
                                </a>
                                <form action="#" method="POST" class="d-inline">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger btn-sm mr-1" type="submit" onclick="return confirm('Are you sure?')">
                                        <i class="fas fa-solid fa-trash-alt mr-1"></i>Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td><strong>Total Pemasukkan:</strong></td>
                            <td></td>
                            <td></td>
                            <td class="text-center">Rp. {{ number_format($totalPemasukkan, 0, ',', '.') }}</td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
                {{ $funds->links() }}
            </div>
        </div>
        @endif
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.all.min.js" integrity="sha256-2Dbg51yxfa7qZ8CSKqsNxHtph8UHdgbzxXF9ANtyJHo=" crossorigin="anonymous"></script>
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
