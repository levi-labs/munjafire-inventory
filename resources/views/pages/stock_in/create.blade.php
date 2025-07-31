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
                    <form action="{{ route('stock_in.store') }}" method="post" class="form-horizontal">
                        @csrf
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="price" class=" form-control-label">
                                    Purchase Price
                                </label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="number" min="0" id="price" name="price" placeholder="0"
                                    class="form-control">
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
                                    class="form-control">
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
                                <input type="date" id="date" name="date" class="form-control">
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
                                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                                    @empty
                                        <option disabled>No categories available</option>
                                    @endforelse
                                </select>
                                @error('product_id')
                                    <small class="help-block form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="supplier" class=" form-control-label">Supplier</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <select name="supplier_id" id="supplier" class="form-control">
                                    <option selected disabled>Please select</option>
                                    @forelse ($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                    @empty
                                        <option disabled>No categories available</option>
                                    @endforelse
                                </select>
                                @error('supplier_id')
                                    <small class="help-block form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="description" class=" form-control-label">Description</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <textarea name="description" id="description" rows="4" placeholder="Description" class="form-control"></textarea>
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
