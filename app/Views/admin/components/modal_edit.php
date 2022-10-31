<div class="p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
    <h6 class="dark:text-white">Edit Pengajuan Legalisir</h6>
</div>
<div class="flex flex-wrap -mx-3 justify-center">
    <div class="bg-white border-0 shadow-soft-xl rounded-2xl bg-clip-border flex flex-col w-full max-w-full px-3 mx-auto lg:mx-0 shrink-0 md:flex-0 md:w-7/12 lg:w-5/12 xl:w-8/12">
        <div class="relative flex flex-col min-w-0 break-words bg-transparent border-0 shadow-none lg:py4 dark:bg-gray-950 rounded-2xl bg-clip-border">
            <div class="flex-auto px-6 mb-10">
                <form role="form" id="form-edit-legalisir" enctype="multipart/form-data" method="POST" action="<?= base_url("legalisir/update/" . $data['kode_pengajuan']) ?>">
                    <div class="mb-2">
                        <label class="mb-2 ml-1 font-bold text-size-xs text-slate-700" for="status">Status Pengajuan</label>
                        <select name="status" id="status" class="form-select focus:shadow-primary-outline dark:bg-gray-950 dark:placeholder:text-white/80 dark:text-white/80 text-size-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-300 focus:outline-none">
                            <option value="" disabled selected>Pilih Status</option>
                            <!-- looping data status -->
                            <?php for ($i = 0; $i < count($status); $i++) { ?>
                                <option value="<?= $status[$i]['id'] ?>" <?= $status[$i]['id'] == $data['status_id'] ? 'selected' : '' ?>><?= $status[$i]['nama_status'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="mt-4 mb-2">
                        <div>
                            <label class="mb-2 ml-1 font-bold text-size-xs text-slate-700" for="note">Catatan</label>
                            <input type="text" name="note" id="note" placeholder="Masukkan Catatan" value="<?= $data['note'] ?>" class="focus:shadow-primary-outline dark:bg-gray-950 dark:placeholder:text-white/80 dark:text-white/80 text-size-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-300 focus:outline-none" />
                        </div>

                        <?php if ($data['metode_pengambilan_id'] == 2) : ?>
                            <div class="mb-2">
                                <label class="mb-2 ml-1 font-bold text-size-xs text-slate-700" for="ekspedisi">Ekspedisi</label>
                                <select name="ekspedisi" id="ekspedisi" class="form-select focus:shadow-primary-outline dark:bg-gray-950 dark:placeholder:text-white/80 dark:text-white/80 text-size-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-300 focus:outline-none">
                                    <option value="" disabled selected>Pilih Ekspedisi</option>
                                    <!-- looping data ekspedisi -->
                                    <?php for ($i = 0; $i < count($ekspedisi); $i++) { ?>
                                        <option value="<?= $ekspedisi[$i]['id'] ?>" <?= $ekspedisi[$i]['id'] == $data['ekspedisi_id'] ? 'selected' : '' ?>><?= $ekspedisi[$i]['nama_ekspedisi'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div>
                                <label class="mb-2 ml-1 font-bold text-size-xs text-slate-700" for="no_resi">Nomor Resi</label>
                                <input type="text" id="no_resi" name="no_resi" placeholder="Masukkan Nomor Resi" value="<?= $data['no_resi'] ?>" class="focus:shadow-primary-outline dark:bg-gray-950 dark:placeholder:text-white/80 dark:text-white/80 text-size-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-300 focus:outline-none" />
                            </div>
                        <?php endif ?>
                        <input type="hidden" value="<?= $data['email'] ?>" name="email">
                    </div>
                    <div class="text-center">
                        <button type="submit" class="inline-block w-full px-16 py-3.5 mt-6 mb-0 font-bold leading-normal text-center text-white align-middle transition-all bg-blue-500 border-0 rounded-lg cursor-pointer hover:-translate-y-px active:opacity-85 hover:shadow-xs text-size-sm ease-in tracking-tight-rem shadow-md bg-150 bg-x-25">Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $('#status, #ekspedisi').select2({
        width: '100%'
    })
</script>