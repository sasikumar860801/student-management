<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

   

    public function store(Request $request)
{
    $validated = $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'mobile' => 'required|digits:10',
        'email' => 'required|email|unique:students,email',
        'address' => 'required|string',
        'department_id' => 'required|exists:departments,id',
        'status' => 'required|in:active,inactive',
    ]);

    $student = Student::create($validated);

    return response()->json(['student' => $student]);
}

public function update(Request $request, $id)
{
    
    $validated = $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'mobile' => 'required|digits:10',
        'email' => 'required|email|unique:students,email,' . $id,
        'address' => 'required|string',
        'department_id' => 'required|exists:departments,id',
        'status' => 'required|in:active,inactive',
    ]);

    $student = Student::findOrFail($id);
    $student->update($validated);

    return response()->json(['student' => $student]);
}

public function edit($id)
{
    $student = Student::findOrFail($id);
    return response()->json(['student' => $student]);
}


    public function index()
    {
            $students = Student::join('departments', 'students.department_id', '=', 'departments.id')
            ->select('students.*', 'departments.name as department_name')
            ->get();
        $departments = Department::all();
       
        return view('students', compact('students', 'departments'));
    }

    
}

