<div class="row">
    {!! Form::model($toko, ['url' => $url, 'method' => $method]) !!}
        <div class="col-xs-12 col-md-12">
            <div class="form-group">
                {!! Form::label('id_toko', 'id toko') !!}
                {!! Form::text('id_toko', null, [
                    'class'       => 'form-control',
                    'placeholder' => 'id toko',
                    'disabled'     =>  'true',
                    (isset($disabled) ? 'disabled' : ''),
                ]) !!}
            </div>

            <div class="form-group">
                {!! Form::label('nama_toko', 'Nama Toko') !!}
                {!! Form::text('nama_toko', null, [
                    'class'       => 'form-control',
                    'placeholder' => 'nama toko',
                    (isset($disabled) ? 'disabled' : ''),
                ]) !!}
            </div>

            <div class="form-group">
                {!! Form::label('alamat', 'Alamat') !!}
                {!! Form::textarea('alamat', null, [
                    'class'       => 'form-control',
                    'placeholder' => 'Alamat karyawan',
                    'size' => '30x5',
                    (isset($disabled) ? 'disabled' : ''),
                ]) !!}
            </div>

            <div class="form-group">
                {!! Form::label('supervisor', 'Supervisor') !!}
                {!! Form::select('supervisor', $karyawan, $toko->supervisor, [
                    'placeholder' => '--',
                    'class'       => 'form-control',
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
