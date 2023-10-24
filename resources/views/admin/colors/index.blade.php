@extends('layouts.admin')

@section('content')
 
<div class="row">
    <div class="col-md-12 grid-margin">
        @if (session('message'))
        <div class="alert alert-success">{{ session('message')}}</div>
        @endif
        <div class="card">     
        <div class="card-header">
            <h4>Shades colors
                <a href="{{ url('admin/colors/create')}}" class="btn btn-success btn-sm text-white float-end">Add Shades</a>
            </h4>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.colors.import') }}" method="POST" enctype="multipart/form-data">
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
            <table id="colorTable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Color Name</th>
                        <th>Color Code</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($colors as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->name }}</td>
                        <td><span class="color-badge" style="background-color: #{{ $item->code }};"></span></td>
                        <td>{{ $item->status ? 'Hidden':'Visible'}}</td>
                        <td>
                            
                            {{-- <a href="{{ url('admin/colors/'.$item->id.'/delete')}}" onclick="return confirm('Are you sure to delete this shade?')" class="btn btn-danger btn-sm">Delete</a> --}}
                            @if($item->deleted_at) <!-- Check if the color is soft-deleted -->
                            <form action="{{ url('admin/colors/'.$item->id.'/restore') }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm">Restore</button>
                            </form>
                        @else
                            <a href="{{ url('admin/colors/'.$item->id.'/edit')}}" class="btn btn-primary btn-sm">Edit</a>
                            <a href="{{ url('admin/colors/'.$item->id.'/delete') }}" onclick="return confirm('Are you sure to delete this shade?')" class="btn btn-danger btn-sm">Delete</a>
                        @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>
</div>

@endsection

@push('script')
<script>
     $(document).ready(function() { 
            $('#colorTable').DataTable();
        });
</script>
@endpush
