<?php

namespace App\Models;

use Eloquent;

class Province extends Eloquent
{
    public $timestamps = false;

    protected $visible = [
        'id',
        'name_th',
        'name_en',
    ];

    protected $casts = [
    ];

    public function getName()
    {
        return $this->name_th;
    }
}