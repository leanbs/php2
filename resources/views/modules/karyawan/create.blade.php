@extends('partials.modal.content', [
    'modalTitle' => 'Tambah Karyawan',
    'modalSize'  => 'sm',
])

@section('content')
    @include('modules.karyawan.form', [
        'url'    => url('/karyawan'),
        'method' => 'post',
    ])
@endsection
