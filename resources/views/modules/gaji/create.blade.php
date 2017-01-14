@extends('partials.modal.content', [
    'modalTitle' => 'Tambah Gaji',
    'modalSize'  => 'sm',
])

@section('content')
    @include('modules.gaji.form', [
        'url'    => url('/gaji'),
        'method' => 'post',
    ])
@endsection
