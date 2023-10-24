@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin">
            @if (session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif

            <div class="me-md-3 me-xl-5">
                <h2>Dashboard,</h2>
                <p class="mb-md-0">Your analytics dashboard template.</p>
                <hr>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-chart-area me-1"></i>
                    Customer Address
                </div>
                <div class="card-body">
                    <canvas id="customerChart" width="100%" height="40"></canvas>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-chart-area me-1"></i>
                    Monthly Order
                </div>
                <div class="card-body">
                    <canvas id="productChart" width="100%" height="40"></canvas>
                </div>
            </div>
        </div>
        <div class="col-xl-12">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-chart-area me-1"></i>
                    Stock Product
                </div>
                <div class="card-body">
                    <canvas id="stockChart" width="400%" height="400"></canvas>
                </div>
            </div>
        </div>

    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script>
        var _ydata = JSON.parse('{!! json_encode($total) !!}');
        var _xdata = JSON.parse('{!! json_encode($address) !!}');
        var _ordydata = JSON.parse('{!! json_encode($totalord) !!}');
        var _ordxdata = JSON.parse('{!! json_encode($month) !!}');
        var _stockdata = JSON.parse('{!! json_encode($stock) !!}');
        var _productdata = JSON.parse('{!! json_encode($product) !!}');

    </script>
    <script src="{{ asset('admin/js/customerChart.js') }}"></script>
    <script src="{{ asset('admin/js/productChart.js') }}"></script>
    <script src="{{ asset('admin/js/stockChart.js') }}"></script>
@endsection
