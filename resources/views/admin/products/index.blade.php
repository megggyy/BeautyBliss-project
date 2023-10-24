@extends('layouts.admin')

@section('content')

    <div class="row">
        <div class="col-md-12 grid-margin">
            @if (session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif
            <div class="card">
                <div class="card-header">
                    <h4>Products
                        <a href="{{ url('admin/products/create') }}" class="btn btn-primary btn-sm text-white float-end">Add
                            Products</a>
                    </h4>
                </div>
                <div class="card-body">

                    <form action="{{ route('product.import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3 align-items-center">
                            <div class="col-sm-7">
                                <div class="input-group">
                                    <input type="file" class="form-control" id="excel_file" name="excel_file">
                                    <button type="submit" class="btn btn-success">Import Excel</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <hr>

                    <table id="productTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Category</th>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Image</th>
                                <th>Quantity</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($products as $product)
                                <tr>
                                    <td>{{ $product->id }}</td>
                                    <td>
                                        @if ($product->category)
                                            {{ $product->category->name }}
                                        @else
                                            No Category
                                        @endif
                                    </td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->selling_price }}</td>
                                    <td>
                                        @foreach ($product->productImages as $image)
                                            <div class="col-md-2">
                                                @if ($image->image)
                                                    <img src="{{ asset($image->image) }}" width="100px" id="image-preview" alt="Product Image"/>
                                                @else
                                                    <a href="{{ asset($image->image) }}" target="_blank">{{ $image->image }}</a>
                                                @endif
                                            </div>
                                        @endforeach
                                    </td>                                                                                                         
                                    <td>{{ $product->quantity }}</td>
                                    <td>{{ $product->status == '1' ? 'Hidden' : 'Visible' }}</td>
                                    <td>
                                        @if ($product->deleted_at)
                                            <form action="{{ url('admin/products/' . $product->id . '/restore') }}"
                                                method="POST" style="display: inline-block;">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-primary">Restore</button>
                                            </form>
                                        @else
                                            <a href="{{ url('admin/products/' . $product->id . '/edit') }}"
                                                class="btn btn-success">Edit</a>
                                            <form action="{{ url('admin/products/' . $product->id . '/delete') }}"
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
                                    <td colspan="7">No Products Available</td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
            {{-- {{ $products->links() }} --}}
        </div>
    </div>

@endsection
@push('script')
    <!-- Include the DataTables library -->
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">

    <script>
        // Initialize DataTables using id selector
        let dataTable = null;
        document.addEventListener('livewire:load', function() {
            dataTable = $('#productTable').DataTable();

            // Listen for the reinitialize-datatable event and reinitialize DataTables
            Livewire.on('reinitialize-datatable', function() {
                dataTable.destroy();
                dataTable = $('#productTable').DataTable();
            });
        });
    </script>
@endpush
