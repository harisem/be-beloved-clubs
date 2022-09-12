@extends('templates.master')

@section('content')
    <div class="section-header">
        <h1>Order Management</h1>
        <div class="section-header-breadcrumb">
            <a href="{{ route('warehouses.create') }}" class="btn btn-primary">Add New <i class="fas fa-plus"></i></a>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Warehouses</h4>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped table-md">
                                <tr>
                                    <th>#</th>
                                    <th>Invoice</th>
                                    <th>Customer's Name</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $orders->firstItem() + $loop->iteration - 1 }}</td>
                                    <td>{{ $order->invoice }}</td>
                                    <td>{{ $order->name }}</td>
                                    <td>{{ $order->orders->sum('quantity') }}</td>
                                    <td>{{ $order->grand_total }}</td>
                                    <td>
                                        @switch($order->status)
                                            @case('success')
                                                <span class="badge rounded-pill bg-success">{{ $order->status }}</span>
                                                @break
                                            @case('failed')
                                                <span class="badge rounded-pill bg-danger">{{ $order->status }}</span>
                                                @break
                                            @case('expired')
                                                <span class="badge rounded-pill bg-warning">{{ $order->status }}</span>
                                                @break
                                            @default
                                                <span class="badge rounded-pill bg-info">{{ $order->status }}</span>
                                        @endswitch
                                    </td>
                                    <td>
                                        <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-secondary" role="button">Detail</a>
                                        <button type="button" href="{{ route('warehouses.destroy', $order->id) }}" class="btn btn-sm btn-warning" onclick="event.preventDefault(); document.getElementById('delete-product-{{ $order->id }}').submit();">
                                            Delete
                                        </button>
                                        <form action="{{ route('warehouses.destroy', $order->id) }}" method="POST" id="delete-product-{{ $order->id }}" style="display: none">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                                    @endforeach
                            </table>
                        </div>
                    </div>
                    <div class="card-footer text-right text-white-all">
                        <nav class="d-inline-block">
                            <ul class="pagination mb-0">
                                {{ $orders->links() }}
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection