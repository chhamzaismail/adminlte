<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Student;
use App\Models\Course;
use Auth;
use Image;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::all();
        $user_name = Auth::user()->name; 
        return view('students.form', compact('courses','user_name'));
    }

     // Store a newly created resource in storage.
     
    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'email' => 'required|email',
                'image' => 'required| mimes:png,jpeg,jpg',
                // 'file' => 'required|extension:docx,xlsx',
                // 'picture' => 'required|image',
            //     'picture' => 'required|dimensions:min_width = 200,       min_height=200,max_width = 400, max_height = 400',
            ]
        );

        //Use Helper function
        // p($request->all());
        // die;

        //Store image
        // $image = $request->file('image');
        // $filename = time(). '.' .$image->getClientOriginalExtension();
        
        // $destinationPath = 'storage/uploadImage/thumb';
        // $resize_img = Image::make($image->path());
        // $resize_img->resize(100,100, function($constraint){
        //     $constraint->aspectRatio();
        // });
        // $resize_img->save($destinationPath.'/'.$filename);
        
        // $destinationPath = 'public/uploadImage';
        // $image->storeAs('public/uploadImage', $filename);

        //store image by using storage Facades
        $image = $request->file('image');
        $imageName =  $image->getClientOriginalName();
        $imagePath = 'uploadImage/'. $image->getClientOriginalName();
        Storage::disk('public')->put($imagePath, file_get_contents($image));

        //Insert Data into DB
        $student = new Student;   
        $student->student_name = UC($request->name);
        // $student->image = asset('storage/uploadImage/thumb'.'/'.$filename);
        $student->image = $imageName;
        $student->email = $request->email;
        $student->course_id = $request->course;
        $student->save();

        return redirect('/student/show');
    }

    public function show()
    {
        // $students = Student::all();
        $user_name = Auth::user()->name; 
        $students = DB::table('students')
        ->join('courses', 'students.course_id', '=', 'courses.course_id')
        ->select('students.*', 'courses.course_name')
        ->get();
        // dd($students);
        // $user_name = Auth::user()->name; 
        return view('students.show',compact('students','user_name'));
    }

 
    public function edit(string $id)
    {   
        $user_name = Auth::user()->name; 
        $courses = Course::all();
        $student = Student::find($id); 
        return view('students.edit',compact('student', 'courses','user_name'));
    }

    public function update(Request $request, string $id){
        $request->validate(
            [
                'name' => 'required',
                'email' => 'required|email',
                'image' => 'required|mimes:png,jpeg,jpg'
            ]
        );

        $student = Student::find($id);  

        if($request->hasFile('image')){
            //delete old image
            // if(Storage::disk('public')->exists($student->image)){
                $imageDelete ='storage/uploadImage/'.$student->image;
                Storage::delete($imageDelete);

                // }
                $image = $request->file('image');
                $imageName = $image->getClientOriginalName();
                $imagePath = 'uploadImage/'. $image->getClientOriginalName();
                //store new image  
                Storage::disk('public')->put($imagePath, file_get_contents($image));
            
            }
        
 

        $student->student_name = $request->name;
        $student->image = $imageName;
        $student->email = $request->email;
        $student->course_id = $request->course;
        $student->save();

        return redirect('/student/show');
    }

    public function delete(string $id)
    {
       
        $student = Student::find($id)->delete();
        // if(Storage::disk('public')->exists($student->image)){
        //     $imageDelete = 'public/'.$student->image;
        //     Storage::delete($imageDelete);
        //     $student->delete();
        // }
        return redirect('/student/show');
    }
}
