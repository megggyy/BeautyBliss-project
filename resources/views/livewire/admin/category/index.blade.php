        {{-- <div class="row">
            <div class="col-md-12 grid-margin">
        
                @if(session('message'))
                <div class="alert alert-success">{{ session('message')}}</div>
                @error('name')<small class="text-danger"></small> @enderror
                @endif
        
                <div class="card">
                    <div class="card-header">
                        <h4>Category
                            <a href="{{ url('admin/category/create')}}" class="btn btn-primary btn-sm float-end">Add Category</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <table id="categoryTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr>
                                        <td>{{ $category->id }}</td>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->description }}</td>
                                        <td>
                                            @if ($category->images)
                                                @foreach ($category->images as $image)
                                                    <img src="{{ asset($image) }}" width="100px" alt="Category Image">
                                                @endforeach
                                            @endif
                                        </td>
                                        <td>
                                            @if ($category->deleted_at)
                                                <form wire:submit.prevent="restore({{ $category->id }})" style="display: inline-block;">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-primary">Restore</button>
                                                </form>
                                            @else
                                                <a href="{{ url('admin/category/'.$category->id.'/edit') }}" class="btn btn-success">Edit</a>
                                                <form wire:submit.prevent="destroy({{ $category->id }})" style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this category?')">Delete</button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div>
                            {{ $categories->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        @push('script')
            <!-- Include the DataTables library -->
            <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
            <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
        
            <script>
                // Initialize DataTables using id selector
                let dataTable = null;
                document.addEventListener('livewire:load', function () {
                    dataTable = $('#categoryTable').DataTable();
        
                    // Listen for the reinitialize-datatable event and reinitialize DataTables
                    Livewire.on('reinitialize-datatable', function () {
                        dataTable.destroy();
                        dataTable = $('#categoryTable').DataTable();
                    });
                });
            </script>
        @endpush
        
         --}}

         <div class="container-fluid">

            <!-- Page Header and Breadcrumbs -->
            {{-- <div class="page-header">
                <h2>Category Management</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Categories</li>
                    </ol>
                </nav>
            </div> --}}
        
            <!-- Flash Messages -->
            @if(session('message'))
            <div class="alert alert-success">{{ session('message')}}</div>
            @endif
        
            <!-- Category Card -->
            <div class="card">
                <div class="card-header">
                    <h4>Categories
                        <a href="{{ url('admin/category/create')}}" class="btn btn-primary btn-sm float-end">Add Category</a>
                    </h4>
                </div>
                <div class="card-body">
        
                    <!-- Import Form -->
                    <form action="{{ route('category.import') }}" method="POST" enctype="multipart/form-data">
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
        
                    <!-- Categories Table -->
                    <table id="categoryTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->description }}</td>
                                <td>
                                    @if ($category->images)
                                    @foreach ($category->images as $image)
                                    <img src="{{ asset($image) }}" class="category-image" alt="Category Image">
                                    @endforeach
                                    @endif
                                </td>
                                <td>
                                    @if ($category->deleted_at)
                                    <form wire:submit.prevent="restore({{ $category->id }})" style="display: inline-block;">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-primary">Restore</button>
                                    </form>
                                    @else
                                    <a href="{{ url('admin/category/'.$category->id.'/edit') }}" class="btn btn-success">Edit</a>
                                    <form wire:submit.prevent="destroy({{ $category->id }})" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this category?')">Delete</button>
                                    </form>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{-- {{ $categories->links() }} --}}
            </div>
        </div>
        
        @push('script')
        <!-- Include the DataTables library -->
        <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
        
        <script>
            // Initialize DataTables using id selector
            let dataTable = null;
            document.addEventListener('livewire:load', function () {
                dataTable = $('#categoryTable').DataTable();
        
                // Listen for the reinitialize-datatable event and reinitialize DataTables
                Livewire.on('reinitialize-datatable', function () {
                    dataTable.destroy();
                    dataTable = $('#categoryTable').DataTable();
                });
            });
        </script>
        @endpush
        