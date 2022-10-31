<h5 class="font-bold my-4">Detail Pengajuan</h5>
<div class="relative p-4 rounded-lg bg-transparent border border-slate-800">
    <div class="font-bold text-size-md">Informasi Pembayaran</div>
    <p class="text-size-md">Nomor tagihan pembayaran merupakan NIM Alumni.
        <br>
        Pembayaran dapat dilakukan melalui Bank BSI dengan memasukkan nomor tagihan.
    </p>
</div>
<br>
<table class="items-center w-full mb-0 align-top border-collapse dark:border-white/40 text-slate-500">
    <tbody>
        <tr>
            <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                <p class="mb-0 leading-tight dark:text-white dark:opacity-80 text-size-sm lg:text-size-md">Nama</p>
            </td>
            <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                <p class="mb-0 leading-tight dark:text-white dark:opacity-80 text-size-sm lg:text-size-md"><?= $data['nama'] ?></p>
            </td>
        </tr>
        <tr>
            <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                <p class="mb-0 leading-tight dark:text-white dark:opacity-80 text-size-sm lg:text-size-md">Jurusan</p>
            </td>
            <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                <p class="mb-0 leading-tight dark:text-white dark:opacity-80 text-size-sm lg:text-size-md"><?= $data['jurusan'] ?></p>
            </td>
        </tr>
        <tr>
            <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                <p class="mb-0 leading-tight dark:text-white dark:opacity-80 text-size-sm lg:text-size-md">Nomor Tagihan</p>
            </td>
            <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                <p class="mb-0 leading-tight dark:text-white dark:opacity-80 text-size-sm lg:text-size-md"><?= $data['nim'] ?></p>
            </td>
        </tr>
 
        <tr>
            <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                <p class="mb-0 leading-tight dark:text-white dark:opacity-80 text-size-sm lg:text-size-md">Metode Pengambilan</p>
            </td>
            <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                <p class="mb-0 leading-tight dark:text-white dark:opacity-80 text-size-sm lg:text-size-md"><?= $data['nama_metode'] ?></p>
            </td>
        </tr>
        <tr>
            <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                <p class="mb-0 leading-tight dark:text-white dark:opacity-80 text-size-sm lg:text-size-md">Alamat</p>
            </td>
            <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                <p class="mb-0 leading-tight dark:text-white dark:opacity-80 text-size-sm lg:text-size-md"><?= $data['alamat'] ? $data['alamat'] : '-' ?></p>
            </td>
        </tr>
        <tr>
            <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                <p class="mb-0 leading-tight dark:text-white dark:opacity-80 text-size-sm lg:text-size-md">Jenis & Jumlah Berkas</p>
            </td>
            <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                <p class="mb-0 leading-tight dark:text-white dark:opacity-80 text-size-sm lg:text-size-md">
                    <ul>
                        <?php foreach($berkas as $b): ?>
                            <li><?= $b['nama_berkas']; ?> - <?= $b['jumlah']; ?> Lembar - Rp. <?= number_format($b['biaya'], 0, ',', '.'); ?></li>
                        <?php endforeach ?>
                    </ul>
                </p>
            </td>
        </tr>
        <tr>
            <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                <p class="mb-0 leading-tight dark:text-white dark:opacity-80 text-size-sm lg:text-size-md">Total Biaya</p>
            </td>
            <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                <p class="mb-0 leading-tight dark:text-white dark:opacity-80 text-size-sm lg:text-size-md">Rp <?= number_format($data['biaya'], 2, ',', '.') ?></p>
            </td>
        </tr>
        <tr>
            <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                <p class="mb-0 leading-tight dark:text-white dark:opacity-80 text-size-sm lg:text-size-md">Status Pengajuan</p>
            </td>
            <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                <p class="mb-0 leading-tight dark:text-white dark:opacity-80 text-size-sm lg:text-size-md"><?= $data['nama_status'] ?></p>
            </td>
        </tr>
        <?php if ($data['metode_pengambilan_id'] == 2) : ?>
            <tr>
                <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                    <p class="mb-0 leading-tight dark:text-white dark:opacity-80 text-size-sm lg:text-size-md">Nama Ekspedisi</p>
                </td>
                <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                    <p class="mb-0 leading-tight dark:text-white dark:opacity-80 text-size-sm lg:text-size-md"><?= $data['nama_ekspedisi'] ? $data['nama_ekspedisi'] : "Belum ditentukan" ?></p>
                </td>
            </tr>
            <tr>
                <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                    <p class="mb-0 leading-tight dark:text-white dark:opacity-80 text-size-sm lg:text-size-md">Nomor Resi</p>
                </td>
                <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                    <p class="mb-0 leading-tight dark:text-white dark:opacity-80 text-size-sm lg:text-size-md"><?= $data['no_resi'] ? $data['no_resi'] : "Belum ditentukan" ?></p>
                </td>
            </tr>
        <?php endif ?>
    </tbody>
</table>