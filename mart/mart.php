<?php
$tagihanAwal = 0;
$diskon = 0;
$tagihanAkhir = 0;
$hargaSatuan = 0;

if (isset($_POST['submit'])) {
    $merek = $_POST['merek'];
    $jumlah = $_POST['jumlah'];

    // Harga satuan produk snack
    $hargaGaruda = 20000;
    $hargaMerekLain = 20000;

    // Menghitung harga satuan berdasarkan merek
    if ($merek == 'Garuda' || $merek == 'MerekLain') {
        if ($merek == 'Garuda') {
            $diskon = 0.2;
        } elseif ($merek == 'MerekLain') {
            $diskon = 0.1;
        }

        $hargaSatuan = ${'harga' . $merek};
        $tagihanAwal = $hargaSatuan * $jumlah;

        // Menerapkan diskon berdasarkan merek
        $diskon = $diskon * $tagihanAwal;
    }

    // Memeriksa apakah tagihan awal lebih dari Rp 50.000
    if ($tagihanAwal > 50000) {
        // Menyimpan hasil tagihan akhir setelah diskon
        $tagihanAkhir = $tagihanAwal - $diskon;
    } else {
        // Tidak ada diskon jika tagihan awal kurang dari atau sama dengan Rp 50.000
        $tagihanAkhir = $tagihanAwal;
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zara Mart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-3 mb-5" style="width: 30rem;">
        <div class="card-body rounded-start shadow">
            <div class="text-center">
                <img src="logo.png" class="rounded" alt="...">
            </div>
            <form action="mart.php" method="POST">
                <div class="mb-3">
                    <label for="merek" class="form-label">Merek Produk:</label>
                    <select name="merek" id="merek" class="form-select">
                        <option value="Garuda">Garuda</option>
                        <option value="MerekLain">Merek Lain</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="jumlah" class="form-label">Jumlah:</label>
                    <input type="number" name="jumlah" id="jumlah" class="form-control" required>
                </div>
                <div class="text-center">
                <button type="submit" name="submit" class="form-control btn btn-primary mb-1">Hitung Tagihan</button>
                <a href="index.php" class=" form-control btn btn-danger">Keluar</a>
                </div>
            </form>

            <?php if (isset($_POST['submit'])) : ?>
                <h2 class="mt-4">Hasil Pembelian :</h2>
                <p>Merek Produk: <?php echo $merek; ?></p>
                <p>Harga Satuan: Rp <?php echo number_format($hargaSatuan, 0, ",", "."); ?></p>
                <p>Jumlah: <?php echo $jumlah; ?></p>
                <p>Tagihan Awal: Rp <?php echo number_format($tagihanAwal, 0, ",", "."); ?></p>
                <?php if ($tagihanAwal > 50000) : ?>
                    <p>Diskon: Rp <?php echo number_format($diskon, 0, ",", "."); ?></p>
                <?php else : ?>
                    <p>Tidak ada diskon</p>
                <?php endif; ?>
                <p>Total Tagihan: Rp <?php echo number_format($tagihanAkhir, 0, ",", "."); ?></p>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>