@extends('layouts.admin')

@section('content')
<style>
    label.error{
        font-weight: 700;
        display: block;
        color: #f00;
        font-size: 14px;
    }
</style>
<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="card">     
        <div class="card-header">
            <h4>Edit Category
                <a href="{{ url('admin/category')}}" class="btn btn-primary btn-sm text-white float-end">BACK</a>
            </h4>
        </div>
        <div class="card-body">
            <form action="{{ url('admin/category/'.$category->id)}}" method="POST" enctype="multipart/form-data" id="CategoryFormValidation">
                @csrf
                @method('PUT')
                <div class="row" >
                <div class="col-md-6 mb-3">
                    <label>Name</label>
                    <input type="text" name="name" value="{{ $category->name}}" class="form-control"/>
                    {{-- @error('name')<small class="text-danger">{{$message}}</small> @enderror --}}
                </div>
                <div class="col-md-6 mb-3">
                    <label>Slug</label>
                    <input type="text" name="slug" value="{{ $category->slug }}" class="form-control"/>
                    {{-- @error('slug')<small class="text-danger">{{$message}}</small> @enderror --}}
                </div>
                <div class="col-md-6 mb-3">
                    <label>Description</label>
                    <textarea name="description" class="form-control" rows="3">{{ $category->description}}</textarea>
                    {{-- @error('description')<small class="text-danger">{{$message}}</small> @enderror --}}
                </div>
                <div class="col-md-6 mb-3">
                    <label>Image</label><br>
                    <input type="file" name="images[]" multiple class="form-control-file"/>
                    @if ($category->images)
                        @foreach($category->images as $image)
                            <img src="{{ asset($image) }}" width="100px" class="image-preview" />
                        @endforeach
                    @endif
                    {{-- @error('images')<small class="text-danger">{{$message}}</small> @enderror --}}
                </div>
                <div class="col-md-6 mb-3">
                    <label>Status</label><br/>
                    <input type="checkbox" name="status" {{ $category->status == '1' ? 'checked':''}}/>
                    {{-- @error('status')<small class="text-danger">{{$message}}</small> @enderror --}}
                </div>
                <div class="col-md-12 mb-3">
                    <button type="submit" class="btn btn-primary float-end">Update</button>
                 </div>
        </div>
        </form>
        </div>
        </div>
    </div>
</div>
@endsection
