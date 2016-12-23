@section('title', 'Edit Marketing Campaign')
@extends('layouts.master')

@section('content')
    <ul class="breadcrumb">
        <li>{!! link_to_route('home.index', 'Home ') !!}</li>
        <li>{!! link_to_route('note.index', 'Note Management') !!}</li>
        <li class="active">Edit</li>
    </ul>

    {{ Form::model($note, ['url' => route('note.update', [$note]), 'method' => 'PATCH']) }}
        <div class="ui segments">
            <div class="ui segment clearfix">
                <h2 class="pull-left h2-margin-bottom">Edit {{ $note->title }} </h2>
                <div class="pull-right">
                    <a href="{{ route('note.index') }}" class="ui button" data-ng-cloak>Note</a>
                </div>
            </div>

            <div class="ui green segment fafa">
                @include('notes._form')
            </div>

            <div class="ui segment clearfix">
                <a href="{{ route('note.index') }}" class="ui button" data-ng-cloak>Cancel</a>
                <button class="ui right floated blue button" type="submit">Update</button>
            </div>
        </div>
    {{ Form::close() }}
@endsection