<?= $this->extend('layouts/app-layout') ?>

<?= $this->section('breadcrumb') ?>
<ol class="flex flex-wrap pt-1 mr-12 bg-transparent rounded-lg sm:mr-16">
    <li class="leading-normal text-size-sm">
        <a class="text-white" href="<?= base_url() ?>">Beranda</a>
    </li>
    <a href="<?= base_url('pengajuan') ?>">
        <li class="text-size-sm pl-2 font-bold capitalize leading-normal text-white before:float-left before:pr-2 before:text-white before:content-['/']" aria-current="page">Pengajuan Legalisir</li>
    </a>
</ol>
<h6 class="mb-0 font-bold text-white capitalize">Pengajuan Legalisir</h6>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="flex flex-wrap -mx-3">
    <div class="flex-none w-full max-w-full px-3">
        <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <h6 class="dark:text-white">Kirim Pengajuan Legalisir</h6>
            </div>
            <div class="flex flex-wrap -mx-3 justify-center">
                <div class="bg-white border-0 shadow-soft-xl rounded-2xl bg-clip-border flex flex-col w-full max-w-full px-3 mx-auto lg:mx-0 shrink-0 md:flex-0 md:w-7/12 lg:w-5/12 xl:w-8/12">
                    <div class="relative flex flex-col min-w-0 break-words bg-transparent border-0 shadow-none lg:py4 dark:bg-gray-950 rounded-2xl bg-clip-border">
                        <div class="relative p-4 m-6 rounded-lg bg-transparent border border-slate-800">
                            <div class="font-bold">Informasi</div>
                            <p class="text-size-sm">Dimohon untuk mengunggah dokumen secara timbal balik dalam bentuk format PDF dengan kualitas yang baik. Terimakasih</p>
                        </div>
                        <div class="flex-auto px-6 mb-10">
                            <form role="form" id="form-pengajuan" enctype="multipart/form-data" method="POST" action="<?= base_url('pengajuan') ?>">
                                <!-- <div class="mb-2">
                                    <label class="mb-2 ml-1 font-bold text-size-xs text-slate-700" for="username">Jenis Berkas</label>
                                    <?php foreach ($berkas as $b) :?>
                                        <div class=" mb-2 pl-8">
                                        <input id="metode1" value="<?= $b['id']?>" name="metode_pengambilan" class="w-5-em h-5-em ease text-base -ml-7-em rounded-1.4  checked:bg-gradient-to-tl checked:from-blue-500 checked:to-violet-500 after:text-size-fa-check after:font-awesome after:duration-250 after:ease-in-out duration-250 relative float-left mt-1 cursor-pointer appearance-none border border-solid border-slate-150 bg-white bg-contain bg-center bg-no-repeat align-top transition-all after:absolute after:flex after:h-full after:w-full after:items-center after:justify-center after:text-white after:opacity-0 after:transition-all after:content-['\f00c'] checked:border-0 checked:border-transparent checked:bg-transparent checked:after:opacity-100" type="checkbox" />
                                        <label for="metode1" class="text-size-xs cursor-pointer select-none text-slate-700"><?= $b['nama_berkas'] ?></label>
                                    </div>
                                    <?php endforeach ?> -->
                                    <div class="mb-2">
                                    <label class="mb-2 ml-1 font-bold text-size-xs text-slate-700" for="username">Jenis Berkas</label>
                                    <!-- <select name="jenis_berkas" id="jenis_berkas" class="form-select focus:shadow-primary-outline dark:bg-gray-950 dark:placeholder:text-white/80 dark:text-white/80 text-size-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-300 focus:outline-none">
                                        <option value="" disabled selected>Pilih Jenis Berkas</option>
                                        <?php foreach ($berkas as $b) :?>
                                        <option value="<?= $b['id']?>"><?= $b['nama_berkas'] ?></option>
                                        <?php endforeach ?>
                                    </select> -->
                                    <div class="flex flex-wrap">
                                    <?php foreach($berkas as $b): ?>
                                            <div class="form-check form-check-inline mr-2">
                                                <input class="form-check-input jenis_berkas" type="checkbox" name="jenis_berkas_<?= $b['id'] ?>" value="<?= $b['id']; ?>">
                                                <label class="form-check-label"><?= $b['nama_berkas']; ?></label>
                                            </div>
                                            <?php endforeach ?>
                                        </div>
                                    
                                </div>
                                <!-- Ijazah -->
                                <div class="mt-4 mb-2 flex items-center justify-between hidden" id="radio_berkas_ijazah">
                                <label class="font-bold text-size-xs text-slate-700" for="berkas">Berkas Ijazah :</label>
                                    <div class="pl-8">
                                        <input id="radio_newberkas_ijazah" value="1" name="radio_berkas_ijazah" class="w-5-em h-5-em ease text-base -ml-7-em rounded-1.4 relative float-left mt-1 cursor-pointer border border-solid border-slate-150 bg-white bg-contain bg-center bg-no-repeat align-top transition-all after:absolute after:flex after:h-full after:w-full after:items-center after:justify-center " type="radio" />
                                        <label for="radio_newberkas_ijazah" class="text-size-xs cursor-pointer select-none text-slate-700">Upload Berkas Ijazah Baru</label>
                                    </div>
                                    <div class="pl-8">
                                        <input id="radio_oldberkas_ijazah" value="2" name="radio_berkas_ijazah" class="w-5-em h-5-em ease text-base -ml-7-em rounded-1.4 relative float-left mt-1 cursor-pointer border border-solid border-slate-150 bg-white bg-contain bg-center bg-no-repeat align-top transition-all after:absolute after:flex after:h-full after:w-full after:items-center after:justify-center " type="radio" />
                                        <label for="radio_oldberkas_ijazah" class="text-size-xs cursor-pointer select-none text-slate-700">Gunakan Berkas Ijazah Lama</label>
                                    </div>
                                </div>
                                <div class="mb-2">
                                    <div id="new_berkas_ijazah" class="hidden">
                                        <input type="file" id="berkas" name="berkas_ijazah" class="focus:shadow-primary-outline dark:bg-gray-950 dark:placeholder:text-white/80 dark:text-white/80 text-size-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-300 focus:outline-none" />
                                        <p class="text-red-700 font-light text-size-xs">
                                            berkas ijazah wajib .pdf maksimal 2MB
                                        </p>
                                    </div>
                                    <div id="old_berkas_ijazah" class="hidden"></div>
                                </div> 
                                <div class="grid md:grid-cols-2 gap-2 hidden" id="jumlah_berkas_ijazah">
                                    <div>
                                        <input type="number" name="jumlah_ijazah" min="1" max="10" onkeypress="return event.charCode >= 48 && event.charCode <=57" id="jumlah_ijazah" placeholder="Masukkan Jumlah Berkas Ijazah" class="focus:shadow-primary-outline dark:bg-gray-950 dark:placeholder:text-white/80 dark:text-white/80 text-size-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-300 focus:outline-none" />
                                    </div>
                                    <div>
                                        <input type="text" id="biaya_ijazah" name="biaya_ijazah" placeholder="Biaya" class="focus:shadow-primary-outline dark:bg-gray-950 dark:placeholder:text-white/80 dark:text-white/80 text-size-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-300 focus:outline-none" readonly />
                                    </div>
                                </div>
                                
                                <!-- Transkrip -->
                                <div class="mt-5 mb-2 flex items-center justify-between hidden" id="radio_berkas_transkrip">
                                    <label class="font-bold text-size-xs text-slate-700" for="berkas">Berkas Ijazah :</label>
                                    <div class="pl-8">
                                        <input id="radio_newberkas_transkrip" value="1" name="radio_berkas_transkrip" class="w-5-em h-5-em ease text-base -ml-7-em rounded-1.4 relative float-left mt-1 cursor-pointer border border-solid border-slate-150 bg-white bg-contain bg-center bg-no-repeat align-top transition-all after:absolute after:flex after:h-full after:w-full after:items-center after:justify-center " type="radio" />
                                        <label for="radio_newberkas_transkrip" class="text-size-xs cursor-pointer select-none text-slate-700">Upload Berkas Transkrip Baru</label>
                                    </div>
                                    <div class="pl-8">
                                        <input id="radio_oldberkas_transkrip" value="2" name="radio_berkas_transkrip" class="w-5-em h-5-em ease text-base -ml-7-em rounded-1.4 relative float-left mt-1 cursor-pointer border border-solid border-slate-150 bg-white bg-contain bg-center bg-no-repeat align-top transition-all after:absolute after:flex after:h-full after:w-full after:items-center after:justify-center " type="radio" />
                                        <label for="radio_oldberkas_transkrip" class="text-size-xs cursor-pointer select-none text-slate-700">Gunakan Berkas Transkrip Lama</label>
                                    </div>
                                </div>
                                <div class="mb-2">
                                    <div id="new_berkas_transkrip" class="hidden">
                                        <label class="mb-2 ml-1 font-bold text-size-xs text-slate-700" for="berkas">Berkas Transkrip :</label>
                                        <input type="file" id="berkas" name="berkas_transkrip" class="focus:shadow-primary-outline dark:bg-gray-950 dark:placeholder:text-white/80 dark:text-white/80 text-size-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-300 focus:outline-none" />
                                        <p class="text-red-700 font-light text-size-xs">
                                            berkas transkrip wajib .pdf maksimal 2MB
                                        </p>
                                    </div>
                                    <div id="old_berkas_transkrip" class="hidden"></div>
                                </div> 
                                <div class="grid md:grid-cols-2 gap-2 hidden" id="jumlah_berkas_transkrip">
                                    <div>
                                        <input type="number" name="jumlah_transkrip" min="1" max="10" onkeypress="return event.charCode >= 48 && event.charCode <=57" id="jumlah_transkrip" placeholder="Masukkan Jumlah Berkas Transkrip" class="focus:shadow-primary-outline dark:bg-gray-950 dark:placeholder:text-white/80 dark:text-white/80 text-size-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-300 focus:outline-none" />
                                    </div>
                                    <div>
                                        <input type="text" id="biaya_transkrip" placeholder="Biaya" name="biaya_transkrip" class="focus:shadow-primary-outline dark:bg-gray-950 dark:placeholder:text-white/80 dark:text-white/80 text-size-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-300 focus:outline-none" readonly />
                                    </div>
                                </div>
                                
                                <!-- Akreditasi -->
                                <div class="mt-4 mb-2 flex justify-between items-center hidden" id="radio_berkas_akreditasi">
                                    <label class="font-bold text-size-xs text-slate-700" for="berkas">Berkas Akreditasi :</label>
                                    <div class="mb-2 pl-8">
                                        <input id="radio_newberkas_akreditasi" value="1" name="radio_berkas_akreditasi" class="w-5-em h-5-em ease text-base -ml-7-em rounded-1.4 relative float-left mt-1 cursor-pointer border border-solid border-slate-150 bg-white bg-contain bg-center bg-no-repeat align-top transition-all after:absolute after:flex after:h-full after:w-full after:items-center after:justify-center " type="radio" />
                                        <label for="radio_newberkas_akreditasi" class="text-size-xs cursor-pointer select-none text-slate-700">Upload Berkas Akreditasi Baru</label>
                                    </div>
                                    <div class="mb-2 pl-8">
                                        <input id="radio_oldberkas_akreditasi" value="2" name="radio_berkas_akreditasi" class="w-5-em h-5-em ease text-base -ml-7-em rounded-1.4 relative float-left mt-1 cursor-pointer border border-solid border-slate-150 bg-white bg-contain bg-center bg-no-repeat align-top transition-all after:absolute after:flex after:h-full after:w-full after:items-center after:justify-center " type="radio" />
                                        <label for="radio_oldberkas_akreditasi" class="text-size-xs cursor-pointer select-none text-slate-700">Gunakan Berkas Akreditasi Lama</label>
                                    </div>
                                </div>
                                <div class="mb-2">
                                    <div id="new_berkas_akreditasi" class="hidden">
                                        <label class="mb-2 ml-1 font-bold text-size-xs text-slate-700" for="berkas">Berkas Akreditasi :</label>
                                        <input type="file" id="berkas" name="berkas_akreditasi" class="focus:shadow-primary-outline dark:bg-gray-950 dark:placeholder:text-white/80 dark:text-white/80 text-size-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-300 focus:outline-none" />
                                        <p class="text-red-700 font-light text-size-xs">
                                            berkas akreditasi wajib .pdf maksimal 2MB
                                        </p>
                                    </div>
                                    <div id="old_berkas_akreditasi" class="hidden"></div>
                                </div> 
                                <div class="grid md:grid-cols-2 gap-2 hidden" id="jumlah_berkas_akreditasi">
                                    <div>
                                        <input type="number" name="jumlah_akreditasi" min="1" max="10" onkeypress="return event.charCode >= 48 && event.charCode <=57" id="jumlah_akreditasi" placeholder="Masukkan Jumlah Berkas Akreditasi" class="focus:shadow-primary-outline dark:bg-gray-950 dark:placeholder:text-white/80 dark:text-white/80 text-size-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-300 focus:outline-none" />
                                    </div>
                                    <div>
                                        <input type="text" placeholder="Biaya" id="biaya_akreditasi" name="biaya_akreditasi" class="focus:shadow-primary-outline dark:bg-gray-950 dark:placeholder:text-white/80 dark:text-white/80 text-size-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-300 focus:outline-none" readonly />
                                    </div>
                                </div>



                                <div class="mt-4 mb-2">
                                    <div class="mt-2 ml-1 font-bold text-size-xs text-slate-700">Metode Pengambilan</div>
                                    <div class=" mb-2 pl-8">
                                        <input id="metode1" value="1" name="metode_pengambilan" class="w-5-em h-5-em ease text-base -ml-7-em rounded-1.4  checked:bg-gradient-to-tl checked:from-blue-500 checked:to-violet-500 after:text-size-fa-check after:font-awesome after:duration-250 after:ease-in-out duration-250 relative float-left mt-1 cursor-pointer appearance-none border border-solid border-slate-150 bg-white bg-contain bg-center bg-no-repeat align-top transition-all after:absolute after:flex after:h-full after:w-full after:items-center after:justify-center after:text-white after:opacity-0 after:transition-all after:content-['\f00c'] checked:border-0 checked:border-transparent checked:bg-transparent checked:after:opacity-100" type="radio" />
                                        <label for="metode1" class="text-size-xs cursor-pointer select-none text-slate-700">TTD Basah, Berkas ambil di fakultas</label>
                                    </div>
                                    <div class="mb-2 pl-8">
                                        <input id="metode2" value="2" name="metode_pengambilan" class="w-5-em h-5-em ease text-base -ml-7-em rounded-1.4  checked:bg-gradient-to-tl checked:from-blue-500 checked:to-violet-500 after:text-size-fa-check after:font-awesome after:duration-250 after:ease-in-out duration-250 relative float-left mt-1 cursor-pointer appearance-none border border-solid border-slate-150 bg-white bg-contain bg-center bg-no-repeat align-top transition-all after:absolute after:flex after:h-full after:w-full after:items-center after:justify-center after:text-white after:opacity-0 after:transition-all after:content-['\f00c'] checked:border-0 checked:border-transparent checked:bg-transparent checked:after:opacity-100" type="radio" />
                                        <label for="metode2" class="text-size-xs cursor-pointer select-none text-slate-700">TTD Basah, Berkas dikirim ke alamat</label>
                                    </div>
                                </div>
                                <div id="alamat" class="mb-2 hidden">
                                    <label class="mb-2 ml-1 font-bold text-size-xs text-slate-700" for="alamat">Alamat Pengiriman</label>
                                    <textarea name="alamat" class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded-lg transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" id="catatan" rows="3" placeholder="Masukkan Alamat"></textarea>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="inline-block w-full px-16 py-3.5 mt-6 mb-0 font-bold leading-normal text-center text-white align-middle transition-all bg-blue-500 border-0 rounded-lg cursor-pointer hover:-translate-y-px active:opacity-85 hover:shadow-xs text-size-sm ease-in tracking-tight-rem shadow-md bg-150 bg-x-25">Kirim</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('assets-js') ?>
<script>
    var session_nim = '<?= session('nim') ?>'
    var base_url = '<?= base_url() ?>'
</script>
<script src="<?= base_url('js/script.js'); ?>"></script>
<?= $this->endSection() ?>