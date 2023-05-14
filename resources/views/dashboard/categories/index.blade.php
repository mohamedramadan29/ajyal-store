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
            @if(session()->has('success'))
                <div class="alert alert-success"> {{session('success')}} </div>
            @endif
            @if(session()->has('info'))
                <div class="alert alert-info"> {{session('info')}} </div>
            @endif
        </div>
        <div class="card-body">
    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th></th>
            <th>id</th>
            <th>Name</th>
            <th>Parent</th>
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
            <td> {{ $category->parent_id }} </td>
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
        </div>
    </div>
@endsection
