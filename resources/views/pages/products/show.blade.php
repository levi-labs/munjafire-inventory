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
                <div class="card-header bg-munja">
                    <strong class="card-title">Detail Product</strong>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Product Name: {{ $product->name }}</h5>
                            <hr>
                            {{-- <h5>Supplier: {{ $stockOut->supplier->name }}</h5> --}}
                        </div>
                        <div class="col-md-6 text-right">
                            <a href="{{ route('products.index') }}" class="btn btn-secondary btn-sm">Back to List</a>
                        </div>
                    </div>

                    <table class="table table-bordered mt-3">
                        <tr>
                            <th>Stock</th>
                            <td>{{ $product->stock }}</td>
                            <th>Total Demand</th>
                            <td>{{ $eoq->total_demand ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Price</th>
                            <td>{{ formatRupiah($product->price) }}</td>
                            <th>EOQ</th>
                            <td>{{ $eoq->eoq ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Category</th>
                            <td>{{ $product->category->name }}</td>
                            <th>ROP</th>
                            <td>{{ $eoq->reorder_point ?? '-' }}</td>
                        </tr>
                        @php
                            $dateNow = \Carbon\Carbon::parse($eoq->date);
                            $start = $dateNow->copy()->subMonths(5)->startOfMonth();
                        @endphp
                        <tr>
                            <th>Periode</th>
                            <td>{{ $start->format('Y-F') . ' - ' . $dateNow->format('Y-F') ?? '-' }}</td>
                            <th>Safety Stock</th>
                            <td>{{ $eoq->safety_stock ?? '-' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
