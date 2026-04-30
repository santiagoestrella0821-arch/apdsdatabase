<!DOCTYPE html>
<html>
<head>
    <title>APDS Admin</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            overflow-x: hidden;
        }

        .sidebar {
            width: 240px;
            min-height: 100vh;
            background: #111827;
        }

        .sidebar a {
            color: #cbd5e1;
            text-decoration: none;
            padding: 10px;
            display: block;
        }

        .sidebar a:hover {
            background: #1f2937;
            color: white;
        }

        .content {
            width: 100%;
        }
    </style>
</head>

<body>
@stack('scripts')
<div class="d-flex">

    <!-- SIDEBAR (DESKTOP) -->
    <div class="sidebar d-none d-md-block p-3">

        <h5 class="text-white">APDS</h5>

        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        <a href="{{ route('pli.index') }}">PLI Management</a>
        <a href="#">Coverage</a>
        <a href="#">Verifiers</a>
        <a href="#">Reports</a>

        <hr class="text-secondary">

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button class="btn btn-danger w-100 mt-2">
            Logout
        </button>
</form>

    </div>

    <!-- CONTENT -->
    <div class="content">

        <!-- TOPBAR -->
        <nav class="navbar navbar-light bg-light px-3">

            <!-- MOBILE MENU BUTTON -->
            <button class="btn btn-primary d-md-none"
                data-bs-toggle="offcanvas"
                data-bs-target="#mobileSidebar">
                ☰
            </button>

            <span>APDS Admin</span>
            <span>{{ auth()->user()->name }}</span>
        </nav>

        <!-- PAGE CONTENT -->
        <div class="p-4">
            @yield('content')
        </div>

    </div>

</div>

<!-- MOBILE SIDEBAR -->
<div class="offcanvas offcanvas-start text-bg-dark d-md-none"
     id="mobileSidebar">

    <div class="offcanvas-header">
        <h5>Menu</h5>
        <button class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
    </div>

    <div class="offcanvas-body">

        <a href="{{ route('admin.dashboard') }}" class="d-block mb-2 text-white">Dashboard</a>
        <a href="#" class="d-block mb-2 text-white">PLI</a>
        <a href="#" class="d-block mb-2 text-white">Coverage</a>

    </div>

    <form method="POST" action="{{ route('logout') }}">
    @csrf
    <button class="btn btn-danger w-100">
        Logout
    </button>
</form>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

@if(session('success'))
<div class="toast-container position-fixed top-0 end-0 p-3">
    <div id="successToast" class="toast align-items-center text-bg-success border-0" role="alert">
        <div class="d-flex">
            <div class="toast-body">
                {{ session('success') }}
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
        </div>
    </div>
</div>
@endif


@if($errors->any())
<div class="toast-container position-fixed top-0 end-0 p-3">
    <div class="toast text-bg-danger">
        <div class="toast-body">
            Please check your input!
        </div>
    </div>
</div>
@endif

@if ($errors->any())
<script>
document.addEventListener('DOMContentLoaded', function () {
    var modal = new bootstrap.Modal(document.getElementById('addModal'));
    modal.show();
});


const modal = document.getElementById('addCoverageModal');

modal.addEventListener('show.bs.modal', function () {
    document.getElementById('region').value = '';
    provinceDropdown.innerHTML = '<option value="">Select Province</option>';
    provinceDropdown.disabled = true;
});
</script>
@endif

@if(session('success'))
<script>
document.addEventListener('DOMContentLoaded', function () {
    var toastEl = document.getElementById('successToast');
    var toast = new bootstrap.Toast(toastEl, {
        delay: 3000 // 3 seconds
    });
    toast.show();
});
</script>
@endif
</body>
</html>

