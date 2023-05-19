@extends('layouts.dashboard')
@section('title', 'Edit Category')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active"> Edit Category </li>

@endsection
@section('content')
    <div class="card">
        <div class="card-header">

        </div>
        <div class="card-body">

            <form method="post" action="{{ route('dashboard.categories.update', $category->id) }}"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name"> Name </label>
                    <input type="text" @class(['form-control', 'is-invalid' => $errors->has('name')]) class="form-control" id="name" name="name"
                        value="{{ old('name', $category->name) }}">
                    <div class="invalid-feedback">
                        @error('name')
                            {{ $message }}
                        @enderror
                    </div>

                </div>
                <div class="form-group">
                    <label for="name"> Parent </label>
                    <select class="form-control form-select" id="select" name="parent_id">
                        <option value=""> No Parent </option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}" @selected(old('parent_id', $category->parent_id) == $cat->id)> {{ $cat->name }} </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="name"> Description </label>
                    <textarea class="form-control" id="description" name="description">{{ old('description', $category->description) }}</textarea>
                </div>
                <div class="form-group">
                    <label for="name"> status </label>
                    <select class="form-control form-select" id="select" name="status">
                        <option value="active" @selected(old('status', $category->status) == 'active')> Active </option>
                        <option value="archieve" @selected(old('status', $category->status) == 'archieve')> archieve </option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="name"> Image </label>
                    <input type="file" class="form-control" name="image">
                </div>
                <button class="btn btn-primary" type="submit"> Edit Category <i class="fa fa-plus"></i> </button>
            </form>
        </div>
    </div>
@endsection
