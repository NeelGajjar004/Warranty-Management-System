@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Show Vendor</h2>
            </div>
            <div class="pull-right mb-3">
                <a class="btn btn-primary" href="{{ route('vendors.index') }}"> Back</a>
            </div>
        </div>
    </div>

    <div class="row text-center">
        <div class="col-xs-12 col-sm-12 col-md-12 mb-4">
            <div class="form-group">
                <!-- <strong>vendor Name : </strong> -->
                @if($vendor->vendor_image != '' && file_exists(public_path().'/uploads/vendor/'.$vendor->vendor_image))
                    <img src="{{ url('uploads/vendor/'.$vendor->vendor_image) }}" alt="" width="105" height="95">
                @else
                    <img src="{{ url('assets/images/no-image.png') }}" alt="" width="105" height="95" >                        
                @endif
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6 mb-2">
            <div class="form-group">
                <strong>Vendor Name : </strong>
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>{{ $vendor->vendor_name }}</strong>
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6 mb-2">
            <div class="form-group">
                <strong>Store Name : </strong>
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>{{ $vendor->store_name }}</strong>
            </div>
        </div>

        <div class="col-xs-6 col-sm-6 col-md-6 mb-2">
            <div class="form-group">
                <strong>Vendor Email : </strong>
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>{{ $vendor->vendor_email }}</strong>
            </div>
        </div>
	  <div class="col-xs-6 col-sm-6 col-md-6 mb-2">
            <div class="form-group">
                <strong>Vendor Phone : </strong>
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>{{ $vendor->vendor_phone }}</strong>
            </div>
        </div>     
        <div class="col-xs-6 col-sm-6 col-md-6 mb-2">
            <div class="form-group">
                <strong>Vendor Password : </strong>
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>{{ $vendor->vendor_password }}</strong>
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6 mb-2">
            <div class="form-group">
                <strong>Vendor Address : </strong>
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>{{ $vendor->vendor_address }}</strong>
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6 mb-2">
            <div class="form-group">
                <strong>City : </strong>
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>{{ $vendor['cities']['city_name'] }}</strong>
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6 mb-2">
            <div class="form-group">
                  <strong>Vendor Pincode : </strong>
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>{{ $vendor->vendor_pincode }}</strong>
                </div>
          </div>
        <div class="col-xs-6 col-sm-6 col-md-6 mb-2">
              <div class="form-group">
                  <strong>GST Number : </strong>
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>{{ $vendor->gst_number }}</strong>
                </div>
            </div>
        </div>
@endsection