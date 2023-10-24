@extends('layouts.admin')

@section('title', 'Edit Customer')

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
        @if (session('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
        @endif

        @if ($errors->any())
        <ul class="alert alert-warning">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        @endif

        <div class="card">
            <div class="card-header">
                <h4>Edit Customer
                    <a href="{{ url('admin/customers') }}" class="btn btn-danger btn-sm text-white float-end">Back</a>
                </h4>
            </div>
            <div class="card-body">
                <form action="{{ url('admin/customers/'.$customer->id) }}" method="post" id="CustomerFormValidation" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>User</label>
                            <select name="user_id" class="form-control">
                                @foreach ($users as $user)
                                <option value="{{ $user->id }}" {{ $user->id === $customer->user_id ? 'selected' : '' }}>{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Name</label>
                            <input type="text" name="name" value="{{ $customer->name }}" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Phone</label>
                            <input type="text" name="phone" value="{{ $customer->phone }}" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Pin Code</label>
                            <input type="text" name="pin_code" value="{{ $customer->pin_code }}" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Address</label>
                            <input type="text" name="address" value="{{ $customer->address }}" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Images</label>
                            <input type="file" name="images[]" multiple class="form-control">
                        </div>
                        <div class="col-md-12 text-end">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
