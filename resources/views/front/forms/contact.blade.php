{!! Form::open(['url' => 'contact/send', 'method' => 'post', 'id' => 'contact']) !!}
    <div class="fields">
        <div class="field">
            {!! Form::label('email', 'E-mail', ['for'=>'email']) !!}
            <div class="field-container">
                {!! Form::email('email', '', ['id' => 'email', 'placeholder' => 'ex: jango.fett@caramail.com', 'required']) !!}
            </div>
        </div>
        <div class="field">
            {!! Form::label('message', 'Message', ['for'=>'message']) !!}
            <div class="field-container">
                {!! Form::textarea('message', '', ['id' => 'message', 'placeholder' => 'Your message', 'required']); !!}
            </div>
        </div>
        <p class="success">Message sent</p>
        <p class="progress">Sending...</p>
    </div>
    <div class="container-btn submit">
        {!! Form::submit('Send', ['class' => 'btn']) !!}
        <div class="top"></div>
        <div class="right"></div>
        <div class="bot"></div>
        <div class="left"></div>
    </div>
{!! Form::close() !!}
