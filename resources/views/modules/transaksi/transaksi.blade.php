@extends('layouts.master')

@section('title')
    Manajemen Transaksi
@endsection

@section('modals')
    @include('partials.modal.index')
@endsection

@section('content')
    <div class="box">
      <div class="box-body">
        <h1 class="pull-left">
          <i class="fa fa-cart-plus"></i>
          Transaksi
        </h1>
        <h1 class="pull-right">
            {{ link_to('report/TransaksiMonthly', 'Report', array('class' => 'btn btn-success')) }}
        </h1 >
        <table id="table-transaksi" class="table-transaksi table table-bordered table-hover table-striped">
          <thead>
              <tr>
                <th>No Nota</th>
                <th>Jenis Transaksi</th>
                <th>Nama Karyawan</th>
                <th>Nama Pelanggan</th>
                <th>Alamat</th>
                <th>Telepon</th>
                <th>Tanggal</th>
                <th>Lunas</th>
                <th>Kirim</th>
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
          'id_karyawan':{
            'required'  : true,
          },
            'tipe_brg':   {
              'required'  : true,
              'maxlength' : 10,
            },
        };

        $(document).ready(function() {
            var elementTable = $('#table-transaksi');
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
                'ajax'       : '{{ url('/transaksi') }}',
                'columns'    : [
                    { 'data': 'id_transaksi', 'name': 'transaksi.id_transaksi' },
                    { 'data': 'jenis_transaksi', 'name': 'jenis_transaksi.jenis_transaksi' },
                    { 'data': 'nama_karyawan', 'name': 'karyawan.nama_karyawan' },
                    { 'data': 'nama_pelanggan', 'name': 'transaksi.nama_pelanggan' },
                    { 'data': 'alamat', 'name': 'transaksi.alamat' },
                    { 'data': 'nomor_telp', 'name': 'transaksi.nomor_telp' },
                    { 'data': 'tanggal_transaksi', 'name': 'transaksi.tanggal_transaksi' },
                    { 'data': 'status_kirim', 'name': 'transaksi.status_kirim' },
                    { 'data': 'status_bayar', 'name': 'transaksi.status_bayar' },
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
                elementTable.find('[data-modal=tooltip]').tooltip();

                setupModal();
            }); 

            $('#myModal').on('shown.bs.modal', function() {
              // $(calculateSum);
              calculateSum()
            })
        });

    </script>
@endsection

