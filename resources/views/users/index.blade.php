@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb mb-3">
        <div class="pull-left">
            <h2>User Management</h2>
        </div>
        @can('user-create')
        <div class="pull-right">
            <a class="btn btn-success" href="{{ route('users.create') }}"> Create New User</a>
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
   <th>Image</th>
   <th>Name</th>
   <th>Email</th>
   <th>Phone</th>
   <th>Address</th>
   <th>Roles</th>
   <th>Status</th>
   <th width="280px">Action</th>
 </tr>
 @foreach ($data as $key => $user)
  <tr>
    <td>{{ ++$i }}</td>
    <td>
      @if($user->image != '' && file_exists(public_path().'/uploads/user/'.$user->image))
                <img src="{{ url('uploads/user/'.$user->image) }}" alt="" width="55" height="45" class="rounded-circle">
      @else
            <img src="{{ url('assets/images/no-image.png') }}" alt="" width="55" height="45"  class="rounded-circle">                        
      @endif
    </td>
    <td>{{ $user->user_name }}</td>
    <td>{{ $user->email }}</td>
    <td>{{ $user->phone }}</td>
    <td>{{ $user->address }}</td>
    <td>
      @if(!empty($user->getRoleNames()))
        @foreach($user->getRoleNames() as $v)
           <label class="">{{ $v }}</label>
        @endforeach
      @endif
    </td>
    <td>
      <form action="{{ route('users.update',$user->id) }}" method="POST">
        @csrf
        @method('PATCH')
        <input type="hidden" name="Active" Value="1">
        <input type="hidden" name="IsActive" Value="{{ $user->IsActive }}">
        @if($user->IsActive)
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
       <a class="btn btn-info" href="{{ route('users.show',$user->id) }}">Show</a>
       @can('user-edit')
       <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">Edit</a>
       @endcan
       @can('user-delete')
       {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
        {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
       {!! Form::close() !!}
       @endcan
    </td>
  </tr>
 @endforeach
</table>

{!! $data->render() !!}

@endsection