@extends('layouts.master')

@section('title')
    Manajemen Karyawan
@endsection

@section('modals')
    @include('partials.modal.index')
@endsection

@section('content')
    <div class="box">
      <div class="box-body">
        <h1 class="pull-left">
          <i class="fa fa-cart-plus"></i>
          Karyawan
        </h1>

        <h1 class="pull-right">
          <a href="{{ url('/karyawan/create') }}" data-modal="" class="btn btn-success btn-compact pull-right" style="margin-top: 7px;">
              <i class="fa fa-plus"></i>
              Tambah Karyawan
          </a>
          {{ link_to('report/KaryawanAll', 'Report', array('class' => 'btn btn-success')) }}
        </h1>
        <table id="table-karyawan" class="table-karyawan table table-bordered table-hover table-striped">
          <thead>
              <tr>
                <th>Id</th>
                <th>Toko</th>
                <th>Nama Karyawan</th>
                <th>Jenis Kelamin</th>
                <th>Tempat Lahir</th>
                <th>Tanggal Lahir</th>
                <th>Alamat</th>
                <th>Telepon</th>
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
            'id_karyawan':   {
              'maxlength' : 10,
            },
            'nama_toko':   {
              'required'  : true,
              'maxlength' : 10,
            },
            'jns_kelamin':   {
              'required'  : true,
              'maxlength' : 10,
            },
            'nama_karyawan':  {
              'required'  : true,
              'maxlength' : 50,
            },
            'tempat_lhr':  {
              'required'  : true,
              'maxlength' : 15,
            },
            'tgl_lhr':  {
              'required'  : true,
              'maxlength' : 255,
            },
            'alamat':  {
              'required'  : true,
              'maxlength' : 255,
            },
            'nomor_telp':  {
              'required'  : true,
              'maxlength' : 15,
            },
        };

        /**
         * Element for modal container.
         *
         * @type {object}
         */
        var elementModal = $('#myModal');

        $(document).ready(function() {
            var elementTable = $('#table-karyawan');

            var options = {
                'columnDefs': [
                    {
                        'className' : 'text-center text-nowrap',
                        'targets'   : [0, 2]
                    },
                ],
                'processing' : true,
                'serverSide' : true,
                'ajax'       : '{{ url('/karyawan') }}',
                'columns'    : [
                    { 'data': 'id_karyawan', 'name': 'karyawan.id_karyawan' },
                    { 'data': 'nama_toko', 'name': 'master_toko.nama_toko' },
                    { 'data': 'nama_karyawan', 'name': 'karyawan.nama_karyawan' },
                    { 'data': 'jns_kelamin', 'name': 'jns_kelamin.jns_kelamin' },
                    { 'data': 'tempat_lhr', 'name': 'karyawan.tempat_lhr' },
                    { 'data': 'tgl_lhr', 'name': 'karyawan.tgl_lhr' },   
                    { 'data': 'alamat', 'name': 'karyawan.alamat' },  
                    { 'data': 'nomor_telp', 'name': 'karyawan.nomor_telp' },  
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
                    'yearRange' : "-30:+0",
                });
            });
        });
    </script>
@endsection

