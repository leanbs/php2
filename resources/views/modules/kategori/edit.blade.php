@extends('partials.modal.content', [
    'modalTitle' => 'Edit Kategori',
    'modalSize'  => 'sm',
])

@section('content')
    @include('modules.kategori.form', [
        'url'    => url('/kategori/' . $kategori->id_kategori),
        'method' => 'patch',
    ])
@endsection
