<div class="row">
    {!! Form::model($akun, ['url' => $url, 'method' => $method]) !!}
        <div class="col-xs-12 col-md-12">
            <div class="form-group">
                {!! Form::label('id', 'id') !!}
                {!! Form::text('id', null, [
                    'class'       => 'form-control',
                    'placeholder' => 'id Akun (cth: 4009)',
                    (isset($disabled) ? 'disabled' : ''),
                ]) !!}
            </div>

            <div class="form-group">
                {!! Form::label('name', 'Nama') !!}
                {!! Form::text('name', null, [
                    'class'       => 'form-control',
                    'placeholder' => 'nama barang',
                    (isset($disabled) ? 'disabled' : ''),
                ]) !!}
            </div>

            <div class="form-group">
                {!! Form::label('username', 'Username') !!}
                {!! Form::text('username', null, [
                    'class'       => 'form-control',
                    'placeholder' => 'username',
                    (isset($disabled) ? 'disabled' : ''),
                ]) !!}
            </div>

            <div class="form-group">
                {!! Form::label('password', 'Password') !!}
                {!! Form::text('password', null, [
                    'class'       => 'form-control',
                    'placeholder' => 'nama barang',
                    (isset($disabled) ? 'disabled' : ''),
                ]) !!}
            </div>
        </div>

        <div class="col-xs-6 col-md-6 text-center">
            {!! Form::submit('OK', ['class' => 'btn btn-confirm btn-sm']) !!}
        </div>
    {!! Form::close() !!}

    <div class="col-xs-6 col-md-6 text-center">
        {!! Form::button('Cancel', ['class' => 'btn btn-decline btn-sm', 'data-dismiss' => 'modal']) !!}
    </div>
</div>
