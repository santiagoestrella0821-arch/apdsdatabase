<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
            margin: 40px;
        }

        .header {
            text-align: center;
            margin-bottom: 10px;
        }

        .title {
            font-weight: bold;
            font-size: 13px;
        }

        .subtitle {
            font-size: 11px;
        }

        .pli {
            margin-top: 10px;
            font-weight: bold;
        }

        .region {
            margin-top: 12px;
            font-weight: bold;
        }

        .province {
            margin-left: 20px;
        }

        footer {
            position: fixed;
            bottom: -20px;
            right: 0;
            font-size: 10px;
        }

        .pagenum:before {
            content: counter(page);
        }

        footer {
    position: fixed;
    bottom: -40px;
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
    font-size: 11px;
}

.page-number:before {
    content: "Page " counter(page) " of " counter(pages);
}

.footer-text {
    margin-top: 10px;
}

.footer-division {
    margin-top: 20px;
    font-style: italic;
}
    </style>
    <title>Coverage Report</title>
</head>

<body>

<!-- HEADER -->
<div class="header">
    <div class="title">
        List of Accredited Private Lending Institutions and Provinces where Authorized to Utilize DepEd-APDS
    </div>

    <div class="subtitle">
        DEPARTMENT OF EDUCATION<br>
        Employee Account Management Division<br>
        Automatic Payroll Deduction System
    </div>
</div>

<!-- PLI -->
<div class="pli">
    {{ $pli->code }} {{ strtoupper($pli->name) }}
</div>

<!-- BODY -->
@foreach($coverages as $region => $items)

    <div class="region">
        {{ $region }}
    </div>

    @foreach($items as $c)
        <div class="province">
            {{ $c->province_name }}
        </div>
    @endforeach

@endforeach

<!-- FOOTER -->
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