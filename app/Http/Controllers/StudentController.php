<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    // Fetch students and pass them to the welcome view
    public function index()
    {
        $students = Student::all();
        return view('siswa.index', compact('students')); // Pass $students to the view
    }

    // Handle form submission
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nis' => 'required|unique:students',
            'nama' => 'required',
            'kelas' => 'required',
            'jenis_kelamin' => 'required',
            'alamat' => 'required'
        ]);
    
        Student::create($validated);
    
        return response()->json(['success' => true]);
    }
    
    public function update(Request $request, $id)
{
    $validatedData = $request->validate([
        'nis' => 'required|unique:students,nis,'.$id,
        'nama' => 'required',
        'kelas' => 'required',
        'jenis_kelamin' => 'required',
        'alamat' => 'required',
    ]);

    $student = Student::findOrFail($id);
    $student->update($validatedData);

    return response()->json([
        'success' => true,
        'message' => 'Data siswa berhasil diperbarui!'
    ]);
}

public function show($id)
{
    $student = Student::findOrFail($id);
    return response()->json($student);
}
}
