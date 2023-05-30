@extends('layouts.app')

@section('content')
    <div class="row mb-3">
        <div class="col-lg-6 margin-tb">
            <div class="pull-left">
                    <a class="btn btn-primary" href="{{ route('products.index') }}"> 
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-left" viewBox="0 0 16 16">
                            <path d="M10 12.796V3.204L4.519 8 10 12.796zm-.659.753-5.48-4.796a1 1 0 0 1 0-1.506l5.48-4.796A1 1 0 0 1 11 3.204v9.592a1 1 0 0 1-1.659.753z"/>
                        </svg>
                    </a>
                    <b>Add New Product</b> 
                <!-- <h2>Add New Product</h2> -->
            </div>
        </div>
        <!-- <div class="col-lg-6 margin-tb mr-sm-0">
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('products.index') }}"> 
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-left" viewBox="0 0 16 16">
                        <path d="M10 12.796V3.204L4.519 8 10 12.796zm-.659.753-5.48-4.796a1 1 0 0 1 0-1.506l5.48-4.796A1 1 0 0 1 11 3.204v9.592a1 1 0 0 1-1.659.753z"/>
                    </svg>
                </a>
            </div>
        </div>   -->
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


    {!! Form::open(array('route' => 'products.store','method'=>'POST','enctype' => 'multipart/form-data')) !!}
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
                <strong>Product Price : </strong>
                {!! Form::text('product_price',null, array('placeholder' => 'Product Price','class' => 'form-control')) !!}
	        </div>
	    </div>
        <div class="col-xs-12 col-sm-12 col-md-12 mb-2">
            <div class="form-group">
                <strong>Warranty Period : </strong>
                {!! Form::text('warranty_period',null, array('placeholder' => 'Warranty Period','class' => 'form-control')) !!}
	        </div>
	    </div>
        <div class="col-xs-6 col-sm-6 col-md-6 mb-2">
            <div class="form-group">
                <strong>Category : </strong>
                    <select name="category_id" id="category_id" class="form-control" required>
                        <option value="">Select Category</option>
                        @foreach($categorys as $cate )
                            <option value="{{ $cate->id }}">{{$cate->category_name}}</option>
                        @endforeach
                    </select>
            </div>
	    </div>
        <div class="col-xs-6 col-sm-6 col-md-6 mb-2">
            <div class="form-group">
                <strong>Company : </strong>
                <select name="company_id" id="company_id" class="form-control" required>
                    <option value="">Select Company</option>
                    @foreach($companys as $comp )
                        <option value="{{ $comp->id }}">{{$comp->company_name}}</option>
                    @endforeach
                </select>
            </div>
	    </div>
        <div class="col-xs-12 col-sm-12 col-md-12 mb-2">
            <div class="form-group">
                <strong>Product Image:</strong>
                {!! Form::File('product_image', array('placeholder' => 'Product Image','class' => 'form-control')) !!}
            </div>
        </div>
		<div class="col-xs-12 col-sm-12 col-md-12 text-center">
		    <button type="submit" class="btn btn-primary">Submit</button>
		</div>
	</div>

@endsection



       