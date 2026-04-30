<!DOCTYPE html>
<html>
<head>
    <title>APDS Admin</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    
</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <h4 class="text-center py-3">APDS</h4>

    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
    <a href="{{ route('pli.index') }}">PLI Management</a>
    <a href="#">Coverage</a>
    <a href="#">Verifiers</a>
    <a href="#">Reports</a>
</div>



<!-- CONTENT -->
<div class="content">

    <!-- TOPBAR -->
    <div class="topbar d-flex justify-content-between">
        <div>Admin Panel</div>
        <div>{{ auth()->user()->name ?? 'Admin' }}</div>
    </div>

    <!-- PAGE CONTENT -->
    <div class="mt-3">
        @yield('content')
    </div>

</div>
<script src="{{ asset('js/admin.js') }}"></script>
</body>
</html>