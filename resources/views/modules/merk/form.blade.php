<div class="row">
    {!! Form::model($merk, ['url' => $url, 'method' => $method]) !!}
        <div class="col-xs-12 col-md-12">
            <div class="form-group">
                {!! Form::label('id_merk', 'id merk') !!}
                {!! Form::text('id_merk', null, [
                    'class'       => 'form-control',
                    'placeholder' => 'id merk',
                    'disabled'    => 'true',
                    (isset($disabled) ? 'disabled' : ''),
                ]) !!}
            </div>

            <div class="form-group">
                {!! Form::label('merk', 'Merk') !!}
                {!! Form::text('merk', null, [
                    'class'       => 'form-control',
                    'placeholder' => 'Merk',
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
