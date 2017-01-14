@extends('layouts.master')

@section('title')
    Manajemen Data Master
@endsection

@section('modals')
    @include('partials.modal.index')
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-12 col-md-6">
            <div class="box">
              <div class="box-body">
                <h1>
                    <i class="fa fa-intersex"></i>
                    Jenis Kelamin
                    <a id="add-tipe" href="{{ url('/jeniskelamin/create') }}" data-modal="" class="btn btn-success btn-compact pull-right">
                        <i class="fa fa-plus"></i>
                        Tambah Jenis Kelamin
                    </a>
                </h1>
                <hr>

                <table id="table-jns-kelamin" class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Jenis Kelamin</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th></th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
               </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->

        <div class="col-xs-12 col-md-6">
            <div class="box">
              <div class="box-body">
                        <h1>
                            <i class="fa fa-list-alt"></i>
                            Jenis Transaksi
                            <a id="add-project" href="{{ url('/jenistransaksi/create') }}" data-modal="" class="btn btn-success btn-compact pull-right">
                                <i class="fa fa-plus"></i>
                                Tambah Jenis Transaksi
                            </a>
                        </h1>
                        <hr>

                        <table id="table-jns-transaksi" class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Jenis Transaksi</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </tfoot>
                        </table>
               </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection

@section('script')
    <script type="text/javascript">
    /**
         * Initial rule container for jquery validation.
         *
         * @type {object}
         */
        var rule = {};

        /**
         * Checker for modal setup readiness.
         *
         * @type {integer}
         */
        var checker = 1;

        /**
         * Element for modal container.
         *
         * @type {object}
         */
        var elementModal = $('#myModal');

        /**
         * Check if modal is ready to be setup.
         *
         * @return {void}
         */
        function checkSetupModalReady() {
            if (checker++ >= 3) {
                // Setup modal ajax.
                setupModal();
            }
        }

        $(document).ready(function() {
            /**
             * Tables objects.
             *
             * @type {array}
             */
            var tables = {
                'tipe': {
                    'element' : $('#table-jns-kelamin'),
                    'options' : {
                        'columnDefs': [
                            {
                                'className' : 'text-center text-nowrap',
                                'targets'   : [-1, 0]
                            },
                        ],
                        'processing' : true,
                        'serverSide' : true,
                        'ajax'       : '{{ url('/jeniskelamin') }}',
                        'columns'    : [
                            { 'data': 'id_jns_kelamin', 'name': 'jns_kelamin.id_jns_kelamin' },
                            { 'data': 'jns_kelamin', 'name': 'jns_kelamin.jns_kelamin' },
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
                    },
                    'rule'   : {
                        'id_kategori' : {
                            'required'  : true,
                            'maxlength' : 10,
                        },
                        'kategori' : {
                            'required'  : true,
                            'maxlength' : 50,
                        },
                    },
                },
                'merk': {
                    'element' : $('#table-jns-transaksi'),
                    'options' : {
                        'columnDefs': [
                            {
                                'className' : 'text-center text-nowrap',
                                'targets'   : [-1, 0]
                            },
                        ],
                        'processing' : true,
                        'serverSide' : true,
                        'ajax'       : '{{ url('/jenistransaksi') }}',
                        'columns'    : [
                            { 'data': 'id_jenis_transaksi', 'name': 'jenis_transaksi.id_jenis_transaksi' },
                            { 'data': 'jenis_transaksi', 'name': 'jenis_transaksi.jenis_transaksi' },
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
                    },
                    'rule'   : {
                        'id_merk' : {
                            'required'  : true,
                            'maxlength' : 50,
                        },
                        'merk' : {
                            'required'  : true,
                            'maxlength' : 50,
                        },
                    },
                },
            };

             /**
             * Trigger data table & setup modal ajax
             */
            $.each(tables, function (title, object) {
                setDataTable(object.element, object.options);

                object.element.on('draw.dt', function () {
                    object.element.find('[data-toggle=tooltip]').tooltip();

                    object.element.find('.action-edit').click(function () {
                        // Update rule according to current table.
                        rule = object.rule;
                    });

                    checkSetupModalReady();
                    setupModal();
                });
            });

            tables.on('draw.dt', function () {
                tables.find('[data-toggle=tooltip]').tooltip();

                setupModal();
            });
        });
    </script>
@endsection


