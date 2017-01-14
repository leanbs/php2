@extends('layouts.master')

@section('title')
    Manajemen Akun
@endsection

@section('modals')
    @include('partials.modal.index')
@endsection

@section('content')
    <div class="box">
      <div class="box-body">
        <h1 class="pull-left">
          <i class="fa fa-cart-plus"></i>
          Akun
        </h1>
        <h1 class="pull-right">
          {{ link_to('/register', 'Tambah Users', array('class' => 'btn btn-success')) }}
        </h1>
        <table id="table-akun" class="table-akun table table-bordered table-hover table-striped">
          <thead>
              <tr>
                <th>Id</th>
                <th>Nama</th>
                <th>Username</th>
                <th>Password</th>
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
            'id':   {
              'required'  : true,
              'maxlength' : 10,
            },
            'name':  {
              'required'  : true,
              'maxlength' : 50,
            },
            'username':  {
              'required'  : true,
              'maxlength' : 50,
            },
            'password':  {
              'required'  : true,
              'maxlength' : 50,
            },
        };

        $(document).ready(function() {
            var elementTable = $('#table-akun');

            var options = {
                'columnDefs': [
                    {
                        'className' : 'text-center text-nowrap',
                        'targets'   : [0, 2]
                    },
                ],
                'processing' : true,
                'serverSide' : true,
                'ajax'       : '{{ url('/akun') }}',
                'columns'    : [
                    { 'data': 'id', 'name': 'users.Id' },
                    { 'data': 'name', 'name': 'users.Name' },
                    { 'data': 'username', 'name': 'users.Username' },
                    { 'data': 'password', 'name': 'users.Password' },
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

