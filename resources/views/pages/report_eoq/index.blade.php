@extends('layouts.main')
@push('select2')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <strong class="card-title">{{ $title . ' Page' }} </strong>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-munja">
                    <strong>Form {{ $title }}</strong>
                </div>
                <div class="card-body">
                    <form action="{{ route('report_eoq.store') }}" method="post" class="form-horizontal" target="_blank">
                        @csrf
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="from" class=" form-control-label">
                                    Select Periode
                                </label>
                            </div>
                            <style>
                                /* Tampilan normal (belum diklik) */
                                .select2-container--default .select2-selection--multiple {
                                    padding: 5px !important;
                                    border-radius: 6px;
                                    border: 1px solid #ccc;
                                    background-color: #fff;
                                    min-height: 38px;
                                    /* Menyamakan tinggi dengan form-control */
                                }

                                /* Saat select dalam keadaan aktif/focus (diklik) */
                                .select2-container--default.select2-container--focus .select2-selection--multiple {
                                    padding: 5px !important;
                                    border-color: #86b7fe;
                                    box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
                                    /* seperti Bootstrap */
                                }

                                /* Styling teks dan item yang dipilih */
                                .select2-container--default .select2-selection--multiple .select2-selection__choice {
                                    background-color: #4180ff;
                                    border: none;
                                    color: white;
                                }

                                select.s-example-basic-multiple.form-control {
                                    padding: 10px !important;
                                }
                            </style>
                            <div class="col-12 col-md-9">
                                <select class="js-example-basic-multiple form-control" name="periodes[]"
                                    multiple="multiple">
                                    @forelse ($eoq_periodes as $item)
                                        <option value="{{ $item }}">{{ $item }}</option>
                                    @empty
                                        <option selected disabled>No Data</option>
                                    @endforelse
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <a href="{{ route('report_eoq.index') }}" class="btn btn-secondary btn-sm">
                                    <i class="fa fa-ban"></i> Cancel
                                </a>
                                <button type="submit" class="btn btn-primary btn-sm">
                                    <i class="fa fa-dot-circle-o"></i> Submit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    @push('script2')
        <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script>
            $(document).ready(function() {
                $('.js-example-basic-multiple').select2({
                    placeholder: "Select Periode",
                    allowClear: true
                });

            });
        </script>
    @endpush
@endsection
