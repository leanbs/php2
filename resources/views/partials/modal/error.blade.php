@extends('partials.modal.content', [
    'modalTitle' => 'Error',
    'modalSize'  => 'sm',
])

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="alert alert-danger">
                {{ $error }}
            </div>
        </div>
    </div>

    {!! Form::button('Close', [
        'class'        => 'btn btn-submit btn-sm',
        'data-dismiss' => 'modal',
    ]) !!}
@endsection
