@extends('layouts.admin')

@section('title', 'Customers List')

@section('content')

<div class="row">
    <div class="col-md-12 grid-margin">
        @if (session('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        @elseif (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="card">
            <div class="card-header">
                <h4>Customers
                    <a href="{{ url('admin/customers/create') }}" class="btn btn-success btn-sm text-white float-end">Add Customer</a>
                </h4>
            </div>
            <div class="card-body">
                <form action="{{ url('admin/customers/import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3 align-items-center">
                        <div class="col-sm-7">
                            <div class="input-group">
                                <input type="file" class="form-control" id="excel_file" name="file">
                                <button type="submit" class="btn btn-success">Import Excel</button>
                            </div>
                        </div>
                    </div>
                </form>
                <table id="customersTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>User</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Pin Code</th>
                            <th>Address</th>
                            <th>Images</th> <!-- Add a new column for displaying images -->
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($customers as $customer)
                        <tr>
                            <td>{{ $customer->id }}</td>
                            <td>{{ $customer->user->name }}</td>
                            <td>{{ $customer->name }}</td>
                            <td>{{ $customer->phone }}</td>
                            <td>{{ $customer->pin_code }}</td>
                            <td>{{ $customer->address }}</td>
                            <td>
                                @if ($customer->images)
                                    @foreach ($customer->images as $image)
                                        <img src="{{ asset('storage/' . $image) }}" alt="Customer Image" width="100">
                                    @endforeach
                                @endif
                            </td>
                            <td>
                                @if ($customer->deleted_at)
                                    <form action="{{ url('admin/customers/'.$customer->id.'/restore') }}" method="POST" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success">Restore</button>
                                    </form>
                                @else
                                    <a href="{{ url('admin/customers/'.$customer->id.'/edit') }}" class="btn btn-sm btn-primary">Edit</a>
                                    <a href="{{ url('admin/customers/'.$customer->id.'/delete') }}" onclick="return confirm('Are you sure you want to delete this data?')" class="btn btn-sm btn-danger">Delete</a>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8">No Customers Available</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{-- {{ $customers->links() }} --}}
        </div>
    </div>
</div>

@endsection

@push('script')
<script>
     $(document).ready(function() {
        $('#customersTable').DataTable({
            "paging": true, // Enable pagination
            "lengthMenu": [10, 25, 50, 100], // Set the number of records per page
        });
    });
</script>
@endpush

