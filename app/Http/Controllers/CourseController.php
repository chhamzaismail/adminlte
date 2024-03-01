<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Course;
use Auth;

class CourseController extends Controller
{
    /*
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_name = Auth::user()->name; 
        return view('courses.form',compact('user_name'));
    }


    public function store(Request $request)
    {
        $request->validate(
            [
                'c_name' => 'required',
                'c_code' => 'required'
            ]
        );

        $course = new Course;
        $course->course_name = $request->c_name;
        $course->course_code = $request->c_code;
        $course->save();

        return redirect('/course/show');
    }

    public function show()
    {
        $user_name = Auth::user()->name; 
        $courses = Course::all();
        
        return view('courses.show',compact('courses','user_name'));
    }

    public function edit(string $id)
    {
        $user_name = Auth::user()->name; 
        $courses = Course::find($id);

        return view('courses.edit', compact('courses', 'user_name'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $course = Course::find($id);
        $course->course_name = $request->c_name;
        $course->course_code = $request->c_code;
        $course->save();

        return redirect('/course/show');
    }


    public function delete(string $id)
    {
        $course = Course::find($id)->delete();
        return redirect('/course/show');
    }
}
