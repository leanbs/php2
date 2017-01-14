<div class="row">
    {!! Form::model($gaji, ['url' => $url, 'method' => $method]) !!}
        <div class="col-xs-12 col-md-12">

            <div class="form-group">
                {!! Form::label('id_karyawan', 'Karyawan') !!}
                {!! Form::select('id_karyawan', $karyawan, $gaji->id_karyawan, [
                    'placeholder' => '--',
                    'class'       => 'form-control',
                ]) !!}
            </div>  

            <div class="form-group">
                {!! Form::label('gaji', 'Gaji Pokok') !!}
                {!! Form::text('gaji', null, [
                    'class'       => 'form-control',
                    'placeholder' => 'Gaji Pokok',
                    (isset($disabled) ? 'disabled' : ''),
                ]) !!}
            </div>

            <div class="form-group">
                {!! Form::label('bonus', 'Bonus') !!}
                {!! Form::text('bonus', null, [
                    'class'       => 'form-control',
                    'placeholder' => 'Bonus',
                    (isset($disabled) ? 'disabled' : ''),
                ]) !!}
            </div>

            <div class="form-group">
                {!! Form::label('denda', 'Denda') !!}
                {!! Form::text('denda', null, [
                    'class'       => 'form-control',
                    'placeholder' => 'Denda',
                    (isset($disabled) ? 'disabled' : ''),
                ]) !!}
            </div>

            <div class="form-group">
                {!! Form::label('uang_makan', 'Uang Makan') !!}
                {!! Form::text('uang_makan', null, [
                    'class'       => 'form-control',
                    'placeholder' => 'Uang Makan',
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
