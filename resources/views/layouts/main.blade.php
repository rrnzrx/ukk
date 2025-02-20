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
            --sidebar-width: 280px;
            --sidebar-bg: #DFF0D8;
            --primary-green: #01772B;
            --hover-green: #B3DCA3;
        }

        body {
            background-color: #F5F5F5;
            display: flex;
            min-height: 100vh;
        }

        .main-content {
            flex: 1;
            margin-left: var(--sidebar-width);
            padding: 2rem;
        }

        /* Remove duplicate styles and consolidate */
        .table-container {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            overflow: hidden;
        }

        .student-table th {
            background: #B3DCA3;
            padding: 1rem;
            color: #121212;
        }

        .student-table td {
            padding: 1rem;
            vertical-align: middle;
        }

        /* Better button styling */
        .btn-add, .btn-delete {
            gap: 8px;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            transition: all 0.2s ease;
        }

        .btn-add {
            background: var(--primary-green);
            color: white;
            border: none;
        }

        .btn-add:hover {
            background: #015a23;
        }

        .btn-delete {
            background: #E20505;
            color: white;
            border: none;
        }

        /* Modal improvements */
        .modal-content {
            border-radius: 12px;
        }

        .form-control {
            border-radius: 8px;
            padding: 0.75rem;
        }

        @media (max-width: 768px) {
            .main-content {
                margin-left: 0;
                padding: 1rem;
            }
            
            .student-table td, .student-table th {
                padding: 0.75rem;
                font-size: 0.9rem;
            }
        }
    </style>
</head>


<body>
@include('layouts.sidebar')
    
    <main class="main-content">
        @yield('content')
    </main>

</body>


</html>
