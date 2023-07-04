@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb mb-3">
        <div class="pull-left">
            <h2>Company</h2>
        </div>
        @can('company-create')
        <div class="pull-right mb-3">
            <a class="btn btn-success" href="{{ route('companys.create') }}">Add New Company</a>
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
   <th>logo</th>
   <th>Name</th>
   <th>Email</th>
   <th>Phone</th>
   <th>Address</th>
   <!-- <th>Description</th> -->
   <th>Status</th>
   <th width="280px">Action</th>
 </tr>
 @foreach ($data as $key => $company)
  <tr>
    <td>{{ ++$i }}</td>
    <td>
      @if($company->company_logo != '' && file_exists(public_path().'/uploads/company/'.$company->company_logo))
            <img src="{{ url('uploads/company/'.$company->company_logo) }}" alt="" width="70" height="60" class="square">
      @else
            <img src="{{ url('assets/images/no-image.png') }}" alt="" width="70" height="60"  class="rounded-circle">                        
      @endif
    </td>
    <td>{{ $company->company_name }}</td>
    <td>{{ $company->company_email }}</td>
    <td>{{ $company->company_phone }}</td>
    <td>{{ $company->company_address }}</td>
    <!-- <td>{{$company->company_description}}</td> -->
    <td>
      <form action="{{ route('companys.update',$company->id) }}" method="POST">
        @csrf
        @method('PATCH')
        <input type="hidden" name="Active" Value="1">
        <input type="hidden" name="IsActive" Value="{{ $company->IsActive }}">
        @if($company->IsActive)
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
       <a class="btn btn-info" href="{{ route('companys.show',$company->id) }}">Show</a>
       @can('company-edit')
       <a class="btn btn-primary" href="{{ route('companys.edit',$company->id) }}">Edit</a>
       @endcan
       @can('company-delete')
       {!! Form::open(['method' => 'DELETE','route' => ['companys.destroy', $company->id],'style'=>'display:inline']) !!}
        {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
       {!! Form::close() !!}
       @endcan
    </td>
  </tr>
 @endforeach
</table>

{!! $data->render() !!}

@endsection