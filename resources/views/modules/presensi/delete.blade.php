@extends('partials.modal.content', [
    'modalTitle' => 'Delete Presensi',
    'modalSize'  => 'sm',
])

@section('content')
    @include('modules.presensi.form', [
        'url'      => url('/presensi/'. $presensi->id_presensi),
        'method'   => 'delete',
        'disabled' => true,
    ])
@endsection
