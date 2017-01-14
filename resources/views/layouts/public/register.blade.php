@extends('layouts.public.master')

@section('title')
    Login
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @include('auth.register')
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection
