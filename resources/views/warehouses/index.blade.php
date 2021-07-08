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
                                    <th>Weight</th>
                                    <th>Production</th>
                                    <th>Ready</th>
                                    <th>Delivered</th>
                                    <th>Action</th>
                                </tr>
                                @foreach ($warehouses as $warehouse)
                                <tr>
                                    <td>{{ $warehouses->firstItem() + $loop->iteration - 1 }}</td>
                                    <td>{{ $warehouse->name }}</td>
                                    <td>{{ $warehouse->weight }}</td>
                                    <td></td>
                                    <td>
                                        <a href="{{ route('warehouses.edit', $warehouse->id) }}" class="btn btn-sm btn-secondary" role="button">Detail</a>
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