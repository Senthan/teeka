@extends('layouts.master')
@section('title', 'Create User')
@section('content')
    <ul class="breadcrumb">
        <li>{!! link_to_route('home.index', 'Home ') !!}</li>
        <li>{!! link_to_route('user.index', 'User management ') !!}</li>
        <li class="active">Create</li>
    </ul>
    {!! form()->open(['url' => route('user.store'), 'method' => 'POST']) !!}
    <div class="panel panel-default">
        <div class="panel-body">
            @include('users.form')
        </div>
        <div class="panel-footer">
            @include('admin.users.submit-btn', ['text' => 'Create', 'class' => 'green'])
        </div>
    </div>
    {!! form()->close() !!}
@endsection