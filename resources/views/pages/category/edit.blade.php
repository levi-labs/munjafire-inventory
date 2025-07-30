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
                    <form action="{{ route('categories.update', $category->id) }}" method="post" class="form-horizontal">
                        @method('PUT')
                        @csrf
                        <div class="row form-group">
                            <div class="col col-md-3"><label for="name" class=" form-control-label">Category
                                    Name</label>
                            </div>
                            <div class="col-12 col-md-9"><input type="text" id="name" name="name"
                                    placeholder="Category Name" class="form-control"
                                    value="{{ old('name') ?? $category->name }}">
                                @error('name')
                                    <small class="form-text text-danger">{{ $message }}</small>
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
