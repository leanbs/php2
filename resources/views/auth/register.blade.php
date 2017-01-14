<div class="content-register main-content">
    <h1>
        <i class="fa fa-user"></i>
        Register
    </h1>
    <hr>
    
    {!! Form::open(['url' => '/register', 'method' => 'post', 'id' => 'formRegister']) !!}
            {{ csrf_field() }}
            <div class="input-group input-group-lg {{ $errors->has('name') ? ' has-error' : '' }}">
                {!! Form::text('name', old('name'), ['class' => 'form-control','placeholder' => 'Name']) !!}
                <span class="input-group-addon">
                    <i class="fa fa-user"></i>
                </span>
                @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
                <br>
            <div class="input-group input-group-lg {{ $errors->has('username') ? ' has-error' : '' }}">
                {!! Form::text('username', old('username'), ['class' => 'form-control','placeholder' => 'Username']) !!}
                <span class="input-group-addon">
                    <i class="fa fa-user"></i>
                </span>
                @if ($errors->has('username'))
                    <span class="help-block">
                        <strong>{{ $errors->first('username') }}</strong>
                    </span>
                @endif
            </div>
                <br>
            <div class="input-group input-group-lg {{ $errors->has('password') ? ' has-error' : '' }}">
                {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password']) !!}
                <span class="input-group-addon">
                    <i class="fa fa-lock"></i>
                </span>
                @if ($errors->has('password'))                               
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                 @endif
            </div>
                <br>
            <div class="input-group input-group-lg {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                {!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'Confirm Password']) !!}
                <span class="input-group-addon">
                    <i class="fa fa-lock"></i>
                </span>
                @if ($errors->has('password_confirmation'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                    </span>
                @endif
            </div>
                <br>

            <div class="row">
                <div class="col-xs-6 col-md-6 ">
                    {!! Form::submit('Submit', ['id' => 'btn-reg-submit', 'class' => 'btn btn-primary btn-block',]) !!}
                </div>
                <div class="col-xs-6 col-md-6 ">
                    <a href="{{ url('manage/akun') }}">
                        {!! Form::button('Back ', ['id' => 'btn-reg-cancel', 'class' => 'btn btn-danger btn-block',]) !!}
                    </a>
                </div>
            </div>
            {!! Form::close() !!}
    </div>
</div>



