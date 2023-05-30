@extends('layouts.dashboard')
@section('title','Categories')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active"> Categories </li>

@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{route('dashboard.categories.create')}}" class="btn btn-primary btn-sm"> Add New Category <i class="fa fa-plus"></i> </a>
            <a href="{{route('dashboard.categories.trash')}}" class="btn btn-outline-primary btn-sm"> Category Trash <i class="fa fa-trash"></i> </a>
         <x-alert />
        </div>
        <div class="card-body">
            <form action="{{URL::current()}}" method="get" class="form-group d-flex justify-content-between">
                <input type="text" name="name" placeholder="Category Name" class="form-control mx-2" value="{{request('name')}}">
                <select class="form-control mx-2 custome-select" name="status">
                    <option value=""> All </option>
                    <option value="active" @selected(request('status') == 'active')> Active </option>
                    <option value="archieve" @selected(request('status') == 'archieve')> Archieve </option>
                </select>
                <button class="btn btn-info btn-sm mx-2" type="submit"> <i class="fa fa-search"></i> </button>
            </form>
    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th></th>
            <th>id</th>
            <th>Name</th>
            <th>Parent</th>
            <th> status </th>
            <th>Create At</th>
            <th> Action </th>
        </tr>
        </thead>
        <tbody>
        @forelse($categories as $category)
        <tr>
            <td><img src="{{asset('storage/'.$category->image)}}" height="50" alt=""></td>
            <td> {{ $category->id }} </td>
            <td> {{ $category->name }} </td>

            <td>
                @if ($category->parent)
                    {{$category->parent->name}}
                @else
                    No Parent
                @endif
            </td>
            <td> {{ $category->status  }} </td>
            <td> {{ $category->created_at }} </td>
            <td>
                <a href="{{route('dashboard.categories.edit',$category->id)}}" class="btn btn-primary btn-sm"> Edit </a>
            <form method="post" action="{{route('dashboard.categories.destroy',$category->id)}}">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-danger btn-sm"> Delete </button>
            </form>
            </td>
        </tr>
        @empty
            <tr>
                <td class="text-center" colspan="7"> No Data found </td>
            </tr>
        @endforelse
        </tbody>
    </table>
            {{$categories->withQueryString()->links()}}
        </div>
    </div>
@endsection
