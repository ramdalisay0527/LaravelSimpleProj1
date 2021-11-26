@extends('layouts.master')

@section('title')
  Update a Vehicle
@endsection

@section('content')
  <br>
  <h1> Update a Vehicle </h1>
  <form method="post" action="{{url("update_vehicle_action")}}">
    {{csrf_field()}}
    <input type = "hidden" name="id" value="{{$vehicle->id}}">
    <p>
    <label>Vehicle model</label>
    <input type="text" name="vehiclemodel" value="{{$vehicle->model}}">
    </p>

    <p>
    <label>Vehicle rego</label>
    <input type="text" name="vehiclerego" value="{{$vehicle->rego}}">
    </p>

    <p>
    <label>Year of Model</label>
    <input type="text" name="vehiclemodelyear" value="{{$vehicle->modelyear}}">
    </p>
    
    <p>
    <label>Vehicle Odomoter Reading</label>
    <input type="text" name="vehicleodometer" value="{{$vehicle->odometer}}">
    </p>

    <p>
    <label>Vehicle Color</label>
    <input type="text" name="vehiclecolor" value="{{$vehicle->color}}">
    </p>

    <p>
    <input type="submit" value="Update">
    </p>

  </form>

  @endsection