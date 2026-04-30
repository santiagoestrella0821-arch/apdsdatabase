<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; }
        table, th, td { border: 1px solid black; }
        th, td { padding: 5px; }
        h3 { text-align: center; }

        .header {
    text-align: center;
    margin-bottom: 15px;
}

.title {
    font-weight: bold;
    font-size: 14px;
}

.subtitle {
    font-size: 12px;
    margin-top: 3px;
}

.report-title {
    font-style: italic;
    margin-top: 8px;
    font-size: 12px;
}

footer {
    position: fixed;
    bottom: -30px;
    left: 0;
    right: 0;
    height: 80px;
    text-align: center;
    font-size: 11px;
}

.footer-line {
    border-top: 1px solid #000;
    margin-bottom: 5px;
}

.page-number {
    position: absolute;
    right: 0;
    top: 0;
}

.page-number:before {
    content: "Page " counter(page) " of " counter(pages);
}

.footer-text {
    margin-top: 10px;
}

.footer-division {
    margin-top: 15px;
    font-style: italic;
}
    </style>
    <title>List of Private Lending Institutions</title>
</head>
<body>
    
<div class="header">
    <div class="title">
        DEPARTMENT OF EDUCATION
    </div>

    <div class="subtitle">
        Employee Account Management Division<br>
        Automatic Payroll Deduction System
    </div>

    <div class="report-title">
        List of Accredited Private Lending Institutions
    </div>
</div>

<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Code</th>
            <th>Name</th>
            <th>Classification</th>
            <th>Accredited</th>
        </tr>
    </thead>
    <tbody>
     @foreach($plis as $index => $pli)
    <tr>
      <tr>
    <td>{{ $loop->iteration }}</td>
    <td>{{ $pli->code }}</td>
    <td>{{ $pli->name }}</td>
    <td>{{ $pli->classification }}</td>
    <td>{{ $pli->accredited }}</td>
</tr>
    </tr>
@endforeach
    </tbody>
</table>
<br>
<footer>
    <div class="footer-line"></div>

    <div class="page-number"></div>

    <div class="footer-text">
        Generated from the APDS Database on {{ now()->format('d F Y') }} by: {{ auth()->user()->name }}
    </div>

    <div class="footer-division">
        Employee Account Management Division
    </div>
</footer>
</body>
</html>