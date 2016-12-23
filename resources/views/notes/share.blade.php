@section('title', "Share Individual " . $note->title)
@extends('layouts.master')

@section('content')
    <ul class="breadcrumb">
        <li>{!! link_to_route('home.index', 'Home ') !!}</li>
        <li>{!! link_to_route('note.index', 'Note Management') !!}</li>
        <li class="active">Share</li>
    </ul>

    {{ Form::open(['url' => route('note.share', [$note]), 'method' => 'POST']) }}
        <div class="ui segments">
            <div class="ui segment clearfix">
                <h2 class="pull-left h2-margin-bottom">Share {{ $note->title }}</h2>
            </div>

            <div class="ui blue segment fafa form">
                <div class="field">
                    <label>Users</label>
                    <div class="ui search selection dropdown" id="contactDropDown">
                        <input type="hidden" name="contact_id" value="kp">
                        <div class="text">Search Users</div>
                        <i class="dropdown icon"></i>
                        <div class="menu"></div>
                    </div>
                </div>
            </div>

            <div class="ui segment clearfix">
                <a href="{{ route('note.index') }}" class="ui button" data-ng-cloak>Cancel</a>
                <button type="submit" class="ui right floated teal button">Share</button>
            </div>
        </div>
    {{ Form::close() }}
@endsection

@section('script')
    <script>
        var contactDropDown = $('#contactDropDown');

        contactDropDown.dropdown();
        contactDropDown.dropdown('setting', {
            apiSettings: {
                url: '{{ route('user.search') }}/{query}'
            },
            saveRemoteData: false,
            forceSelection: false
        });

    </script>
@endsection