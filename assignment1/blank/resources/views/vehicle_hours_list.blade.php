@extends('layouts.master')

@section('title')
  Welcome to Carsales
@endsection

@section('content')

  
<h1> Vehicle Booking Hours List Sorted </h1>

@if ($regoandhours)
    <ul>
<!-- show all vehicle models and rego in a list -->
    @foreach($regoandhours as $regoandhours)
      <li> {{$regoandhours->rego}} | {{$regoandhours->hoursbooking}} Hours booked</a> </li>
    @endforeach
    </ul>
  @else
    No vehicle found 
  @endif
 




@endsection