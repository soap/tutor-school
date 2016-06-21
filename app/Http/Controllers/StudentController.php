<?php

namespace App\Http\Controllers;

use View;
use Auth;
use DB;
use Validator;
use Input;
use Cache;
use App\Models\Student;
use App\Models\Province;
use App\Models\EducationLevel;
use App\Http\Requests\StudentRequest;
use App\Http\Requests\CreateStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\School\Repositories\StudentRepository;
use App\Services\StudentService;
use Illuminate\Http\Request;
use Yajra\Datatables\Html\Builder;


class StudentController extends Controller
{
    protected $studentRepo;
    protected $studentService;
    protected $entityType = ENTITY_STUDENT;

    public function __construct(StudentService $studentService, StudentRepository $studentRepo)
    {
        $this->studentRepo = $studentRepo;
        $this->studentService = $studentService;
    }

    public function index(Builder $htmlBuilder)
    {
        $table = $htmlBuilder
            ->addColumn(['data' => 'id', 'name'=> 'students.id', 'title' => 'Id', 'searchable' => false ])
            ->addColumn(['data' => 'name', 'name' => 'students.first_name', 'title' => 'Full Name', 'searchable' => false])
            ->addColumn(['data' => 'short_name', 'name' => 'students.short_name', 'title' =>'Short Name', 'searchable' => false])
            ->addColumn(['data' => 'education_level', 'name' => 'education_level', 'title' =>'Level', 'searchable' => false])
            ->addColumn(['data' => 'created_at', 'name' => 'created_at', 'title' => 'Created At', 'searchable' => false])
            ->addColumn(['data' => 'updated_at', 'name' => 'updated_at', 'title' =>'Updated At', 'searchable' => false])
            //->addColumn(['data' => 'dropdown', 'name' => 'dropdown', 'title' => 'Action', 'orderable' => false, 'searchable' => false])
            ->ajax(['url'=>  route('api.students')])
        ->addAction();
        $data = [
            'title' => trans('strings.students.students'),
            'entity'=> $this->entityType,
            'table' => $table
        ];
        return View::make('list', $data);
    }

    public function create()
    {
        $data = [
            'title' => "strings.students.add_new",
            'url'=> route('students.save'),
            'method' => 'POST'
        ];

        $data = array_merge($data, self::getViewModel());

        return View::make('students.edit', $data);
    }

    public function edit(StudentRequest $request)
    {
        $student = $request->entity();

        $data = [
            'client' => $student,
            'method' => 'PUT',
            'url' => 'students/'.$student->public_id,
            'title' => trans('texts.edit_client'),
        ];

        $data = array_merge($data, self::getViewModel());

        return View::make('students.edit', $data);
    }
    /**
     * Save new student record
     * @param CreateStudentRequest $request
     * @return boolean
     */
    public function store(CreateStudentRequest $request)
    {
        $student = $this->studentRepo->save($request->input());

        return redirect()->to($student->getRoute());
    }

    /**
     * Save existing student record
     * @param UpdateStudentRequest $request
     */
    public function update(UpdateStudentRequest $request)
    {

    }

    /**
     * Get list of students to be use in Datatable
     * @param Request $request
     * @return mixed
     */
    public function getDataTable(Request $request)
    {
        $search = $request->get('search')['value'];

        return $this->studentService->getDatatable($search);
    }

    private static function getViewModel()
    {
        return [
            'data' => Input::old('data'),
            'name_titles' => DB::table('name_titles')->select('id', 'name')->get(),
            'provinces' => Province::get(),
            'education_levels' => EducationLevel::get()
        ];
    }
}
