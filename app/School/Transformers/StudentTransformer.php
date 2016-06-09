<?php

namespace App\School\Transformers;

use App\Models\Student;
use League\Fractal;

class StudentTransformer extends EntityTransformer
{
    public function __construct($serializer = null)
    {
        parent::__construct($serializer);
    }

    public function transform(Student $student)
    {
        return array_merge($this->getDefaults($student), [

        ]);
    }
}