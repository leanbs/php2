<div class="row">
    {!! Form::model($jeniskelamin, ['url' => $url, 'method' => $method]) !!}
        <div class="col-xs-12 col-md-12">
            <div class="form-group">
                {!! Form::label('id_jns_kelamin', 'id jenis kelamin') !!}
                {!! Form::text('id_jns_kelamin', null, [
                    'class'       => 'form-control',
                    'placeholder' => 'id jenis kelamin',
                    'disabled'    => 'true',
                    (isset($disabled) ? 'disabled' : ''),
                ]) !!}
            </div>

            <div class="form-group">
                {!! Form::label('jns_kelamin', 'Jenis Kelamin') !!}
                {!! Form::text('jns_kelamin', null, [
                    'class'       => 'form-control',
                    'placeholder' => 'Jenis Kelamin',
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
