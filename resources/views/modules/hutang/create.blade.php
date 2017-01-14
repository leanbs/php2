@extends('partials.modal.content', [
    'modalTitle' => 'Tambah Hutang',
    'modalSize'  => 'sm',
])

@section('content')
    @include('modules.hutang.form', [
        'url'    => url('/hutang'),
        'method' => 'post',
    ])
@endsection
