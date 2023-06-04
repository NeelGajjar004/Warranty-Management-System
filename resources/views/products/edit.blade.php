@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Product</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('products.index') }}"> Back</a>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {!! Form::model($product, ['method' => 'PATCH','enctype' => 'multipart/form-data','route' => ['products.update', $product->id]]) !!}
    <div class="row">
	    <div class="col-xs-12 col-sm-12 col-md-12 mb-2">
	        <div class="form-group">
	            <strong>Product Name : </strong>
                {!! Form::text('product_name',null, array('placeholder' => 'Product Name','class' => 'form-control')) !!}
	        </div>
	    </div>
	    <div class="col-xs-12 col-sm-12 col-md-12 mb-2">
            <div class="form-group">
                <strong>Product Description : </strong>
                {!! Form::text('product_description',null, array('placeholder' => 'Product Description','class' => 'form-control')) !!}
	        </div>
	    </div>
        <div class="col-xs-12 col-sm-12 col-md-12 mb-2">
            <div class="form-group">
                <strong>Product Model : </strong>
                {!! Form::text('product_model',null, array('placeholder' => 'Product Model','class' => 'form-control')) !!}
	        </div>
	    </div>
        <div class="col-xs-12 col-sm-12 col-md-12 mb-2">
            <div class="form-group">
                <strong>Product Model Year : </strong>
                {!! Form::text('product_model_year',null, array('placeholder' => 'Product Model year','class' => 'form-control')) !!}
	        </div>
	    </div>
        <div class="col-xs-12 col-sm-12 col-md-12 mb-2">
            <div class="form-group">
                <strong>Product Price : </strong>
                {!! Form::text('product_price',null, array('placeholder' => 'Product Price','class' => 'form-control')) !!}
	        </div>
	    </div>
        <div class="col-xs-12 col-sm-12 col-md-12 mb-2">
            <div class="form-group">
                <strong>Warranty Days : </strong>
                {!! Form::text('warranty_days',null, array('placeholder' => 'Warranty Days','class' => 'form-control')) !!}
	        </div>
	    </div>
        <div class="col-xs-12 col-sm-12 col-md-12 mb-2">
            <div class="form-group">
                <strong>Warranty Extendable Days : </strong>
                {!! Form::text('warranty_extendable_days',null, array('placeholder' => 'Warranty Extendable Days','class' => 'form-control')) !!}
	        </div>
	    </div>
        <div class="col-xs-12 col-sm-12 col-md-12 mb-2">
            <div class="form-group">
                <strong>Age of Product : </strong>
                {!! Form::text('age_of_product',null, array('placeholder' => 'Age of Product','class' => 'form-control')) !!}
	        </div>
	    </div>
        <div class="col-xs-12 col-sm-12 col-md-12 mb-2">
            <div class="form-group">
                <strong>Return Days : </strong>
                {!! Form::text('return_days',null, array('placeholder' => 'Return Days','class' => 'form-control')) !!}
	        </div>
	    </div>
        <div class="col-xs-12 col-sm-12 col-md-12 mb-2">
            <div class="form-group">
                <strong>Product Policy : </strong>
                {!! Form::textarea('product_policy',null, array('placeholder' => 'Product Policy','class' => 'form-control' , 'rows'=> 3)) !!}
	        </div>
	    </div>
        <div class="col-xs-6 col-sm-6 col-md-6 mb-2">
            <div class="form-group">
                <strong>Category : </strong>
                    <select name="category_id" id="category_id" class="form-control" required>
                        <option value="">Select Category</option>
                        @foreach($categorys as $cate )
                            @if($product['category_id'] == $cate->id)
                                <option value="{{ $cate->id }}" selected>{{$cate->category_name}}</option>
                            @else
                                <option value="{{ $cate->id }}" selected>{{$cate->category_name}}</option>
                            @endif
                        @endforeach
                    </select>
            </div>
	    </div>
        <div class="col-xs-6 col-sm-6 col-md-6 mb-2">
            <div class="form-group">
                <strong>Company : </strong>
                <select name="company_id" id="company_id" class="form-control" required>
                    <option value="">Select Company</option>
                    @foreach($companys as $comp)
                        @if($product['company_id'] == $comp->id)
                            <option value="{{ $comp->id }}" selected>{{$comp->company_name}}</option>
                        @else
                            <option value="{{ $comp->id }}" selected>{{$comp->company_name}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
	    </div>
        <div class="col-xs-12 col-sm-12 col-md-12 mb-2">
            <div class="form-group">
                <strong>Product Image:</strong>
                {!! Form::File('product_image', array('placeholder' => 'Product Image','class' => 'form-control')) !!}
            </div>
            <div class="pt-3">
            @if($product->product_image != '' && file_exists(public_path().'/uploads/product/'.$product->product_image))
                <img src="{{ url('uploads/product/'.$product->product_image) }}" alt="" width="105" height="95">
            @endif
            </div>
        </div>
		<div class="col-xs-12 col-sm-12 col-md-12 text-center">
		    <button type="submit" class="btn btn-primary">Submit</button>
		</div>
	</div>
    {!! Form::close() !!}

@endsection