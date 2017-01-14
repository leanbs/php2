<div class="row">
    {!! Form::model($inventori, ['url' => $url, 'method' => $method]) !!}
        <div class="col-xs-12 col-md-12">

            <div class="form-group">
                {!! Form::label('id_kategori', 'Kategori') !!}
                {!! Form::select('id_kategori', $kategori, $inventori->id_kategori, [
                    'placeholder' => '--',
                    'class'       => 'form-control',
                ]) !!}
            </div>

            <div class="form-group">
                {!! Form::label('id_merk', 'Merk') !!}
                {!! Form::select('id_merk', $merk, $inventori->id_merk, [
                    'placeholder' => '--',
                    'class'       => 'form-control',
                ]) !!}
            </div>

            <div class="form-group">
                {!! Form::label('tipe_brg', 'Tipe barang') !!}
                {!! Form::text('tipe_brg', null, [
                    'class'       => 'form-control',
                    'placeholder' => 'Tipe barang (cth: AX-123)',
                    (isset($disabled) ? 'disabled' : ''),
                ]) !!}
            </div>

            <div class="form-group">
                {!! Form::label('harga_barang', 'Harga barang') !!}
                {!! Form::text('harga_barang', null, [
                    'class'       => 'form-control',
                    'id'          => 'Total',
                    'placeholder' => 'Harga barang',
                    (isset($disabled) ? 'disabled' : ''),
                ]) !!}
            </div>

            <div class="form-group">
                {!! Form::label('stok', 'Stok') !!}
                {!! Form::text('jumlah', null, [
                    'class'       => 'form-control',
                    'placeholder' => 'Stok',
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
        data.set('harga_barang', currency);
    });
</script>