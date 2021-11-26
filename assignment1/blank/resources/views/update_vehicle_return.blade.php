@extends('layouts.master')

@section('title')
  Update a Vehicle
@endsection

@section('content')
  <br>
  <h1> Update a Vehicle </h1>
  
  <form method="post" action="{{url("return_vehicle_action")}}">
    {{csrf_field()}}
    <input type = "hidden" name="vehicle_id" value="{{$vehicle_booking_id}}">
    <input type = "hidden" name="booking_id" value="{{$booking_id}}">
    
    <p>
    <label>Enter Distance Travelled </label>
    <input type="text" name="distancetravelled" value="">
    </p>

    <p>
    <input type="submit" value="Update">
    </p>

  </form>

@endsection