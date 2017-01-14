@extends('partials.modal.content', [
    'modalTitle' => 'Delete Jenis Transaksi',
    'modalSize'  => 'sm',
])

@section('content')
    @include('modules.jenistransaksi.form', [
        'url'      => url('/jenistransaksi/'. $jenistransaksi->id_jenis_transaksi),
        'method'   => 'delete',
        'disabled' => true,
    ])
@endsection
