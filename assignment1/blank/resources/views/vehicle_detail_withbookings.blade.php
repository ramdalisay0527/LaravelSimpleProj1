@extends('layouts.master')

@section('title')
  Car Details
@endsection

@section('content')

<!-- show vehicle details -->


  <br><br>
  <h1>{{$vehicle->model}}</h1>
  <p>Rego: {{$vehicle->rego}}</p>
  <p>Year of Model: {{$vehicle->modelyear}}</p>
  <p>Odometer reading: {{$vehicle->odometer}}</p>
  <p>Color: {{$vehicle->color}}</p>

  <br><br>



  
  
  
  <a href= "{{url("vehicle_viewbookings/$vehicle->id")}}">View Vehicle Bookings</a> <br>
  <a href= "{{url("vehicle_delete/$vehicle->id/$vehicle->rego")}}">Delete Item</a> <br>
  <a href= "{{url("vehicle_update/$vehicle->id")}}">Update Item</a> <br>
  <a href= "{{url("/")}}">Back</a>
 
@endsection