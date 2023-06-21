@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb mb-3">
        <div class="pull-left">
            <h2>Company Details</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary mb-3" href="{{ route('companys.index') }}"> Back</a>
        </div>
    </div>
</div>

<div class="row text-center">
<div class="col-xs-12 col-sm-12 col-md-12 mb-3">
        <div class="form-group">
            <!-- <strong>Image:</strong> -->
            @if($company->company_logo != '' && file_exists(public_path().'/uploads/company/'.$company->company_logo))
                <img src="{{ url('uploads/company/'.$company->company_logo) }}" alt="" width="105" height="95">
            @else
                <img src="{{ url('assets/images/no-image.png') }}" alt="" width="105" height="95"  class="rounded-circle">                        
            @endif
        </div>
    </div>
    <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>Company Name : </strong>
        </div>
    </div>
    <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
            {{ $company->company_name }}
        </div>
    </div>
    <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>Company_Email : </strong>
        </div>
    </div>
    <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
            {{ $company->company_email }}
        </div>
    </div>
    <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>Company_phone : </strong>
        </div>
    </div>
    <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
            {{ $company->company_phone }}
        </div>
    </div>
    <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>Company_Address : </strong>
        </div>
    </div>
    <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
            {{ $company->company_address }}
        </div>
    </div>
    <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>Company_Description : </strong>
        </div>
    </div>
    <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
            {{$company->company_description}}
        </div>
    </div>
</div>
@endsection
