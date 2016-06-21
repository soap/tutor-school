<?php

namespace App\School\Repositories;

use DB;
use DataTables;
use App\School\Repositories\BaseRepository;
use App\Models\Student;

class StudentRepository extends BaseRepository
{
    public function getClassName()
    {
        return 'App\Models\Student';
    }

    public function all()
    {
        return Student::scope()
            ->with('education_level',  'province')
            ->withTrashed()
            ->where('is_deleted', '=', false)
            ->get();
    }

    public function find($filter = null)
    {
        $query = DB::table('students')
            ->join('name_titles', 'name_titles.id', '=', 'students.name_title_id')
            ->join('provinces', 'students.province_id', '=', 'provinces.id')
            ->join('education_levels', 'education_levels.id', '=', 'students.education_level_id')
            ->select(
                'students.id',
                'students.public_id',
                'first_name',
                'last_name',
                'students.short_name',
                'students.created_at',
                'students.updated_at',
                'students.deleted_at',
                'name_titles.name as name_title',
                'education_levels.short_name as education_level'
            );

        if (!\Session::get('show_trash:students')) {
            $query->where('students.deleted_at', '=', null);
        }

        if ($filter) {
            $query->where(function ($query) use ($filter) {

                $query->where('students.first_name', 'like', '%'.$filter.'%')
                    ->orWhere('students.last_name', 'like', '%'.$filter.'%');
            });
        }

        return $query;
    }

    public function save($data, $student = null)
    {
        $publicId = isset($data['public_id']) ? $data['public_id'] : false;

        if ($student) {
            // do nothing
        } elseif (!$publicId || $publicId == '-1') {
            $student = Student::createNew();
        } else {
            $student = Student::scope($publicId)->firstOrFail();
            //\Log::warning('Entity not set in client repo save');
        }

        $student->fill($data);
        $student->save();

        return $student;
    }

}
