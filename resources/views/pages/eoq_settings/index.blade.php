@extends('layouts.main')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <strong class="card-title">{{ $title }}</strong>
                    @if (session('success'))
                        <div class="mt-2 sufee-alert alert with-close alert-success alert-dismissible fade show">
                            <span class="badge badge-pill badge-success">Success</span>
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                    @elseif(session('error'))
                        <div class="mt-2 sufee-alert alert with-close alert-danger alert-dismissible fade show">
                            <span class="badge badge-pill badge-danger">Error</span>
                            {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                    @endif
                    <div class="row mt-2">
                        @php
                            $count = $eoqSettings->count();
                        @endphp
                        <div class="col-md-6">
                            @if ($count < 1)
                                <a href="{{ route('eoq_settings.create') }}" class="btn btn-primary btn-sm">Add EOQ</a>
                            @endif

                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table id="bootstrap-data-table" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Ordering Cost</th>
                                <th>Storage Cost</th>
                                <th>Lead Time</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($eoqSettings as $eoq)
                                <tr>
                                    <td>{{ $eoq->ordering_cost }}</td>
                                    <td>{{ $eoq->storage_cost }}</td>
                                    <td>{{ $eoq->lead_time }}</td>
                                    <td>
                                        {{-- <a href="{{ route('suppliers.edit', 1) }}" class="btn btn-info btn-sm">Detail</a> --}}
                                        <a href="{{ route('eoq_settings.edit', $eoq->id) }}"
                                            class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('eoq_settings.destroy', $eoq->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Deleting this value may also delete related data. Are you sure?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('datatables')
    <script src="assets/js/lib/data-table/datatables.min.js"></script>
    <script src="assets/js/lib/data-table/dataTables.bootstrap.min.js"></script>
    <script src="assets/js/lib/data-table/dataTables.buttons.min.js"></script>
    <script src="assets/js/lib/data-table/buttons.bootstrap.min.js"></script>
    <script src="assets/js/lib/data-table/jszip.min.js"></script>
    <script src="assets/js/lib/data-table/vfs_fonts.js"></script>
    <script src="assets/js/lib/data-table/buttons.html5.min.js"></script>
    <script src="assets/js/lib/data-table/buttons.print.min.js"></script>
    <script src="assets/js/lib/data-table/buttons.colVis.min.js"></script>
    <script src="assets/js/init/datatables-init.js"></script>


    <script type="text/javascript">
        $(document).ready(function() {
            $('#bootstrap-data-table-export').DataTable();
        });
    </script>
@endpush
