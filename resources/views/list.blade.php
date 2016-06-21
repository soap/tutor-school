@extends('layouts.app')

@section('contentheader_title')

    {{ $title }}

@endsection

@section('toolbar')
    <div class="btn-toolbar" role="toolbar" aria-label="Toolbar">
        <div class="btn-group" role="group" aria-label="{{ $entity }}">
            <button type="button" class="btn btn-default">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                <a href="{{ url("/$entity") }}s/create">New {{ ucfirst($entity) }}</a>
            </button>
        </div>
    </div>
@endsection

@section('main-content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    {!! $table->table() !!}
                </div>
            </div>
        </div>
    </div>
@stop


@section('scripts')
    @parent

    <script src="/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="/plugins/datatables/dataTables.bootstrap.min.js"></script>
    <link href="/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css"/>

    {!! $table->scripts() !!}
@stop
