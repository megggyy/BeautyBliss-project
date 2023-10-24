

<div class="container-fluid p-0">
    @include('livewire.admin.brand.modal-form')
    <div class="row">
        <div class="col-md-12">
            @if(session('message'))
            <div class="alert alert-success">{{ session('message')}}</div>
            @error('name')<small class="text-danger"></small> @enderror
            @endif
            <div class="card">
                <div class="card-header">
                    <h4>
                        Brands List
                        <button wire:click="create()" data-bs-toggle="modal" data-bs-target="#addBrandModal" class="btn btn-success btn-sm float-end">Add brands</button>
                    </h4>
                </div>
                <div class="card-body">
                    <div class="input-group">
                        <label for="importFile" class="col-sm-3 col-form-label">Import Excel File:</label>
                        <input wire:model="importFile" type="file" class="form-control" id="importFile">
                        @error('importFile') <span class="text-danger">{{ $message }}</span> @enderror
                        <button wire:click="import" class="btn btn-primary">Import</button>
                    </div>
                    <br>
                    <table id="brandTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Slug</th> 
                                <th>Status</th>
                                <th>Images</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($brands as $brand)

                            <tr>
                                <td>{{$brand->id}}</td>
                                <td>{{$brand->name}}</td>
                                <td>
                                    @if ($brand->category)
                                        {{$brand->category->name}}
                                    @else
                                        No Category
                                    @endif
                                </td>
                                <td>{{$brand->slug}}</td>
                                <td>{{$brand->status == '1' ? 'hidden':'visible'}}</td>
                                <td>
                                    @if ($brand->images)
                                        @foreach ($brand->images as $imagePath) <!-- Removed json_decode -->
                                            <img src="{{ asset('storage/' . $imagePath) }}" alt="Brand Image" style="max-width: 100px;">
                                        @endforeach
                                    @endif
                                </td>
                                {{-- <td>
                                    <a href="#" wire:click="editBrand({{$brand->id}})" data-bs-toggle="modal" data-bs-target="#updateBrandModal" class="btn btn-sm btn-primary">Edit</a>
                                    <a href="#" wire:click="deleteBrand({{$brand->id}})" data-bs-toggle="modal" data-bs-target="#deleteBrandModal" class="btn btn-sm btn-danger">Delete</a>
                                </td> --}}
                                <td>
                                    @if ($brand->trashed()) <!-- Check if the brand is soft-deleted -->
                                    <button wire:click="setSelectedBrandId({{ $brand->id }})" data-bs-toggle="modal" data-bs-target="#restoreBrandModal" class="btn btn-primary btn-sm">Restore</button>
                                    @else
                                        <button wire:click="editBrand({{ $brand->id }})" data-bs-toggle="modal" data-bs-target="#updateBrandModal" class="btn btn-primary btn-sm">Edit</button>                   
                                        <button wire:click="deleteBrand({{ $brand->id }})" data-bs-toggle="modal" data-bs-target="#deleteBrandModal" class="btn btn-danger btn-sm">Delete</button>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5">No Brands Found</td>
                            </tr>
                                                            
                            @endforelse
                        </tbody>
                    </table>
                </div>
                {{-- {{ $brands->links() }} --}}
            </div>
        </div>
    </div>
</div>

{{-- @push('script')
<script>
     $(document).ready(function() {
            $('#brandTable').DataTable();
        });
    window.addEventListener('close-modal', event => {
        $('#addBrandModal').modal('hide');
        $('#updateBrandModal').modal('hide');
        $('#deleteBrandModal').modal('hide');
    });
    
</script>
@endpush  --}}

@push('script')
<!-- Include the DataTables library -->
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">

<script>
    // Initialize DataTables using id selector
    let dataTable = null;
    document.addEventListener('livewire:load', function () {
        dataTable = $('#brandTable').DataTable();

        // Listen for the reinitialize-datatable event and reinitialize DataTables
        Livewire.on('reinitialize-datatable', function () {
            if (dataTable !== null) {
                dataTable.destroy();
            }
            dataTable = $('#brandTable').DataTable();
        });

        // Initialize DataTables for brandTable
        $('#brandTable').DataTable();

        // Close modal event listener
        window.addEventListener('close-modal', event => {
            $('#addBrandModal').modal('hide');
            $('#updateBrandModal').modal('hide');
            $('#deleteBrandModal').modal('hide');
            $('#restoreBrandModal').modal('hide');
        });

        // Listen for the import-finished event and reinitialize DataTables
        Livewire.on('import-finished', function () {
            initializeDataTable();
        });
    });
</script>
@endpush

