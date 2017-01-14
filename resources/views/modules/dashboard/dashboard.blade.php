@extends('layouts.master')

@section('title')
    Dashboard
@endsection

@section('desc')
    Dashboard Toko Metro
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{ $penjualan[0] }}</h3>

              <p>Penjualan Hari ini</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <!-- <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>Rp. {{ number_format($keuntungan[0], 2, ",", ".") }}</h3>

              <p>Keuntungan Hari ini</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <!-- <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->
          </div>
        </div>
        <!-- ./col -->
        
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>{{ $presensi }}</h3>

              <p>Karyawan Absen</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-stalker"></i>
            </div>
            <!-- <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->
          </div>
        </div>
        <!-- ./col -->
      </div>

    <div class='row'>
        <div class='col-md-3'>
            <!-- Box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Top 10 Selling Product</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                    </div>

                    <div class="box-body">
                      <ul class="products-list product-list-in-box">
                        <li class="item">
                          <div class="product-info">
                          @foreach($transaksi as $transaksis)
                            <a href="javascript:void(0)" class="product-title">{{ $transaksis->kategori }}&nbsp;{{ $transaksis->merk }}
                              <span class="label label-warning pull-right">{{ $transaksis->jumlah }}</span></a>
                                <span class="product-description">{{ $transaksis->tipe_brg }}</span>
                                <hr>
                          @endforeach
                          </div>
                        </li>
                        <!-- /.item -->
                      </ul>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->

            </div>
        </div>

        <div class='col-md-3'>
            <!-- Box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Top 10 Buying Product</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                    </div>

                    <div class="box-body">
                      <ul class="products-list product-list-in-box">
                        <li class="item">
                          <div class="product-info">
                          @foreach($transaksi2 as $transaksis)
                            <a href="javascript:void(0)" class="product-title">{{ $transaksis->kategori }}&nbsp;{{ $transaksis->merk }}
                              <span class="label label-warning pull-right">{{ $transaksis->jumlah }}</span></a>
                                <span class="product-description">{{ $transaksis->tipe_brg }}</span>
                                <hr>
                          @endforeach
                          </div>
                        </li>
                        <!-- /.item -->
                      </ul>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->

            </div>
        </div>
        
        <div class='col-md-4'>
            <!-- Box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Dashboard</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div id="chart" style="margin-left: -2%;"></div>
            </div>
        </div>



    </div> <!-- row -->
</div>
@endsection

@section('script')
<script type="text/javascript">
 $('[data-toggle="tooltip"]').tooltip();

var test_array_JSONs = [
    {"Label 1": 20, "Label 2": 50, "Label 3": 30},
];

  c3.generate({
            'bindto' : '#chart',
            'data'   : {
                'url'      : '{{ url('/testing') }}',
                'mimeType' : 'json',
                'type'     : 'donut',
                'keys'     : {
                    'value' : [
                        'Pembelian',
                        'Penjualan',
                    ],
                },
            },
            'color'  : {
                'pattern': [
                    '#cccc00', // yellow
                    '#0066b2', // blue
                ],
            },
            'donut'  : {
                'title': 'Grafik Perbandingan',
            }
        });
</script>
@endsection
