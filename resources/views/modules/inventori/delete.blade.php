@extends('partials.modal.content', [
    'modalTitle' => 'Delete Inventori',
    'modalSize'  => 'sm',
])

@section('content')
    @include('modules.inventori.form', [
        'url'      => url('/inventori/'. $inventori->tipe_brg),
        'method'   => 'delete',
        'disabled' => true,
    ])
@endsection
