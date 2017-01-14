@extends('partials.modal.content', [
    'modalTitle' => 'Tambah Merk',
    'modalSize'  => 'sm',
])

@section('content')
    @include('modules.merk.form', [
        'url'    => url('/merk'),
        'method' => 'post',
    ])
@endsection
