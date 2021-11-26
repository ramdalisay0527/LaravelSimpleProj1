@extends('layouts.master')

@section('title')
  Welcome to Carsales
@endsection

@section('content')
<h1> Vehicles </h1>

  @if ($vehicles)
    <ul>
<!-- show all vehicle models and rego in a list -->
    @foreach($vehicles as $vehicle)
      <li><a href= "{{url("vehicle_detail/$vehicle->id")}}"> {{$vehicle->rego}} | {{$vehicle->model}}</a> </li>
    @endforeach
    </ul>
  @else
    No vehicle found 
  @endif


@endsection