<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();
        return view('siswa.index', compact('students'));
    }

    public function create()
    {
        return view('siswa.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nis' => 'required|unique:students',
            'nama' => 'required',
            'kelas' => 'required',
            'jenis_kelamin' => 'required',
            'alamat' => 'required'
        ]);

        try {
            Student::create($validated);
            return response()->json([
                'success' => true,
                'message' => 'Data siswa berhasil ditambahkan!'
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menambahkan data siswa!'
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $student = Student::findOrFail($id);
            return response()->json($student);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data siswa tidak ditemukan!'
            ], 404);
        }
    }
    // Edit
    public function edit($nis)
    {
        $student = Student::findOrFail($nis);
        return view('siswa.edit', compact('student'));
    }

    public function update(Request $request, $nis)
    {
        $validatedData = $request->validate([
            'nis' => 'required|unique:students,nis,' . $nis,
            'nama' => 'required',
            'kelas' => 'required',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
        ]);

        try {
            $student = Student::findOrFail($nis);
            $student->update($validatedData);
            return response()->json([
                'success' => true,
                'message' => 'Data siswa berhasil diperbarui!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui data siswa!'
            ], 500);
        }
    }
    public function destroy($nis)
    {
        try {
            $student = Student::findOrFail($nis);
            $student->delete();
            return response()->json([
                'success' => true,
                'message' => 'Data siswa berhasil dihapus!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data siswa!'
            ], 500);
        }
    }
}
