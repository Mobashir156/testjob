<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with(['user', 'teacher'])
            ->withTrashed()
            ->when(auth()->user()->isTeacher(), fn($q) => $q->where('teacher_id', auth()->id()))
            ->latest()
            ->paginate(10);

        return view('appviews::students.index', compact('students'));
    }

    public function create()
    {
        return view('appviews::students.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
            'phone' => 'nullable|string|max:20',
        ]);

        DB::transaction(function () use ($request) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'phone' => $request->phone,
                'role' => 'student',
                'permission' => "",
            ]);

            Student::create([
                'user_id' => $user->id,
                'teacher_id' => auth()->id(),
                'roll_number' => $request->roll_number,
                'class' => $request->class,
                'section' => $request->section,
            ]);
        });

        return redirect()->route('students.index')
            ->with('success', 'Student created successfully.');
    }

    public function show(Student $student)
    {
        return view('appviews::students.show', compact('student'));
    }

    public function edit(Student $student)
    {
        return view('appviews::students.edit', compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($student->user_id),
            ],
            'phone' => 'nullable|string|max:20',
        ]);

        $student->user->update($request->only(['name', 'email', 'phone']));

        return redirect()->route('students.index')
            ->with('success', 'Student updated successfully.');
    }
    
    public function approveDelete($id)
    {
        //dd('ok');
        $student = Student::withTrashed()->where('id', $id)->firstOrFail();
    
        $user = User::withTrashed()->find($student->user_id);
    
        if ($user) {
            $user->forceDelete();
        }
    
        $student->forceDelete();
    
        return back()->with('success', 'Student deleted permanently.');
    }



    public function requestDelete(Student $student)
    {
        $student->delete();
    
        return back()->with('success', 'Deletion request sent to headmaster.');
    }

}
