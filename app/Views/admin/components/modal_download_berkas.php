<h5 class="font-bold my-4">Download Berkas</h5>
<br>
<table class="items-center w-full mb-0 align-top border-collapse dark:border-white/40 text-slate-500">
    <tbody>        
            <?php foreach($data as $dt): ?>
                <tr>
                    <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                        <p class="mb-0 leading-tight dark:text-white dark:opacity-80 text-size-lg"><?= $dt['nama_berkas']; ?></p>
                    </td>
                    <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                    <a href="<?= base_url(); ?>/berkas/<?= $dt['nama_file']; ?>" class="p-2  bg-black text-white">Download Berkas</a>
                    </td>
                </tr>        
                <?php endforeach ?>
    </tbody>
</table>