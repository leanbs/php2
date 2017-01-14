@extends('layouts.master')

@section('title')
    Manajemen Toko
@endsection

@section('modals')
    @include('partials.modal.index')
@endsection

@section('content')
    <div class="box">
      <div class="box-body">
        <h1>
          <i class="fa fa-cart-plus"></i>
          Toko

          <a href="{{ url('/toko/create') }}" data-modal="" class="btn btn-success btn-compact pull-right">
              <i class="fa fa-plus"></i>
              Tambah Toko
          </a>
        </h1>
        <table id="table-toko" class="table-toko table table-bordered table-hover table-striped">
          <thead>
              <tr>
                <th>Nama Toko</th>
                <th>Alamat</th>
                <th>Supervisor</th>
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
            'id_toko':   {
              'required'  : true,
              'maxlength' : 10,
            },
            'nama_toko':  {
              'required'  : true,
              'maxlength' : 50,
            },
        };

        $(document).ready(function() {
            var elementTable = $('#table-toko');

            var options = {
                'columnDefs': [
                    {
                        'className' : 'text-center text-nowrap',
                        'targets'   : [0, 2]
                    },
                ],
                'processing' : true,
                'serverSide' : true,
                'ajax'       : '{{ url('/toko') }}',
                'columns'    : [
                    { 'data': 'nama_toko', 'name': 'master_toko.nama_toko' },
                    { 'data': 'alamat', 'name': 'master_toko.alamat' },
                    { 'data': 'nama_karyawan', 'name': 'master_toko.nama_karyawan' },
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
        });
    </script>
@endsection

