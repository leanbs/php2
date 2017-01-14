<div class="row">
    {!! Form::model($jenistransaksi, ['url' => $url, 'method' => $method]) !!}
        <div class="col-xs-12 col-md-12">
            <div class="form-group">
                {!! Form::label('id_jenis_transaksi', 'id jenis transaksi') !!}
                {!! Form::text('id_jenis_transaksi', null, [
                    'class'       => 'form-control',
                    'placeholder' => 'id jenis transaksi',
                    'disabled'    => 'true',
                    (isset($disabled) ? 'disabled' : ''),
                ]) !!}
            </div>

            <div class="form-group">
                {!! Form::label('jenis_transaksi', 'Jenis Transaksi') !!}
                {!! Form::text('jenis_transaksi', null, [
                    'class'       => 'form-control',
                    'placeholder' => 'Jenis Transaksi',
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
