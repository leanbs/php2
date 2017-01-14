@extends('partials.modal.content', [
    'modalTitle' => 'Delete Kategori',
    'modalSize'  => 'sm',
])

@section('content')
    @include('modules.kategori.form', [
        'url'      => url('/kategori/'. $kategori->id_kategori),
        'method'   => 'delete',
        'disabled' => true,
    ])
@endsection
