@extends('layouts.master1')

@section('title')
  Add a Vehicle
@endsection

@section('content')
  <br>
  <h1> Sorry, Booking date and time already exists </h1><br>
  <a href= "{{url("vehicle_booking")}}">Try Again</a>
 

  @endsection