@extends('layouts.main')

@section('content')
    <!-- Main Content -->
    <div></div>
    <div class="container-fluid p-4">
        <h1 class="fw-bold" style="font-size: 60px; color: #121212; margin: 32px 0 0 40px;">Data Siswa</h1>
        <div class="d-flex justify-content-between align-items-center my-3 mx-5">
            <!-- Class Filter -->
            <div class="dropdown class-filter">
                <button class="btn btn-light dropdown-toggle" type="button" id="classFilterDropdown" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    Kelas
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"
                        class="ms-2">
                        <path d="M5 7.5L10 12.5L15 7.5" stroke="#121212" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </button>
                <ul class="dropdown-menu class-dropdown-menu" aria-labelledby="classFilterDropdown">
                    <li><a class="dropdown-item class-dropdown-item active" href="#">Kelas</a></li>
                    <li><a class="dropdown-item class-dropdown-item" href="#">1A</a></li>
                    <li><a class="dropdown-item class-dropdown-item" href="#">1B</a></li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Add Buttons -->
    <div class="action-buttons">
        <button class="btn-add">
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M10 4.16675V15.8334M4.16667 10.0001H15.8333" stroke="#121212" stroke-width="1.5"
                    stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            Tambah
        </button>
        <!-- Delete Buttons -->
        <button class="btn-delete">
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M15.8333 5.83325L4.16667 5.83325M8.33333 9.16659V13.3333M11.6667 9.16659V13.3333M14.1667 5.83325V15.8333C14.1667 16.2753 13.9911 16.6993 13.6785 17.0119C13.366 17.3244 12.942 17.4999 12.5 17.4999H7.5C7.05797 17.4999 6.63405 17.3244 6.32149 17.0119C6.00893 16.6993 5.83333 16.2753 5.83333 15.8333V5.83325M13.3333 5.83325V4.16659C13.3333 3.72456 13.1577 3.30064 12.8452 2.98808C12.5326 2.67552 12.1087 2.49992 11.6667 2.49992H8.33333C7.8913 2.49992 7.46738 2.67552 7.15482 2.98808C6.84226 3.30064 6.66667 3.72456 6.66667 4.16659V5.83325"
                    stroke="#121212" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </button>
    </div>


    <!-- Student Data Table -->
    <div class="table-container mb-4">
        <table class="student-table">
            <thead>
                <tr>
                    <th>NIS</th>
                    <th>Nama Lengkap</th>
                    <th>Kelas</th>
                    <th>Jenis Kelamin</th>
                    <th>Alamat</th>
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
