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
            <h4>Add Category
                <a href="{{ url('admin/category')}}" class="btn btn-primary btn-sm text-white float-end">BACK</a>
            </h4>
        </div>
        <div class="card-body">
            <form action="{{ url('admin/category')}}" method="POST" enctype="multipart/form-data" id="CategoryFormValidation">
                @csrf
                <div class="row">
                <div class="col-md-6 mb-3">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" required/>
                </div>
                <div class="col-md-6 mb-3">
                    <label>Slug</label>
                    <input type="text" name="slug" class="form-control" required/>
                </div>
                <div class="col-md-6 mb-3">
                    <label>Description</label>
                    <textarea name="description" class="form-control" rows="3" required></textarea>
                </div>
                <div class="col-md-6 mb-3">
                    <label>Image</label>
                    <input type="file" name="images[]" multiple class="form-control" required/>
                </div>
                <div class="col-md-6 mb-3">
                    <label>Status</label><br/>
                    <input type="checkbox" name="status"/>
                </div>
                <div class="col-md-12 mb-3">
                    <button type="submit" class="btn btn-primary float-end">Save</button>
                 </div>
        </div>
        </form>
        </div>
        </div>
    </div>
</div>
@endsection
