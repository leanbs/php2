@extends('partials.modal.content', [
    'modalTitle' => 'Tambah Akun',
    'modalSize'  => 'sm',
])

@section('content')
    @include('modules.akun.form', [
        'url'    => url('/akun'),
        'method' => 'post',
    ])
@endsection
