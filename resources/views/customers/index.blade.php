@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb mb-3">
            <div class="pull-left">
                <h2>Customers List</h2>
            </div>
            <div class="pull-right mb-3">
                @can('customer-create')
                <a class="btn btn-success" href="{{ route('customers.create') }}"> Add New customer</a>
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
                <th>ID</th>
                <th>Customer Image</th>
                <th>Customer Name</th>
                <th>Customer Email</th>
                <th>Customer Phone</th>
                <th>Customer Password</th>
                <th>DOB</th>
                <!-- <th>Date Of Birth</th> -->
                <th>Country</th>
                <th>State</th>
                <th>City</th>
                <th>Status</th>
                <th width="280px">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($customers as $customer)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $customer->id }}</td>
                <td>
                    @if($customer->customer_image != '' && file_exists(public_path().'/uploads/customer/'.$customer->customer_image))
                    <img src="{{ url('uploads/customer/'.$customer->customer_image) }}" alt="" width="55" height="45">
                    @else
                    <img src="{{ url('assets/images/no-image.png') }}" alt="" width="55" height="45" >                        
                    @endif
                </td>
                <td>{{ $customer->customer_name }}</td>
                <td>{{ $customer->customer_email }}</td>
                <td>{{ $customer->customer_phone }}</td>
                <td>{{ $customer->customer_password }}</td>
                <td>{{ $customer->date_of_birth }}</td>
                <td>{{ $customer['countrys']['country_name'] }}</td>
                <td>{{ $customer['states']['state_name'] }}</td>
                <td>{{ $customer['cities']['city_name'] }}</td>
                <td>
                    <form action="{{ route('customers.update',$customer->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="Active" Value="1">
                        <input type="hidden" name="InActive" Value="{{ $customer->IsActive }}">
                        @if($customer->IsActive)
                        <button type="submit" class="btn btn-small btn-outline-success">
                            <i class="fa fa-toggle-on fa-sm text-success"></i>&nbsp;Active
                        </button>
                        @else
                        <button type="submit" class="btn btn-small btn-outline-danger" title="Make Active">
                            <i class="fa fa-toggle-on fa-sm text-danger"></i>&nbsp;InActive
                        </button>
                        @endif
                    </form>&nbsp;

                    <form action="{{ route('customers.update',$customer->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="Delete" Value="1">
                        <input type="hidden" name="Restore" Value="{{ $customer->IsDelete }}">
                        @if($customer->IsDelete)
                        <button type="submit" class="btn btn-small btn-outline-success">
                            <i class="fa fa-toggle-on fa-sm text-success"></i>&nbsp;Delete
                        </button>
                        @else
                        <button type="submit" class="btn btn-small btn-outline-danger" title="Make Restore">
                            <i class="fa fa-toggle-on fa-sm text-danger"></i>&nbsp;Restore
                        </button>
                        @endif
                    </form>
                    </td>
                    <td>
                        <form action="{{ route('customers.destroy',$customer->id) }}" method="POST">
                            <a class="btn btn-info" href="{{ route('customers.show',$customer->id) }}">Show</a>
                            @can('customer-edit')
                            <a class="btn btn-primary" href="{{ route('customers.edit',$customer->id) }}">Edit</a>
                            @endcan
                            
                            @csrf
                            @method('DELETE')
                            @can('customer-delete')
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

    {!! $customers->links() !!}

@endsection