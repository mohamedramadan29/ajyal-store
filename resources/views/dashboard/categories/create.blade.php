@extends('layouts.dashboard')
@section('title','Add Category')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active"> Add Category </li>

@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        <div class="card-body">
           <form method="post" action="{{route('dashboard.categories.store')}}" enctype="multipart/form-data">
               @csrf
               <div class="form-group">
                   <label for="name"> Name </label>
                   <input type="text" @class(['form-control','is-invalid'=>$errors->has('name')]) id="name" name="name" value="{{old('name')}}">
                   @error('name')
                   <div class="invalid-feedback">
                       {{$message}}
                   </div>
                   @enderror
               </div>
               <div class="form-group">
                   <label for="name"> Parent </label>
                   <select class="form-control form-select" id="select" name="parent_id">
                       <option value=""> No Parent </option>
                       @foreach($categories as $cat)
                           <option value="{{$cat->id}}" @selected(old('parent_id')) > {{$cat->name}} </option>
                       @endforeach
                   </select>
                   @error('parent_id')
                   <div class="text-danger"> {{$message}} </div>
                   @enderror
               </div>
               <div class="form-group">
                   <label for="name"> Description </label>
                   <textarea class="form-control" id="description" name="description">{{old('description')}}</textarea>
               </div>
               <div class="form-group">
                   <label for="name"> status </label>
                   <select class="form-control form-select" id="select" name="status">
                       <option value="active" @selected(old('status'))> Active </option>
                       <option value="archieve" @selected(old('status'))> archieve </option>
                   </select>
               </div>
               <div class="form-group">
                   <label for="name"> Image </label>
                    <input type="file" class="form-control" name="image" accept="image/*">
               </div>
               <button class="btn btn-primary" type="submit"> Add Category <i class="fa fa-plus"></i> </button>
           </form>
        </div>
    </div>
@endsection
