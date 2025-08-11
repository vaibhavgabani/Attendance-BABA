<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Student;

class StudentControllers extends Controller
{
    public function index()
    {
        $students = Student::all();
        return response()->json($students);
    }

    public function show($id)
    {
        $student = Student::findOrFail($id);
        return response()->json($student);
    }

    public function store(Request $request)
    {
        Log::info('Store method called with data: ' . json_encode($request->all()));
        
        // Validate request data
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:students,email',
                'course' => 'required|string|max:100',
            ]);
            
            Log::info('Validation passed. Creating student...');
            
            // Create new student using validated data
            $student = Student::create($validatedData);

            Log::info('Student created: ' . json_encode($student));
            
            // Return successful response with created resource
            return response()->json([
                'success' => true,
                'message' => 'Student created successfully',
                'data' => $student
            ], 201);
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation failed: ' . json_encode($e->errors()));
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            // Handle any exceptions that might occur
            Log::error('Exception occurred: ' . $e->getMessage());
            Log::error($e->getTraceAsString());
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to create student',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id){
        // Validate request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email,' . $id,
            'course' => 'required|string|max:100',
        ]);

        try {
            // Find the student by ID
            $student = Student::findOrFail($id);

            // Update the student with validated data
            $student->update($validatedData);

            // Return successful response with updated resource
            return response()->json([
                'success' => true,
                'message' => 'Student updated successfully',
                'data' => $student
            ], 200);
            
        } catch (\Exception $e) {
            // Handle any exceptions that might occur
            return response()->json([
                'success' => false,
                'message' => 'Failed to update student',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            // Find the student by ID
            $student = Student::findOrFail($id);

            // Delete the student
            $student->delete();

            // Return successful response
            return response()->json([
                'success' => true,
                'message' => 'Student deleted successfully'
            ], 200);
            
        } catch (\Exception $e) {
            // Handle any exceptions that might occur
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete student',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
