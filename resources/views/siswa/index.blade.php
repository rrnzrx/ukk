@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="flex display-center align-items center margin-left:250px">
            <div class="flex container-fluid p-4" style=" margin-left:250px ; background-color: white;">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <!-- Title -->
                    <h1 class="fw-bold" style="font-size: 60px; color: #121212; font-family: 'Noto Sans', sans-serif;">Data
                        Siswa
                    </h1>

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
                                        stroke="#A3A3A3" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path d="M17.5 17.5L14.1667 14.1667" stroke="#A3A3A3" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Action Buttons -->
                <div class="d-flex gap-3 mb-4">
                    <!-- Add Button -->
                    <a href="{{ route('siswa.create') }}">
                        <button class="btn btn-outline-secondary d-flex align-items-center gap-2"
                            style="border-width: 2px; padding: 8px 16px; background-color: #ffffff; color: #121212;"
                            onmouseover="this.style.backgroundColor='#01772B'; this.style.color='#FFFFFF';"
                            onmouseout="this.style.backgroundColor='#ffffff'; this.style.color='#121212';">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 5V19M5 12H19" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                            Tambah
                        </button>
                    </a>
                </div>

                <!-- Student Data Table -->
                <div id="messageContainer" class="mb-3" style="display: none;">
                    <div class="alert alert-success" id="successMessage"></div>
                    <div class="alert alert-danger" id="errorMessage"></div>
                </div>

                <div class="table-container mb-4" style="background-color: white;">
                    <table class="table table-hover">
                        <thead class="table-header" style="background-color: #B3DCA3;">
                            <tr>
                                <th
                                    style="color: #121212; font-size: 16px; font-weight: 500; text-align: center; background-color: #B3DCA3;">
                                    NIS
                                </th>
                                <th
                                    style="color: #121212; font-size: 16px; font-weight: 500; text-align: center; background-color: #B3DCA3;">
                                    Nama
                                    lengkap</th>
                                <th
                                    style="color: #121212; font-size: 16px; font-weight: 500; text-align: center; background-color: #B3DCA3;">
                                    Kelas
                                </th>
                                <th
                                    style="color: #121212; font-size: 16px; font-weight: 500; text-align: center; background-color: #B3DCA3;">
                                    Jenis
                                    Kelamin</th>
                                <th
                                    style="color: #121212; font-size: 16px; font-weight: 500; text-align: center; background-color: #B3DCA3;">
                                    Alamat
                                </th>
                                <th
                                    style="color: #121212; font-size: 16px; font-weight: 500; text-align: center; background-color: #B3DCA3;">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        @if (isset($students) && $students->count() > 0)
                            @foreach ($students as $student)
                                <tr>
                                    <td class="text-align:center">{{ $student->nis }}</td>
                                    <td>{{ $student->nama }}</td>
                                    <td class="text-align:center">{{ $student->kelas }}</td>
                                    <td class="text-align:center">{{ $student->jenis_kelamin }}</td>
                                    <td>{{ $student->alamat }}</td>
                                    <td>
                                        <button onclick="editStudent({{ $student->id }})"
                                            class="btn btn-primary btn-sm">Edit</button>
                                        <button onclick="deleteStudent({{ $student->id }})"
                                            class="btn btn-danger btn-sm">Delete</button>
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

                <script>
                    function deleteStudent(id) {
                        if (confirm('Apakah Anda yakin ingin menghapus data siswa ini?')) {
                            fetch(`/delete-student/${id}`, {
                                    method: 'DELETE',
                                    headers: {
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                        'Content-Type': 'application/json'
                                    }
                                })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        alert(data.message);
                                        location.reload();
                                    }
                                });
                        }
                    }

                    function editStudent(id) {
                        window.location.href = `/siswa/${id}/edit`;
                    }
                </script>

            </div>
        </div>
    @endsection
