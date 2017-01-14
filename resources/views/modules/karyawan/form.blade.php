<div class="row">
    {!! Form::model($karyawan, ['url' => $url, 'method' => $method]) !!}
        <div class="col-xs-12 col-md-12">
            <div class="form-group">
                {!! Form::label('id_karyawan', 'Id Karyawan') !!}
                {!! Form::text('id_karyawan', null, [
                    'class'       => 'form-control',
                    'placeholder' => 'id Karyawan (cth: 4009)',
                    'disabled'    => 'true',
                    (isset($disabled) ? 'disabled' : ''),
                ]) !!}
            </div>

            <div class="form-group">
                {!! Form::label('id_toko', 'Toko') !!}
                {!! Form::select('id_toko', $toko, $karyawan->id_toko, [
                    'placeholder' => '--',
                    'class'       => 'form-control',
                    (isset($disabled) ? 'disabled' : ''),
                ]) !!}
            </div>

            <div class="form-group">
                {!! Form::label('nama_karyawan', 'Nama Karyawan') !!}
                {!! Form::text('nama_karyawan', null, [
                    'class'       => 'form-control',
                    'placeholder' => 'id Karyawan (cth: 4009)',
                    (isset($disabled) ? 'disabled' : ''),
                ]) !!}
            </div>

            <div class="form-group">
                {!! Form::label('jns_kelamin', 'Jenis kelamin karyawan') !!}
                @foreach($jns_kelamin as $id_jns_kelamin => $jns_kelamin)
                    {!! Form::radioInLabel('id_jns_kelamin', $id_jns_kelamin, $jns_kelamin, $karyawan->id_jns_kelamin == $id_jns_kelamin) !!}
                @endforeach
            </div>

            <div class="form-group">
                {!! Form::label('tempat_lhr', 'Tempat Lahir') !!}
                {!! Form::text('tempat_lhr', null, [
                    'class'       => 'form-control',
                    'placeholder' => 'Tempat lahir karyawan',
                    (isset($disabled) ? 'disabled' : ''),
                ]) !!}
            </div>

            <div class="form-group">
                {!! Form::label('tgl_lhr', 'Tanggal Lahir') !!}
                {!! Form::text('tgl_lhr', null, [
                    'class'       => 'form-control date-picker',
                    'placeholder' => 'Tanggal lahir karyawan',
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
                {!! Form::label('nomor_telp', 'Nomor Telepon') !!}
                {!! Form::text('nomor_telp', null, [
                    'class'       => 'form-control',
                    'placeholder' => 'Nomor telepon karyawan',
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
