@extends('layouts.main')
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
                    <form action="{{ route('report_stock_in.store') }}" method="post" class="form-horizontal"
                        target="_blank">
                        @csrf
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="from" class=" form-control-label">
                                    From
                                </label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="date" id="from" name="from" class="form-control">
                                @error('from')
                                    <small class="help-block form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="from" class=" form-control-label">
                                    To
                                </label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="date" id="to" name="to" class="form-control">
                                @error('to')
                                    <small class="help-block form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <a href="{{ route('report_stock_in.index') }}" class="btn btn-secondary btn-sm">
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
@endsection
