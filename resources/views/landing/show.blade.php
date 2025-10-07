<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Slip Gaji | HRIS Payroll</title>

    <!-- Bootstrap CSS & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
        }

        .slip-container {
            border: 2px solid #007bff;
            border-radius: 10px;
            background-color: #ffffff;
            padding: 30px;
            box-shadow: 0 0 10px rgba(0, 123, 255, 0.2);
        }

        .header-slip {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            border-bottom: 2px solid #007bff;
            padding-bottom: 10px;
            margin-bottom: 25px;
        }

        .header-slip h4 {
            font-weight: 700;
            color: #007bff;
        }

        .slip-info {
            text-align: right;
        }

        .slip-info h5 {
            margin: 0;
            color: #0d6efd;
            font-weight: 700;
        }

        .slip-info small {
            color: #6c757d;
        }

        .table th {
            background-color: #e9f2ff;
        }

        .total-box {
            border-top: 2px dashed #007bff;
            padding-top: 15px;
        }
    </style>
</head>

<body>
    <div class="container py-5">
        <div class="slip-container">
            <!-- Header Slip -->
            <div class="header-slip">
                <div>
                    <h4><i class="bi bi-person-badge-fill me-2"></i>TOYOTA INTERCOM</h4>
                    <p class="mb-0 text-muted">HRIS Payroll System</p>
                </div>
                <div class="slip-info">
                    <h5>Slip Gaji</h5>
                    <small>{{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</small>
                </div>
            </div>

            <!-- Isi Slip -->
            <div class="row mb-4">
                <!-- Informasi Wiraniaga -->
                <div class="col-md-6 mb-3 mb-md-0">
                    <h6 class="fw-bold mb-3 text-primary">
                        <i class="bi bi-person-fill me-1"></i> Informasi Wiraniaga
                    </h6>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><strong>Nama Sales:</strong> {{ $data->nama }}</li>
                        <li class="list-group-item"><strong>Jabatan:</strong> {{ $data->jabatan }}</li>
                        <li class="list-group-item"><strong>Target Penjualan:</strong> {{ $data->target }} unit</li>
                        <li class="list-group-item"><strong>Jumlah Penjualan:</strong> {{ $data->jumlah_penjualan }}
                            unit</li>
                    </ul>
                </div>

                <!-- Detail Pendapatan -->
                <div class="col-md-6">
                    <h6 class="fw-bold mb-3 text-primary">
                        <i class="bi bi-cash-stack me-1"></i> Pendapatan Detail
                    </h6>
                    <table class="table table-bordered align-middle table-striped">
                        <tbody>
                            <tr>
                                <th>Gaji Pokok</th>
                                <td>Rp {{ number_format($gajiPokok, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <th>Tunjangan Transport</th>
                                <td>Rp {{ number_format($tunjanganTransport, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <th>Insentif Progresif</th>
                                <td>Rp {{ number_format($insentifProgresif, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <th>Insentif Unit</th>
                                <td>Rp {{ number_format($insentifUnit, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <th>Bonus Dua Bulanan</th>
                                <td>Rp {{ number_format($bonusDuaBulanan, 0, ',', '.') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Total Pendapatan -->
            <div class="text-center total-box">
                <h5 class="fw-bold text-success mb-2">
                    Total Pendapatan:
                </h5>
                <h3 class="fw-bold text-dark">
                    Rp {{ number_format($totalPendapatan, 0, ',', '.') }}
                </h3>
            </div>

            <!-- Tombol Kembali -->
            <div class="text-center mt-4">
                <a href="{{ url('/') }}" class="btn btn-outline-primary rounded-pill px-4">
                    <i class="bi bi-arrow-left me-1"></i> Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
