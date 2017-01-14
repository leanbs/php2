@extends('partials.modal.content', [
    'modalTitle' => 'Delete Toko',
    'modalSize'  => 'sm',
])

@section('content')
    @include('modules.toko.form', [
        'url'      => url('/toko/'. $toko->id_toko),
        'method'   => 'delete',
        'disabled' => true,
    ])
@endsection
