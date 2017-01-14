@extends('layouts.master')

@section('title')
    Manajemen Inventori
@endsection

@section('modals')
    @include('partials.modal.index')
@endsection

@section('content')
    <div class="box">
      <div class="box-body">
        <h1>
          <i class="fa fa-cart-plus"></i>
          Gaji

          <a href="{{ url('/gaji/create') }}" data-modal="" class="btn btn-success btn-compact pull-right">
              <i class="fa fa-plus"></i>
              Tambah Gaji
          </a>
        </h1>
        <table id="table-gaji" class="table-gaji table table-bordered table-hover table-striped">
          <thead>
              <tr>
                <th>Karyawan</th>
                <th>Gaji Pokok</th>
                <th>Bonus</th>
                <th>Denda</th>
                <th>Uang Makan</th>
                <th>Jumlah Gaji</th>
                <th>Action</th>
              </tr>
          </thead>
          <tfoot>
            <tr>
              <th></th>
              <th></th>
              <th></th>
              <th></th>
              <th></th>
              <th></th>
            </tr>
          </tfoot>
        </table>
      </div>
            <!-- /.box-body -->
    </div>
    <!-- /.box -->

    <div class="box">
      
      <div class="box-body">
        <h1 class="pull-left">
          <i class="fa fa-cart-plus"></i>
          Rekap Gaji
        </h1>
        <h1 class="pull-right">
            {{ Form::selectMonth('month', 7, ['class' => 'form-control', 'id' => 'laporan-bulan']) }}
            <a id="see-report" class="btn btn-success" onclick="changeYearorMonth()">Report Bulan</a>
            {{ link_to('report/GajiAll', 'Report', array('class' => 'btn btn-success')) }}
        </h1 >
        <table id="table-gaji-total" class="table-gaji table table-bordered table-hover table-striped">
          <thead>
              <tr>
                <th>Karyawan</th>
                <th>Gaji Pokok</th>
                <th>Penjualan</th>
                <th>Bonus Kerajinan</th>
                <th>total</th>
              </tr>
          </thead>
          <tfoot>
            <tr>
              <th></th>
              <th></th>
              <th></th>
              <th></th>
              <th></th>
            </tr>
          </tfoot>
        </table>
      </div>
            <!-- /.box-body -->
    </div>
    <!-- /.box -->
@endsection

@section('script')
    <script type="text/javascript">
    /**
         * Initial rule container for jquery validation.
         *
         * @type {object}
         */
        var rule = {
            'tipe_brg':   {
              'required'  : true,
              'maxlength' : 10,
            },
        };

        function changeYearorMonth()
        {
            // alert('aa');
            var bulan = $('#laporan-bulan').find(":selected").val();
            // alert(bulan);
            // var tahun = $('#laporanTahun').val();
            $("#see-report").attr('href', 'report/GajiMonthly/' + bulan + '/');
        }

        $(document).ready(function() {
            var elementTable = $('#table-gaji');
            var elementTableTotal = $('#table-gaji-total');
            var elementSelectKategori = $('#id_kategori')

            var options = {
                'columnDefs': [
                    {
                        'className' : 'text-center text-nowrap',
                        'targets'   : [0, 2]
                    },
                ],
                'processing' : true,
                'serverSide' : true,
                'ajax'       : '{{ url('/gaji') }}',
                'columns'    : [
                    { 'data': 'nama_karyawan', 'name': 'karyawan.nama_karyawan' },
                    { 'data': 'gaji', 'name': 'gaji_karyawan.gaji' },
                    { 'data': 'bonus', 'name': 'gaji_karyawan.bonus' },
                    { 'data': 'denda', 'name': 'gaji_karyawan.denda' },
                    { 'data': 'uang_makan', 'name': 'gaji_karyawan.uang_makan' }, 
                    { 'data': 'jumlah_gaji', 'name': 'jumlah_gaji' }, 
                    { 'data': 'Action', 'name': 'Action', 'orderable': false, 'searchable': false },
                ],
                initComplete: function () {
                    this.api().columns().every(function () {
                        var column = this;
                        var input = document.createElement("input");
                        $(input).appendTo($(column.footer()).empty())
                        .on('change', function () {
                            column.search($(this).val()).draw();
                        });
                    });
                }
            };

            var optionsForTableTotal = {
                'columnDefs': [
                    {
                        'className' : 'text-center text-nowrap',
                        'targets'   : [0, 2]
                    },
                ],
                'processing' : true,
                'serverSide' : true,
                'ajax'       : '{{ url('/hitGaji') }}',
                'columns'    : [
                    { 'data': 'nama_karyawan', 'name': 'karyawan.nama_karyawan' },
                    { 'data': 'gaji_pokok', 'name': 'gaji_pokok' },
                    { 'data': 'penjualan', 'name': 'penjualan' },
                    { 'data': 'presensi', 'name': 'presensi' },
                    { 'data': 'total', 'name': 'total' },
                ],
                initComplete: function () {
                    this.api().columns().every(function () {
                        var column = this;
                        var input = document.createElement("input");
                        $(input).appendTo($(column.footer()).empty())
                        .on('change', function () {
                            column.search($(this).val()).draw();
                        });
                    });
                }
            };

            /**
             * Trigger data table & setup modal ajax
             */
            setDataTable(elementTable, options);
            setDataTable(elementTableTotal, optionsForTableTotal);

            elementTable.on('draw.dt', function () {
                elementTable.find('[data-toggle=tooltip]').tooltip();

                setupModal();
            });
        });
    </script>
@endsection

