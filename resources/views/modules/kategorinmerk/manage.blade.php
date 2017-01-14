@extends('layouts.master')

@section('title')
    Manajemen Kategori dan Merk
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
                    <i class="fa fa-bookmark"></i>
                    Kategori
                    <a id="add-tipe" href="{{ url('/kategori/create') }}" data-modal="" class="btn btn-success btn-compact pull-right">
                        <i class="fa fa-plus"></i>
                        Tambah Kategori
                    </a>
                </h1>
                <hr>

                <table id="table-tipe" class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Kategori</th>
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
                            <i class="fa fa-bookmark-o"></i>
                            Merk
                            <a id="add-project" href="{{ url('/merk/create') }}" data-modal="" class="btn btn-success btn-compact pull-right">
                                <i class="fa fa-plus"></i>
                                Tambah Merk
                            </a>
                        </h1>
                        <hr>

                        <table id="table-merk" class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Merk</th>
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
                    'element' : $('#table-tipe'),
                    'options' : {
                        'columnDefs': [
                            {
                                'className' : 'text-center text-nowrap',
                                'targets'   : [-1, 0]
                            },
                        ],
                        'processing' : true,
                        'serverSide' : true,
                        'ajax'       : '{{ url('/kategori') }}',
                        'columns'    : [
                            { 'data': 'id_kategori', 'name': 'master_kategori.id_kategori' },
                            { 'data': 'kategori', 'name': 'master_kategori.kategori' },
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
                    'element' : $('#table-merk'),
                    'options' : {
                        'columnDefs': [
                            {
                                'className' : 'text-center text-nowrap',
                                'targets'   : [-1, 0]
                            },
                        ],
                        'processing' : true,
                        'serverSide' : true,
                        'ajax'       : '{{ url('/merk') }}',
                        'columns'    : [
                            { 'data': 'id_merk', 'name': 'master_merk.id_merk' },
                            { 'data': 'merk', 'name': 'master_merk.merk' },
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


