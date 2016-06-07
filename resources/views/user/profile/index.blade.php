@extends('layouts.app')

@section('content')
    <div class="row">

        <div class="col-md-10 col-md-offset-1">

            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('navs.user.my_profile') }}</div>

                <div class="panel-body">
                    <div role="tabpanel">

                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active">
                                <a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">{{ trans('navs.user.my_information') }}</a>
                            </li>
                        </ul>

                        <div class="tab-content">

                            <div role="tabpanel" class="tab-pane active" id="profile">
                                <table class="table table-striped table-hover table-bordered dashboard-table">
                                    <tr>
                                        <th>{{ trans('labels.user.profile.avatar') }}</th>
                                        <td><img src="{!! $user->picture !!}" class="user-profile-image" /></td>
                                    </tr>
                                    <tr>
                                        <th>{{ trans('labels.user.profile.name') }}</th>
                                        <td>{!! $user->first_name !!} {!! $user->last_name !!}</td>
                                    </tr>
                                    <tr>
                                        <th>{{ trans('labels.user.profile.email') }}</th>
                                        <td>{!! $user->email !!}</td>
                                    </tr>
                                    <tr>
                                        <th>{{ trans('labels.user.profile.created_at') }}</th>
                                        <td>{!! $user->created_at !!} ({!! $user->created_at->diffForHumans() !!})</td>
                                    </tr>
                                    <tr>
                                        <th>{{ trans('labels.user.profile.last_updated') }}</th>
                                        <td>{!! $user->updated_at !!} ({!! $user->updated_at->diffForHumans() !!})</td>
                                    </tr>
                                    <tr>
                                        <th>{{ trans('labels.general.actions') }}</th>
                                        <td>
                                            <a href="{!! route('user.profile.edit') !!}" class="btn btn-primary btn-xs">{{ trans('labels.user.profile.edit') }}</a>

                                            @if ($user->id)
                                                <a href="{!! route('auth.password.change') !!}" class="btn btn-warning btn-xs">{{ trans('navs.user.change_password') }}</a>
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                            </div><!--tab panel profile-->

                        </div><!--tab content-->

                    </div><!--tab panel-->

                </div><!--panel body-->

            </div><!-- panel -->

        </div><!-- col-md-10 -->

    </div><!-- row -->
@endsection