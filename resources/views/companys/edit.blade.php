@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Edit Comapny Details</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('companys.index') }}"> Back</a>
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

{!! Form::model($company, ['method' => 'PATCH','enctype' => 'multipart/form-data','route' => ['companys.update', $company->id]]) !!}
<div class="row">
<div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Company Name : </strong>
            {!! Form::text('company_name',null, array('placeholder' => 'Company Name','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Company Email : </strong>
            {!! Form::text('company_email',null, array('placeholder' => 'Company Email','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Company Phone : </strong>
            {!! Form::text('company_phone',null, array('placeholder' => 'Company Phone','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Company Address:</strong>
            {!! Form::text('company_address',null, array('placeholder' => 'Company Address','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Company Description:</strong>
            {!! Form::text('company_description',null, array('placeholder' => 'Company Description','class' => 'form-control')) !!}
        </div>
    </div>
    <!-- <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Password:</strong>
            {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Confirm Password:</strong>
            {!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control')) !!}
        </div>
    </div> -->
    <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
        <div class="form-group">
            <strong>Company Logo:</strong>
            {!! Form::File('company_logo', array('class' => 'form-control' ,'style' => 'display:inline;')) !!}
        </div>
        <!-- <div class="pt-3"> -->
            @if($company->company_logo != '' && file_exists(public_path().'/uploads/company/'.$company->company_logo))
                <img src="{{ url('uploads/company/'.$company->company_logo) }}" alt="" width="105" height="95">
            @endif
        <!-- </div> -->
    </div>
    
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>
{!! Form::close() !!}

@endsection