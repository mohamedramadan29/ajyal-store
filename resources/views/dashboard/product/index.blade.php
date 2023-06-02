@extends('layouts.dashboard')
@section('title','Categories')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active"> Products </li>

@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{route('dashboard.products.create')}}" class="btn btn-primary btn-sm"> Add New Product <i class="fa fa-plus"></i> </a>
            <a href="{{route('dashboard.products.trash')}}" class="btn btn-outline-primary btn-sm"> Product Trash <i class="fa fa-trash"></i> </a>
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
                    <th>Store</th>
                    <th>Category</th>
                    <th> status </th>
                    <th>Create At</th>
                    <th> Action </th>
                </tr>
                </thead>
                <tbody>
                @forelse($products as $product)
                    <tr>
                        <td><img src="{{asset('storage/'.$product->image)}}" height="50" alt=""></td>
                        <td> {{ $product->id }} </td>
                        <td> {{ $product->name }} </td>

                        <td>
                            @if ($product->store_id)
                                {{$product->Store->name}}
                            @else
                                No Store
                            @endif
                        </td>
                        <td>
                            @if($product->category_id)
                                {{$product->Category->name}}
                            @else
                            No Category
                            @endif
                        </td>
                        <td> {{ $product->status  }} </td>
                        <td> {{ $product->created_at }} </td>
                        <td>
                            <a href="{{route('dashboard.categories.edit',$product->id)}}" class="btn btn-primary btn-sm"> Edit </a>
                            <form method="post" action="{{route('dashboard.categories.destroy',$product->id)}}">
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
            {{$products->withQueryString()->links()}}
        </div>
    </div>
@endsection
