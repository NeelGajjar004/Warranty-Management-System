@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb mb-3">
        <div class="pull-left">
            <h2>Categorys List</h2>
        </div>
        @can('category-create')
        <div class="pull-right mb-3">
            <a class="btn btn-success" href="{{ route('categorys.create') }}"> Create New category</a>
        </div>
        @endcan
    </div>
</div>

@if ($message = Session::get('success'))
<div class="alert alert-success">
  <p>{{ $message }}</p>
</div>
@endif

<table class="table table-bordered">
 <tr>
   <th>No</th>
   <th>Category ID</th>
   <th>Category Image</th>
   <th>Category Name</th>
   <th>Parent Category id</th>
   <th>Sort Category</th>
   <th>Status</th>
   <th width="280px">Action</th>
 </tr>
 @foreach ($data as $key => $category)
  <tr>
    <td>{{ ++$i }}</td>
    <td>{{ $category->id }}</td>
    <td>
      @if($category->category_image != '' && file_exists(public_path().'/uploads/category/'.$category->category_image))
            <img src="{{ url('uploads/category/'.$category->category_image) }}" alt="" width="105" height="65" class="rounded-sqaur">
      @else
            <img src="{{ url('assets/images/no-image.png') }}" alt="" width="55" height="45"  class="rounded-circle">                        
      @endif
    </td>
    <td>{{ $category->category_name }}</td>
    <td>{{ $category->parent_category_id }}</td>
    <td>{{ $category->sort_category }}</td>
    <td>
      <form action="{{ route('categorys.update',$category->id) }}" method="POST">
        @csrf
        @method('PATCH')
        <input type="hidden" name="Active" Value="1">
        <input type="hidden" name="IsActive" Value="{{ $category->IsActive }}">
        @if($category->IsActive)
        <button type="submit" class="btn btn-small btn-outline-success">
          <i class="fa fa-toggle-on fa-sm text-success"></i>&nbsp;Active
        </button>
        @else
        <button type="submit" class="btn btn-small btn-outline-danger" title="Make Active">
          <i class="fa fa-toggle-on fa-sm text-danger"></i>&nbsp;InActive
        </button>
        @endif
      </form>
    </td>
    <td>
       <a class="btn btn-info" href="{{ route('categorys.show',$category->id) }}">Show</a>
       @can('category-edit')
       <a class="btn btn-primary" href="{{ route('categorys.edit',$category->id) }}">Edit</a>
       @endcan
       @can('category-delete')
       {!! Form::open(['method' => 'DELETE','route' => ['categorys.destroy', $category->id],'style'=>'display:inline']) !!}
        {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
       {!! Form::close() !!}
       @endcan
    </td>
  </tr>
 @endforeach
</table>

{!! $data->render() !!}

@endsection