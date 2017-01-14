@extends('partials.modal.content', [
    'modalTitle' => 'Edit Merk',
    'modalSize'  => 'sm',
])

@section('content')
    @include('modules.merk.form', [
        'url'    => url('/merk/' . $merk->id_merk),
        'method' => 'patch',
    ])
@endsection
