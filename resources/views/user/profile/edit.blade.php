@extends('layouts.app')

@section('content')
    <div class="row">

        <div class="col-md-10 col-md-offset-1">

            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('labels.user.profile.update_information') }}</div>

                <div class="panel-body">

                    {!! Form::model($user, ['route' => 'user.profile.update', 'class' => 'form-horizontal', 'method' => 'PATCH']) !!}

                        <div class="form-group">
                            {!! Form::label('first_name', trans('validation.attributes.first_name'), ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::input('text', 'first_name', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.first_name')]) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form::label('last_name', trans('validation.attributes.last_name'), ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::input('text', 'last_name', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.last_name')]) !!}
                            </div>
                        </div>

                        @if ($user->canChangeEmail())
                            <div class="form-group">
                                {!! Form::label('email', trans('validation.attributes.email'), ['class' => 'col-md-4 control-label']) !!}
                                <div class="col-md-6">
                                    {!! Form::input('email', 'email', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.email')]) !!}
                                </div>
                            </div>
                        @endif

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                {!! Form::submit(trans('labels.general.buttons.save'), ['class' => 'btn btn-primary']) !!}
                            </div>
                        </div>

                    {!! Form::close() !!}

                </div><!--panel body-->

            </div><!-- panel -->

        </div><!-- col-md-10 -->

    </div><!-- row -->
@endsection