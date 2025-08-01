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
                    <form action="{{ route('stock_out.update', $stockOut->id) }}" method="post" class="form-horizontal">
                        @method('PUT')
                        @csrf
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="price" class=" form-control-label">
                                    Selling Price
                                </label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="number" min="0" id="price" name="price" placeholder="0"
                                    class="form-control" value="{{ old('price', $stockOut->price) }}">
                                @error('price')
                                    <small class="help-block form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="quantity" class=" form-control-label">
                                    Quantity
                                </label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="number" min="0" id="quantity" name="quantity" placeholder="0"
                                    class="form-control" value="{{ old('quantity', $stockOut->quantity) }}">
                                @error('quantity')
                                    <small class="help-block form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="date" class=" form-control-label">
                                    Date In
                                </label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="date" id="date" name="date" class="form-control"
                                    value="{{ old('date', $stockOut->date) }}">
                                @error('date')
                                    <small class="help-block form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="product" class=" form-control-label">Product</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <select name="product_id" id="product" class="form-control">
                                    <option selected disabled>Please select</option>
                                    @forelse ($products as $product)
                                        <option {{ $product->id == $stockOut->product_id ? 'selected' : '' }}
                                            value="{{ $product->id }}">{{ $product->name }}</option>
                                    @empty
                                        <option disabled>No products available</option>
                                    @endforelse
                                </select>
                                @error('product_id')
                                    <small class="help-block form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="description" class=" form-control-label">Description</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <textarea name="description" id="description" rows="4" placeholder="Description" class="form-control">{{ $stockOut->description }}</textarea>
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
