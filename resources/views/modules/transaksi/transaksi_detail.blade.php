@extends('partials.modal.content', [
    'modalTitle' => 'Transaksi Details',
    'modalSize'  => 'md',
])

@section('content')
    <div class="transaksi-details">
        <div class="overall-information">
            <div class="row">
                <div class="col-md-11">
                    <div class="transaksi-project-name">
                        <dl class="dl-horizontal dl-custom pull-left">
                            <dt>Penjual</dt>
                            <dd>{{ $karyawan }}</dd>

                            <dt>No Nota</dt>
                            <dd>{{ $id_transaksi }}</dd>
                        </dl>

                        <dl class="dl-horizontal dl-custom pull-right">
                            <dt>Tanggal</dt>
                            <dd>{{ $tanggal }}</dd>

                            <dt>Pembeli</dt>
                            <dd>{{ $nama_pelanggan }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <div class="transaksi-details-container">
            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                <table class="table table-striped table-bordered table-list">
                  <thead>
                    <tr>
                        <th class="hidden-xs">No</th>
                        <th>Barang</th>           
                        <th>Harga Modal</th>
                        <th>Harga Satuan</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                    </tr> 
                  </thead>
                  <tbody>
                  <?php $no=0; ?>
                    @foreach($detil as $index => $detils)
                    <?php $no++; ?>                  
                        <tr>
                            <td>{{$no}}</td>
                            <td>{{$harga_modal[$index]->kategori}} {{$harga_modal[$index]->merk}}, {{$detils->tipe_barang}}</td>
                            
                            <td class="hrg_modal">{{ number_format( $harga_modal[$index]->harga_barang, 2, ",", ".") }}</td>
                            <td class="harga">{{ number_format( $detils->harga, 2, ",", ".") }}</td>
                            <td class="jumlah">{{ $detils->jumlah }}</td>
                            <td class="price">{{  $detils->harga_total }}</td>
                        </tr>
                    @endforeach
                   </tbody>
                </table>
                <div class="form-group">
                    <textarea name="keterangan" id="keterangan" class="form-control" cols="30" rows="5" disabled="true">@foreach($detil as $detils)
{{{$detils->keterangan}}} 
@endforeach
                    </textarea>
                </div>
                <div class="pull-right">
                    <label>Harga Total : <label id="result"></label></label>
                </div>
            </div><!-- /.panel-group -->
        </div><!-- /.candidate-details-container -->
    </div><!-- /#candidate-details -->

    <button type="button" class="btn btn-submit btn-md" data-dismiss="modal">Close</button>
@endsection