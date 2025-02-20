<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard Siswa</title>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <link rel="icon" type="image/logo" href="/images/logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        :root {
            --primary-text: #121212;
            --light-bg: #F5F5F5;
            --placeholder-color: #A3A3A3;
            --table-header-bg: #B3DCA3;
            --button-stroke: #D0D5DD;
            --add-button-hover: #01772B;
            --delete-button-hover: #E20505;
            --white: #FFFFFF;
        }

        body {
            font-family: 'Noto Sans', sans-serif;
            background-color: #F8FAF5;
        }

        .sidebar {
            background-color: #E8F5E1;
            min-height: 100vh;
            padding: 20px 0;
        }

        .logo-container {
            display: flex;
            justify-content: center;
            margin-bottom: 40px;
        }

        .logo {
            width: 80px;
            height: 80px;
        }

        .page-title {
            font-size: 60px;
            font-weight: 700;
            color: var(--primary-text);
            margin-bottom: 0;
        }

        .content-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .search-container {
            position: relative;
            max-width: 300px;
        }

        .search-input {
            background-color: var(--light-bg);
            border: none;
            border-radius: 8px;
            padding: 10px 40px 10px 16px;
            width: 100%;
            color: var(--primary-text);
        }

        .search-input::placeholder {
            color: var(--placeholder-color);
        }

        .search-icon {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--placeholder-color);
        }

        .class-filter {
            min-width: 150px;
        }

        .class-dropdown-menu {
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding: 0;
        }

        .class-dropdown-item {
            padding: 10px 16px;
            transition: background-color 0.2s;
        }

        .class-dropdown-item.active,
        .class-dropdown-item:hover {
            background-color: #E8F5E1;
        }

        .action-buttons {
            display: flex;
            gap: 16px;
            margin: 30px 0;
        }

        .btn-add,
        .btn-delete {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 10px 16px;
            border: 2px solid var(--button-stroke);
            border-radius: 8px;
            background-color: transparent;
            color: var(--primary-text);
            transition: all 0.2s ease;
        }

        .btn-add:hover {
            background-color: var(--add-button-hover);
            border-color: var(--add-button-hover);
            color: var(--white);
        }

        .btn-delete:hover {
            background-color: var(--delete-button-hover);
            border-color: var(--delete-button-hover);
            color: var(--white);
        }

        .btn-add:hover svg path,
        .btn-delete:hover svg path {
            fill: var(--white);
        }

        .table-container {
            background-color: var(--white);
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .student-table {
            width: auto;
            border-collapse: collapse;
        }

        .student-table th {
            background-color: var(--table-header-bg);
            color: var(--primary-text);
            font-size: 16px;
            font-weight: 500;
            padding: 16px;
            text-align: center;
        }

        .student-table td {
            padding: 16px;
            border-bottom: 1px solid #f0f0f0;
            color: var(--primary-text);
            text-align: center;
        }

        .student-table tr:hover {
            background-color: #f8f9fa;
            cursor: pointer;
        }

        .student-row.zebra-stripe:nth-child(even) {
            background-color: #f9fcf7;
        }

        .student-row.zebra-stripe:hover {
            background-color: #f0f7eb;
        }

        .dashboard-nav,
        .logout-nav {
            padding: 12px 24px;
            margin: 8px 20px;
            display: flex;
            align-items: center;
            gap: 12px;
            border-radius: 8px;
            color: var(--primary-text);
            text-decoration: none;
            transition: background-color 0.2s;
        }

        .dashboard-nav:hover,
        .logout-nav:hover {
            background-color: #D6EAC8;
        }

        .dashboard-nav.active {
            background-color: #D6EAC8;
            font-weight: 500;
        }

        /* Edit Modal Styles */
        .edit-modal {
            max-width: 600px;
        }

        .edit-form-container {
            background-color: var(--white);
            border-radius: 12px;
            padding: 24px;
        }

        .form-label {
            font-weight: 500;
            color: var(--primary-text);
        }

        .btn-save {
            background-color: var(--add-button-hover);
            color: var(--white);
            border: none;
            padding: 10px 24px;
            border-radius: 8px;
        }

        .btn-cancel {
            background-color: transparent;
            color: var(--primary-text);
            border: 1px solid var(--button-stroke);
            padding: 10px 24px;
            border-radius: 8px;
            margin-right: 12px;
        }

        #editStudentModal .modal-content {
            border-radius: 12px;
            border: none;
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Inisialisasi variabel
            let selectedRows = new Set();
            const addModal = new bootstrap.Modal(document.getElementById('addSiswaModal'));

            // Load initial data
            loadSiswa();

            // Button Tambah
            document.querySelector('.btn-add').addEventListener('click', function() {
                document.getElementById('addSiswaForm').reset();
                addModal.show();
            });

            // Button Simpan pada modal
            document.getElementById('saveSiswa').addEventListener('click', function() {
                const form = document.getElementById('addSiswaForm');
                const formData = new FormData(form);
                const data = Object.fromEntries(formData);

                fetch('api/siswa.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify(data)
                    })
                    .then(response => response.json())
                    .then(result => {
                        if (result.message === "Siswa was created.") {
                            addModal.hide();
                            loadSiswa();
                            alert('Data siswa berhasil ditambahkan');
                        } else {
                            alert('Gagal menambahkan data siswa');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan saat menambahkan data');
                    });
            });

            // Checkbox pada tabel
            document.querySelector('table').addEventListener('click', function(e) {
                const row = e.target.closest('tr');
                if (row && row.querySelector('input[type="checkbox"]')) {
                    const checkbox = row.querySelector('input[type="checkbox"]');
                    checkbox.checked = !checkbox.checked;

                    if (checkbox.checked) {
                        selectedRows.add(row.dataset.id);
                        row.classList.add('table-active');
                    } else {
                        selectedRows.delete(row.dataset.id);
                        row.classList.remove('table-active');
                    }

                    // Enable/disable tombol hapus
                    document.querySelector('.btn-delete').disabled = selectedRows.size === 0;
                }
            });

            // Button Hapus
            document.querySelector('.btn-delete').addEventListener('click', function() {
                if (selectedRows.size === 0) return;

                if (confirm('Apakah Anda yakin ingin menghapus data yang dipilih?')) {
                    const deletePromises = Array.from(selectedRows).map(id =>
                        fetch(`api/siswa.php?id=${id}`, {
                            method: 'DELETE'
                        }).then(response => response.json())
                    );

                    Promise.all(deletePromises)
                        .then(() => {
                            loadSiswa();
                            selectedRows.clear();
                            document.querySelector('.btn-delete').disabled = true;
                            alert('Data berhasil dihapus');
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Terjadi kesalahan saat menghapus data');
                        });
                }
            });

            // Filter Kelas
            document.querySelectorAll('.dropdown-item').forEach(item => {
                item.addEventListener('click', function(e) {
                    e.preventDefault();
                    const kelas = this.textContent;
                    loadSiswa(kelas);

                    // Update active state
                    document.querySelectorAll('.dropdown-item').forEach(el =>
                        el.classList.remove('active'));
                    this.classList.add('active');

                    // Update button text
                    document.querySelector('.dropdown-toggle').textContent = `Kelas ${kelas}`;
                });
            });

            // Search
            let searchTimeout;
            document.querySelector('.search-input').addEventListener('input', function(e) {
                clearTimeout(searchTimeout);
                const keyword = e.target.value;

                searchTimeout = setTimeout(() => {
                    if (keyword.length >= 3 || keyword.length === 0) {
                        searchSiswa(keyword);
                    }
                }, 500);
            });
        });

        function loadSiswa(kelas = '') {
            fetch(`api/siswa.php${kelas ? `?kelas=${kelas}` : ''}`)
                .then(response => response.json())
                .then(data => {
                    updateTable(data.records || []);
                })
                .catch(error => console.error('Error:', error));
        }

        function updateTable(records) {
            const tbody = document.querySelector('tbody');
            tbody.innerHTML = '';

            if (records.length === 0) {
                tbody.innerHTML = `
                <tr>
                    <td colspan="6" class="text-center">Tidak ada data siswa</td>
                </tr>
            `;
                return;
            }

            records.forEach(record => {
                const tr = document.createElement('tr');
                tr.dataset.id = record.id;
                tr.innerHTML = `
                <td>
                    <input type="checkbox" class="form-check-input">
                </td>
                <td>${record.nis}</td>
                <td>${record.nama_lengkap}</td>
                <td>${record.kelas}</td>
                <td>${record.jenis_kelamin}</td>
                <td>${record.alamat}</td>
            `;
                tbody.appendChild(tr);
            });
        }

        function searchSiswa(keyword) {
            fetch(`api/siswa.php?search=${encodeURIComponent(keyword)}`)
                .then(response => response.json())
                .then(data => {
                    updateTable(data.records || []);
                })
                .catch(error => console.error('Error:', error));
        }
    </script>
</head>

<body>
    @include('layouts.sidebar')

    <main class="main-content">
        @yield('content')
    </main>

</body>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.getElementById('simpanButton').addEventListener('click', function() {
        const formData = new FormData(document.getElementById('tambahForm'));

        fetch('/students', {
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
    function deleteStudent(id) {
        if (confirm('Apakah yakin menghapus data siswa?')) {
            fetch(`/siswa/${nis}`, {
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
                        document.getElementById(`student-${nis}`).remove();
                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => console.error('Error:', error));
        }
    }

    // Search Functionality
    document.getElementById('searchInput').addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        document.querySelectorAll('#studentTable tbody tr').forEach(row => {
            const nama = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
            row.style.display = nama.includes(searchTerm) ? '' : 'none';
        });
    });

    // Filter 
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

    // Edit Student 
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
            console.log(data);
        })
        .catch(error => console.error('Error:', error));


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
                    $('#tambahModal').modal('hide');
                    showMessage('success', 'Data siswa berhasil ditambahkan');
                    location.reload();
                } else {
                    showMessage('error', 'Gagal menambahkan data: ' + (data.message || ''));
                }

            })
            .catch(error => console.error('Error:', error));
    });
</script>

</html>
