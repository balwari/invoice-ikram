@extends('layouts.app')

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type=text/javascript> $(document).ready(function() { $('#country').change(function(){ console.log("state changed"); var countryID=$(this).val(); if(countryID){ $.ajax({ type:"GET", url:"{{url('get-state-list')}}?country_id="+countryID,
            success:function(res){        
                if(res){
                    $(" #state").empty(); $("#designation").empty(); $("#state").append('<option value="">All</option>');
                    $.each(res,function(key,value){
                    $("#state").append('<option value="'+key+'">'+value+'</option>');
                    });
                } 
                else {
                    $("#state").empty();
                }
            }
        });
  }else{
    $("#state").empty();
    $("#designation").empty();
  }   
  });
  
  $('#state').on('change',function(){
  var stateID = $(this).val();  
  if(stateID){
    $.ajax({
      type:"GET",
      url:"{{url('get-designation-list')}}?state_id="+stateID,
      success:function(res){        
        if(res){
            $("#designation").empty();
            $.each(res,function(key,value){
            $("#designation").append('<option value="'+key+'">'+value+'</option>');
        });
      
      }else{
        $("#designation").empty();
      }
      }
    });
  }else{
    $("#designation").empty();
  }
    
  });
  $("#dob").change(function(){
    var birthDate = $(this).val();  
    birthDate = new Date(birthDate);
    var today = new Date();
    var age = today.getFullYear() - birthDate.getFullYear();
    var m = today.getMonth() - birthDate.getMonth();
    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
        age--;
    }
    document.getElementById('age').value = age;
});
});
</script>
<div class="container-fluid">
    <h3 style="text-align:center;">Report</h3>
    <ul class="breadcrumb">
        <li><a href="{{route('all')}}">Home </a></li> /
        <li>Report</li>
    </ul>
    <form class="form-horizontal" method="get" action="{{route('get-employees')}}">
        {{ csrf_field() }}
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="doj">Country:</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="country_id" id="country" required>
                                <option value="">All</option>
                                @foreach($countries as $country)
                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="state">State:</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="state_id" id="state" required>
                            <option value="">All</option>    
                        </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="doj">Designation:</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="designation_id" id="designation" required>
                            <option value="">All</option>    
                        </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label col-sm-4">Order By:</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="order_by" required>
                                <option value="">Select</option>
                                <option value="name">Name</option>
                                <option value="email">Email</option>
                                <option value="age">Age</option>
                                <option value="designation_id">Designation</option>
                                <option value="state_id">State</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label col-sm-4">Sort By:</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="sort_by" required>
                            <option value="">Select</option>    
                            <option value="asc">Ascending order</option>
                                <option value="desc">Descending order</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="col-md-4 offset-md-4">
                        <div class="form-group">
                            <input type="submit" class="btn btn-success" value="Submit">
                            <a href="{{route('get-employees')}}" style="margin-left:30px;background-color:black;padding:9px;color:white;"><span>Show All Designation Employees</span></a>
                        </div>
                    </div>
                </div>
    </form>

    <table class="table table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>DOJ</th>
                <th>DOB</th>
                <th>Age</th>
                <th>Designation</th>
                <th>State</th>
                <th>Country</th>
                <th>Department</th>
            </tr>
        </thead>
        <tbody>
            @foreach($employees as $employee)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $employee->name }}</td>
                <td>{{ $employee->email }}</td>
                <td>{{ $employee->doj }}</td>
                <td>{{ $employee->dob }}</td>
                <td>{{ $employee->age }}</td>
                <td>{{ $employee->designation_name }}</td>
                <td>{{ $employee->state_name }}</td>
                <td>{{ $employee->country_name }}</td>
                <td>{{ $employee->department }}</td>
            <tr>
                @endforeach
        </tbody>
    </table>
</div>
@endsection