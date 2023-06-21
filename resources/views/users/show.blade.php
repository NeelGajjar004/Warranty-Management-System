@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb mb-3">
        <div class="pull-left">
            <h2>User Profile</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary mb-2" href="{{ route('users.index') }}"> Back</a>
        </div>
    </div>
</div>

<div class="row text-center">
<div class="col-xs-12 col-sm-12 col-md-12 mb-3">
        <div class="form-group">
            <!-- <strong>Image:</strong> -->
            @if($user->image != '' && file_exists(public_path().'/uploads/user/'.$user->image))
                <img src="{{ url('uploads/user/'.$user->image) }}" alt="" width="105" height="95" >
            @else
                <img src="{{ url('assets/images/no-image.png') }}" alt="" width="105" height="95"  class="rounded-circle">                        
            @endif
        </div>
    </div>
    <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>Name:</strong>
        </div>
    </div>
    <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
            {{ $user->user_name }}
        </div>
    </div>
    <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>Email:</strong>
        </div>
    </div>
    <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
            {{ $user->email }}
        </div>
    </div>
    <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>Phone:</strong>
        </div>
    </div>
    <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
            {{ $user->phone }}
        </div>
    </div>
    <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>Address:</strong>
        </div>
    </div>
    <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
            {{ $user->address }}
        </div>
    </div>
    <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>Roles:</strong>
        </div>
    </div>
    <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
            @if(!empty($user->getRoleNames()))
                @foreach($user->getRoleNames() as $v)
                    <label class="">{{ $v }}</label>
                @endforeach
            @endif
        </div>
    </div>
</div>
@endsection