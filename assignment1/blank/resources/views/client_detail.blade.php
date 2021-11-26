@extends('layouts.master1')

@section('title')
  Car Details
@endsection

@section('content')

<!-- show vehicle details -->
  <br><br>
  <h1>{{$client->clientname}}</h1>
  <p>Age: {{$client->clientage}}</p>
  <p>License No.: {{$client->clientlicense}}</p>
  <p>License Type: {{$client->clientlicensetype}}</p>
  <p>State: {{$client->clientstate}}</p>

  <!-- <a href= "{{url("client_delete/$client->id")}}">Delete Item</a> <br>
  <a href= "{{url("client_update/$client->id")}}">Update Item</a> <br> -->
  <a href= "{{url("/")}}">Back</a>
 
@endsection