@extends('start.home-layout')

@section('title', 'Trading')

@section('content')
<h4>Energy Market List</h4>
<table id ="table1">
    <thead>
        <tr>
            <th>ID</th>
            <th>Type</th>
            <th>Volume</th>
            <th>Price</th>
            <th>Zone</th>
        </tr>
    </thead>
    <tbody>
        @foreach($home_searches as $home_search)
        <tr>
            <td>{{$home_search->id}}</td>
            <td>{{$home_search->type}}</td>
            <td>{{$home_search->volume}}</td>
            <td>{{$home_search->price}}</td>
            <td>{{$home_search->zone}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
<style>
    h4{
        color: #000080;
    }

    #table1 {
    font-family: Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 100%;
    }

    #table1 th{
        background-color: #87CEEB;
        color: #000000;
        font-weight: bold;
    }

    #table1 td, #table1 th {
        padding: 8px;
    }

    #table1 tr{
        border-bottom: 1px solid #ddd;
    }

    #table1 tr:nth-child(even){background-color: #D5FFFF;}    
</style>
@endsection