@extends('templates.master')

@section('content')
    <div class="section-header">
        <h1>Catalog Management</h1>
        <div class="section-header-breadcrumb">
            <a href="{{ route('catalogs.create') }}" class="btn btn-primary">Add New <i class="fas fa-plus"></i></a>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Catalogs</h4>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped table-md">
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                                @foreach ($catalogs as $catalog)
                                <tr>
                                    <td>{{ $catalogs->firstItem() + $loop->iteration - 1 }}</td>
                                    <td>{{ $catalog->name }}</td>
                                    <td>
                                        <a href="{{ route('catalogs.edit', $catalog->id) }}" class="btn btn-sm btn-secondary" role="button">Detail</a>
                                        <button type="button" href="{{ route('catalogs.destroy', $catalog->id) }}" class="btn btn-sm btn-warning" onclick="event.preventDefault(); document.getElementById('delete-product-{{ $catalog->id }}').submit();">
                                            Delete
                                        </button>
                                        <form action="{{ route('catalogs.destroy', $catalog->id) }}" method="POST" id="delete-product-{{ $catalog->id }}" style="display: none">
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
                                {{ $catalogs->links() }}
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection