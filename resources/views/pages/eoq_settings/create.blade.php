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
                <div class="card-header">
                    <strong>Form {{ $title }}</strong>
                </div>
                <div class="card-body">
                    <form action="{{ route('eoq_settings.store') }}" method="post" class="form-horizontal">
                        @csrf
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="ordering-cost" class=" form-control-label">
                                    Ordering Cost
                                </label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="number" id="ordering-cost" name="ordering_cost" placeholder="5000"
                                    class="form-control">
                                @error('ordering_cost')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="storage-cost" class=" form-control-label">
                                    Storage Cost
                                </label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="number" id="storage-cost" name="storage_cost" placeholder="5000"
                                    class="form-control">
                                @error('storage_cost')
                                    <small class="help-block form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="lead-time" class=" form-control-label">
                                    Lead Time
                                </label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="number" id="lead-time" name="lead_time" placeholder="5" class="form-control">
                                @error('lead_time')
                                    <small class="help-block form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <a href="{{ route('suppliers.index') }}" class="btn btn-secondary btn-sm">
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
