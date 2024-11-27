<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Student;

use Validator;

class StudentController extends Controller
{
    public function index()
    {
        $student = Student::all();

        $data = [
            'status' => 200,
            'student' => $student
        ];

        return response()->json($data,200);
    }

    public function store(Request $request){
        
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
        ]);

      
        if ($validator->fails()) {
            $data = [
                'status' => 400,
                'message' => $validator->messages(),
            ];

            return response()->json($data, 422);
        }

        else{
            $student = new Student;
            $student->name = $request->name;
            $student->email = $request->email;
            $student->phone = $request->phone;
            $student->save();

            $data = [
                'status' => 200,
                'message' => 'Student added successfully',
            ];

            return response()->json($data, 200);
        }
    }

   
    public function update(Request $request, $id){

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
        ]);

      
        if ($validator->fails()) {
            $data = [
                'status' => 400,
                'message' => $validator->messages(),
            ];

            return response()->json($data, 422);
        }

        else{

        $student = Student::find($id);
        $student->name = $request->name;
        $student->email = $request->email;
        $student->phone = $request->phone;
        $student->save();

        $data = [
            'status' => 200,
            'message' => 'Student updated successfully',
        ];
        return response()->json($data, 200);

    }
    }
}
