@extends('partials.modal.content', [
    'modalTitle' => 'Tambah Kategori',
    'modalSize'  => 'sm',
])

@section('content')
    @include('modules.kategori.form', [
        'url'    => url('/kategori'),
        'method' => 'post',
    ])
@endsection
