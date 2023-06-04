@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Vendor</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('vendors.index') }}"> Back</a>
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

    {!! Form::model($vendor, ['method' => 'PATCH','enctype' => 'multipart/form-data','route' => ['vendors.update', $vendor->id]]) !!}
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
                            @if($vendor['city_id'] == $city->id)
                                <option value="{{ $city->id }}" selected>{{$city->city_name}}</option>
                            @else
                                <option value="{{ $city->id }}" selected>{{$city->city_name}}</option>
                            @endif
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
            <div class="pt-3">
            @if($vendor->vendor_image != '' && file_exists(public_path().'/uploads/vendor/'.$vendor->vendor_image))
                <img src="{{ url('uploads/vendor/'.$vendor->vendor_image) }}" alt="" width="105" height="95">
            @endif
            </div>
        </div>
		<div class="col-xs-12 col-sm-12 col-md-12 text-center">
		    <button type="submit" class="btn btn-primary">Submit</button>
		</div>
	</div>
    {!! Form::close() !!}

@endsection