<?php

namespace App\Services;

use Auth;
use App\School\Repositories\StudentRepository;
use App\School\Datatables\StudentDatatable;
use Illuminate\Foundation\Bus\DispatchesJobs;
use App\Services\DatatableService;

class StudentService extends BaseService
{
    protected $studentRepo;
    protected $datatableService;

    public function __construct(StudentRepository $studentRepo, DatatableService $datatableService)
    {
        $this->studentRepo = $studentRepo;
        $this->datatableService = $datatableService;
    }

    public function getDatatable($search)
    {
        $datatable = new StudentDatatable();

        $query = $this->studentRepo->find($search);

        return $this->datatableService->createDatatable($datatable, $query);
    }
}