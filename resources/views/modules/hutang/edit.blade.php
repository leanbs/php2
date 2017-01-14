@extends('partials.modal.content', [
    'modalTitle' => 'Edit Hutang',
    'modalSize'  => 'sm',
])

@section('content')
    @include('modules.hutang.form', [
        'url'    => url('/hutang/' . $hutang->id_hutang),
        'method' => 'patch',
    ])
@endsection
