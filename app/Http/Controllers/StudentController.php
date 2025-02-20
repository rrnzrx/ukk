<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        
        $students = Student::when($search, function($query) use ($search) {
            return $query->where('nama', 'like', '%'.$search.'%')
                         ->orWhere('nis', 'like', '%'.$search.'%');
        })->get();
        
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
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'alamat' => 'required'
        ]);
    
        Student::create($validated);
    
        return response()->json(['success' => true]);
    }
        
        public function update(Request $request, $id)
        {
            $validatedData = $request->validate([
                'nis' => 'required|unique:students,nis,' . $id,
                'nama' => 'required',
                'kelas' => 'required',
                'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
                'alamat' => 'required',
            ]);
        
            $student = Student::findOrFail($id);
            $student->update($validatedData);
        
            return response()->json([
                'success' => true,
                'message' => 'Data siswa berhasil diperbarui!'
            ]);
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
    public function edit($id)
    {
        $student = Student::findOrFail($id);
        return view('siswa.edit', compact('student'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nis' => 'required|unique:students,nis,' . $id,
            'nama' => 'required',
            'kelas' => 'required',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
        ]);

        try {
            $student = Student::findOrFail($id);
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
    // Delete
    public function destroy($id)
    {
        try {
            $student = Student::findOrFail($id);
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
