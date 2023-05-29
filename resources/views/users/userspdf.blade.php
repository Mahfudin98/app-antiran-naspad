<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Data Maintenance</title>
    {{--
    <link rel="stylesheet" href="/assets/css/style.css" media="all" /> --}}
    <style>
        @font-face {
            font-family: SourceSansPro;
            src: url(SourceSansPro-Regular.ttf);
        }

        .clearfix:after {
            content: "";
            display: table;
            clear: both;
        }

        a {
            color: #555555;
            text-decoration: none;
        }

        body {
            position: relative;
            width: 25cm;
            height: 29.7cm;
            margin: 0 auto;
            color: #555555;
            background: #ffffff;
            font-family: Arial, sans-serif;
            font-size: 14px;
            font-family: SourceSansPro;
        }

        header {
            padding: 10px 0;
            margin-bottom: 20px;
            border-bottom: 1px solid #aaaaaa;
        }

        #logo {
            float: left;
            margin-top: 5px;
        }

        #logo img {
            height: 50px;
        }

        #company {
            float: right;
            text-align: right;
        }

        #details {
            margin-bottom: 50px;
        }

        #client {
            padding-left: 6px;
            border-left: 6px solid #0087c3;
            float: left;
        }

        #client .to {
            color: #777777;
        }

        h2.name {
            font-size: 1.4em;
            font-weight: normal;
            margin: 0;
        }

        #invoice {
            float: right;
            text-align: right;
        }

        #invoice h1 {
            color: #0087c3;
            font-size: 2.4em;
            line-height: 1em;
            font-weight: normal;
            margin: 0 0 10px 0;
        }

        #invoice .date {
            font-size: 1.1em;
            color: #777777;
        }

        table {
            width: 25cm;
            border-collapse: collapse;
            border-spacing: 0;
            margin-bottom: 50px;
        }

        table tr:nth-child(2n-1) td {
            background: #f5f5f5;
        }

        table th,
        table td {
            text-align: center;
        }

        table th {
            padding: 5px 20px;
            color: #5d6975;
            border-bottom: 1px solid #c1ced9;
            white-space: nowrap;
            font-weight: normal;
        }

        table td {
            padding: 20px;
        }

        table td.grand {
            border-top: 1px solid #5d6975;
        }

        table tfoot td {
            padding: 10px 20px;
            background: #ffffff;
            border-bottom: none;
            font-size: 1.2em;
            white-space: nowrap;
            border-top: 1px solid #aaaaaa;
        }

        table tfoot tr:first-child td {
            border-top: none;
        }

        .hormat {
            margin-top: 70px;
        }

        table tfoot tr:last-child td {
            color: #57b223;
            font-size: 1.4em;
            border-top: 1px solid #57b223;
        }

        table tfoot tr td:first-child {
            border: none;
        }

        #thanks {
            font-size: 2em;
            margin-bottom: 50px;
        }

        #notices {
            padding-left: 6px;
            border-left: 6px solid #009d9c;
        }

        #notices .notice {
            font-size: 1.2em;
        }

        footer {
            color: #777777;
            width: 100%;
            height: 30px;
            position: absolute;
            bottom: 0;
            border-top: 1px solid #aaaaaa;
            padding: 8px 0;
            text-align: center;
        }
    </style>
</head>

<body>
    <header class="clearfix">
        <div id="logo">
            <h2 class="name"><strong>Rumah Makan Chaniago</strong></h2>
            <div>Jalan Majalengka
                <br>
                kecamatan majalengka
            </div>
            <div>123 - 45678910</div>
            <div><a href="mailto:info@enesers.com">chanigo.com</a></div>
        </div>
        <br>
        <div id="company">
            {{-- <img src="/img/enesers.png" width="150"> --}}
            <img src="<?php echo $base64 ?>" alt="Logo Chaniago">
            <h2 class="name"><strong> #123/CHA/123/123 </strong></h2>
        </div>
    </header>
    <main>
        <h2>Data Users Apps Chaniago</h2>
        <table style="text-center">
            <thead>
                <tr>
                    <th class="text-center">No.</th>
                    <th class="text-center">Nama</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">No HP</th>
                </tr>
            </thead>
            <tbody>
                @php $no=1; @endphp
                @foreach($user as $item)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->no_hp }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div id="notices">
            <div>NOTICE:</div>
            <div class="notice">Harap gunakan dengan bijak data tersebut.</div>
        </div>
        <h3 class="hormat">Mengetahui,
            <br>
            <br>
            <br>
            <br>
            Tutik Lestari
        </h3>
    </main>
</body>

</html>