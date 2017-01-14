@extends('partials.modal.content', [
    'modalTitle' => 'Edit Gaji',
    'modalSize'  => 'sm',
])

@section('content')
    @include('modules.gaji.form', [
        'url'    => url('/gaji/' . $gaji->id_karyawan),
        'method' => 'patch',
    ])
@endsection
