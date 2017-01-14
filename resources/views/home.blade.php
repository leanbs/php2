@extends('layouts.master')

@section('title')
    Dashboard
@endsection

@section('desc')
    Dashboard Toko Metro
@endsection

@section('content')
<div class="container">
    <div class='row'>
        <div class='col-md-6'>
            <!-- Box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Dashboard</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
