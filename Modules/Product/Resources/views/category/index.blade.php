@extends('product::layouts.master')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('category.create') }}"> Create New Category</a>
            </div>
            <div class="pull-right" style="margin-left:20px">
                <a class="btn btn-danger" href="{{ route('product.index') }}"> Change to  Product</a>
            </div>
        </div>
    </div>



    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th width="200px">Action</th>
        </tr>
        @foreach ($categories as $product)
            <tr>
                <td>{{ $loop->iteration }}  </td>
                <td>{{ $product->name }}</td>
                <td>
                    <form action="{{ route('category.destroy',$product->id) }}" method="POST">


                        <a class="btn btn-primary" href="{{ route('category.edit',$product->id) }}">Edit</a>

                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>


@endsection
