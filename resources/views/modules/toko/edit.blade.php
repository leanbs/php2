@extends('partials.modal.content', [
    'modalTitle' => 'Edit Toko',
    'modalSize'  => 'sm',
])

@section('content')
    @include('modules.toko.form', [
        'url'    => url('/toko/' . $toko->id_toko),
        'method' => 'patch',
    ])
@endsection
