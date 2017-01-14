<div class="row">
    {!! Form::model($presensi, ['url' => $url, 'method' => $method]) !!}
        <div class="col-xs-12 col-md-12">
            <div class="form-group">
                {!! Form::label('id_karyawan', 'Id Karyawan') !!}
                {!! Form::select('id_karyawan', $karyawan, $presensi->id_karyawan, [
                    'placeholder' => '--',
                    'class'       => 'form-control',
                    (isset($disabled) ? 'disabled' : ''),
                ]) !!}
            </div>

            <div class="form-group">
                {!! Form::label('tgl_presensi', 'Tanggal Presensi') !!}
                {!! Form::text('tgl_presensi', null, [
                    'class'       => 'form-control date-picker',
                    'placeholder' => 'Tanggal Presensi',
                    (isset($disabled) ? 'disabled' : ''),
                ]) !!}
            </div>

            <div class="form-group">
                {!! Form::label('keterangan', 'Keterangan') !!}
                {!! Form::textarea('keterangan', null, [
                    'class'       => 'form-control',
                    'placeholder' => 'Keterangan Hutang Karyawan',
                    'size' => '30x5',
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
