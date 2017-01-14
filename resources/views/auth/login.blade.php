<div class="content-login main-content">
    <div class="login-box">
        <div class="login-box-body">
            <div class="login-logo">
                <h1>
                    <i class="fa fa-sign-in"></i>
                    Sign In
                </h1>
                <hr>
            </div> <!-- /.login-logo -->            
            {!! Form::open(['url' => 'login', 'method' => 'post', 'id' => 'formLogin']) !!}
                <div class="input-group input-group-lg">
                    {!! Form::text('username', old('username'), ['class' => 'form-control','placeholder' => 'Username']) !!}
                    <span class="input-group-addon">
                        <i class="fa fa-envelope fa-fw"></i>
                    </span>
                </div>
                    <br>
                <div class="input-group input-group-lg">
                    {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password']) !!}
                    <span class="input-group-addon">
                        <i class="fa fa-unlock-alt fa-fw"></i>
                    </span>
                </div>

                <div class="checkbox">
                    <div class="row">
                        <div class="col-xs-6 col-md-6">
                            {!! Form::checkboxInLabel('remember', 'remember', 'Remember me') !!}
                        </div>

                        <div class="col-xs-6 col-md-6">
                            {!! Form::submit('Login', ['class' => 'btn btn-primary btn-block btn-flat']) !!}
                        </div>
                    </div>
                </div>

                <div class="text-center">
                    <!-- <a href="{{ url('password/email') }}">Forgot your password? Click here.</a>
                    <br>
                    <a href="{{ url('register') }}">Register</a> -->
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div><!-- /.content-login.main-content -->
