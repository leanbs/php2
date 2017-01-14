@extends('partials.modal.content', [
    'modalTitle' => 'Tambah Kontak',
    'modalSize'  => 'sm',
])

@section('content')
    @include('modules.kontak.form', [
        'url'    => url('/kontak'),
        'method' => 'post',
    ])
@endsection
