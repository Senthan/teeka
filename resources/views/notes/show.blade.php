@section('title', $note->title)
@extends('layouts.master')

@section('content')
    <ul class="breadcrumb">
        <li>{!! link_to_route('home.index', 'Home ') !!}</li>
        <li>{!! link_to_route('note.index', 'Note Management') !!}</li>
        <li class="active">{{ $note->title }}</li>
    </ul>

    <div class="ui segments">
        <div class="ui segment clearfix">
            <h2 class="pull-left h2-margin-bottom">{{ $note->title }}</h2>
        </div>

        <div class="ui teal segment fafa">
            {!! $note->content !!}
        </div>

        <div class="ui segment clearfix">
            <a href="{{ route('note.index') }}" class="small ui black button">Cancel</a>
            <a href="{{ route('note.delete', [$note]) }}" class="ui right floated red button">Delete</a>
            <a href="{{ route('note.edit', [$note]) }}" class="ui right floated blue button">Edit</a>
        </div>
    </div>
@endsection