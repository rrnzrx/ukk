<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}"> <!-- Include CSRF token -->
    <title>Dashboard Siswa</title>
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
            font-family: "Noto Sans", sans-serif;
            background-color: #f4f4f4;
        }

        .rounded {
            border-radius: var(--border-radius);
        }

        /* Sidebar */
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

        /* Data Siswa */

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

        /* Search Bar */
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

        /* Filter Class */

        .class-filter {
            min-width: 150px;
        }

        .class-dropdown-menu {
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            overflow: hidden;
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

        /* Add,delete button */
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

        /* Student Tabel */
        .table-container {
            background-color: var(--white);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .student-table {
            width: 100%;
            border-collapse: collapse;
        }

        .student-table th {
            background-color: var(--table-header-bg);
            color: var(--primary-text);
            font-size: 16px;
            font-weight: 500;
            padding: 16px;
            text-align: left;
        }

        .student-table td {
            padding: 16px;
            border-bottom: 1px solid #f0f0f0;
            color: var(--primary-text);
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

        /* Edit */
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

        /* .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            color: var(--text-light);
            border-radius: var(--border-radius);
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
        }

        /input

        .form-control {
            border-radius: var(--border-radius);
            background-color: #f5f5f5;
            border: 1px solid #d0d5dd;
        }

        /* Tables
        .table {
            border-radius: var(--border-radius);
            overflow: hidden;
        }

        .table thead {
            background-color: var(--secondary-color);
        }

        /* Responsive design
        @media (max-width: 768px) {
            .sidebar {
                width: 70px;
            }

            .main-content {
                margin-left: 70px;
            }
        } */
    </style>
</head>


<body>

    @include('layouts.sidebar')

    @yield('content')

</body>


</html>
