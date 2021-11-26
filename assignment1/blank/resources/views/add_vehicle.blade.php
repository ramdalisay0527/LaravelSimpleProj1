@extends('layouts.master')

@section('title')
  Add a Vehicle
@endsection

@section('content')
  <br>
  <h1> Add a Vehicle
  <form method="post" action="add_vehicle_action">
    {{csrf_field()}}
    <p>
    <label>Vehicle model</label>
    <input type="text" name="vehiclemodel">
    </p>

    <p>
    <label>Vehicle rego</label>
    <input type="text" name="vehiclerego">
    </p>

    <p>
    <label>Year of Model</label>
    <input type="text" name="vehiclemodelyear">
    </p>
    
    <p>
    <label>Vehicle Odomoter Reading</label>
    <input type="text" name="vehicleodometer">
    </p>

    <p>
    <label>Vehicle Color</label>
    <input type="text" name="vehiclecolor">
    </p>

    <p>
    <input type="submit" value="Add">
    </p>

  </form>

  @endsection