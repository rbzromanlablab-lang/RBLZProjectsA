<?php

namespace App\Http\Controllers;

use App\Models\Degree;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class DegreeController extends Controller
{
    public function index()
    {
        $degrees = Degree::paginate();
        return view('degree')->with('degrees', $degrees);
    }

    public function create()
    {
        return view('add_degree');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'degree_title' => 'required|string|max:255|unique:degrees,degree_title',
        ]);

        Degree::create(
            [
                'degree_title' => $validated['degree_title']
            ]
        );

        return redirect('/degrees')->with('success', 'Degree added successfully.');
    }

    public function show(string $id)
    {
        $degree = Degree::findOrFail($id);
        return view('showDegreeDetails')->with('degree', $degree);
    }

    public function edit(string $id)
    {
        $degree = Degree::findOrFail($id);
        return view('edit_degree')->with('degree', $degree);
    }

    public function update(Request $request, string $id)
    {
        $degree = Degree::findOrFail($id);
        $validated = $request->validate([
            'degree_title' => 'required|string|max:255|unique:degrees,degree_title,' . $degree->id,
        ]);
        $degree->update(
            [
                'degree_title' => $validated['degree_title']
            ]
        );

        return redirect('/degrees')->with('success', 'Degree updated successfully.');
    }

    public function destroy(string $id)
    {
        $degree = Degree::findOrFail($id);

        if ($degree->students()->exists()) {
            return redirect('/degrees')->with('error', 'Cannot delete this degree because it is assigned to one or more students.');
        }

        try {
            $degree->delete();
        } catch (QueryException $e) {
            return redirect('/degrees')->with('error', 'Cannot delete this degree because it is still being used by students.');
        }

        return redirect('/degrees')->with('success', 'Degree deleted successfully.');
    }
}
