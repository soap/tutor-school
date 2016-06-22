@extends("layouts.app")

@section("contentheader_title")

    {{ trans($title) }}

@endsection

@section("main-content")
<div class="row">
    <div clas="col-md-10">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">{!! $student->present()->fullname() !!}</h3>
            </div>
            <div class="box-body">

            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="box box-info">
        <div class="box-header with-border">

        </div>
        <div class="box-body">
            <ul class="nav nav-tabs nav-justified">
                {!! Form::tab_link('#activity', trans('strings.activities.activities'), true) !!}
                {!! Form::tab_link('#registrations', trans('strings.registrations.registrations')) !!}
                {!! Form::tab_link('#invoices', trans('strings.invoices.invoices')) !!}
                {!! Form::tab_link('#payments', trans('strings.payments.payments')) !!}
            </ul>
            <div class="tab-content">

                <div class="tab-pane active" id="activity">

                </div>
                <div class="tab-pane" id="registrations">

                </div>
                <div class="tab-pane" id="invoices">

                </div>
                <div class="tab-pane" id="payments">

                </div>
            </div>
        </div>
    </div>
</div>
@endsection