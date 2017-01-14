@extends('partials.modal.content', [
    'modalTitle' => 'Delete Gaji',
    'modalSize'  => 'sm',
])

@section('content')
    @include('modules.gaji.form', [
        'url'      => url('/gaji/'. $gaji->id_karyawan),
        'method'   => 'delete',
        'disabled' => true,
    ])
@endsection
