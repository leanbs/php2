@extends('layouts.master')

@section('title')
    Presensi
@endsection

@section('modals')
    @include('partials.modal.index')
@endsection

@section('content')
<div class="box">
	<div class="box-header">
	<h1>
    	<i class="fa fa-cart-plus"></i>
      	Presensi

      	<a href="{{ url('/make/presensi') }}" data-modal="" class="btn btn-success btn-compact pull-right">
	          <i class="fa fa-plus"></i>
	          Buka Toko !
      	</a>
    </h1>

		{!! Form::model($karyawan, ['url' => url('/set/presensi'), 'class'=>'form-inline', 'method' => 'post']) !!}

			<?php 	$all_data = array();
				foreach($selected as $data){
				     $all_data[] =  $data['id_karyawan'];
				} 
			?>
			
			@foreach($karyawan as $id_karyawan => $nama_karyawan)
			<div class="form-group" style="margin-right: 7px">
				<div class="checkbox">
					<label>
				    	{!! Form::checkbox('karyawan[]', $id_karyawan, in_array($id_karyawan, $all_data), [
				    		'class' => 'iCheck-helper',
				    		]) !!} {{$nama_karyawan}}
				   	</label>
				</div>
			</div>
			@endforeach 
			
			<div class="pull-right">
				{!! Form::submit('OK', ['class' => 'btn btn-success btn-md']) !!}
			</div>
		{!! Form::close() !!}
	</div>
</div>

<div class="box">
	<div class="box-header">
		<h1>
	    	<i class="fa fa-cart-plus"></i>
	      	Daftar Presensi
	    </h1>
	</div>
	<div class="box-body">
	  	<table id="table-presensi" class="table-presensi table table-bordered table-hover table-striped">
          <thead>
              <tr>
                <th>Nama</th>
                <th>Tanggal Kehadiran</th>
                <th>Jam Kehadiran</th>
                <th>Hadir</th>
                <th>Keterangan</th>
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

<div class="box">
	<div class="box-header">
		<h1>
	    	<i class="fa fa-cart-plus"></i>
	      	Pencarian Presensi
	    </h1>
	    <?php $this_month=date('n'); $this_year=date('Y'); ?>
	    {{ Form::selectMonth('month', $this_month, ['class' => 'form-control', 'id' => 'laporan-bulan']) }}
	    {{ Form::selectYear('year', $this_year - 2, $this_year, $this_year, ['class' => 'form-control', 'id' => 'laporan-tahun']) }}
	</div>
	<div class="box-body">
	  	<table id="table-pencarian-presensi" class="table-pencarian-presensi table table-bordered table-hover table-striped">
          <thead>
              <tr>
                <th>Nama</th>
                <th>Tanggal Kehadiran</th>
                <th>Jam Kehadiran</th>
                <th>Hadir</th>
                <th>Keterangan</th>
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
                    { 'data': 'jam_hadir', 'name': 'presensi_karyawan.jam_hadir' },
                    { 'data': 'status_hadir', 'name': 'presensi_karyawan.status_hadir' },
                    { 'data': 'keterangan', 'name': 'presensi_karyawan.keterangan' },
                    // { 'data': 'Action', 'name': 'Action', 'orderable': false, 'searchable': false },
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

            var elementTable2 = $('#table-pencarian-presensi');
            
            var options2 = {
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
                    { 'data': 'jam_hadir', 'name': 'presensi_karyawan.jam_hadir' },
                    { 'data': 'status_hadir', 'name': 'presensi_karyawan.status_hadir' },
                    { 'data': 'keterangan', 'name': 'presensi_karyawan.keterangan' },
                    // { 'data': 'Action', 'name': 'Action', 'orderable': false, 'searchable': false },
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
            setDataTable(elementTable2, options2);

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