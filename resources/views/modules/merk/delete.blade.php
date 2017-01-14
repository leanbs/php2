@extends('partials.modal.content', [
    'modalTitle' => 'Delete Merk',
    'modalSize'  => 'sm',
])

@section('content')
    @include('modules.merk.form', [
        'url'      => url('/merk/'. $merk->id_merk),
        'method'   => 'delete',
        'disabled' => true,
    ])
@endsection
