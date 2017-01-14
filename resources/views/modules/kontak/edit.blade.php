@extends('partials.modal.content', [
    'modalTitle' => 'Edit Kontak',
    'modalSize'  => 'sm',
])

@section('content')
    @include('modules.kontak.form', [
        'url'    => url('/kontak/' . $kontak->id_kontak),
        'method' => 'patch',
    ])
@endsection
