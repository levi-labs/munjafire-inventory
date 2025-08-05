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
                    <strong class="card-title">Result EOQ</strong>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Product Name: {{ $eoqResult->product->name }}</h5>
                            <hr>
                            {{-- <h5>Supplier: {{ $stockOut->supplier->name }}</h5> --}}
                        </div>
                        <div class="col-md-6 text-right">
                            <a href="{{ route('eoq_result.index') }}" class="btn btn-secondary btn-sm">Back to List</a>
                        </div>
                    </div>

                    <table class="table table-bordered mt-3">
                        <tr>
                            <th>Total Demand</th>
                            <td>{{ $eoqResult->total_demand }}</td>
                            <th>EOQ</th>
                            <td>{{ $eoqResult->eoq }}</td>
                        </tr>
                        <tr>
                            <th>Max</th>
                            <td>{{ $eoqResult->max }}</td>
                            <th>ROP</th>
                            <td>{{ $eoqResult->reorder_point }}</td>
                        </tr>
                        <tr>
                            <th>Average</th>
                            <td>{{ $eoqResult->average }}</td>
                            <th>Safety Stock</th>
                            <td>{{ $eoqResult->safety_stock }}</td>
                        </tr>
                        <tr>
                            <th>Date In</th>
                            <td>{{ $eoqResult->date }}</td>
                            <th>Frequency</th>
                            <td>{{ $eoqResult->frequency }}</td>
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
                    <strong class="card-title">Detail Data </strong>
                </div>
                <div class="card-body">
                    <table class="table table-bordered mt-3">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Sub Total</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($stock_outs as $stock)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $stock->quantity }}</td>
                                    <td>{{ formatRupiah($stock->price) }}</td>
                                    <td>{{ formatRupiah($stock->price * $stock->quantity) }}</td>
                                    <td>{{ $stock->date }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td>No Data!</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
