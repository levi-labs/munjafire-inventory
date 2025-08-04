@extends('print.main')
@section('print-content')
    <hr>
    <div class="main-content">
        <h3 class="text-center">{{ $periode }}</h3>
        <button class="btn-print" onclick="window.print()"> 🖨️ print </button>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td class="text-item">{{ $item->product_name }}</td>
                        <td class="text-item">{{ formatRupiah($item->price) }}</td>
                        <td class="text-item">{{ $item->quantity }}</td>
                        <td class="text-item">{{ $item->date }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
