<?php
namespace App\Http\Controllers\API;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{ 

	public function index()
    {
        $students = Student::cursor()->filter(function($students){
        	return $students;
        });

        return response()->json([
            'status'=> 200,
            'students'=>$students,
        ]);
    }

    
	public function store(Request $request)
    { 
        $validator = Validator::make($request->all(),[
            'name'=>'required|max:191',
            'course'=>'required|max:191',
            'email'=>'required|email|max:191',
           
        ]);

        if($validator->fails())
        {
            return response()->json([
                'status'=> 422,
                'validate_err'=> $validator->messages(),
            ]);
        }
        else
        {
            $student = new Student;
            $student->name = $request->input('name');
            $student->course = $request->input('course');
            $student->email = $request->input('email');
            $student->phone = $request->input('phone');
            $student->state = $request->input('state');
            $student->save();

            return response()->json([
                'status'=> 200,
                'message'=>'Student Added Successfully',
            ]);
        }

    }
     public function edit($id)
    {
        $students = Student::find($id);
        if($students)
        {
            return response()->json([
                'status'=> 200,
                'student' => $students,
            ]);
        }
        else
        {
            return response()->json([
                'status'=> 404,
                'message' => 'No Student ID Found',
            ]);
        }

    }

    public function update(Request $request,$id)
    {
    	$validator = Validator::make($request->all(),[
            'name'=>'required|max:191',
            'course'=>'required|max:191',
            'email'=>'required|email|max:191',
            'phone'=>'required|max:10|min:10',
        ]);

        if($validator->fails())
        {
            return response()->json([
                'status'=> 422,
                'validationErrors'=> $validator->messages(),
            ]);
        }
        else
        {
            $students = Student::find($id);
	        if($students)
	        {
	            $students->name = $request->input('name');
	            $students->course = $request->input('course');
	            $students->email = $request->input('email');
	            $students->phone = $request->input('phone');
	            $students->state = $request->input('state');
	            $students->update();

	            return response()->json([
	                'status'=> 200,
	                'message'=>'Student Updated Successfully',
	            ]);
	         }
	         else   
	        {
	        	 return response()->json([
                'status'=> 404,
                'message' => 'No Student ID Found',
            ]);
	        } 	
        }
    }

    public function destroy($id)
    {
        $student = Student::find($id);
        if($student)
        {
            $student->delete();
            return response()->json([
                'status'=> 200,
                'message'=>'Student Deleted Successfully',
            ]);
        }
        else
        {
            return response()->json([
                'status'=> 404,
                'message' => 'No Student ID Found',
            ]);
        }
    }

}
