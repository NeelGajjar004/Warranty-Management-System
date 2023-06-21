@extends('layouts.app')

@section('content')
    <div class="row mb-3">
        <div class="col-lg-6 margin-tb mb-3">
            <div class="pull-left">
                    <a class="btn btn-primary" href="{{ route('customers.index') }}"> 
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-left" viewBox="0 0 16 16">
                            <path d="M10 12.796V3.204L4.519 8 10 12.796zm-.659.753-5.48-4.796a1 1 0 0 1 0-1.506l5.48-4.796A1 1 0 0 1 11 3.204v9.592a1 1 0 0 1-1.659.753z"/>
                        </svg>
                    </a>
                    <b>Add New Customer</b> 
                <!-- <h2>Add New customer</h2> -->
            </div>
        </div>
        <!-- <div class="col-lg-6 margin-tb mr-sm-0">
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('customers.index') }}"> 
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-left" viewBox="0 0 16 16">
                        <path d="M10 12.796V3.204L4.519 8 10 12.796zm-.659.753-5.48-4.796a1 1 0 0 1 0-1.506l5.48-4.796A1 1 0 0 1 11 3.204v9.592a1 1 0 0 1-1.659.753z"/>
                    </svg>
                </a>
            </div>
        </div>   -->
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    {!! Form::open(array('route' => 'customers.store','method'=>'POST','enctype' => 'multipart/form-data')) !!}
    <div class="row">
	    <div class="col-xs-12 col-sm-12 col-md-12 mb-2">
	        <div class="form-group">
	            <strong>Customer Name : </strong>
                {!! Form::text('customer_name',null, array('placeholder' => 'Customer Name','class' => 'form-control')) !!}
	        </div>
	    </div>
	    
        <div class="col-xs-12 col-sm-12 col-md-12 mb-2">
            <div class="form-group">
                <strong>Customer Email : </strong>
                {!! Form::email('customer_email',null, array('placeholder' => 'Customer Email','class' => 'form-control')) !!}
	        </div>
	    </div>
        <div class="col-xs-12 col-sm-12 col-md-12 mb-2">
            <div class="form-group">
                <strong>Customer Phone : </strong>
                {!! Form::text('customer_phone',null, array('placeholder' => 'Customer Phone','class' => 'form-control')) !!}
	        </div>
	    </div>
        <div class="col-xs-12 col-sm-12 col-md-12 mb-2">
            <div class="form-group">
                <strong>Customer Password : </strong>
                {!! Form::text('customer_password',null, array('placeholder' => 'Customer Password','class' => 'form-control')) !!}
	        </div>
	    </div>
        <div class="col-xs-4 col-sm-4 col-md-4 mb-2">
            <div class="form-group">
                <strong>Date Of Birth : </strong>
                {!! Form::date('date_of_birth',null, array('placeholder' => 'Date Of Birth','class' => 'form-control')) !!}
	        </div>
	    </div><div class="col-xs-8 col-sm-8 col-md-8 mb-2"></div>
        <div class="col-xs-4 col-sm-4 col-md-4 mb-2">
            <div class="form-group">
                <strong>Country : </strong>
                    <select name="country_id" id="country_id" class="form-control" required>
                        <option value="">Select Country</option>
                        @if(!empty($countrys))
                            @foreach($countrys as $country )
                                <option value="{{ $country->id }}">{{$country->country_name}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
            <div class="col-xs-4 col-sm-4 col-md-4 mb-2">
                <div class="form-group">
                    <strong>State : </strong>
                    <select name="state_id" id="state_id" class="form-control" required>
                        <option value="">Select State</option>
                    </select>
                </div>
            </div>
            <div class="col-xs-4 col-sm-4 col-md-4 mb-2">
                <div class="form-group">
                    <strong>City : </strong>
                    <select name="city_id" id="city_id" class="form-control" required>
                        <option value="">Select City</option>
                    </select>
            </div>
        </div>
        
        <div class="col-xs-12 col-sm-12 col-md-12 mb-2">
            <div class="form-group">
                <strong>Customer Image:</strong>
                {!! Form::File('customer_image', array('placeholder' => 'customer Image','class' => 'form-control')) !!}
            </div>
        </div>
		<div class="col-xs-12 col-sm-12 col-md-12 text-center">
		    <button type="submit" class="btn btn-primary">Submit</button>
		</div>
	</div>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
   });

    $(document).ready(function(){
        $("#country_id").change(function(){
            var countryid = $(this).val();

            if(countryid == "")
            {
               var countryid = 0;
            }

            $.ajax({
                url : '{{ url("/fetchstates/") }}/' + countryid,
                type : 'post',
                dataType : 'json',
                success:function(response){
                    $('#state_id').find('option:not(:first)').remove();
                    $('#city_id').find('option:not(:first)').remove();
                    if(response['states'].length > 0)
                    {
                        $.each(response['states'],function(key,value){
                            $('#state_id').append("<option value='" + value['id'] + "'>"+ value['state_name']+"</option>")
                        });
                    }
                }  
            });
        });


        $("#state_id").change(function(){
            var stateid = $(this).val();

            if(stateid == "")
            {
                var stateid = 0;
            }

            $.ajax({
                url : '{{ url("/fetchcities/") }}/' + stateid,
                type : 'post',
                dataType : 'json',
                success:function(response){
                    $('#city_id').find('option:not(:first)').remove();
                    if(response['cities'].length > 0)
                    {
                        $.each(response['cities'],function(key,value){
                            $('#city_id').append("<option value='" + value['id'] + "'>"+ value['city_name']+"</option>")
                        });
                    }
                }  
            });
        });





    });

</script>


@endsection



       