<?php

namespace App\School\Transformers;

use App\Models\Student;
use League\Fractal;
use Carbon\Carbon;

class StudentTransformer extends EntityTransformer
{
    public function __construct($serializer = null)
    {
        parent::__construct($serializer);
    }

    public function transform(Student $student)
    {
        return array_merge($this->getDefaults($student), [
            'id'            => (int) $student['id'],
            'first_name'    => $student['first_name'],
            'last_name'     => $student['last_name'],
            'created_at'    => $this->dateFormatter($student['created_at']),
            'updated_at'    => $this->dateFormatter($student['updated_at']),
        ]);
    }

    /**
     * @param null|DateTime $dateTime
     * @return string
     */
    public function dateFormatter($dateTime)
    {
        return $dateTime ? with(new Carbon($dateTime))->format($this->getDateFormat()) : null;
    }

    /**
     * @return string
     */
    public function getDateFormat()
    {
        return 'Y-m-d';
    }
}