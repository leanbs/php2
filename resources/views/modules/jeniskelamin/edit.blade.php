@extends('partials.modal.content', [
    'modalTitle' => 'Edit Jenis Kelamin',
    'modalSize'  => 'sm',
])

@section('content')
    @include('modules.jeniskelamin.form', [
        'url'    => url('/jeniskelamin/' . $jeniskelamin->id_jns_kelamin),
        'method' => 'patch',
    ])
@endsection
