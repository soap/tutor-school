<?php

namespace App\School\Presenters;

class StudentPresenter extends EntityPresenter
{
    public function province()
    {

    }

    public function fullName()
    {
        return $this->entity->first_name.' '.$this->entity->last_name;
    }
}