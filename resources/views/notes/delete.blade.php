@extends('layouts.master')
@section('title', 'Delete a note')
@section('content')
    <ul class="breadcrumb">
        <li>{!! link_to_route('home.index', 'Home ') !!}</li>
        <li>{!! link_to_route('note.index', 'Note Management') !!}</li>
        <li class="active">Delete</li>
    </ul>
        {{ Form::model($note, ['url' => route('note.destroy', ['note' => $note]), 'method' => 'delete']) }}
        {{ Form::hidden('id', null) }}
    <div class="panel panel-default">
        <div class="panel-heading">
            <a href="{{ route('note.index') }}" class="ui button" data-ng-cloak>Note</a>
            </div>
            <div class="panel-body">
                @if($errors->has('id'))
                    <p class="alert alert-info">{{ $errors->first('id') }}</p>
                @else
                    <p>Do you really want to delete this ({{ $note->title }}) ?</p>
                @endif
            </div>
            <div class="panel-footer">
                <a href="{{ route('note.index') }}" class="ui button" data-ng-cloak>Cancel</a>
                <button class="ui right floated red button" type="submit">Delete</button>
            </div>
        </div>
    {{ Form::close() }}
@endsection