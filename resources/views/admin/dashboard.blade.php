@extends('layouts.app')


@section('content')
<div class="container">
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
    <h4>Dashboard</h4>
</h2>
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-body">
            Bonjour {{ Auth::user()->nom }}


@endsection
