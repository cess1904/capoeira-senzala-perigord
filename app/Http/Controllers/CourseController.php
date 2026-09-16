<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::all();

        return view('admin.courses.index', compact('courses'));
    }

    public function create()
    {
        return view('admin.courses.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'day' => 'required|string|max:50',
            'start_time' => 'required',
            'end_time' => 'required',
            'audience' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'venue' => 'required|string|max:255',
            'room' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['title'] = 'Cours de capoeira';

        Course::create($validated);

        return redirect()
            ->route('admin.courses.index')
            ->with('success', 'Cours ajouté avec succès.');
    }
    public function edit(Course $course)
{
    return view('admin.courses.edit', compact('course'));
}
public function update(Request $request, Course $course)
{
    $validated = $request->validate([
        'day' => 'required|string|max:50',
        'start_time' => 'required',
        'end_time' => 'required',
        'audience' => 'required|string|max:255',
        'category' => 'required|string|max:255',
        'city' => 'required|string|max:255',
        'venue' => 'required|string|max:255',
        'room' => 'nullable|string|max:255',
        'notes' => 'nullable|string',
        'is_active' => 'nullable|boolean',
    ]);

    $validated['title'] = 'Cours de capoeira';

    $course->update($validated);

    return redirect()
        ->route('admin.courses.index')
        ->with('success', 'Cours modifié avec succès.');
}
public function destroy(Course $course)
{
    $course->delete();

    return redirect()
        ->route('admin.courses.index')
        ->with('success', 'Cours supprimé avec succès.');
}

public function duplicate(Course $course)
{
    $newCourse = $course->replicate();
    $newCourse->save();

    return redirect()
        ->route('admin.courses.index')
        ->with('success', 'Cours dupliqué avec succès.');
}

}