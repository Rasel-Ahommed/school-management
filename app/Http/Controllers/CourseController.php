<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::where('status','active')->get();
        return view('admin.courses.index',compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|unique:courses,name',
        ]);

        $course                 = new Course();
        $course->name           = $request->name;
        $course->slug           = Str::slug($request->name);
        $course->class_type     = $request->class_type;
        $course->status         = 'active';
        $course->save();

        return redirect()->back()->with('success','Class created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($slug)
    {
        $course = Course::where('slug',$slug)->first();
        if(!$course){
            abort(404);
        }
        return view('admin.courses.edit',compact('course'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'  => 'required|unique:courses,name,'.$id,
        ]);

        $course                 = Course::findOrFail($id);
        $course->name           = $request->name;
        $course->slug           = Str::slug($request->name);
        $course->class_type     = $request->class_type;
        $course->status         = 'active';
        $course->save();

        return redirect()->route('course.index')->with('success','Class updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $course = Course::findOrFail($id);
        $course->delete();
        return redirect()->back()->with('success','Class deleted successfully!');
    }
}
