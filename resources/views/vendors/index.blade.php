@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Vendor</h2>
            </div>
            <div class="pull-right mb-3">
                @can('vendor-create')
                <a class="btn btn-success" href="{{ route('vendors.create') }}"> Add New Vendor</a>
                @endcan
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css"></link>
    
    <table class="table table-bordered" id="tbl">
        <thead>
            <tr>
                <th>No</th>
                <th>Image</th>
                <th>Name</th>
                <th>Store Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>City</th>
                <th>GST Number</th>
                <th>Company</th>
                <th>Status</th>
                <th width="280px">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($vendors as $vendor)
            <tr>
                <td>{{ ++$i }}</td>
                <td>
                    @if($vendor->vendor_image != '' && file_exists(public_path().'/uploads/vendor/'.$vendor->vendor_image))
                    <img src="{{ url('uploads/vendor/'.$vendor->vendor_image) }}" alt="" width="75" height="60">
                    @else
                    <img src="{{ url('assets/images/no-image.png') }}" alt="" width="75" height="60" >                        
                    @endif
                </td>
                <td>{{ $vendor->vendor_name }}</td>
                <td>{{ $vendor->store_name }}</td>
                <td>{{ $vendor->vendor_email }}</td>
                <td>{{ $vendor->vendor_phone }}</td>
                <td>{{ $vendor['cities']['city_name'] }}</td>
                <td>{{ $vendor->gst_number }}</td>
                <td><a class="btn btn-info" href="{{ route('vencom',$vendor->id) }}">Company</a></td>
                <td>
                    <form action="{{ route('vendors.update',$vendor->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="Active" Value="1">
                        <input type="hidden" name="InActive" Value="{{ $vendor->IsActive }}">
                        @if($vendor->IsActive)
                        <button type="submit" class="btn btn-small btn-outline-success">
                            <i class="fa fa-toggle-on fa-sm text-success"></i>&nbsp;Active
                        </button>
                        @else
                        <button type="submit" class="btn btn-small btn-outline-danger" title="Make Active">
                            <i class="fa fa-toggle-on fa-sm text-danger"></i>&nbsp;InActive
                        </button>
                        @endif
                    </form>&nbsp;

                    <form action="{{ route('vendors.update',$vendor->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="Delete" Value="1">
                        <input type="hidden" name="Restore" Value="{{ $vendor->IsDelete }}">
                        @if($vendor->IsDelete)
                        <button type="submit" class="btn btn-small btn-outline-success">
                            <i class="fa fa-toggle-on fa-sm text-success"></i>&nbsp;Delete
                        </button>
                        @else
                        <button type="submit" class="btn btn-small btn-outline-danger" title="Make Restore">
                            <i class="fa fa-toggle-on fa-sm text-danger"></i>&nbsp;Restore
                        </button>
                        @endif
                    </form>&nbsp;

                    <form action="{{ route('vendors.update',$vendor->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="Verified" Value="1">
                        <input type="hidden" name="NotVerified" Value="{{ $vendor->IsVerified }}">
                        @if($vendor->IsVerified)
                        <button type="submit" class="btn btn-small btn-outline-success">
                            <i class="fa fa-toggle-on fa-sm text-success"></i>&nbsp;Verified
                        </button>
                        @else
                        <button type="submit" class="btn btn-small btn-outline-danger" title="Make Not Verified">
                            <i class="fa fa-toggle-on fa-sm text-danger"></i>&nbsp;NotVerified
                        </button>
                        @endif
                    </form>&nbsp;
                    
                        <form action="{{ route('vendors.update',$vendor->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="Block" Value="1">
                            <input type="hidden" name="UnBlock" Value="{{ $vendor->IsBlock }}">
                            @if($vendor->IsBlock)
                            <button type="submit" class="btn btn-small btn-outline-success">
                                <i class="fa fa-toggle-on fa-sm text-success"></i>&nbsp;Block
                            </button>
                            @else
                            <button type="submit" class="btn btn-small btn-outline-danger" title="Make restore">
                                <i class="fa fa-toggle-on fa-sm text-danger"></i>&nbsp;UnBlock
                            </button>
                            @endif
                        </form>
                    </td>
                    <td>
                        <form action="{{ route('vendors.destroy',$vendor->id) }}" method="POST">
                            <a class="btn btn-info" href="{{ route('vendors.show',$vendor->id) }}">Show</a>
                            @can('vendor-edit')
                            <a class="btn btn-primary" href="{{ route('vendors.edit',$vendor->id) }}">Edit</a>
                            @endcan
                            
                            @csrf
                            @method('DELETE')
                            @can('vendor-delete')
                            <button type="submit" class="btn btn-danger">Delete</button>
                            @endcan
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
    </table>

<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
<script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

<!-- <script>
    $(document).ready( function () {
    $('#tbl').DataTable();
});
</script> -->

    {!! $vendors->links() !!}

@endsection