<?php

namespace App\School\Datatables;

use URL;
use Auth;
use Carbon\Carbon;
use Datatables;

class StudentDatatable extends EntityDatatable
{
    public $entityType = ENTITY_STUDENT;

    public function columns()
    {
        return [
            [
                'id',
                function ($model) {
                    return $model->id;
                }
            ],
            [
                'name',
                function ($model) {
                    return link_to("students/{$model->id}", $model->name_title.' '.$model->first_name.' '.$model->last_name)->toHtml();
                }
            ],
            [
                'short_name',
                function ($model) {
                    return link_to("students/{$model->id}", $model->short_name ?: '')->toHtml();
                }
            ],
            [
                'education_level',
                function ($model) {
                    return $model->education_level;
                }
            ],
            [
                'created_at',
                function ($model) {
                    $date = new Carbon($model->created_at);
                    return $date->format('Y-m-d');
                }
            ],
            [
                'updated_at',
                function ($model) {
                    $date = new Carbon($model->updated_at);
                    return $date->format('Y-m-d');
                }
            ],
        ];
    }

    public function actions()
    {
        return [
            [
                trans('strings.students.edit'),
                function ($model) {
                    return URL::to("students/{$model->id}/edit");
                },
                function ($model) {
                    return true;//Auth::user()->can('editByOwner', [ENTITY_CLIENT, $model->user_id]);
                }
            ],
            [
                '--divider--', function(){return false;},
                function ($model) {
                    $user = Auth::user();
                    return true;//$user->can('editByOwner', [ENTITY_CLIENT, $model->user_id]) && ($user->can('create', ENTITY_TASK) || $user->can('create', ENTITY_INVOICE));
                }
            ],
            [
                trans('strings.invoices.add_new'),
                function ($model) {
                    return URL::to("invoices/create/{$model->id}");
                },
                function ($model) {
                    return true; //Auth::user()->can('create', ENTITY_INVOICE);
                }
            ],
            [
                '--divider--', function(){return false;},
                function ($model) {
                    $user = Auth::user();
                    return true; //($user->can('create', ENTITY_TASK) || $user->can('create', ENTITY_INVOICE)) && ($user->can('create', ENTITY_PAYMENT) || $user->can('create', ENTITY_CREDIT) || $user->can('create', ENTITY_EXPENSE));
                }
            ],
            [
                trans('strings.payments.enter_payment'),
                function ($model) {
                    return URL::to("payments/create/{$model->id}");
                },
                function ($model) {
                    return true; //Auth::user()->can('create', ENTITY_PAYMENT);
                }
            ]
        ];
    }
}