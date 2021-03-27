@extends('layouts.app')

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type=text/javascript> $(document).ready(function() { $('#country').change(function(){ console.log("state changed"); var countryID=$(this).val(); if(countryID){ $.ajax({ type:"GET", url:"{{url('get-state-list')}}?country_id="+countryID,
            success:function(res){        
                if(res){
                    $(" #state").empty(); $("#designation").empty(); $("#state").append('<option>Select State</option>');
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

    <h3 style="text-align:center;">Add Employee</h3>

    <ul class="breadcrumb">
        <li><a href="{{route('all')}}">Home </a></li> /
        <li>Add Employee</li>
    </ul>

    <div class="container">
        <form class="form-horizontal" method="POST" action="{{route('create-employee')}}">
            {{ csrf_field() }}

            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="name">Name:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="email">Email:</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" name="email" id="email" placeholder="Enter Email" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="doj">DOJ:</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" name="doj" id="doj" placeholder="Enter DOJ" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="dob">DOB:</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" name="dob" id="dob" placeholder="Enter DOB" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="doj">Age:</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" name="age" id="age" placeholder="Select DOB for Age" readonly required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="doj">Country:</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="country_id" id="country" required>
                                    <option value="">Select Country</option>
                                    @foreach($countries as $country)
                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="state">State:</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="state_id" id="state" required>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="doj">Designation:</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="designation_id" id="designation" required>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="dob">Department:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="department" id="dob" placeholder="Enter Department Name" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="col-md-2 offset-md-5">
                    <div class="form-group">
                        <input type="submit" class="btn btn-success" value="Submit">
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection