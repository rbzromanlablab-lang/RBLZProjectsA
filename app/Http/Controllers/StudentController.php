<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Degree;
use App\Models\Student;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    // // public function greet()
    // // {
    // //     $name = "John Dela Cruz";
    // //     $address = "Dagupan City, Pangasinan";
    // //     return view("greeting",compact('name','address'));

    // //     // return view("greeting",['name'=>$name]);
        
    // // }

    // public function displayProfile()
    // {
    //     $name = "Roman Benedict L. Zacarias";
    //     $address = "Brgy. PangPang SCCP.";
    //     return view("profile",compact('name','address'));
        
    //     // return view("greeting",['name'=>$name]);
        
    // }

    // public function displayDashboard()
    // {
    //     $name = "qazwsxedc";
    //     $address = "qwaszxedc";
    //     return view("dashboard",compact('name','address'));
        
    //     // return view("greeting",['name'=>$name]);
        
    // }

    // public function displayAboutUs()
    // {
    //     $num = "zeroonetwothree";
    //     $prof = "Benedict Zacarias";
    //     return view("aboutus",compact('num','prof'));
        
    //     // return view("greeting",['name'=>$name]);
        
    // }


    public function index()
    {
        // $students = Student::all();
        // $students = Student::paginate();
        $students = Student::with('degree')->paginate(3);
        $degrees = Degree::all();

        if (request()->ajax()) {
            return response()->json([
                'students' => $students->getCollection()->map(fn ($student) => $this->studentJson($student))->values(),
                'pagination' => [
                    'current_page' => $students->currentPage(),
                    'last_page' => $students->lastPage(),
                    'next_page_url' => $students->nextPageUrl(),
                    'prev_page_url' => $students->previousPageUrl(),
                ],
            ]);
        }

        return view('student', compact('students', 'degrees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $degrees = Degree::all();
        return view('add_student', compact('degrees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'fname' => 'required|string|max:255',
            'mname' => 'nullable|string|max:255',
            'lname' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'contact_no' => 'required|numeric',
            'degree_id' => 'required|exists:degrees,id',
        ]);

        // $student = new Student;
        // $student->  fname = $request->input('fname');
        // $student->  mname = $request->input('mname');
        // $student->  lname = $request->input('lname');
        // $student->  email = $request->input('email');
        // $student->  contactno = $request->input('contact_no');
        // $student-> save();

        // Mass Assignment
        // Student::create(
        //     [
        //         "fname"=>$request->input('fname'),
        //         "mname"=>$request->input('mname'),
        //         "lname"=>$request->input('lname'),
        //         "email"=>$request->input('email'),
        //         "contactno"=>$request->input('contact_no'),
        //         "degree_id"=>$request->input('degree_id')
        //     ]
        // );
        $student = Student::create(
            [
                "fname" => $validated['fname'],
                "mname" => $validated['mname'] ?? null,
                "lname" => $validated['lname'],
                "email" => $validated['email'],
                "contactno" => $validated['contact_no'],
                "degree_id" => $validated['degree_id']
            ]
        );

        if ($request->ajax()) {
            return response()->json([
                'message' => 'Student added successfully.',
                'student' => $this->studentJson($student->load('degree')),
            ], 201);
        }
        
        return redirect('/students')->with('success', 'Student added successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       $student = Student::with('degree')->findOrFail($id);
       return view('showStudentDetails')->with("student",$student);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $student = Student::findOrFail($id);
        $degrees = Degree::all();
        return view('edit_student', compact('student', 'degrees'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $student = Student::findOrFail($id);
        $validated = $request->validate([
            'fname' => 'required|string|max:255',
            'mname' => 'nullable|string|max:255',
            'lname' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'contact_no' => 'required|numeric',
            'degree_id' => 'required|exists:degrees,id',
        ]);
        // $student->update(
        //     [
        //         "fname" => $request->input('fname'),
        //         "mname" => $request->input('mname'),
        //         "lname" => $request->input('lname'),
        //         "email" => $request->input('email'),
        //         "contactno" => $request->input('contact_no'),
        //         "degree_id" => $request->input('degree_id')
        //     ]
        // );
        $student->update(
            [
                "fname" => $validated['fname'],
                "mname" => $validated['mname'] ?? null,
                "lname" => $validated['lname'],
                "email" => $validated['email'],
                "contactno" => $validated['contact_no'],
                "degree_id" => $validated['degree_id']
            ]
        );

        if ($request->ajax()) {
            return response()->json([
                'message' => 'Student updated successfully.',
                'student' => $this->studentJson($student->load('degree')),
            ]);
        }

        return redirect('/students')->with('success', 'Student updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $student = Student::findOrFail($id);
        $student->delete();

        if ($request->ajax()) {
            return response()->json([
                'message' => 'Student deleted successfully.',
                'student_id' => (int) $id,
            ]);
        }

        return redirect('/students')->with('success', 'Student deleted successfully.');
    }

    private function studentJson(Student $student): array
    {
        return [
            'id' => $student->id,
            'fname' => $student->fname,
            'mname' => $student->mname,
            'lname' => $student->lname,
            'email' => $student->email,
            'contact_no' => $student->contactno,
            'degree_id' => $student->degree_id,
            'degree_title' => $student->degree->degree_title ?? 'No Degree',
            'show_url' => url('/students/' . $student->id),
            'update_url' => url('/students/' . $student->id),
        ];
    }
}
