@extends('layouts.app')

@section('content')
    <div class="row mb-3">
        <div class="col-lg-6 margin-tb">
            <div class="pull-left">
                    <a class="btn btn-primary" href="{{ route('vendors.index') }}"> 
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-left" viewBox="0 0 16 16">
                            <path d="M10 12.796V3.204L4.519 8 10 12.796zm-.659.753-5.48-4.796a1 1 0 0 1 0-1.506l5.48-4.796A1 1 0 0 1 11 3.204v9.592a1 1 0 0 1-1.659.753z"/>
                        </svg>
                    </a>
                    <b>Add New vendor</b> 
                <!-- <h2>Add New vendor</h2> -->
            </div>
        </div>
        <!-- <div class="col-lg-6 margin-tb mr-sm-0">
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('vendors.index') }}"> 
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


    {!! Form::open(array('route' => 'vendors.store','method'=>'POST','enctype' => 'multipart/form-data')) !!}
    <div class="row">
	    <div class="col-xs-12 col-sm-12 col-md-12 mb-2">
	        <div class="form-group">
	            <strong>Vendor Name : </strong>
                {!! Form::text('vendor_name',null, array('placeholder' => 'vendor Name','class' => 'form-control')) !!}
	        </div>
	    </div>
	    <div class="col-xs-12 col-sm-12 col-md-12 mb-2">
            <div class="form-group">
                <strong>Store Name : </strong>
                {!! Form::text('store_name',null, array('placeholder' => 'Store Name','class' => 'form-control')) !!}
	        </div>
	    </div>
        <div class="col-xs-12 col-sm-12 col-md-12 mb-2">
            <div class="form-group">
                <strong>Vendor Email : </strong>
                {!! Form::email('vendor_email',null, array('placeholder' => 'Vendor Email','class' => 'form-control')) !!}
	        </div>
	    </div>
        <div class="col-xs-12 col-sm-12 col-md-12 mb-2">
            <div class="form-group">
                <strong>Vendor Phone : </strong>
                {!! Form::text('vendor_phone',null, array('placeholder' => 'Vendor Phone','class' => 'form-control')) !!}
	        </div>
	    </div>
        <div class="col-xs-12 col-sm-12 col-md-12 mb-2">
            <div class="form-group">
                <strong>Vendor Password : </strong>
                {!! Form::text('vendor_password',null, array('placeholder' => 'Vendor Password','class' => 'form-control')) !!}
	        </div>
	    </div>
        <div class="col-xs-12 col-sm-12 col-md-12 mb-2">
            <div class="form-group">
                <strong>Vendor Address : </strong>
                {!! Form::text('vendor_address',null, array('placeholder' => 'Vendor Address','class' => 'form-control')) !!}
	        </div>
	    </div>
        <div class="col-xs-6 col-sm-6 col-md-6 mb-2">
            <div class="form-group">
                <strong>City : </strong>
                    <select name="city_id" id="city_id" class="form-control" required>
                        <option value="">Select City</option>
                        @foreach($cities as $city )
                            <option value="{{ $city->id }}">{{$city->city_name}}</option>
                        @endforeach
                    </select>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 mb-2">
            <div class="form-group">
                <strong>Vendor Pincode : </strong>
                {!! Form::text('vendor_pincode',null, array('placeholder' => 'Vendor Pincode','class' => 'form-control')) !!}
	        </div>
	    </div>
        <div class="col-xs-12 col-sm-12 col-md-12 mb-2">
            <div class="form-group">
                <strong>GST Number : </strong>
                {!! Form::text('gst_number',null, array('placeholder' => 'GST Number','class' => 'form-control')) !!}
	        </div>
	    </div>
        <div class="col-xs-12 col-sm-12 col-md-12 mb-2">
            <div class="form-group">
                <strong>Vendor Image:</strong>
                {!! Form::File('vendor_image', array('placeholder' => 'Vendor Image','class' => 'form-control')) !!}
            </div>
        </div>
		<div class="col-xs-12 col-sm-12 col-md-12 text-center">
		    <button type="submit" class="btn btn-primary">Submit</button>
		</div>
	</div>

@endsection



       