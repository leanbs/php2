@extends('partials.modal.content', [
    'modalTitle' => 'Edit Karyawan',
    'modalSize'  => 'sm',
])

@section('content')
    @include('modules.karyawan.form', [
        'url'    => url('/karyawan/' . $karyawan->id_karyawan),
        'method' => 'patch',
    ])
@endsection
