@extends('layouts.master')

@section('title')
  Welcome to Carsales
@endsection

@section('content')

  <br>
  <h1> Add a Booking </h1>
  <form method="post" action="{{url("book_vehicle_action")}}">
    {{csrf_field()}}
    <label for="regos">Choose a Rego:</label>
    <select name="regos" id="regos">
      @foreach($vehicles as $vehicles)
      <option  value = "{{$vehicles->rego}}"> {{$vehicles->rego}} </option>
      @endforeach
    </select>
    <br>

    <label for="regos">Choose a name:</label>
    <select name="clients" ud="clients">
      @foreach($clients as $clients)
      <option value = "{{$clients->clientname}}"> {{$clients->clientname}} </option>
      @endforeach
    </select>
    <br>


    <p>
    <label>Date of Booking</label>
    <input type="text" name="bookingdate" value="YYYY-MM-DD">
    </p>

    <p>
    <label>Time of Booking</label>
    <input type="text" name="bookingtime" value="HH:MM:SS"> 
    </p>

    <p>
    <label>Date of Return</label>
    <input type="text" name="returndate" value="YYYY-MM-DD">
    </p>
    
    <p>
    <label>Time of Return</label>
    <input type="text" name="returntime" value="HH:MM:SS">
    </p>

    <p>
    <input type="submit" value="Book">
    </p>

  </form>



@endsection