@extends('partials.modal.content', [
    'modalTitle' => 'Tambah Toko',
    'modalSize'  => 'sm',
])

@section('content')
    @include('modules.toko.form', [
        'url'    => url('/toko'),
        'method' => 'post',
    ])
@endsection
