<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    protected $student;

    public function __construct()
    {
        $this->student = new Student();
    }

    public function index()
    {
        return $this->student->where('is_active', 1)
                    ->whereNull('deleted_at')
                    ->get();
    }

    public function store(Request $request)
    {
        return $this->student->create($request->all());
    }

    public function show(string $id)
    {
        $student = $this->student->where('id', $id)
                        ->where('is_active', 1)
                        ->whereNull('deleted_at')
                        ->first();

        return $student;
    }

    public function update(Request $request, string $id)
    {
        $student = $this->student->find($id);
        $student->update($request->all());

        return $student;
    }

    public function destroy(string $id)
    {
        $student = $this->student->find($id);

        $student->softDeleteWithTimezone();

        return 'Successfully deleted user '.$student['fullname'];
    }
}
