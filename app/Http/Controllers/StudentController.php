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
        return view('welcome', compact('students')); // Pass $students to the view
    }

    // Handle form submission
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nis' => 'required|unique:students',
            'nama' => 'required',
            'kelas' => 'required',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
        ]);

        Student::create($validatedData);

        return response()->json([
            'success' => true,
            'message' => 'Data siswa berhasil disimpan!'
        ]);
    }
}