@extends('templates.master')

@section('content')
    <div class="section-header">
        <h1>Sales Report</h1>
        <div class="section-header-breadcrumb">
            <a href="{{ url()->previous() }}" class="btn btn-primary"><i class="fas fa-chevron-left"></i> Back</a>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-md">
                            <tr>
                                <th>Issued Date</th>
                                <th>Invoice</th>
                                <th>Issued For</th>
                                <th>Product</th>
                                <th>Price (Rp)</th>
                                <th>Quantity</th>
                                <th>Courier</th>
                                <th>Grand Total (Rp)</th>
                            </tr>
                            @foreach ($orders as $ord)
                                <tr>
                                    <td>{{ date('d-m-Y', strtotime($ord->created_at)) }}</td>
                                    <td>{{ $ord->invoices->invoice }}</td>
                                    <td>{{ $ord->invoices->name }}</td>
                                    <td>{{ $ord->warehouses->name }}</td>
                                    <td>{{ number_format($ord->warehouses->price, 2, ',', '.') }}</td>
                                    <td>{{ $ord->quantity }}</td>
                                    <td>{{ Str::upper($ord->invoices->courier) }}</td>
                                    <td>{{ number_format($ord->price, 2, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <nav class="d-inline-block">
                        <ul class="pagination mb-0">
                            {{ $orders->links() }}
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection