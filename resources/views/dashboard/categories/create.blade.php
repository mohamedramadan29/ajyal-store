@extends('layouts.dashboard')
@section('title','Add Category')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active"> Add Category </li>

@endsection
@section('content')
    <div class="card">
        <div class="card-header">

        </div>
        <div class="card-body">
           <form method="post" action="{{route('dashboard.categories.store')}}">
               @csrf
               <div class="form-group">
                   <label for="name"> Name </label>
                   <input type="text" class="form-control" id="name" name="name">
               </div>
               <div class="form-group">
                   <label for="name"> Parent </label>
                   <select class="form-control form-select" id="select" name="parent_id">
                       <option value=""> No Parent </option>
                       @foreach($categories as $cat)
                           <option value="{{$cat->id}}"> {{$cat->name}} </option>
                       @endforeach
                   </select>
               </div>
               <div class="form-group">
                   <label for="name"> Description </label>
                   <textarea class="form-control" id="description" name="description"></textarea>
               </div>
               <div class="form-group">
                   <label for="name"> status </label>
                   <select class="form-control form-select" id="select" name="status">
                       <option value="active"> Active </option>
                       <option value="archieve"> archieve </option>
                   </select>
               </div>
               <div class="form-group">
                   <label for="name"> Image </label>
                    <input type="file" class="form-control" name="image">
               </div>
               <button class="btn btn-primary" type="submit"> Add Category <i class="fa fa-plus"></i> </button>
           </form>
        </div>
    </div>
@endsection
