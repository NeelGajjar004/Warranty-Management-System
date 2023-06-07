@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Show Customer</h2>
            </div>
            <div class="pull-right mb-3">
                <a class="btn btn-primary" href="{{ route('customers.index') }}"> Back</a>
            </div>
        </div>
    </div>

    <div class="row text-center">
        <div class="col-xs-12 col-sm-12 col-md-12 mb-4">
            <div class="form-group">
                <!-- <strong>customer Name : </strong> -->
                @if($customer->customer_image != '' && file_exists(public_path().'/uploads/customer/'.$customer->customer_image))
                    <img src="{{ url('uploads/customer/'.$customer->customer_image) }}" alt="" width="105" height="95">
                @else
                    <img src="{{ url('assets/images/no-image.png') }}" alt="" width="105" height="95" >                        
                @endif
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6 mb-2">
            <div class="form-group">
                <strong>Customer Name : </strong>
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>{{ $customer->customer_name }}</strong>
            </div>
        </div>
        
        <div class="col-xs-6 col-sm-6 col-md-6 mb-2">
            <div class="form-group">
                <strong>Customer Email : </strong>
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>{{ $customer->customer_email }}</strong>
            </div>
        </div>
	    <div class="col-xs-6 col-sm-6 col-md-6 mb-2">
            <div class="form-group">
                <strong>Customer Phone : </strong>
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>{{ $customer->customer_phone }}</strong>
            </div>
        </div>     
        <div class="col-xs-6 col-sm-6 col-md-6 mb-2">
            <div class="form-group">
                <strong>Customer Password : </strong>
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>{{ $customer->customer_password }}</strong>
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6 mb-2">
            <div class="form-group">
                <strong>Date Of Birth : </strong>
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>{{ $customer->date_of_birth }}</strong>
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6 mb-2">
            <div class="form-group">
                <strong>Country : </strong>
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>{{ $customer['countrys']['country_name'] }}</strong>
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6 mb-2">
            <div class="form-group">
                <strong>State : </strong>
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>{{ $customer['states']['state_name'] }}</strong>
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6 mb-2">
            <div class="form-group">
                <strong>City : </strong>
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>{{ $customer['cities']['city_name'] }}</strong>
            </div>
        </div>
    </div>
@endsection