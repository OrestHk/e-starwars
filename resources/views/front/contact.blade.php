@extends('front.layouts.master')

@section('title', 'Contact us')

@section('content')

    {!! Form::open(['url' => 'contact/send', 'method' => 'post']) !!}
        <div class="field">
            {!! Form::label('email', 'E-mail', ['for'=>'email']) !!}
            {!! Form::email('email', '', ['id' => 'email', 'placeholder' => 'ex: jango.fett@caramail.com']) !!}
            {!! $errors->first('email', '<p class="error">:message</p>') !!}
        </div>
        <div class="field">
            {!! Form::label('message', 'Message', ['for'=>'message']) !!}
            {!! Form::textarea('message', '', ['id' => 'message', 'placeholder' => 'Your message']); !!}
            {!! $errors->first('message', '<p class="error">:message</p>') !!}
        </div>
        {!! Form::submit('Send') !!}
    {!! Form::close() !!}

@endsection
