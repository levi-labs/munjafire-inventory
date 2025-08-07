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
                    <strong class="card-title">Stock In</strong>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Product Name: {{ $stockIn->product->name }}</h5>
                            <hr>
                            <h5>Supplier: {{ $stockIn->supplier->name }}</h5>
                        </div>
                        <div class="col-md-6 text-right">
                            <a href="{{ route('stock_in.index') }}" class="btn btn-secondary btn-sm">Back to List</a>
                        </div>
                    </div>

                    <table class="table table-bordered mt-3">
                        <tr>
                            <th>Purchase Price</th>
                            <td>{{ formatRupiah($stockIn->price) }}</td>
                        </tr>
                        <tr>
                            <th>Quantity</th>
                            <td>{{ $stockIn->quantity }}</td>
                        </tr>
                        <tr>
                            <th>Date In</th>
                            <td>{{ $stockIn->date }}</td>
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
                            <td>{{ formatRupiah($stockIn->product->price) }}</td>
                        </tr>
                        <tr>
                            <th>Stock</th>
                            <td>{{ $stockIn->product->stock }}</td>
                        </tr>
                        <tr>
                            <th>Description</th>
                            <td>{{ $stockIn->description }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
