<p>Kepada Yth. <?= $data['nama'] ?></p>
<br>
<p>Data akun SLIT FMIPA USK</p>
<br>
<a href="<?= site_url('auth/reset/'.$data['key']); ?>">klik reset password</a>
<p>Berikut adalah rincian informasi:</p>
<table>
    <tr>
        <td>Nama</td>
        <td>: <?= $data['nama'] ?></td>
    </tr>
    <tr>
        <td>NIM</td>
        <td>: <?= $data['nim'] ?></td>
    </tr>
    <tr>
        <td>Email</td>
        <td>: <?= $data['email'] ?></td>
    </tr>
    <tr>
        <td>Nomor HP</td>
        <td>: <?= $data['nohp'] ?></td>
    </tr>
    <tr>
        <td>Alamat</td>
        <td>: <?= $data['alamat'] ?></td>
    </tr>
</table>
<br>
<p>Terima Kasih,</p>
<br>
<b>SLIT FMIPA USK</b>