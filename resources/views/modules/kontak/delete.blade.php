@extends('partials.modal.content', [
    'modalTitle' => 'Delete Kontak',
    'modalSize'  => 'sm',
])

@section('content')
    @include('modules.kontak.form', [
        'url'      => url('/kontak/'. $kontak->id_kontak),
        'method'   => 'delete',
        'disabled' => true,
    ])
@endsection
