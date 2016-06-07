@extends('layouts.app')

@section('content')
    <div class="row">

        <div class="col-md-10 col-md-offset-1">

            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('labels.user.passwords.change') }}</div>

                <div class="panel-body">

                    {!! Form::open(['route' => ['auth.password.update'], 'class' => 'form-horizontal']) !!}

                    <div class="form-group">
                        {!! Form::label('old_password', trans('validation.attributes.old_password'), ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::input('password', 'old_password', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.old_password')]) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('password', trans('validation.attributes.new_password'), ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::input('password', 'password', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.new_password')]) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('password_confirmation', trans('validation.attributes.new_password_confirmation'), ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::input('password', 'password_confirmation', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.new_password_confirmation')]) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            {!! Form::submit(trans('labels.general.buttons.update'), ['class' => 'btn btn-primary']) !!}
                        </div>
                    </div>

                    {!! Form::close() !!}

                </div><!--panel body-->

            </div><!-- panel -->

        </div><!-- col-md-10 -->

    </div><!-- row -->
@endsection