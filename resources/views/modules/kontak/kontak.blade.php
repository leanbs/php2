@extends('layouts.master')

@section('title')
    Manajemen Kontak
@endsection

@section('modals')
    @include('partials.modal.index')
@endsection

@section('content')
    <div class="box">
      <div class="box-body">
        <h1>
          <i class="fa fa-cart-plus"></i>
          Kontak

          <a href="{{ url('/kontak/create') }}" data-modal="" class="btn btn-success btn-compact pull-right">
              <i class="fa fa-plus"></i>
              Tambah Kontak
          </a>
        </h1>
        <table id="table-kontak" class="table-kontak table table-bordered table-hover table-striped">
          <thead>
              <tr>
                <th>Nama Perusahaan / Toko</th>
                <th>Nama Kontak</th>
                <th>Alamat</th>
                <th>No Telepon</th>
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

        <div class="row">
          <div class="col-md-12 col-xs-12">
                <input id="pac-input" class="controls" type="text" placeholder="Search Box">
                <div class="container" id="map-canvas" style="height:300px !important;"></div>
          </div>
        </div>
        
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
            'nama_perusahaan':  {
              'required'  : true,
              'maxlength' : 50,
            },
        };

        function init() {
           var map = new google.maps.Map(document.getElementById('map-canvas'), {
             center: {
               lat: 12.9715987,
               lng: 77.59456269999998
             },
             zoom: 12
           });


           var searchBox = new google.maps.places.SearchBox(document.getElementById('pac-input'));
           map.controls[google.maps.ControlPosition.TOP_CENTER].push(document.getElementById('pac-input'));
           google.maps.event.addListener(searchBox, 'places_changed', function() {
             searchBox.set('map', null);


             var places = searchBox.getPlaces();

             var bounds = new google.maps.LatLngBounds();
             var i, place;
             for (i = 0; place = places[i]; i++) {
               (function(place) {
                 var marker = new google.maps.Marker({

                   position: place.geometry.location
                 });
                 marker.bindTo('map', searchBox, 'map');
                 google.maps.event.addListener(marker, 'map_changed', function() {
                   if (!this.getMap()) {
                     this.unbindAll();
                   }
                 });
                 bounds.extend(place.geometry.location);


               }(place));

             }
             map.fitBounds(bounds);
             searchBox.set('map', map);
             map.setZoom(Math.min(map.getZoom(),12));

           });
         }
        google.maps.event.addDomListener(window, 'load', init);

        $(document).ready(function() {
            var elementTable = $('#table-kontak');

            var options = {
                'columnDefs': [
                    {
                        'className' : 'text-center text-nowrap',
                        'targets'   : [0, 2]
                    },
                ],
                'processing' : true,
                'serverSide' : true,
                'ajax'       : '{{ url('/kontak') }}',
                'columns'    : [
                    { 'data': 'nama_perusahaan', 'name': 'kontak.nama_perusahaan' },
                    { 'data': 'nama', 'name': 'kontak.nama' },
                    { 'data': 'alamat', 'name': 'kontak.alamat' },
                    { 'data': 'no_telp', 'name': 'kontak.no_telp' },
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

