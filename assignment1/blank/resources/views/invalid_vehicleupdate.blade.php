@extends('layouts.master1')

@section('title')
  Add a Vehicle
@endsection

@section('content')
  <br>
  <h1> Invalid Rego No. </h1><br>
  <a href= "{{url("vehicle_update/$id")}}">Try Again</a>
 

  @endsection