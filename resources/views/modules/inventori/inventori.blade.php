@extends('layouts.master')

@section('title')
    Manajemen Inventori
@endsection

@section('modals')
    @include('partials.modal.index')
@endsection

@section('content')
    @include('modal.serial.show.show')
    
    <div class="box">
      <div class="box-body">
        <h1 class="pull-left">
          <i class="fa fa-cart-plus"></i>
          Inventori
        </h1>

        <h1 class="pull-right">
          <a href="{{ url('/inventori/create') }}" data-modal="" class="btn btn-success btn-compact pull-right" style="margin-top: 7px;">
              <i class="fa fa-plus"></i>
              Tambah Inventori
          </a>
          {{ link_to('report/InventoriAll', 'Report', array('class' => 'btn btn-success')) }}
        </h1>
        <table id="table-inventori" class="table-inventori table table-bordered table-hover table-striped">
          <thead>
              <tr>
                <th>Kategori</th>
                <th>Merk</th>
                <th>Tipe barang</th>
                <th>Harga</th>
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

        $(document).ready(function() {
            var elementTable = $('#table-inventori');
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
                'ajax'       : '{{ url('/inventori') }}',
                'columns'    : [
                    { 'data': 'kategori', 'name': 'master_kategori.kategori' },
                    { 'data': 'merk', 'name': 'master_merk.merk' },
                    { 'data': 'tipe_brg', 'name': 'inventori.tipe_brg' },
                    { 'data': 'harga_barang', 'name': 'inventori.harga_barang' },
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

