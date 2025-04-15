<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = User::where('role', 'teacher')->withCount('students')->latest()->paginate(10);

        return view('teachers.index', compact('teachers'));
    }

    public function create()
    {
        return view('teachers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
            'phone' => 'nullable|string|max:20',
        ]);

        $teacherPermissions = [
            'dashboard' => ['view' => true],
            'teachers' => [
                'view' => false,
                'create' => false,
                'edit' => false,
                'delete' => false,
                'manage_permissions' => false,
            ],
            'students' => [
                'view_own' => true,
                'create' => true,
                'edit_own' => true,
                'delete' => false,
                'request_delete' => true,
            ],
            'tasks' => [
                'view_own' => true,
                'create' => true,
                'edit_own' => true,
                'delete_own' => true,
                'approve' => false,
                'submit' => false,
                'give_feedback' => true,
            ],
            'announcements' => [
                'view' => true,
                'create' => false,
                'edit' => false,
                'delete' => false,
                'publish' => false,
            ],
            'profile' => [
                'view' => true,
                'edit' => true,
                'change_password' => true,
            ],
        ];

        $teacher = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'phone' => $request->phone,
            'role' => 'teacher',
            'permissions' => $teacherPermissions,
        ]);

        return redirect()->route('teachers.index')->with('success', 'Teacher created successfully.');
    }
}
