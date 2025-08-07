@extends('print.main')
@section('print-content')
    <hr>
    {{-- <h3 class="text-center">{{ $periode }}</h3> --}}
    <button class="btn-print" onclick="window.print()"> 🖨️ print </button>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th rowspan="2">NO</th>
                <th rowspan="2">NAME</th>
                <th colspan="4" class="text-center">EOQ RESULT</th>
                <th colspan="3" class="text-center">STOCK OUT</th>
                <th rowspan="2" class="text-center">Periode</th>
            </tr>
            <tr>
                <th>EOQ</th>
                <th>ROP</th>
                <th>SS</th>
                <th>FREQ</th>
                <th>Max</th>
                <th>Average</th>
                <th>Total Demand</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($results as $item)
                @php
                    $dateNow = \Carbon\Carbon::parse($item->date);
                    $start = $dateNow->copy()->subMonths(5)->startOfMonth();
                @endphp
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td class="text-item">{{ $item->product->name }}</td>
                    <td class="text-item">{{ $item->eoq }}</td>
                    <td class="text-item">{{ $item->reorder_point }}</td>
                    <td class="text-item">{{ $item->safety_stock }}</td>
                    <td class="text-item">{{ $item->frequency }}</td>
                    <td class="text-item">{{ $item->max }}</td>
                    <td class="text-item">{{ $item->average }}</td>
                    <td class="text-item">{{ $item->total_demand }}</td>
                    <td class="text-item">{{ $start->format('Y-F') . ' - ' . $dateNow->format('Y-F') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
