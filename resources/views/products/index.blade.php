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

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css"></link>
    
    <table class="table table-bordered" id="tbl">
        <thead>
            <tr>
                <th>No</th>
                <th>ID</th>
                <th>Product Image</th>
                <th>Product Name</th>
                <th>Product Description</th>
                <th>Product Model</th>
                <th>Product Model Year</th>
                <th>Product Price</th>
                <th>Warranty Days</th>
                <th>Warranty Extendable Days</th>
                <th>Age Of Product[In Year]</th>
                <th>Return Days</th>
                <th>Product Policy</th>
                <th>Category</th>
                <!-- <th>Company</th> -->
                <th>Status</th>
                <th width="280px">Action</th>
            </tr>
        </thead>
        <tbody>
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
                <td>{{ $product->product_model }}</td>
                <td>{{ $product->product_model_year }}</td>
                <td>{{ $product->product_price }}</td>
                <td>{{ $product->warranty_days }}</td>
                <td>{{ $product->warranty_extendable_days }}</td>
                <td>{{ $product->age_of_product }}</td>
                <td>{{ $product->return_days }}</td>
                <td>{{ $product->product_policy }}</td>
                <td>{{ $product['category']['category_name'] }}</td>
                <td>
                    <form action="{{ route('products.update',$product->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="Active" Value="1">
                        <input type="hidden" name="InActive" Value="{{ $product->IsActive }}">
                        @if($product->IsActive)
                        <button type="submit" class="btn btn-small btn-outline-success">
                            <i class="fa fa-toggle-on fa-sm text-success"></i>&nbsp;Active
                        </button>
                        @else
                        <button type="submit" class="btn btn-small btn-outline-danger" title="Make Active">
                            <i class="fa fa-toggle-on fa-sm text-danger"></i>&nbsp;InActive
                        </button>
                        @endif
                    </form>&nbsp;

                    <form action="{{ route('products.update',$product->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="Delete" Value="1">
                        <input type="hidden" name="Restore" Value="{{ $product->IsDelete }}">
                        @if($product->IsDelete)
                        <button type="submit" class="btn btn-small btn-outline-success">
                            <i class="fa fa-toggle-on fa-sm text-success"></i>&nbsp;Delete
                        </button>
                        @else
                        <button type="submit" class="btn btn-small btn-outline-danger" title="Make Active">
                            <i class="fa fa-toggle-on fa-sm text-danger"></i>&nbsp;Restore
                        </button>
                        @endif
                    </form>&nbsp;
                    
                        <form action="{{ route('products.update',$product->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="Sold" Value="1">
                            <input type="hidden" name="UnSold" Value="{{ $product->IsSold }}">
                            @if($product->IsSold)
                            <button type="submit" class="btn btn-small btn-outline-success">
                                <i class="fa fa-toggle-on fa-sm text-success"></i>&nbsp;Sold
                            </button>
                            @else
                            <button type="submit" class="btn btn-small btn-outline-danger" title="Make restore">
                                <i class="fa fa-toggle-on fa-sm text-danger"></i>&nbsp;UnSold
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
            </tbody>
    </table>

<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
<script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

<!-- <script>
    $(document).ready( function () {
    $('#tbl').DataTable();
});
</script> -->

    {!! $products->links() !!}

@endsection