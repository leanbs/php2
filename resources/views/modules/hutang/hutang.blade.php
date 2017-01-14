@extends('layouts.master')

@section('title')
    Manajemen Hutang
@endsection

@section('modals')
    @include('partials.modal.index')
@endsection

@section('content')
    <div class="box">
      <div class="box-body">
        <h1 class="pull-left">
          <i class="fa fa-cart-plus"></i>
          Hutang
        </h1>
          
        <h1 class="pull-right">
            <a href="{{ url('/hutang/create') }}" data-modal="" class="btn btn-success btn-compact pull-right" style="margin-top: 7px;">
              <i class="fa fa-plus"></i>
              Tambah Hutang
            </a>
            {{ link_to('report/HutangAll', 'Report', array('class' => 'btn btn-success')) }}
        </h1 >
        <table id="table-hutang" class="table-hutang table table-bordered table-hover table-striped">
          <thead>
              <tr>
                <th>Nama</th>
                <th>Hutang</th>
                <th>Jangka Waktu</th>
                <th>Keterangan</th>
                <th>Status</th>
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
            'nama':  {
              'required'  : true,
              'maxlength' : 50,
            },
        };

        var elementModal = $('#myModal');

        $(document).ready(function() {
            var elementTable = $('#table-hutang');

            var options = {
                'columnDefs': [
                    {
                        'className' : 'text-center text-nowrap',
                        'targets'   : [0, 2]
                    },
                ],
                'processing' : true,
                'serverSide' : true,
                'ajax'       : '{{ url('/hutang') }}',
                'columns'    : [
                    { 'data': 'nama_karyawan', 'name': 'karyawan.nama_karyawan' },
                    { 'data': 'hutang', 'name': 'hutang_karyawan.hutang' },
                    { 'data': 'jangka_waktu', 'name': 'hutang_karyawan.jangka_waktu' },
                    { 'data': 'keterangan', 'name': 'hutang_karyawan.keterangan' },
                    { 'data': 'status', 'name': 'hutang_karyawan.status' },
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

