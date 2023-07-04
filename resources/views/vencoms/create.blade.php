@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Assign New Company</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('vendors.index') }}"> Back</a>
        </div>
    </div>
</div>

@if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
@endif

{!! Form::open(array('route' => 'vencoms.store','method'=>'POST')) !!}
<div class="row">
    <div class="col-xs-6 col-sm-6 col-md-6 mb-2">
        <div class="form-group">
            <strong>Vendors : </strong>
            <select name="vendor_id" id="vendor_id" class="form-control" required>
                <!-- <option value="">Select Vendor</option> -->
                <!-- @foreach($vendors as $vendor ) -->
                    <option value="{{ $vendor->id }}">{{$vendor->vendor_name}}</option>
                <!-- @endforeach -->
            </select>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Company:</strong>
            <br/>
            @foreach($companies as $company)
                <label>{{ Form::checkbox('companies[]', $company->id, false, array('class' => 'company')) }}
                {{ $company->company_name }}</label>
            <br/>
            @endforeach
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Allocate</button>
    </div>
</div>
{!! Form::close() !!}

@endsection