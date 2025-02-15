<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
use App\Models\Section;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses        = Course::where('status','active')->get();
        $teachers       = User::where('type','teacher')->get();
        $subjects       = Subject::where('status','active')->get();

        return view('admin.subjects.index',compact('courses','teachers','subjects'));
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
            'short_name'        => 'required',
            'course_id'         => 'required',
            'section_id'        => 'required',
            'teacher_id'        => 'nullable|exists:users,id',
        ]);

        try{
            $subject = new Subject();
            $subject->name          = $request->name;
            $subject->short_name    = $request->short_name;
            $subject->course_id     = $request->course_id;
            $subject->section_id    = $request->section_id;
            $subject->teacher_id    = $request->teacher_id;
            $subject->status        = 'active';
            $subject->save();

            return redirect()->back()->with('success','Subject created successfully');
        }catch(\Exception $e){
            return redirect()->back()->with('error','Something went wrong');
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
    public function edit(string $id)
    {
        $subject        = Subject::findOrFail($id);
        $courses        = Course::where('status','active')->get();
        $teachers       = User::where('type','teacher')->get();
        $sections       = Section::where('course_id',$subject->course_id)->where('status','active')->get();

        return view('admin.subjects.edit',compact('courses','teachers','subject','sections'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'              => 'required',
            'short_name'        => 'required',
            'course_id'         => 'required',
            'section_id'        => 'required',
            'teacher_id'        => 'required',
        ]);
        try{
            $subject = Subject::findOrFail($id);
            $subject->name          = $request->name;
            $subject->short_name    = $request->short_name;
            $subject->course_id     = $request->course_id;
            $subject->section_id    = $request->section_id;
            $subject->teacher_id    = $request->teacher_id;
            $subject->status        = 'active';
            $subject->save();

            return redirect()->route('subject.index')->with('success','Subject updated successfully');
        }catch(\Exception $e){
            return redirect()->back()->with('error','Something went wrong');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $subject = Subject::findOrFail($id);
        $subject->delete();
        return redirect()->back()->with('success','Subject deleted successfully!');
    }

    //get section 
    public function getSections(Request $request){
        $sections = Section::where('course_id',$request->course_id)->where('status','active')->get();
        return response()->json($sections);
    }
}
