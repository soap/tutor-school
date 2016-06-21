<?php

namespace App\School\Repositories;

use DB;
use Auth;
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
        $Id = isset($data['id']) ? $data['id'] : false;

        if ($student) {
            if ( !isset($data['updated_by'])) $data['updated_by'] = Auth::user()->id;
        } elseif (!$Id || $Id == '-1') {
            $student = new Student();
            if ( !isset($data['created_by'])) $data['created_by'] = Auth::user()->id;
        } else {
            $student = Student::scope($Id)->firstOrFail();
            if ( !isset($data['updated_by'])) $data['updated_by'] = Auth::user()->id;
        }

        $student->fill($data);
        $student->save();

        return $student;
    }

}
