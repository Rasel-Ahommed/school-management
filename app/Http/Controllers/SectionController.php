<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
use App\Models\Section;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sections   = Section::where('status','active')->get();
        $courses    = Course::where('status','active')->get();
        $teachers   = User::where('type','teacher')->get();
        return view('admin.sections.index',compact('sections','courses','teachers'));
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
            'name'              => 'required',
            'course_id'         => 'required',
            'teacher_id'        => 'nullable|exists:users,id',
        ]);
        try {
            $class              = Course::findOrFail($request->course_id);
            $slug               = Str::slug($class->name . '-' . $request->name);

            if (Section::where('slug', $slug)->exists()) {
                return redirect()->back()->with('error', $request->name.' is already exists for'.$class->name.' . Please choose a different name.');
            }

            $section                = new Section();
            $section->name          = $request->name;
            $section->slug          = $slug;
            $section->course_id     = $request->course_id;
            $section->teacher_id    = $request->teacher_id;
            $section->status        = 'active';
            $section->save();
            return redirect()->back()->with('success','Section created successfully!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error',$th->getMessage());
        }
        
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
        $section = Section::where('slug',$slug)->first();
        $courses    = Course::where('status','active')->get();
        $teachers   = User::where('type','teacher')->get();

        if(!$section){
            abort(404);
        }
        return view('admin.sections.edit',compact('section','courses','teachers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'       => 'required',
            'course_id'  => 'required',
            'teacher_id' => 'nullable|exists:users,id',
        ]);
    
        try {
            $class = Course::findOrFail($request->course_id);
            $section = Section::findOrFail($id);
            $slug = Str::slug($class->name . '-' . $request->name);
    
            // Check if the slug exists but exclude the current section ID
            if (Section::where('slug', $slug)->where('id', '!=', $id)->exists()) {
                return redirect()->back()->with('error', $request->name . ' is already exists for ' . $class->name . ' . Please choose a different name.');
            }
    
            $section->name       = $request->name;
            $section->slug       = $slug;
            $section->course_id  = $request->course_id;
            $section->teacher_id = $request->teacher_id;
            $section->status     = 'active';
            $section->save();
    
            return redirect()->route('section.index')->with('success', 'Section updated successfully!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $section = Section::findOrFail($id);
        $section->delete();
        return redirect()->back()->with('success','Section deleted successfully!');
    }
}
