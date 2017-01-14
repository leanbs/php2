<div class="row">
    {!! Form::model($hutang, ['url' => $url, 'method' => $method]) !!}
        <div class="col-xs-12 col-md-12">
            <div class="form-group">
                {!! Form::label('id_hutang', 'id hutang') !!}
                {!! Form::text('id_hutang', null, [
                    'class'       => 'form-control',
                    'placeholder' => 'id hutang',
                    'disabled'     =>  'true',
                    (isset($disabled) ? 'disabled' : ''),
                ]) !!}
            </div>

            <div class="form-group">
                {!! Form::label('hutang', 'Nominal Hutang') !!}
                {!! Form::text('hutang', null, [
                    'class'       => 'form-control',
                    'id'          => 'Total',
                    'placeholder' => 'Nominal Hutang',
                    (isset($disabled) ? 'disabled' : ''),
                ]) !!}
            </div>

            <div class="form-group">
                {!! Form::label('id_karyawan', 'Id Karyawan') !!}
                {!! Form::select('id_karyawan', $karyawan, $hutang->id_karyawan, [
                    'placeholder' => '--',
                    'class'       => 'form-control',
                    (isset($disabled) ? 'disabled' : ''),
                ]) !!}
            </div>

            <div class="form-group">
                {!! Form::label('jangka_waktu', 'Jangka Waktu') !!}
                {!! Form::text('jangka_waktu', null, [
                    'class'       => 'form-control date-picker',
                    'placeholder' => 'Jangka Waktu Hutang',
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
        {!! Form::button('Cancel', ['id' => 'btnSave', 'class' => 'btn btn-decline btn-sm', 'data-dismiss' => 'modal']) !!}
    </div>
</div>

<script type="text/javascript">
    $('#Total').maskMoney({thousands:'.', affixesStay: true, decimal:',', precision:0});
    function parseFloatOpts(num, decimal, thousands) {
        var bits = num.split(decimal, 2),
            ones = bits[0].replace(new RegExp('\\' + thousands, 'g'), '');
            ones = parseFloat(ones, 10),
            decimal = parseFloat('0.' + bits[1], 10);
            return ones + decimal;
    }
    $("#btnSave").click(function(e){        
        var currency = parseFloatOpts($('#Total').val(), ',', '.'); 
        if (isNaN(currency)) 
        {
            currency = '';
        }
        data.set('hutang', currency);
    });
</script>