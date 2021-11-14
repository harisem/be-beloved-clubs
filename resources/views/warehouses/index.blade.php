@extends('templates.master')

@section('content')
    <div class="section-header">
        <h1>Warehouse Management</h1>
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
                                    <th>Product</th>
                                    <th>Size</th>
                                    <th>Color</th>
                                    <th>Ready</th>
                                    <th>Action</th>
                                </tr>
                                @foreach ($warehouses as $warehouse)
                                <tr>
                                    <td>{{ $warehouses->firstItem() + $loop->iteration - 1 }}</td>
                                    <td>{{ $warehouse->name }}</td>
                                    <td>{{ $warehouse->size }}</td>
                                    <td>{{ $warehouse->color }}</td>
                                    <td>{{ $warehouse->ready ? $warehouse->ready : 0 }}</td>
                                    <td>
                                        @can('update warehouses')
                                            <a href="{{ route('warehouses.edit', $warehouse->id) }}" class="btn btn-sm btn-outline-primary" role="button">Detail</a>
                                        @endcan
                                        @can('update products')
                                            <a href="{{ route('products.create', $warehouse->id) }}" class="btn btn-sm btn-outline-primary" role="button">Add to Store</a>
                                        @endcan
                                        <button type="button" href="{{ route('warehouses.destroy', $warehouse->id) }}" class="btn btn-sm btn-warning" onclick="event.preventDefault(); document.getElementById('delete-product-{{ $warehouse->id }}').submit();">
                                            Delete
                                        </button>
                                        <form action="{{ route('warehouses.destroy', $warehouse->id) }}" method="POST" id="delete-product-{{ $warehouse->id }}" style="display: none">
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
                                {{ $warehouses->links() }}
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection