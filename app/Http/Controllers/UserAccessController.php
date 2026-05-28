<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserAccessController extends Controller
{
    public function dashboard(Request $request)
    {
        return match ($request->user()->role) {
            'admin' => redirect()->route('admin.dashboard'),
            'teacher' => redirect()->route('teacher.dashboard'),
            default => redirect()->route('student.dashboard'),
        };
    }

    public function studentDashboard()
    {
        $students = Student::with('degree')
            ->orderBy('lname')
            ->orderBy('fname')
            ->paginate(5);

        return view('student_dashboard', compact('students'));
    }

    public function teacherDashboard()
    {
        return view('teacher_dashboard');
    }

    public function adminDashboard()
    {
        $users = User::where('role', '!=', 'teacher')
            ->orderBy('role')
            ->orderBy('name')
            ->get();
        $students = Student::with('degree')
            ->orderBy('id')
            ->get();
        $teachers = User::where('role', 'teacher')
            ->orderBy('name')
            ->get();

        return view('admin_dashboard', compact('users', 'students', 'teachers'));
    }

    public function storeUser(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
            'role' => ['required', Rule::in(['student', 'teacher'])],
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
            'must_change_password' => true,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'User account added successfully.');
    }

    public function createTeacher()
    {
        return view('add_teacher');
    }

    public function teachers()
    {
        $teachers = User::where('role', 'teacher')
            ->orderBy('name')
            ->get();

        return view('teacher', compact('teachers'));
    }

    public function storeTeacher(Request $request)
    {
        $validated = $request->validate([
            'fname' => ['required', 'string', 'max:255'],
            'mname' => ['nullable', 'string', 'max:255'],
            'lname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'contact_no' => ['required', 'string', 'max:255'],
        ]);

        User::create([
            'name' => trim($validated['fname'].' '.($validated['mname'] ?? '').' '.$validated['lname']),
            'fname' => $validated['fname'],
            'mname' => $validated['mname'] ?? null,
            'lname' => $validated['lname'],
            'email' => $validated['email'],
            'contactno' => $validated['contact_no'],
            'password' => Hash::make('password'),
            'role' => 'teacher',
            'must_change_password' => true,
        ]);

        return redirect()->route('admin.teachers.index')->with('success', 'Teacher added successfully.');
    }

    public function showTeacher(User $teacher)
    {
        $this->ensureTeacher($teacher);

        return view('showTeacherDetails', compact('teacher'));
    }

    public function editTeacher(User $teacher)
    {
        $this->ensureTeacher($teacher);

        return view('edit_teacher', compact('teacher'));
    }

    public function updateTeacher(Request $request, User $teacher)
    {
        $this->ensureTeacher($teacher);

        $validated = $request->validate([
            'fname' => ['required', 'string', 'max:255'],
            'mname' => ['nullable', 'string', 'max:255'],
            'lname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($teacher->id)],
            'contact_no' => ['required', 'string', 'max:255'],
            'password' => ['nullable', 'string', 'min:8'],
        ]);

        $teacher->name = trim($validated['fname'].' '.($validated['mname'] ?? '').' '.$validated['lname']);
        $teacher->fname = $validated['fname'];
        $teacher->mname = $validated['mname'] ?? null;
        $teacher->lname = $validated['lname'];
        $teacher->email = $validated['email'];
        $teacher->contactno = $validated['contact_no'];

        if (! empty($validated['password'])) {
            $teacher->password = Hash::make($validated['password']);
        }

        $teacher->role = 'teacher';
        $teacher->save();

        return redirect()->route('admin.teachers.index')->with('success', 'Teacher updated successfully.');
    }

    public function destroyTeacher(User $teacher)
    {
        $this->ensureTeacher($teacher);
        $teacher->delete();

        return redirect()->route('admin.teachers.index')->with('success', 'Teacher deleted successfully.');
    }

    private function ensureTeacher(User $teacher): void
    {
        abort_if($teacher->role !== 'teacher', 404);
    }
}
