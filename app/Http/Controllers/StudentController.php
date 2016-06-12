<?php

namespace App\Http\Controllers;

use View;
use Auth;
use App\Models\Student;
use App\Http\Requests;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class StudentController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Students'
        ];
        return View::make('students.index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'New Student'
        ];
        return View::make('students.edit', $data);
    }

    public function getDataTable(Request $request)
    {
        $students = Student::select(['id', 'first_name', 'last_name', 'created_at', 'updated_at']);

        return Datatables::of($students)
            ->setTransformer('App\School\Transformers\StudentTransformer')
            ->addColumn('action', function ($student) {
                return '<a href="#edit-'.$student->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
            })
            ->editColumn('id', '{{$id}}')
            //->removeColumn('password')
            ->setRowId('id')
            ->setRowClass(function ($student) {
                return $student->id % 2 == 0 ? 'alert-success' : 'alert-warning';
            })
            ->setRowData([
                'id' => 'test',
            ])
            ->setRowAttr([
                'color' => 'red',
            ])
            ->make(true);
    }
}
