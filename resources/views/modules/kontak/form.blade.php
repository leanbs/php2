<div class="row">
    {!! Form::model($kontak, ['url' => $url, 'method' => $method]) !!}
        <div class="col-xs-12 col-md-12">
            <div class="form-group">
                {!! Form::label('id_kontak', 'id kontak') !!}
                {!! Form::text('id_kontak', null, [
                    'class'       => 'form-control',
                    'placeholder' => 'id kontak',
                    'disabled'     =>  'true',
                    (isset($disabled) ? 'disabled' : ''),
                ]) !!}
            </div>

            <div class="form-group">
                {!! Form::label('nama_perusahaan', 'Nama perusahaan') !!}
                {!! Form::text('nama_perusahaan', null, [
                    'class'       => 'form-control',
                    'placeholder' => 'nama perusahaan',
                    (isset($disabled) ? 'disabled' : ''),
                ]) !!}
            </div>

            <div class="form-group">
                {!! Form::label('nama', 'Nama kontak') !!}
                {!! Form::text('nama', null, [
                    'class'       => 'form-control',
                    'placeholder' => 'nama kontak',
                    (isset($disabled) ? 'disabled' : ''),
                ]) !!}
            </div>

            <div class="form-group">
                {!! Form::label('alamat', 'Alamat') !!}
                {!! Form::textarea('alamat', null, [
                    'class'       => 'form-control',
                    'placeholder' => 'Alamat agen / penjual',
                    'size' => '30x5',
                    (isset($disabled) ? 'disabled' : ''),
                ]) !!}
            </div>

            <div class="form-group">
                {!! Form::label('no_telp', 'No Telepon') !!}
                {!! Form::text('no_telp', null, [
                    'class'       => 'form-control',
                    'placeholder' => 'No Telepon',
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
