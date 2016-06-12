<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name_title_id',
        'first_name',
        'last_name',
        'education_level_id',
        'billable_address',
        'avatar',
        'citizen_id',
        'birth_date',
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
        $this->belongsTo('App\Models\EducationLevel');
    }


}
