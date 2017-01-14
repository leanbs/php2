@extends('partials.modal.content', [
    'modalTitle' => 'Edit Inventori',
    'modalSize'  => 'sm',
])

@section('content')
    @include('modules.inventori.form', [
        'url'    => url('/inventori/' . $inventori->tipe_brg),
        'method' => 'patch',
    ])
@endsection
