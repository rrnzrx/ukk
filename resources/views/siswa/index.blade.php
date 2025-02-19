@extends('layouts.main')

@section('content')
    <!-- Main Content -->
    <div></div>
    <div class="container-fluid p-4">
        <h1 class="fw-bold" style="font-size: 60px; color: #121212; margin: 32px 0 0 40px;">Data Siswa</h1>
        <div class="d-flex justify-content-between align-items-center my-3 mx-5">

            <div class="d-flex gap-3">
                <div class="input-group search-container" style="width: 300px;">

                    <input type="text" class="form-control" placeholder="Cari">

                    <span class="input-group-text">

                        <svg width="20" height="20" viewBox="0 0 24 24" fill="#A3A3A3"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M11 19C15.4183 19 19 15.4183 19 11C19 6.58172 15.4183 3 11 3C6.58172 3 3 6.58172 3 11C3 15.4183 6.58172 19 11 19Z"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M21 21L16.65 16.65" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </span>
                </div>
                <select class="form-select" style="width: 160px;">
                    <option selected>1A</option>
                    <option>1B</option>
                </select>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahModal">
                    Tambah
                </button>
                <button type="button" class="btn btn-danger">
                    Hapus
                </button>
            </div>
        </div>

        <div class="table-container mx-5">

            <table id="studentTable" class="table table-bordered rounded">

                <thead>

                    <tr style="color: #121212; font-weight: 500;">
                        <th>NIS</th>
                        <th>Nama Lengkap</th>
                        <th>Kelas</th>
                        <th>Jenis Kelamin</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if (isset($students) && $students->count() > 0)
                        @foreach ($students as $student)
                            <tr>
                                <td>{{ $student->nis }}</td>
                                <td>{{ $student->nama }}</td>
                                <td>{{ $student->kelas }}</td>
                                <td>{{ $student->jenis_kelamin }}</td>
                                <td>{{ $student->alamat }}</td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-warning edit-btn" data-bs-toggle="modal"
                                        data-bs-target="#editModal" data-id="{{ $student->id }}">Edit</button>
                                    <button class="btn btn-sm btn-danger delete-btn"
                                        data-id="{{ $student->id }}">Hapus</button>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6" class="text-center">Tidak ada data siswa.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahModalLabel">Tambah Data Siswa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="tambahForm">
                        <div class="mb-3">
                            <label for="nis" class="form-label">NIS</label>
                            <input type="text" class="form-control" id="nis" name="nis" required>
                        </div>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="nama" name="nama" required>
                        </div>
                        <div class="mb-3">
                            <label for="kelas" class="form-label">Kelas</label>
                            <select class="form-select" id="kelas" name="kelas" required>
                                <option value="1A">1A</option>
                                <option value="1B">1B</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                            <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input type="text" class="form-control" id="alamat" name="alamat" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" id="simpanButton">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Add Student
        document.getElementById('simpanButton').addEventListener('click', function() {
            const nis = document.getElementById('nis').value;
            const nama = document.getElementById('nama').value;
            const kelas = document.getElementById('kelas').value;
            const jenisKelamin = document.getElementById('jenis_kelamin').value;
            const alamat = document.getElementById('alamat').value;

            fetch('/save-student', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        nis,
                        nama,
                        kelas,
                        jenis_kelamin: jenisKelamin,
                        alamat
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Data siswa berhasil disimpan!');
                        location.reload(); // Reload the page to show the new data
                    } else {
                        alert('Gagal menyimpan data siswa: ' + data.message);
                    }
                })
                .catch(error => console.error('Error:', error));
        });

        // Edit Student
        const editButtons = document.querySelectorAll('.edit-btn');
        editButtons.forEach(button => {
            button.addEventListener('click', function() {
                const studentId = this.getAttribute('data-id');
                fetch(/get-student/$ {
                        studentId
                    })
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('edit_nis').value = data.nis;
                        document.getElementById('edit_nama').value = data.nama;
                        document.getElementById('edit_kelas').value = data.kelas;
                        document.getElementById('edit_jenis_kelamin').value = data.jenis_kelamin;
                        document.getElementById('edit_alamat').value = data.alamat;
                        document.getElementById('editForm').action = /update-student/$ {
                            studentId
                        };
                    });
            });
        });

        // Delete Student
        const deleteButtons = document.querySelectorAll('.delete-btn');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                    const studentId = this.getAttribute('data-id');
                    fetch(/delete-student/$ {
                            studentId
                        }, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                    .content
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                location.reload();
                            } else {
                                alert('Gagal menghapus data');
                            }
                        });
                }
            });
        });
    </script>

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Data Siswa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editForm" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="edit_nis" class="form-label">NIS</label>
                            <input type="text" class="form-control" id="edit_nis" name="nis" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_nama" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="edit_nama" name="nama" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_kelas" class="form-label">Kelas</label>
                            <select class="form-select" id="edit_kelas" name="kelas" required>
                                <option value="1A">1A</option>
                                <option value="1B">1B</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="edit_jenis_kelamin" class="form-label">Jenis Kelamin</label>
                            <select class="form-select" id="edit_jenis_kelamin" name="jenis_kelamin" required>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="edit_alamat" class="form-label">Alamat</label>
                            <input type="text" class="form-control" id="edit_alamat" name="alamat" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
