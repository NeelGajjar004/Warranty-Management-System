@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb mb-3">
        <div class="pull-left">
            <h2>Company Owned Vendor</h2>
        </div>
        <div class="pull-right mb-3">
                <a class="btn btn-success" href="{{ route('vencoms.create') }}">Assign New Vendor</a>
        </div>
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
     <th>Vendor</th>
     <th>Company</th>
     <th width="280px">Action</th>
  </tr>
    @if(!empty($vencoms))
        @foreach ($vencoms as $key => $vencom)
        <tr>
            <td>{{ ++$i }}</td>
            
            <td>
                {{$vencom->vendor_name}}
            </td>
            
            <td>
                {{$vencom->company_name}}
            </td>

            <td>
                <a class="btn btn-primary" href="{{ route('vencoms.edit',$vencom->vendor_id,$vencom->company_id) }}">Edit</a>
                {!! Form::open(['method' => 'DELETE','route' => ['vencoms.destroy',$vencom->vendor_id,$vencom->company_id],'style'=>'display:inline']) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                {!! Form::close() !!}
            </td>
        </tr>
        @endforeach
    @endif
</table>


@endsection