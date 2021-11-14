@extends('templates.master')

@section('content')
    <div class="section-header">
        <h1>Products Management</h1>
        <div class="section-header-breadcrumb">
            <a href="{{ route('products.create') }}" class="btn btn-primary">Add New <i class="fas fa-plus"></i></a>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Products</h4>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped table-md">
                                <tr>
                                    <th>#</th>
                                    <th>Product</th>
                                    <th>Weight</th>
                                    <th>Price</th>
                                    <th>Action</th>
                                </tr>
                                @foreach ($products as $product)
                                <tr>
                                    <td>{{ $products->firstItem() + $loop->iteration - 1 }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->weight }}</td>
                                    <td>{{ $product->price }}</td>
                                    <td>
                                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-secondary" role="button">Detail</a>
                                        <button type="button" href="{{ route('products.destroy', $product->id) }}" class="btn btn-sm btn-warning" onclick="event.preventDefault(); document.getElementById('delete-product-{{ $product->id }}').submit();">
                                            Delete
                                        </button>
                                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" id="delete-product-{{ $product->id }}" style="display: none">
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
                                {{ $products->links() }}
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection