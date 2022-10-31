<h5 class="font-bold my-4">Detail Pengajuan Legalisir</h5>
<br>
<table class="items-center w-full mb-0 align-top border-collapse dark:border-white/40 text-slate-500">
    <tbody>
        <tr>
            <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                <p class="mb-0 leading-tight dark:text-white dark:opacity-80 text-size-lg">Nama</p>
            </td>
            <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                <p class="mb-0 leading-tight dark:text-white dark:opacity-80 text-size-lg"><?= $data['nama'] ?></p>
            </td>
        </tr>
        <tr>
            <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                <p class="mb-0 leading-tight dark:text-white dark:opacity-80 text-size-lg">Jurusan</p>
            </td>
            <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                <p class="mb-0 leading-tight dark:text-white dark:opacity-80 text-size-lg"><?= $data['jurusan'] ?></p>
            </td>
        </tr>
        <tr>
            <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                <p class="mb-0 leading-tight dark:text-white dark:opacity-80 text-size-lg">Nomor Tagihan</p>
            </td>
            <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                <p class="mb-0 leading-tight dark:text-white dark:opacity-80 text-size-lg"><?= $data['nim'] ?></p>
            </td>
        </tr>        
        <tr>
            <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                <p class="mb-0 leading-tight dark:text-white dark:opacity-80 text-size-lg">Jenis & Jumlah Berkas</p>
            </td>
            <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                <p class="mb-0 leading-tight dark:text-white dark:opacity-80 text-size-lg">
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
                <p class="mb-0 leading-tight dark:text-white dark:opacity-80 text-size-lg">Total Biaya</p>
            </td>
            <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                <p class="mb-0 leading-tight dark:text-white dark:opacity-80 text-size-lg">Rp <?= number_format($data['biaya'], 0, ',', '.') ?></p>
            </td>
        </tr>
        <tr>
            <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                <p class="mb-0 leading-tight dark:text-white dark:opacity-80 text-size-lg">Metode Pengambilan</p>
            </td>
            <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                <p class="mb-0 leading-tight dark:text-white dark:opacity-80 text-size-lg"><?= $data['nama_metode'] ?></p>
            </td>
        </tr>
        <tr>
            <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                <p class="mb-0 leading-tight dark:text-white dark:opacity-80 text-size-lg">Alamat</p>
            </td>
            <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                <p class="mb-0 leading-tight dark:text-white dark:opacity-80 text-size-lg"><?= $data['alamat'] ? $data['alamat'] : '-' ?></p>
            </td>
        </tr>        
        <tr>
            <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                <p class="mb-0 leading-tight dark:text-white dark:opacity-80 text-size-lg">Status Pengajuan</p>
            </td>
            <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                <p class="mb-0 leading-tight dark:text-white dark:opacity-80 text-size-lg"><?= $data['nama_status'] ?></p>
            </td>
        </tr>
        <?php if ($data['metode_pengambilan_id'] == 2) : ?>
            <tr>
                <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                    <p class="mb-0 leading-tight dark:text-white dark:opacity-80 text-size-lg">Nama Ekspedisi</p>
                </td>
                <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                    <p class="mb-0 leading-tight dark:text-white dark:opacity-80 text-size-lg"><?= $data['nama_ekspedisi'] ? $data['nama_ekspedisi'] : "Belum ditentukan" ?></p>
                </td>
            </tr>
            <tr>
                <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                    <p class="mb-0 leading-tight dark:text-white dark:opacity-80 text-size-lg">Nomor Resi</p>
                </td>
                <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                    <p class="mb-0 leading-tight dark:text-white dark:opacity-80 text-size-lg"><?= $data['no_resi'] ? $data['no_resi'] : "Belum ditentukan" ?></p>
                </td>
            </tr>
        <?php endif ?>
    </tbody>
</table>