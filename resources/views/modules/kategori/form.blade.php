<div class="row">
    {!! Form::model($kategori, ['url' => $url, 'method' => $method]) !!}
        <div class="col-xs-12 col-md-12">
            <div class="form-group">
                {!! Form::label('id_kategori', 'id kategori') !!}
                {!! Form::text('id_kategori', null, [
                    'class'       => 'form-control',
                    'placeholder' => 'id kategori',
                    'disabled'    => 'true',
                    (isset($disabled) ? 'disabled' : ''),
                ]) !!}
            </div>

            <div class="form-group">
                {!! Form::label('kategori', 'Kategori') !!}
                {!! Form::text('kategori', null, [
                    'class'       => 'form-control',
                    'placeholder' => 'Kategori',
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
