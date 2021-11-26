@extends('layouts.master')

@section('title')
  Car Details
@endsection

@section('content')

<br><br><h1>Bookings for this Vehicle:</h1><br>
  @for ($x = 0; $x < $count; $x++)
    @if ($vehiclebookings[$x]->bookingreturned == 0)
    <p>Client name: {{$clientinfos[$x][0]->clientname}} | License Number: {{$clientinfos[$x][0]->clientlicense}} </p> 
      <p>Booking Date: {{$vehiclebookings[$x]->bookingdate}} | Booking Time: {{$vehiclebookings[$x]->bookingtime}}</p>
      <p>Return Date: {{$vehiclebookings[$x]->returndate}} | Return Time: {{$vehiclebookings[$x]->returntime}}</p>
      
      <p>Vehicle ID: {{$vehicle_booking_id = $vehiclebookings[$x]->vehiclebooking_id}} </p>
      <p>Booking ID: {{$booking_id = $vehiclebookings[$x]->booking_id}} </p>
      <a href = "{{url("vehicle_return/$vehicle_booking_id/$booking_id")}}"> Return Vehicle </a>
      <hr>
    @else
      <p> Booking No.: {{$booking_id = $vehiclebookings[$x]->booking_id}} has already been returned </p>
      <p></p>
      <hr>
    @endif
      
  @endfor 


<br><br>
<a href= "{{url("/")}}">Back</a>

  
  
  
  
 
@endsection