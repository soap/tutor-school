@extends("layouts.app")

@section("contentheader_title")

    {{ trans($title) }}

@endsection

@section("main-content")
    <div class="row">
        {!!  Former::open($url)
            ->method($method)
        !!}
        @if ($student)
            {!! Former::populate($student) !!}
            {!! Former::hidden('public_id') !!}
        @endif
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>{{ trans("strings.students.contact") }}</h4>
                    </div>
                    <div class="panel-body">
                        {!! Former::select('name_title_id')->id('name_title_id')->label('Title')
                            ->fromQuery($name_titles,'name', 'id')
                        !!}
                        {!! Former::text('first_name')->required() !!}
                        {!! Former::text('last_name')->required() !!}
                        {!! Former::text('short_name') !!}
                        {!! Former::text('citizen_id') !!}
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>{{ trans("strings.students.billing_info") }}</h4>
                    </div>
                    <div class="panel-body">
                        {!! Former::textarea('billing_address')->label('Billing Address')
                            ->rows(4)
                         !!}
                        {!! Former::text('credit')->value(15) !!}
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>{{ trans("strings.students.address") }}</h4>
                    </div>
                    <div class="panel-body">
                        {!! Former::text('address1') !!}
                        {!! Former::text('address2') !!}
                        {!! Former::text('city') !!}
                        {!! Former::select('province_id')->addOption('','')->fromQuery($provinces, 'name_th', 'id')
                            ->id('province_id')->class('form-control')->label('Province')->style('width: 75%')
                         !!}
                        {!! Former::text('postal_code') !!}
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>{{ trans("strings.students.additional_info") }}</h4>
                    </div>
                    <div class="panel-body">
                        {!! Former::select('education_level_id')->fromQuery($education_levels, 'name', 'id')
                            ->id('education_level_id')->class('form-control')->style('width: 75%')
                        !!}
                        {!! Former::textarea('private_note') !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="buttons pull-right">
            {!! Button::success(trans('buttons.general.save'))->submit()->large()->appendIcon(Icon::create('floppy-disk')) !!}
            {!! Button::normal(trans('buttons.general.cancel'))->large()->asLinkTo(url('/students'))->appendIcon(Icon::create('remove-circle')) !!}
        </div>

        {!!  Former::close() !!}
    </div>
@endsection

@section('scripts')
    @parent
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script type="text/javascript">
        $('#province_id').select2({placeholder: 'Select province'});
        $('#education_level_id').select2({placeholder: 'Select education'});
    </script>
@endsection