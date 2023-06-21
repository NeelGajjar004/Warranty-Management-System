@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb mb-3">
        <div class="pull-left">
            <h2>Edit Category Details</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('categorys.index') }}"> Back</a>
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

{!! Form::model($category, ['method' => 'PATCH','enctype' => 'multipart/form-data','route' => ['categorys.update', $category->id]]) !!}
<div class="row">
<div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Category Name : </strong>
            {!! Form::text('category_name',null, array('placeholder' => 'Category Name','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Parent_Category_id : </strong>
            {!! Form::text('parent_category_id',null, array('placeholder' => 'Parent_Category_id','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Sort Category : </strong>
            {!! Form::text('sort_category',null, array('placeholder' => 'Sort category','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 mb-1">
        <div class="form-group">
            <strong>category Image:</strong>
            {!! Form::File('category_image', array('class' => 'form-control')) !!}
        </div>
    </div>
        <div class="pt-3">
            @if($category->category_image != '' && file_exists(public_path().'/uploads/category/'.$category->category_image))
                <img src="{{ url('uploads/category/'.$category->category_image) }}" alt="" width="105" height="90">
            @endif
        </div>
    </div>
    
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>
{!! Form::close() !!}

@endsection