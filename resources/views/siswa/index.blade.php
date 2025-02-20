@extends('layouts.main')

@section('content')
    <!-- Main Content -->
    <div class="container-fluid p-4" style="background-color: white;">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <!-- Title -->
            <h1 class="fw-bold" style="font-size: 60px; color: #121212; font-family: 'Noto Sans', sans-serif;">Data Siswa</h1>

            <!-- Filter and Search -->
            <div class="d-flex align-items-center gap-3">
                <!-- Class Filter -->
                <div class="droclepdown">
                    <button class="btn btn-light dropdown-toggle" type="button" id="classFilterDropdown"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Kelas
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="classFilterDropdown">
                        <li><a class="dropdown-item" href="#">1A</a></li>
                        <li><a class="dropdown-item" href="#">1B</a></li>
                    </ul>
                </div>

                <!-- Search Bar -->
                <div class="search-container position-relative">
                    <input type="text" class="form-control search-input" placeholder="Cari data..."
                        style="background-color: #F5F5F5; color: #121212;">
                    <div class="search-icon position-absolute end-0 top-50 translate-middle-y me-3">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M9.58333 15.8333C13.0355 15.8333 15.8333 13.0355 15.8333 9.58333C15.8333 6.13116 13.0355 3.33333 9.58333 3.33333C6.13116 3.33333 3.33333 6.13116 3.33333 9.58333C3.33333 13.0355 6.13116 15.8333 9.58333 15.8333Z"
                                stroke="#A3A3A3" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M17.5 17.5L14.1667 14.1667" stroke="#A3A3A3" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="d-flex gap-3 mb-4">
            <!-- Add Button -->
            <button class="btn btn-outline-secondary d-flex align-items-center gap-2"
                style="border-width: 2px; padding: 8px 16px;"
                onmouseover="this.style.backgroundColor='#01772B'; this.style.color='#FFFFFF';"
                onmouseout="this.style.backgroundColor='transparent'; this.style.color='#121212';">
                Tambah
            </button>

            <!-- Delete Button -->
            <button class="btn btn-outline-secondary d-flex align-items-center gap-2"
                style="border-width: 2px; padding: 8px 16px;"
                onmouseover="this.style.backgroundColor='#E20505'; this.style.color='#FFFFFF';"
                onmouseout="this.style.backgroundColor='transparent'; this.style.color='#121212';">
                Hapus
            </button>
        </div>
        <!-- Student Data Table -->
        <div class="table-container mb-4" style="background-color: white;">
            <table class="table table-hover">
                <thead class="table-header" style="background-color: #B3DCA3;">
                    <tr>
                        <th style="color: #121212; font-size: 16px; font-weight: 500;">NIS</th>
                        <th style="color: #121212; font-size: 16px; font-weight: 500;">Nama Lengkap</th>
                        <th style="color: #121212; font-size: 16px; font-weight: 500;">Kelas</th>
                        <th style="color: #121212; font-size: 16px; font-weight: 500;">Jenis Kelamin</th>
                        <th style="color: #121212; font-size: 16px; font-weight: 500;">Alamat</th>
                        <th style="color: #121212; font-size: 16px; font-weight: 500;">Aksi</th>
                    </tr>
                </thead>
                @if (isset($students) && $students->count() > 0)
                    @foreach ($students as $student)
                        <tr data-kelas="{{ $student->kelas }}">
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
                        <td colspan="6" class="text-center">Tidak ada data siswa</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>

    <!-- DataTables JS -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('simpanButton').addEventListener('click', function() {
            const formData = new FormData(document.getElementById('tambahForm'));

            fetch('/students', { // Ganti endpoint sesuai route Laravel
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: formData
                })
                .then(response => {
                    if (!response.ok) {
                        return response.json().then(err => {
                            throw err;
                        });
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        $('#tambahModal').modal('hide');
                        location.reload();
                    }
                })
                .catch(error => {
                    alert('Error: ' + (error.message || 'Terjadi kesalahan'));
                });
        });
        // Delete Student
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function() {
                if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                    const studentId = this.getAttribute('data-id');
                    fetch(`/delete-student/${studentId}`, {
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

        // Search Functionality
        document.getElementById('searchInput').addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            document.querySelectorAll('#studentTable tbody tr').forEach(row => {
                const nama = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
                row.style.display = nama.includes(searchTerm) ? '' : 'none';
            });
        });

        // Filter by Kelas
        document.querySelectorAll('.dropdown-item').forEach(item => {
            item.addEventListener('click', function() {
                const selectedKelas = this.getAttribute('data-kelas');
                document.querySelectorAll('#studentTable tbody tr').forEach(row => {
                    const kelas = row.getAttribute('data-kelas');
                    row.style.display = (selectedKelas === 'all' || kelas === selectedKelas) ? '' :
                        'none';
                });
            });
        });

        // Edit Student - Update the existing code to this:
        document.querySelectorAll('.edit-btn').forEach(button => {
            button.addEventListener('click', function() {
                const studentId = this.getAttribute('data-id');
                fetch(`/get-student/${studentId}`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('edit_nis').value = data.nis;
                        document.getElementById('edit_nama').value = data.nama;
                        document.getElementById('edit_kelas').value = data.kelas;
                        document.getElementById('edit_jenis_kelamin').value = data.jenis_kelamin;
                        document.getElementById('edit_alamat').value = data.alamat;
                        document.getElementById('editForm').action = `/update-student/${studentId}`;
                    });
            });
        });

        fetch('/get-students')
            .then(response => response.json())
            .then(data => {
                console.log(data); // Check if data is returned
            })
            .catch(error => console.error('Error:', error));

        // Handle edit form submission
        document.getElementById('editForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);

            fetch(this.action, {
                    method: 'PUT',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(data.message);
                        location.reload();
                    }
                })
                .catch(error => console.error('Error:', error));
        });
    </script>
@endsection
