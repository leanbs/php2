@extends('partials.modal.content', [
    'modalTitle' => 'Delete Hutang',
    'modalSize'  => 'sm',
])

@section('content')
    @include('modules.hutang.form', [
        'url'      => url('/hutang/'. $hutang->id_hutang),
        'method'   => 'delete',
        'disabled' => true,
    ])
@endsection
