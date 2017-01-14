@extends('partials.modal.content', [
    'modalTitle' => 'Tambah Presensi',
    'modalSize'  => 'sm',
])

@section('content')
    @include('modules.presensi.form', [
        'url'    => url('/presensi'),
        'method' => 'post',
    ])
@endsection
