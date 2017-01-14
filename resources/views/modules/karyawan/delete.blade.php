@extends('partials.modal.content', [
    'modalTitle' => 'Delete Karyawan',
    'modalSize'  => 'sm',
])

@section('content')
    @include('modules.karyawan.form', [
        'url'      => url('/karyawan/'. $karyawan->id_karyawan),
        'method'   => 'delete',
        'disabled' => true,
    ])
@endsection
