<?php

namespace App\Http\Controllers;

use View;
use Auth;
use App\Models\Student;
use App\Http\Requests;
use Illuminate\Http\Request;


class StudentController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Students',
            'students' => $students = Student::get()
        ];
        return View::make('students.index', $data);
    }

    public function getDataTable()
    {
        //$user = Auth::guard('api')->user();
    }
}
