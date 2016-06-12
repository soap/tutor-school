@extends('layouts.app')

@section('contentheader_title')

{{ trans($title) }}

@endsection

@section('toolbar')
    <div class="btn-toolbar" role="toolbar" aria-label="Toolbar">
        <div class="btn-group" role="group" aria-label="students">
            <button type="button" class="btn btn-default">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                <a href="{{ url("/students/create") }}">New Student</a>
            </button>
        </div>
    </div>
@endsection

@section('main-content')
    <div class="row">
        <table class="table table-bordered" id="students-table">
            <thead>
            <tr>
                <th>Id</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Action</th>
            </tr>
            </thead>
        </table>
    </div>
@stop



@section('scripts')
@parent

<script src="/plugins/datatables/jquery.dataTables.min.js"></script>
<link href="/plugins/datatables/jquery.dataTables.css" rel="stylesheet" type="text/css"/>

<script>
    $(function() {
        $('#students-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url : '{!! route('api.students') !!}',
                data: function (d) {
                    d.name = $('input[name=name]').val();
                    d.email = $('input[name=email]').val();
                }
            },
            columns: [
                { data: 'id', name: 'id' },
                { data: 'first_name', name: 'first_name' },
                { data: 'last_name', name: 'last_name' },
                { data: 'created_at', name: 'created_at' },
                { data: 'updated_at', name: 'updated_at' },
                { data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });
    });
</script>
@stop
