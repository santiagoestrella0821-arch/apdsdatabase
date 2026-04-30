<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DepEd APDS System</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f6f9;
        }

        .navbar {
            background: #0056b3;
            color: white;
            padding: 15px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar h1 {
            margin: 0;
            font-size: 20px;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            margin-left: 15px;
            padding: 8px 15px;
            border-radius: 5px;
            background: #003f88;
        }

        .hero {
            display: flex;
            height: 85vh;
            align-items: center;
            justify-content: center;
            text-align: center;
            background: linear-gradient(to right, #0056b3, #007bff);
            color: white;
            padding: 20px;
        }

        .hero h2 {
            font-size: 40px;
            margin-bottom: 10px;
        }

        .hero p {
            font-size: 18px;
            margin-bottom: 20px;
        }

        .hero a {
            padding: 12px 25px;
            background: #ffffff;
            color: #0056b3;
            text-decoration: none;
            font-weight: bold;
            border-radius: 5px;
        }

        .features {
            display: flex;
            justify-content: center;
            gap: 20px;
            padding: 40px;
        }

        .card {
            background: white;
            padding: 20px;
            width: 250px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        .footer {
            text-align: center;
            padding: 15px;
            background: #0056b3;
            color: white;
        }
    </style>
</head>
<body>

    <!-- NAVBAR -->
    <div class="navbar">
        <h1>DepEd APDS System</h1>
        <div>
            <a href="{{ route('login') }}">Login</a>
            <a href="{{ route('register') }}">Register</a>
        </div>
    </div>

    <!-- HERO -->
    <div class="hero">
        <div>
            <h2>Automated Payroll Deduction System</h2>
            <p>Manage PLI, Verifiers, and Payroll Deductions efficiently</p>
            <a href="{{ route('login') }}">Get Started</a>
        </div>
    </div>

    <!-- FEATURES -->
    <div class="features">
        <div class="card">
            <h3>PLI Management</h3>
            <p>Manage all Private Lending Institutions easily.</p>
        </div>

        <div class="card">
            <h3>Verifier System</h3>
            <p>Assign and manage verifiers per region.</p>
        </div>

        <div class="card">
            <h3>Reports</h3>
            <p>Generate coverage and transaction reports.</p>
        </div>
    </div>

    <!-- FOOTER -->
    <div class="footer">
        © 2026 DepEd APDS System
    </div>

</body>
</html>