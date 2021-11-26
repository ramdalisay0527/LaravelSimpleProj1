@extends('layouts.master')

@section('title')
  Welcome to Carsales
@endsection

@section('content')
<h1> Vehicles </h1>

  @if ($vehicles)
    <table class="bordered">
    <thead>
      <tr><th>Rego</th><th>Model</th><th>Modelyear</th><th>Odometer</th><th>Color</th><th>No. Of Bookings</th></tr>
    </thead>
    <tbody>
      @foreach($vehicles as $vehicle) 
        <tr>
        <td>{{$vehicle->rego}}</td>
        <td>{{$vehicle->model}}</td>
        <td>{{$vehicle->modelyear}}</td>
        <td>{{$vehicle->odometer}}</td>
        <td>{{$vehicle->color}}</td>
        <td>{{$vehicle->bookingcount}}</td>
        </tr>
      @endforeach
    </tbody>
    </table> 
    
  @else
    No vehicle found 
  @endif



@endsection