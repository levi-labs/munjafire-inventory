@extends('layouts.main')
@section('content')
    <style>
        .my-pie {
            width: 100%;
            display: flex;
            justify-content: center;
        }

        .my-pie canvas {
            width: 65% !important;
            height: 65% !important;

            display: flex;
            justify-content: center;
        }
    </style>
    <!-- Widgets  -->
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="stat-widget-five">
                        <div class="stat-icon dib flat-color-1">
                            <i class="pe-7s-cash"></i>
                        </div>
                        <div class="stat-content">
                            <div class="text-left dib">
                                <div class="stat-text"><span class="count">{{ $count_stock_out }}</span></div>
                                <div class="stat-heading">Stock Out</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="stat-widget-five">
                        <div class="stat-icon dib flat-color-2">
                            <i class="pe-7s-cart"></i>
                        </div>
                        <div class="stat-content">
                            <div class="text-left dib">
                                <div class="stat-text"><span class="count">{{ $count_stock_in }}</span></div>
                                <div class="stat-heading">Stock In</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="stat-widget-five">
                        <div class="stat-icon dib flat-color-3">
                            <i class="pe-7s-browser"></i>
                        </div>
                        <div class="stat-content">
                            <div class="text-left dib">
                                <div class="stat-text"><span class="count">{{ $count_product }}</span></div>
                                <div class="stat-heading">Products</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="stat-widget-five">
                        <div class="stat-icon dib flat-color-4">
                            <i class="pe-7s-users"></i>
                        </div>
                        <div class="stat-content">
                            <div class="text-left dib">
                                <div class="stat-text"><span class="count">{{ $count_user }}</span></div>
                                <div class="stat-heading">Users</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Widgets -->
    <!--  Traffic  -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="box-title">Information</h4>
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="card-body">
                            <!-- <canvas id="TrafficChart"></canvas>   -->
                            <h4 class="mb-3">Data Products</h4>
                            <canvas id="products"></canvas>
                        </div>
                    </div>
                    {{-- <div class="col-lg-4">
                        <div class="card-body">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>EOQ</th>
                                        <th>ROP</th>
                                        <th>SS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>data1</td>
                                        <td>data1</td>
                                        <td>data1</td>
                                        <td>data1</td>
                                    </tr>
                                    <tr>
                                        <td>data1</td>
                                        <td>data1</td>
                                        <td>data1</td>
                                        <td>data1</td>
                                    </tr>
                                    <tr>
                                        <td>data1</td>
                                        <td>data1</td>
                                        <td>data1</td>
                                        <td>data1</td>
                                    </tr>
                                    <tr>
                                        <td>data1</td>
                                        <td>data1</td>
                                        <td>data1</td>
                                        <td>data1</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div> --}}
                </div> <!-- /.row -->
                <div class="card-body"></div>
            </div>
        </div><!-- /# column -->
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="box-title">Information</h4>
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="card-body text-center">
                            <!-- <canvas id="TrafficChart"></canvas>   -->
                            <h4 class="mb-3">Stock In</h4>
                            <div class="my-pie">
                                <canvas id="stockin"></canvas>
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card-body text-center">
                            <!-- <canvas id="TrafficChart"></canvas>   -->
                            <h4 class="mb-3">Stock Out</h4>
                            <div class="my-pie">
                                <canvas width=200 height="200" id="stockout"></canvas>
                            </div>

                        </div>
                    </div>

                </div> <!-- /.row -->
                <div class="card-body"></div>
            </div>
        </div><!-- /# column -->
    </div>
    <!--  /Traffic -->
    <div class="clearfix"></div>
    <!-- Orders -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>

    <script>
        // Chart.register(ChartDataLabels); // global plugin

        const stock_in = document.getElementById('stockin');

        const hoverstockInSum = {!! json_encode($stock_in->pluck('total_quantity')) !!}
        const hoverstockInCount = {!! json_encode($stock_in->pluck('total_product')) !!}

        new Chart(stock_in, {
            type: 'pie',
            data: {
                labels: {!! json_encode($stock_in->pluck('name')->toArray()) !!},
                datasets: [{
                    label: 'Stock In',
                    data: {!! json_encode($stock_in->pluck('total_product')->toArray()) !!},
                    backgroundColor: {!! json_encode($colors) !!},
                    borderWidth: 1
                }]
            },
            options: {
                plugins: {
                    datalabels: {
                        color: '#black',
                        formatter: (value, ctx) => {
                            const index = ctx.dataIndex;
                            const quantity = hoverstockInCount[index];
                            return quantity + 'x';
                        },
                        font: {
                            weight: 'bold',
                            size: 14
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const index = context.dataIndex;
                                const count = hoverstockInCount[index];
                                const sum = hoverstockInSum[index];
                                const label = context.label || '';
                                return `${label}:\nCount: ${count}, Quantity: ${sum}`;
                            }
                        }
                    }
                }
            },
            plugins: [ChartDataLabels]
        });
        const stock_out = document.getElementById('stockout');
        const hoverstockOutSum = {!! json_encode($stock_out->pluck('total_quantity')) !!}
        const hoverstockOutCount = {!! json_encode($stock_out->pluck('total_product')) !!}
        new Chart(stock_out, {
            type: 'pie',
            data: {
                labels: {!! json_encode($stock_out->pluck('name')->toArray()) !!},
                datasets: [{
                    label: 'Stock Of Product',
                    data: {!! json_encode($stock_out->pluck('total_product')->toArray()) !!},
                    backgroundColor: {!! json_encode($colors) !!},
                    borderWidth: 1
                }]
            },
            options: {
                plugins: {
                    datalabels: {
                        color: 'black',
                        formatter: (value, ctx) => {
                            const index = ctx.dataIndex;
                            const quantity = hoverstockOutCount[index];
                            return quantity + 'x';
                        },
                        font: {
                            weight: 'bold',
                            size: 14
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const index_out = context.dataIndex;
                                const count_out = hoverstockOutCount[index_out];
                                const sum_out = hoverstockOutSum[index_out];
                                const label_out = context.label || '';
                                return `${label_out}:\nCount: ${count_out}, Quantity: ${sum_out}`;
                            }
                        }
                    }
                }
            },
            plugins: [ChartDataLabels]
        });
        const product = document.getElementById('products');
        new Chart(product, {
            type: 'bar',
            data: {
                labels: {!! json_encode($products->pluck('name')->toArray()) !!},
                datasets: [{
                    label: 'Stock Of Product',
                    data: {!! json_encode($products->pluck('stock')->toArray()) !!},
                    backgroundColor: {!! json_encode($colors) !!},
                    borderWidth: 1
                }]
            },
            options: {
                datalabels: {
                    color: 'black',
                    formatter: (value, ctx) => {
                        return value + ' Stock';
                    },
                    font: {
                        weight: 'bold',
                        size: 14
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            },
            plugins: [ChartDataLabels]
        });
    </script>
@endsection
