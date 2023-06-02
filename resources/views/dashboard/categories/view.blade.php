@extends('layouts.dashboard')
@section('title',$category->name)
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active"> {{$category->name}} </li>

@endsection
@section('content')
    <div class="card">
        <div class="card-body">

            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th></th>
                    <th>Name</th>
                    <th> status </th>
                    <th> Store </th>
                    <th>Create At</th>
                </tr>
                </thead>
                <tbody>
                @php
                // here use hasmany relation in category model
                $products = $category->Products()->with('store')->paginate(5);
                @endphp
                @forelse($products as $product)
                    <tr>

                        <td><img src="{{asset('storage/'.$product->image)}}" height="50" alt=""></td>
                        <td> {{$product->name}} </td>
                        <td> {{ $product->status  }} </td>
                        <td> {{ $product->store->name  }} </td>
                        <td> {{ $product->created_at }} </td>

                    </tr>
                @empty
                    <tr>
                        <td class="text-center" colspan="5"> No Data found </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
            {{$products->links()}}
        </div>
    </div>
@endsection
