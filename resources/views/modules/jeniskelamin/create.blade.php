@extends('partials.modal.content', [
    'modalTitle' => 'Tambah Jenis Kelamin',
    'modalSize'  => 'sm',
])

@section('content')
    @include('modules.jeniskelamin.form', [
        'url'    => url('/jeniskelamin'),
        'method' => 'post',
    ])
@endsection
