@extends('layouts.app')

@section('content')

<div class="container-fluid">
    @isset($success)
<div class="col-md-6 alert alert-success alert-dismissible fade show">
    <strong>Successfully added employee details</strong>
    <button type="button" class="close" data-dismiss="alert">&times;</button>
</div>
@endisset
<h3 style="text-align:center;">Admin</h3>           

<a href="{{route('add-employee')}}">
    <div class="card">
        <h1>Add Employee</h1>
    </div>
</a>
<a href="{{route('get-employees')}}">
    <div class="card">
        <h1>Report</h1>
    </div>
</a>
@endsection

<style>
    .card {
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
    width: 320px;
    height: auto;
    margin: 5px;
    padding: 10px;
    float:left;
    text-align: center;
    font-family: arial;
    text-transform: capitalize;
  }
  
  .price {
    color: grey;
    font-size: 22px;
  }
  
  .card button {
    border: none;
    outline: 0;
    padding: 12px;
    color: white;
    background-color: #000;
    text-align: center;
    cursor: pointer;
    width: 100%;
    font-size: 18px;
  }
  
  .card button:hover {
    opacity: 0.7;
  }
</style>