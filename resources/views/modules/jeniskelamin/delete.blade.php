@extends('partials.modal.content', [
    'modalTitle' => 'Delete Jenis Kelamin',
    'modalSize'  => 'sm',
])

@section('content')
    @include('modules.jeniskelamin.form', [
        'url'      => url('/jeniskelamin/'. $jeniskelamin->id_jns_kelamin),
        'method'   => 'delete',
        'disabled' => true,
    ])
@endsection
