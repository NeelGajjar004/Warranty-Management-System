@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Products</h2>
            </div>
            <div class="pull-right mb-3">
                @can('product-create')
                <a class="btn btn-success" href="{{ route('products.create') }}"> Create New Product</a>
                @endcan
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>ID</th>
            <th>Product Image</th>
            <th>Product Name</th>
            <th>Product Description</th>
            <th>Product Price</th>
            <th>Warranty Period</th>
            <th>Category</th>
            <th>Company</th>
            <th>Status</th>
            <th width="280px">Action</th>
        </tr>
	    @foreach ($products as $product)
	    <tr>
	        <td>{{ ++$i }}</td>
	        <td>{{ $product->id }}</td>
	        <td>
                @if($product->product_image != '' && file_exists(public_path().'/uploads/product/'.$product->product_image))
                    <img src="{{ url('uploads/product/'.$product->product_image) }}" alt="" width="55" height="45">
                @else
                    <img src="{{ url('assets/images/no-image.png') }}" alt="" width="55" height="45" >                        
                @endif
            </td>
	        <td>{{ $product->product_name }}</td>
	        <td>{{ $product->product_description }}</td>
	        <td>{{ $product->product_price }}</td>
	        <td>{{ $product->warranty_period }}</td>
	        <td>{{ $product['category']['category_name'] }}</td>
	        <td>{{ $product['company']['company_name'] }}</td>
            <td>
            <form action="{{ route('products.update',$product->id) }}" method="POST">
                @csrf
                @method('PATCH')
                    <input type="hidden" name="Active" Value="1">
                    <input type="hidden" name="IsActive" Value="{{ $product->IsActive }}">
                @if($product->IsActive)
                    <button type="submit" class="btn btn-small btn-outline-success">
                        <i class="fa fa-toggle-on fa-sm text-success"></i>&nbsp;Active
                    </button>
                @else
                    <button type="submit" class="btn btn-small btn-outline-danger" title="Make Active">
                        <i class="fa fa-toggle-on fa-sm text-danger"></i>&nbsp;InActive
                    </button>
                @endif
            </form>
            </td>
	        <td>
                <form action="{{ route('products.destroy',$product->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('products.show',$product->id) }}">Show</a>
                    @can('product-edit')
                    <a class="btn btn-primary" href="{{ route('products.edit',$product->id) }}">Edit</a>
                    @endcan

                    @csrf
                    @method('DELETE')
                    @can('product-delete')
                    <button type="submit" class="btn btn-danger">Delete</button>
                    @endcan
                </form>
	        </td>
	    </tr>
	    @endforeach
    </table>

    {!! $products->links() !!}

@endsection