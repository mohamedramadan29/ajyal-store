@extends('layouts.dashboard')
@section('title','trashed categories')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active"> trashed categories </li>

@endsection
@section('content')
    <div class="card">
        <div class="card-header">

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
                    <th>Deleted At</th>
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
                        <td> {{ $category->deleted_at }} </td>
                        <td>
                            <form method="post" action="{{route('dashboard.categories.restore',$category->id)}}">
                                @csrf
                                @method('Put')
                                <button type="submit" class="btn btn-success btn-sm"> restore  </button>
                            </form>
                            <form method="post" action="{{route('dashboard.categories.force-delete',$category->id)}}">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger btn-sm"> forec Delete </button>
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
