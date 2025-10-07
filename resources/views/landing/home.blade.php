<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Penjualan | HRIS Payroll</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background-color: #f5f7fa;
            padding-top: 50px;
        }

        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #1e3c72;
            color: #fff;
            font-weight: 600;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
        }

        table thead {
            background-color: #1e3c72;
            color: white;
        }

        table tbody tr:hover {
            background-color: #e9f0ff;
        }
    </style>
</head>

<body>

    <div class="container">
        {{-- PEMBERITAHUAN --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="card">
            <div class="card-header text-center py-3">
                <h5>📊 Data Hasil Penjualan Wiraniaga</h5>
            </div>
            <div class="card-body">
                <!-- Tombol Tambah Data -->
                <!-- Tombol Tambah Data -->
                <div class="d-flex justify-content-end mt-3 mb-3">
                    <button type="button" class="btn btn-success shadow-sm" data-bs-toggle="modal"
                        data-bs-target="#tambahDataModal">
                        <i class="bi bi-plus-circle"></i> Tambah Data
                    </button>
                </div>

                <!-- Modal Tambah Data -->
                <div class="modal fade" id="tambahDataModal" tabindex="-1" aria-labelledby="tambahDataModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content border-0 shadow-lg rounded-4">
                            <div class="modal-header bg-success text-white">
                                <h5 class="modal-title fw-bold" id="tambahDataModalLabel">Tambah Data Wiraniaga</h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>

                            <form action="{{ route('wiraniaga.store') }}" method="POST">
                                @csrf
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="nama" class="form-label fw-semibold">Nama Sales</label>
                                        <input type="text" name="nama" id="nama" class="form-control"
                                            placeholder="Masukkan nama wiraniaga" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="jabatan" class="form-label fw-semibold">Jabatan</label>
                                        <select name="jabatan" id="jabatan" class="form-select" required>
                                            <option value="" selected disabled>Pilih jabatan</option>
                                            <option value="JSE">JSE</option>
                                            <option value="SE">SE</option>
                                            <option value="SSE">SSE</option>
                                            <option value="PSSE">PSSE</option>
                                        </select>
                                    </div>


                                    <div class="mb-3">
                                        <label for="target" class="form-label fw-semibold">Target Penjualan</label>
                                        <input type="number" name="target" id="target" class="form-control"
                                            placeholder="Masukkan target" min="0" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="jumlah_penjualan" class="form-label fw-semibold">Jumlah
                                            Penjualan</label>
                                        <input type="number" name="jumlah_penjualan" id="jumlah_penjualan"
                                            class="form-control" placeholder="Masukkan jumlah penjualan" min="0"
                                            required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="status" class="form-label fw-semibold">Status</label>
                                        <select name="status" id="status" class="form-select" required>
                                            <option value="">-- Pilih Status --</option>
                                            <option value="Aktif">Aktif</option>
                                            <option value="Nonaktif">Nonaktif</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-success">Simpan Data</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


                <table class="table table-bordered table-striped align-middle text-center">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Jabatan</th>
                            <th>Target Penjualan</th>
                            <th>Jumlah Penjualan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($wiraniagas as $index => $item)
                            <tr>
                                <td>{{ $wiraniagas->firstItem() + $loop->index }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->jabatan }}</td>
                                <td>{{ $item->target }}</td>
                                <td>{{ $item->jumlah_penjualan }}</td>
                                <td>
                                    <a href="{{ url('/wiraniaga-destroy/' . $item->id) }}"
                                        onclick="return confirm('Yakin ingin menghapus {{ $item->nama }}?')"
                                        class="btn btn-outline-danger btn-sm" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </a>

                                    <!-- Tombol Show -->
                                    <a href="{{ url('/wiraniaga-show/' . $item->id) }}"
                                        class="btn btn-outline-info btn-sm" title="Lihat Data">
                                        <i class="bi bi-eye"></i> Lihat
                                    </a>

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Data Kosong.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
