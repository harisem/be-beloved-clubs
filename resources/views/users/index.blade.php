@extends('templates.master')

@section('content')
    <div class="section-header">
        <h1>Employee Management</h1>
        <div class="section-header-breadcrumb">
            <a href="{{ route('users.create') }}" class="btn btn-primary">Add New <i class="fas fa-plus"></i></a>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Employees</h4>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped table-md">
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                                @foreach ($users as $user)
                                <tr>
                                    <td>{{ $users->firstItem() + $loop->iteration - 1 }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td><div class="badge badge-primary">{{ implode($user->roles()->get()->pluck('name')->toArray()) }}</div></td>
                                    <td>
                                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-secondary" role="button">Detail</a>
                                        <button type="button" href="{{ route('users.destroy', $user->id) }}" class="btn btn-sm btn-warning" onclick="event.preventDefault(); document.getElementById('delete-user-{{ $user->id }}').submit();">
                                            Delete
                                        </button>
                                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" id="delete-user-{{ $user->id }}" style="display: none">
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