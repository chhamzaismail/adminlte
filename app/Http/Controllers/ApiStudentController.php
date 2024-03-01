<?php

namespace App\Http\Controllers;
use App\Models\ApiStudent;
use Illuminate\Http\Request;

class ApiStudentController extends Controller
{

    public function store(Request $request)
    {
        $validator = $request->validate(
            [
                'name' => 'required',
                'course' => 'required',
                'email' => 'required | email',
                'image' => 'required| mimes:png,jpeg,jpg',
            ]
        );
    //    if($validator->fails()){
    //     return response()->json([
    //         'message' => 'Please fix the error',
    //         'errors' =>  $validator->errors(),
    //         'status' => false
    //     ],200); 
    //    }

        $image = $request->file('image');
        $imageName =  $image->getClientOriginalName();
        $imagePath =  $image->storeAs('public/apiImages',$imageName);

        $student = new ApiStudent;
        $student->name = $request->name;
        $student->email = $request->email;
        $student->course = $request->course;
        $student->phone = $request->phone;
        $student->image = $imageName;
        $student->save();

        return response()->json([
            'message' => 'Information Added Successfully',
            'data' =>  $student,
            'status' => true
        ],200); 
    }

    public function get()
    {
        $students = ApiStudent::all();

        return response()->json([
            'data' =>  $students,
            'status' => true
        ],200);
    }

    public function edit(string $id)
    {
        $students = ApiStudent::find($id);

        return response()->json([
            'data' =>  $students,
            'status' => true
        ],200);
    }

    public function update(Request $request, string $id)
    {
        $validator = $request->validate(
            [
                'name' => 'required',
                'course' => 'required',
                'email' => 'required | email'
            ]
        );

        $student = ApiStudent::find($id);
        $student->name = $request->name;
        $student->email = $request->email;
        $student->course = $request->course;
        $student->phone = $request->phone;
        $student->save();

        return response()->json([
            'message' => 'Information Updated Successfully',
            'data' =>  $student,
            'status' => true
        ],200); 
    }

    public function delete(string $id)
    {
        $student = ApiStudent::find($id)->delete();
        return response()->json([
            'message' => 'Information Deleted ',
            'status' => 200
        ],200); 
    }
}
