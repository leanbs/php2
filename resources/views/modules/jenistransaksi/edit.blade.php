@extends('partials.modal.content', [
    'modalTitle' => 'Edit Jenis Transaksi',
    'modalSize'  => 'sm',
])

@section('content')
    @include('modules.jenistransaksi.form', [
        'url'    => url('/jenistransaksi/' . $jenistransaksi->id_jenis_transaksi),
        'method' => 'patch',
    ])
@endsection
