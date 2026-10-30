<?php

// 1. ARRAY MULTIDIMENSI MATA KULIAH
$matkul = [
    [
        "nama" => "Algoritma dan Pemrograman",
        "sks" => 3,
        "nilai" => 90
    ],
    [
        "nama" => "Basis Data",
        "sks" => 3,
        "nilai" => 85
    ],
    [
        "nama" => "Matematika Diskrit",
        "sks" => 3,
        "nilai" => 75
    ],
    [
        "nama" => "Pemrograman Web",
        "sks" => 3,
        "nilai" => 65
    ],
    [
        "nama" => "Struktur Data",
        "sks" => 3,
        "nilai" => 45
    ]
];

// 2. FUNGSI HITUNG BOBOT
function hitungBobot($nilai) {

    if ($nilai >= 85) {
        return ["A", 4.0];
    } elseif ($nilai >= 75) {
        return ["B", 3.0];
    } elseif ($nilai >= 65) {
        return ["C", 2.0];
    } elseif ($nilai >= 50) {
        return ["D", 1.0];
    } else {
        return ["E", 0.0];
    }

}

// 3. INISIALISASI TOTAL
$totalSKS = 0;
$totalBobot = 0;

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Perhitungan IPS Mahasiswa</title>

    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container">

    <header>
        <h1>Academic Performance</h1>
        <p>Sistem Perhitungan Indeks Prestasi Semester</p>
    </header>

    <section class="card">

        <h2>Daftar Nilai Mata Kuliah</h2>

        <div class="table-container">

            <table>

                <thead>
                    <tr>
                        <th>No</th>
                        <th>Mata Kuliah</th>
                        <th>SKS</th>
                        <th>Nilai Angka</th>
                        <th>Nilai Huruf</th>
                        <th>Bobot</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>

                    <?php foreach ($matkul as $index => $mk): ?>

                        <?php
                            $hasil = hitungBobot($mk["nilai"]);

                            $huruf = $hasil[0];
                            $bobot = $hasil[1];

                            $status = ($bobot >= 2.0)
                                ? "LULUS"
                                : "MENGULANG";

                            $totalSKS += $mk["sks"];

                            $totalBobot +=
                                ($mk["sks"] * $bobot);
                        ?>

                        <tr class="<?= ($status == 'MENGULANG') ? 'mengulang' : '' ?>">

                            <td><?= $index + 1 ?></td>

                            <td><?= htmlspecialchars($mk["nama"]) ?></td>

                            <td><?= $mk["sks"] ?></td>

                            <td><?= $mk["nilai"] ?></td>

                            <td><?= $huruf ?></td>

                            <td><?= number_format($bobot, 1) ?></td>

                            <td>
                                <span class="status">
                                    <?= $status ?>
                                </span>
                            </td>

                        </tr>

                    <?php endforeach; ?>

                </tbody>

            </table>

        </div>

    </section>


    <?php

        // 4. MENGHITUNG IPS
        $ips = ($totalSKS > 0)
            ? $totalBobot / $totalSKS
            : 0;

        // 5. MENENTUKAN MAKSIMAL SKS
        $maksimalSKS = ($ips >= 3.00)
            ? 24
            : 20;

    ?>


    <section class="summary">

        <h2>Ringkasan Akademik</h2>

        <div class="summary-grid">

            <div class="summary-item">
                <p>Total SKS</p>
                <h3><?= $totalSKS ?></h3>
            </div>

            <div class="summary-item">
                <p>Total Bobot x SKS</p>
                <h3><?= number_format($totalBobot, 2) ?></h3>
            </div>

            <div class="summary-item highlight">
                <p>Indeks Prestasi Semester</p>
                <h3><?= number_format($ips, 2) ?></h3>
            </div>

            <div class="summary-item">
                <p>Maksimal SKS Berikutnya</p>
                <h3><?= $maksimalSKS ?> SKS</h3>
            </div>

        </div>

    </section>

    <footer>
        <p>Academic Performance System &copy; 2026</p>
    </footer>

</div>

</body>
</html>