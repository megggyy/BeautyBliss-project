@extends('layouts.admin')

@section('title', 'Users List')

@section('content')

    <div class="row">
        <div class="col-md-12 grid-margin">
            @if (session('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
            @endif
            <div class="card">
                <div class="card-header">
                    <h4>Users
                        <a href="{{ url('admin/users/create') }}" class="btn btn-primary btn-sm text-white float-end">Add
                            User</a>
                    </h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if ($user->role_as == '0')
                                            <label class="badge btn-primary">User</label>
                                        @elseif ($user->role_as == '1')
                                            <label class="badge btn-success">Admin</label>
                                        @else
                                            <label class="badge btn-danger">none</label>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($user->deleted_at)
                                            <form action="{{ url('admin/users/' . $user->id . '/restore') }}"
                                                method="POST" style="display: inline-block;">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-primary">Restore</button>
                                            </form>
                                        @else
                                            <a href="{{ url('admin/users/' . $user->id . '/edit') }}"
                                                class="btn btn-success">Edit</a>
                                            <form action="{{ url('admin/users/' . $user->id . '/delete') }}"
                                                method="POST" style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"
                                                    onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">No Users Available</td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>
                {{ $users->links() }}
            </div>
        </div>
    </div>

@endsection
