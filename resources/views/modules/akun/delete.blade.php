@extends('partials.modal.content', [
    'modalTitle' => 'Delete Akun',
    'modalSize'  => 'sm',
])

@section('content')
    @include('modules.akun.form', [
        'url'      => url('/akun/'. $akun->id),
        'method'   => 'delete',
        'disabled' => true,
    ])
@endsection
