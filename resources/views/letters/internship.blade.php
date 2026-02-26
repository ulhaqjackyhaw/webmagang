<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Keterangan Magang - {{ $acceptedIntern->intern->nama }}</title>
    <style>
        @page {
            size: A4;
            margin: 2cm;
        }

        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12pt;
            line-height: 1.5;
            color: #000;
        }

        .header {
            text-align: center;
            border-bottom: 3px double #000;
            padding-bottom: 15px;
            margin-bottom: 30px;
        }

        .header img {
            height: 80px;
            margin-bottom: 10px;
        }

        .header h1 {
            font-size: 16pt;
            font-weight: bold;
            margin: 0;
        }

        .header h2 {
            font-size: 14pt;
            font-weight: bold;
            margin: 5px 0;
        }

        .header p {
            font-size: 10pt;
            margin: 0;
        }

        .letter-info {
            margin-bottom: 20px;
        }

        .letter-info table {
            width: 50%;
            margin-left: auto;
        }

        .letter-info td {
            padding: 2px 0;
        }

        .title {
            text-align: center;
            margin: 30px 0;
        }

        .title h3 {
            font-size: 14pt;
            text-decoration: underline;
            margin: 0;
        }

        .title p {
            margin: 5px 0 0 0;
        }

        .content {
            text-align: justify;
            margin-bottom: 20px;
        }

        .data-table {
            width: 100%;
            margin: 20px 0;
        }

        .data-table td {
            padding: 5px 0;
            vertical-align: top;
        }

        .data-table td:first-child {
            width: 150px;
        }

        .data-table td:nth-child(2) {
            width: 20px;
            text-align: center;
        }

        .signature {
            margin-top: 50px;
            text-align: right;
        }

        .signature-box {
            display: inline-block;
            text-align: center;
            width: 250px;
        }

        .signature-line {
            margin-top: 80px;
            border-bottom: 1px solid #000;
            margin-bottom: 5px;
        }

        .print-btn {
            position: fixed;
            top: 20px;
            right: 20px;
            background: #20B2AA;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }

        .print-btn:hover {
            background: #1a8f89;
        }

        @media print {
            .print-btn {
                display: none;
            }
        }
    </style>
</head>

<body>
    <button class="print-btn" onclick="window.print()">
        <i class="fas fa-print"></i> Cetak Surat
    </button>

    <div class="header">
        <h1>PT ANGKASA PURA II (PERSERO)</h1>
        <h2>KANTOR REGIONAL I</h2>
        <p>Jl. Bandara Soekarno-Hatta, Tangerang, Banten 15125</p>
        <p>Telepon: (021) 5506127 | Website: www.angkasapura2.co.id</p>
    </div>

    <div class="letter-info">
        <table>
            <tr>
                <td>Nomor</td>
                <td>:</td>
                <td>___/___/{{ date('Y') }}</td>
            </tr>
            <tr>
                <td>Lamp</td>
                <td>:</td>
                <td>-</td>
            </tr>
            <tr>
                <td>Perihal</td>
                <td>:</td>
                <td><strong>Penerimaan Magang</strong></td>
            </tr>
        </table>
    </div>

    <div class="content">
        <p>Kepada Yth,<br>
            Dekan/Kepala Bagian Akademik<br>
            {{ $acceptedIntern->intern->asal_kampus }}<br>
            di Tempat</p>

        <p>Dengan hormat,</p>

        <p>Berdasarkan surat permohonan magang yang kami terima, dengan ini kami sampaikan bahwa mahasiswa berikut ini:
        </p>

        <table class="data-table">
            <tr>
                <td>Nama Lengkap</td>
                <td>:</td>
                <td>{{ $acceptedIntern->intern->nama }}</td>
            </tr>
            <tr>
                <td>NIM</td>
                <td>:</td>
                <td>{{ $acceptedIntern->intern->nim }}</td>
            </tr>
            <tr>
                <td>Program Studi</td>
                <td>:</td>
                <td>{{ $acceptedIntern->intern->program_studi }}</td>
            </tr>
            <tr>
                <td>Asal Kampus</td>
                <td>:</td>
                <td>{{ $acceptedIntern->intern->asal_kampus }}</td>
            </tr>
            <tr>
                <td>Unit Magang</td>
                <td>:</td>
                <td>{{ $acceptedIntern->unit_magang }}</td>
            </tr>
            <tr>
                <td>Periode Magang</td>
                <td>:</td>
                <td>{{ $acceptedIntern->periode_magang ?? ($acceptedIntern->intern->periode_magang ?? '-') }}</td>
            </tr>
        </table>

        <p>Telah <strong>DITERIMA</strong> untuk melaksanakan kegiatan magang di PT Angkasa Pura II (Persero) Kantor
            Regional I pada unit sebagaimana tersebut di atas.</p>

        <p>Demikian surat ini kami sampaikan, atas perhatian dan kerjasamanya kami ucapkan terima kasih.</p>
    </div>

    <div class="signature">
        <div class="signature-box">
            <p>Tangerang, {{ date('d F Y') }}</p>
            <p>Manager Human Capital</p>
            <p>Kantor Regional I</p>
            <div class="signature-line"></div>
            <p><strong>___________________</strong></p>
        </div>
    </div>

    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>

</html>
