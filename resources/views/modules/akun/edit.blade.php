@extends('partials.modal.content', [
    'modalTitle' => 'Edit Akun',
    'modalSize'  => 'sm',
])

@section('content')
    @include('modules.akun.form', [
        'url'    => url('/akun/' . $akun->id),
        'method' => 'patch',
    ])
@endsection
