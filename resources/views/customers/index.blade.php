@extends('templates.master')

@section('content')
    <div class="section-header">
        <h1>Customer Management</h1>
        <div class="section-header-breadcrumb">
            <a href="{{ route('users.create') }}" class="btn btn-primary">Add New <i class="fas fa-plus"></i></a>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Customers</h4>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped table-md">
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Join Since</th>
                                    <th>Action</th>
                                </tr>
                                @foreach ($customers as $customer)
                                <tr>
                                    <td>{{ $customers->firstItem() + $loop->iteration - 1 }}</td>
                                    <td>{{ $customer->name }}</td>
                                    <td>{{ $customer->email }}</td>
                                    <td>{{ dateID($customer->created_at) }}</td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-secondary" role="button">Detail</a>
                                        <button type="button" href="#" class="btn btn-sm btn-warning" onclick="event.preventDefault(); document.getElementById('delete-user-{{ $customer->id }}').submit();">
                                            Delete
                                        </button>
                                        <form action="#" method="POST" id="delete-user-{{ $customer->id }}" style="display: none">
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
                                {{ $users->links() }}
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection