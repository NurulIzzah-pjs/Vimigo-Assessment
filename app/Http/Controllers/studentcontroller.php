<?php

namespace App\Http\Controllers;

use App\Http\Resources\StudentResource;
use App\Models\student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class studentcontroller extends Controller
{
    public function index(Request $request)
    {
        $perPage = 5;
    $page = $request->input('page', 1);
    
    // Assuming you have a query to fetch students
    $query = student::query();
    
    $total = $query->count();
    
    $result = $query->offset(($page - 1) * $perPage)
                    ->limit($perPage)
                    ->get();

     $formattedResult = StudentResource::collection($result);
    
    return response()->json([
        'student list' => $formattedResult,
        'total' => $total,
        'page' => $page,
        'last_page' => ceil($total / $perPage)
    ], 200, [], JSON_PRETTY_PRINT);

    }

    public function searchstudent(Request $request)
    {

        $perPage = 5;
        $page = $request->input('page', 1);
    
        $query = student::query();

if($s= $request-> input('s'))
{
    $query->whereRaw("name LIKE'%" . $s . "%' ")
    ->orWhereRaw("email LIKE'%" . $s . "%'");
}

$total = $query->count();

    $result = $query->offset(($page - 1) * $perPage)
                    ->limit($perPage)
                    ->get();

    $formattedResult = StudentResource::collection($result);

    return response()->json([
        'student list' => $formattedResult,
        'total' => $total,
        'page' => $page,
        'last_page' => ceil($total / $perPage)
    ], 200, [], JSON_PRETTY_PRINT);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:191',
            'email' => 'required|email|max:191', 
            'address' => 'required|string|max:191',
            'study_course' => 'required|string|max:191',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->errors()->all() // Changed to get all errors as an array
            ], 422);
        } else {
            $student = Student::create([
                'name' => $request->name,
                'email' => $request->email,
                'address' => $request->address,
                'study_course' => $request->study_course,
            ]);
    
            if ($student) {
                return response()->json([
                    'status' => 200,
                    'message' => "Student Created Successfully"
                ], 200);
            } else {
                return response()->json([
                    'status' => 500,
                    'message' => "Something went wrong"
                ], 500);
            }
        }
    }    
    public function show($id)
    {
        $student = Student::find($id);
        if ($student) {
            $formattedResult = new StudentResource($student);
            return response()->json([
                'status' => 200,
                'student' => $formattedResult
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => "No Such student found!"
            ], 404);
        }
    }
    

    public function edit($id)
    {
        $student = Student::find($id);
        if ($student) {
            return response()->json([
                'status' => 200,
                'student' => $student
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => "No Such student found!"
            ], 404);
        }
    }
    public function update(Request $request, int $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:191',
            'email' => 'required|email|max:191', // Changed validation rule to validate email format
            'address' => 'required|string|max:191',
            'study_course' => 'required|string|max:191',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->errors()->all() // Changed to get all errors as an array
            ], 422);
        } else {

            $student = Student::find($id);
         
    
            if ($student) {

                $student->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'address' => $request->address,
                    'study_course' => $request->study_course,
                ]);
                return response()->json([
                    'status' => 200,
                    'message' => "Student Updated Successfully"
                ], 200);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => "No such student found!"
                ], 404);
            }
        }
    }
    
    public function destroy($id)
    {
    $student=Student::find($id);
    if($student){
    $student->delete();
    return response()->json([
        'status' => 200,
        'message' => "Student deleted successfully"
    ], 200);
    }
    else{
        return response()->json([
            'status' => 404,
            'message' => "No such student found!"
        ], 404);
    }    

}
}