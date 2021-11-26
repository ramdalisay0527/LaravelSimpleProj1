@extends('layouts.master')

@section('title')
  All Clients
@endsection

@section('content')
<h1> Clients </h1>


  @if ($clients)
    <ul>
    @foreach($clients as $clients)
    <li><a href= "{{url("client_detail/$clients->id")}}"> {{$clients->clientname}} </a> </li>
    <!-- <p> {{$clients->clientname}} | {{$clients->clientage}} | {{$clients->clientlicense}} | {{$clients->clientlicensetype}} | {{$clients->clientstate}}  </p> -->
    @endforeach
    </ul>
  @else
    No client found
  @endif
 
 
@endsection