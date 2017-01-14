@extends('partials.modal.content', [
    'modalTitle' => 'Tambah Inventori',
    'modalSize'  => 'sm',
])

@section('content')
    @include('modules.inventori.form', [
        'url'    => url('/inventori'),
        'method' => 'post',
    ])
@endsection
