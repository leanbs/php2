@extends('partials.modal.content', [
    'modalTitle' => 'Edit Presensi',
    'modalSize'  => 'sm',
])

@section('content')
    @include('modules.presensi.form', [
        'url'    => url('/presensi/' . $presensi->id_presensi),
        'method' => 'patch',
    ])
@endsection
