<!DOCTYPE html>
<html>
<head>
    <style>
   body {
    font-family: Arial;
    font-size: 11px;
    margin: 40px;
}

/* REMOVE FULL TABLE BORDER LOOK */
table {
    width: 100%;
    border-collapse: collapse;
    margin-left: 15px;
}

td {
    padding: 4px 6px;
    border-bottom: 1px solid #ccc; /* light line only */
}

/* REMOVE THIS ❌ */
/* table, th, td { border: 1px solid black; } */

h3 {
    text-align: center;
}

/* HEADER */
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

/* REGION STYLE */
.region {
    background: #e5e7eb;
    padding: 6px 8px;
    font-weight: bold;
    margin-top: 12px;
}

/* PROVINCE */
.province {
    margin-left: 10px;
    margin-top: 6px;
    font-weight: bold;
}

/* CODE COLUMN */
.code {
    width: 70px;
    font-weight: bold;
}

/* NAME */
.name {
    text-transform: uppercase;
}

/* FOOTER (KEEP MO) */
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

@foreach($grouped as $region => $provinces)

    <!-- REGION -->
    <div class="region">
        {{ $region }}
    </div>

    @foreach($provinces as $province => $items)

        <!-- PROVINCE WITH COUNT -->
        <div class="province">
            {{ $province }} ({{ $items->count() }})
        </div>

        <!-- LIST -->
        <table width="100%" cellspacing="0" cellpadding="3">
            @foreach($items as $pli)
            <tr>
                <td width="70" class="code">{{ $pli->code }}</td>
                <td class="name">{{ strtoupper($pli->name) }}</td>
            </tr>
            @endforeach
        </table>

    @endforeach

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