<?php
header("Content-tyoe: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Data Pembayaran.xls");
?>

<html>

<body>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nomor Pembayaran</th>
                <th>Nama</th>
                <th>Biaya</th>
                <th>Tanggal Tagihan</th>
                <th>Status Pembayaran</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($rekapPembayaran as $p => $v) {
                $nomor = $nomor + 1;
                if ($v['status_pembayaran'] == 1) {
                    $v['status_pembayaran'] = "Sudah Bayar";
                } else {
                    $v['status_pembayaran'] = "Belum Bayar";
                }
            ?>
                <tr>
                    <td><?php echo $nomor ?></td>
                    <td><?php echo $v["nim"] ?></td>
                    <td><?php echo $v['nama'] ?></td>
                    <td><?php echo $v['biaya'] ?></td>
                    <td><?php echo $v['tgl_tagihan'] ?></td>
                    <td><?php echo $v['status_pembayaran'] ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>

</html>