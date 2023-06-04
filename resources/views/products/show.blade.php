@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Show Product</h2>
            </div>
            <div class="pull-right mb-3">
                <a class="btn btn-primary" href="{{ route('products.index') }}"> Back</a>
            </div>
        </div>
    </div>

    <div class="row text-center">
        <div class="col-xs-12 col-sm-12 col-md-12 mb-2">
            <div class="form-group">
                <!-- <strong>Product Name : </strong> -->
                @if($product->product_image != '' && file_exists(public_path().'/uploads/product/'.$product->product_image))
                    <img src="{{ url('uploads/product/'.$product->product_image) }}" alt="" width="105" height="95">
                @else
                    <img src="{{ url('assets/images/no-image.png') }}" alt="" width="105" height="95" >                        
                @endif
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6 mb-2">
            <div class="form-group">
                <strong>Product Name : </strong>
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>{{ $product->product_name }}</strong>
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6 mb-2">
            <div class="form-group">
                <strong>Product Description : </strong>
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>{{ $product->product_description }}</strong>
            </div>
        </div>

        <div class="col-xs-6 col-sm-6 col-md-6 mb-2">
            <div class="form-group">
                <strong>Product Model : </strong>
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>{{ $product->product_model }}</strong>
            </div>
        </div>
	  <div class="col-xs-6 col-sm-6 col-md-6 mb-2">
            <div class="form-group">
                <strong>Product Model Year : </strong>
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>{{ $product->product_model_year }}</strong>
            </div>
        </div>     
        <div class="col-xs-6 col-sm-6 col-md-6 mb-2">
            <div class="form-group">
                <strong>Product Price : </strong>
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>{{ $product->product_price }}</strong>
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6 mb-2">
            <div class="form-group">
                <strong>Warranty Days : </strong>
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>{{ $product->warranty_days }}</strong>
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6 mb-2">
              <div class="form-group">
                  <strong>Warranty Extendable Days : </strong>
              </div>
          </div>
          <div class="col-xs-6 col-sm-6 col-md-6">
              <div class="form-group">
                  <strong>{{ $product->warranty_extendable_days }}</strong>
              </div>
          </div>
        <div class="col-xs-6 col-sm-6 col-md-6 mb-2">
              <div class="form-group">
                  <strong>Age Of Product[In Year] : </strong>
              </div>
          </div>
          <div class="col-xs-6 col-sm-6 col-md-6">
              <div class="form-group">
                  <strong>{{ $product->age_of_product }}</strong>
              </div>
          </div>
        <div class="col-xs-6 col-sm-6 col-md-6 mb-2">
              <div class="form-group">
                  <strong>Return Days : </strong>
              </div>
          </div>
          <div class="col-xs-6 col-sm-6 col-md-6">
              <div class="form-group">
                  <strong>{{ $product->return_days }}</strong>
              </div>
          </div>
        <div class="col-xs-6 col-sm-6 col-md-6 mb-2">
              <div class="form-group">
                  <strong>Product Policy : </strong>
              </div>
          </div>
          <div class="col-xs-6 col-sm-6 col-md-6">
              <div class="form-group">
                  <strong>{{ $product->product_policy }}</strong>
              </div>
          </div>
        <div class="col-xs-6 col-sm-6 col-md-6 mb-2">
            <div class="form-group">
                <strong>Category : </strong>
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>{{ $product['category']['category_name'] }}</strong>
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6 mb-2">
            <div class="form-group">
                <strong>Company : </strong>
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>{{ $product['company']['company_name'] }}</strong>
            </div>
        </div>
    </div>
@endsection