@extends('partials.modal.content', [
    'modalTitle' => 'Tambah Jenis Transaksi',
    'modalSize'  => 'sm',
])

@section('content')
    @include('modules.jenistransaksi.form', [
        'url'    => url('/jenistransaksi'),
        'method' => 'post',
    ])
@endsection
