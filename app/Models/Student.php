<?php

namespace App\Models;

use Laracasts\Presenter\PresentableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\EntityModel;

class Student extends EntityModel
{
    use SoftDeletes;
    use PresentableTrait;

    protected $presenter = 'App\School\Presenters\StudentPresenter';

    protected $fillable = [
        'name_title_id',
        'first_name',
        'last_name',
        'short_name',
        'education_level_id',
        'billable_address',
        'avatar',
        'citizen_id',
        'birth_date',
        'address1',
        'address2',
        'city',
        'province_id',
        'postal_code',
        'private_note',
        'status'
    ];

    protected $dates = ['deleted_at'];

    /**
     * Scope a query to only include active users.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function education_level()
    {
        return $this->hasOne('App\Models\EducationLevel');
    }

    public function province()
    {
        return $this->hasOne('App\Models\Province');
    }

    public function getRoute()
    {
        return "/students";
    }
}
