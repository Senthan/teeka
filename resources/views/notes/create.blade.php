@section('title', 'Create a Note')
@extends('layouts.master')

@section('content')
    <ul class="breadcrumb">
        <li>{!! link_to_route('home.index', 'Home ') !!}</li>
        <li>{!! link_to_route('note.index', 'Note Management') !!}</li>
        <li class="active">Create </li>
    </ul>

    {{ Form::open(['url' => route('note.store'), 'method' => 'POST']) }}
        <div class="ui segments">
            <div class="ui segment clearfix">
                <h2 class="pull-left h2-margin-bottom">Create</h2>
                <div class="pull-right">
                    <a href="{{ route('note.index') }}" class="ui button" data-ng-cloak>Note</a>
                </div>
            </div>

            <div class="ui green segment fafa">
                @include('notes._form')
            </div>

            <div class="ui segment clearfix">
                <a href="{{ route('note.index') }}" class="small ui black button">Cancel</a>
                <button class="ui right floated green button" type="submit">Save</button>
            </div>
        </div>
    {{ Form::close() }}
@endsection