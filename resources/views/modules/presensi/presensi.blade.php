@extends('layouts.master')

@section('title')
    Manajemen Presensi
@endsection

@section('modals')
    @include('partials.modal.index')
@endsection

@section('content')
    <div class="box">
      <div class="box-body">
        <h1>
          <i class="fa fa-cart-plus"></i>
          Presensi

          <a href="{{ url('/presensi/create') }}" data-modal="" class="btn btn-success btn-compact pull-right">
              <i class="fa fa-plus"></i>
              Tambah Presensi
          </a>
        </h1>
        <table id="table-presensi" class="table-presensi table table-bordered table-hover table-striped">
          <thead>
              <tr>
                <th>Nama</th>
                <th>Tanggal Kehadiran</th>
                <th>Keterangan</th>
                <th>Action</th>
              </tr>
          </thead>
          <tfoot>
            <tr>
              <th></th>
              <th></th>
              <th></th>
              <th></th>
            </tr>
          </tfoot>
        </table>
      </div><!-- /.box-body -->
    </div><!-- /.box -->
@endsection

@section('script')
    <script type="text/javascript">
    /**
         * Initial rule container for jquery validation.
         *
         * @type {object}
         */
        var rule = {
            'tgl_presensi':  {
              'required'  : true,
            },
        };

        var elementModal = $('#myModal');

        $(document).ready(function() {
            var elementTable = $('#table-presensi');

            var options = {
                'columnDefs': [
                    {
                        'className' : 'text-center text-nowrap',
                        'targets'   : [0, 2]
                    },
                ],
                'processing' : true,
                'serverSide' : true,
                'ajax'       : '{{ url('/presensi') }}',
                'columns'    : [
                    { 'data': 'nama_karyawan', 'name': 'karyawan.nama_karyawan' },
                    { 'data': 'tgl_presensi', 'name': 'presensi_karyawan.tgl_presensi' },
                    { 'data': 'keterangan', 'name': 'presensi_karyawan.keterangan' },
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

            /**
             * Trigger data table & setup modal ajax
             */
            setDataTable(elementTable, options);

            elementTable.on('draw.dt', function () {
                elementTable.find('[data-toggle=tooltip]').tooltip();

                setupModal();
            });

            elementModal.on('shown.bs.modal', function (event) {
                // Date picker jQuery.
                $('.date-picker').datepicker({
                    'changeMonth': true,
                    'changeYear': true,
                    'dateFormat': 'dd MM yy',
                    'yearRange' : "-0:+5",
                });
            });
        });
    </script>
@endsection

