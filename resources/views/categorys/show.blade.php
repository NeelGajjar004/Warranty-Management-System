@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb mb-3">
        <div class="pull-left">
            <h2>Category Details</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary mb-3" href="{{ route('categorys.index') }}"> Back</a>
        </div>
    </div>
</div>

<div class="row text-center">
    <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
        <div class="form-group">
            <!-- <strong>Image:</strong> -->
            @if($category->category_image != '' && file_exists(public_path().'/uploads/category/'.$category->category_image))
                <img src="{{ url('uploads/category/'.$category->category_image) }}" alt="" width="100" height="90" class="rounded-sqaur">
            @else
                <img src="{{ url('assets/images/no-image.png') }}" alt="" width="55" height="45"  class="rounded-circle">                        
            @endif
        </div>
    </div>
    <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>Category ID : </strong>
        </div>
    </div>
    <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
            {{ $category->id }}
        </div>
    </div>
    <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>Category Name : </strong>
        </div>
    </div>
    <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
            {{ $category->category_name }}
        </div>
    </div>
    <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>Parent Category Id : </strong>
        </div>
    </div>
    <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
            {{ $category->parent_category_id }}
        </div>
    </div>
    <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>Sort Category : </strong>
        </div>
    </div>
    <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
            {{ $category->sort_category }}
        </div>
    </div>
   
</div>
@endsection
