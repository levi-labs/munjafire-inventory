@extends('layouts.main')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card p-2">
                <h4 class="card-title my-2">{{ $title . ' Page' }} </h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-indigo">
                    <strong class="card-title">Stock Out</strong>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Product Name: {{ $stockOut->product->name }}</h5>
                            <hr>
                            {{-- <h5>Supplier: {{ $stockOut->supplier->name }}</h5> --}}
                        </div>
                        <div class="col-md-6 text-right">
                            <a href="{{ route('stock_out.index') }}" class="btn btn-secondary btn-sm">Back to List</a>
                        </div>
                    </div>

                    <table class="table table-bordered mt-3">
                        <tr>
                            <th>Purchase Price</th>
                            <td>{{ $stockOut->price }}</td>
                        </tr>
                        <tr>
                            <th>Quantity</th>
                            <td>{{ $stockOut->quantity }}</td>
                        </tr>
                        <tr>
                            <th>Date In</th>
                            <td>{{ $stockOut->date }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-indigo">
                    <strong class="card-title">Detail Product </strong>
                </div>
                <div class="card-body">
                    <table class="table table-bordered mt-3">
                        <tr>
                            <th>Price</th>
                            <td>{{ $stockOut->product->price }}</td>
                        </tr>
                        <tr>
                            <th>Stock</th>
                            <td>{{ $stockOut->product->stock }}</td>
                        </tr>
                        <tr>
                            <th>Description</th>
                            <td>{{ $stockOut->description }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
