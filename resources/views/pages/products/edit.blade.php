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
                    <form action="{{ route('products.update', $product->id) }}" method="post" class="form-horizontal">
                        @method('PUT')
                        @csrf
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="name" class=" form-control-label">
                                    Product Name
                                </label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text" id="name" name="name" placeholder="Name" class="form-control"
                                    value="{{ old('name') ?? $product->name }}">
                                @error('name')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="price" class=" form-control-label">
                                    Price
                                </label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="number" min="0" id="price" name="price" placeholder="0"
                                    class="form-control" value="{{ old('price') ?? formatNumber($product->price) }}">
                                @error('price')
                                    <small class="help-block form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="stock" class=" form-control-label">
                                    Stock
                                </label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="number" min="0" id="stock" name="stock" placeholder="0"
                                    class="form-control" value="{{ old('stock') ?? $product->stock }}">
                                @error('stock')
                                    <small class="help-block form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="category" class=" form-control-label">Select Category</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <select name="category_id" id="category" class="form-control">
                                    <option selected disabled>Please select</option>
                                    @forelse ($categories as $category)
                                        <option {{ $product->category_id == $category->id ? 'selected' : '' }}
                                            value="{{ $category->id }}">{{ $category->name }}</option>
                                    @empty
                                        <option disabled>No categories available</option>
                                    @endforelse
                                </select>
                                @error('category_id')
                                    <small class="help-block form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="description" class=" form-control-label">Description</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <textarea name="description" id="description" rows="4" placeholder="Description" class="form-control">{{ $product->description }}</textarea>
                                @error('description')
                                    <small class="help-block form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <a href="{{ route('products.index') }}" class="btn btn-secondary btn-sm">
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
