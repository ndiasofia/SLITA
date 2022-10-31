<?= $this->extend('layouts/admin-layout') ?>

<?= $this->section('assets-css') ?>
<link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet">
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="flex flex-wrap -mx-3">
    <div class="flex-none w-full max-w-full px-3">
        <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <h6 class="dark:text-white text-size-xl">Generate Token</h6>
            </div>
            <div class="flex flex-wrap -mx-3 justify-center">
                <div class="bg-white border-0 shadow-soft-xl rounded-2xl bg-clip-border flex flex-col w-full max-w-full px-3 mx-auto lg:mx-0 shrink-0 md:flex-0 md:w-7/12 lg:w-5/12 xl:w-8/12">
                    <div class="relative flex flex-col min-w-0 break-words bg-transparent border-0 shadow-none lg:py4 dark:bg-gray-950 rounded-2xl bg-clip-border">
                        <div class="relative p-4 m-6 mt-2 rounded-lg bg-transparent border border-slate-800">
                            <div class="font-bold">Informasi</div>
                            <p class="text-size-sm">Berikut adalah Halaman Generate Bearer Token untuk Webservis host-to-host.</p>
                        </div>
                        <div class="flex-auto px-6 mb-10">
                            <form role="form" id="form-generate-token" action="<?= base_url('tokenjwt') ?>" method="POST">
                                <div class="mb-2">
                                    <label class="mb-2 ml-1 font-bold text-size-xm text-slate-700" for="jumlah">Kode Bank</label>
                                    <input type="text" name="kodebank" id="kodebank" placeholder="Masukkan Kode Bank" class="focus:shadow-primary-outline dark:bg-gray-950 dark:placeholder:text-white/80 dark:text-white/80 text-size-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-300 focus:outline-none" />
                                </div>
                                <div class="mb-2">
                                    <label class="mb-2 ml-1 font-bold text-size-xm text-slate-700" for="jumlah">Nama Bank</label>
                                    <input type="text" name="namabank" id="namabank" placeholder="Masukkan Nama Bank" class="focus:shadow-primary-outline dark:bg-gray-950 dark:placeholder:text-white/80 dark:text-white/80 text-size-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-300 focus:outline-none" />
                                </div>
                                <div class="text-center">
                                    <button type="submit" form="form-generate-token" class="inline-block w-full px-16 py-3.5 mt-6 mb-0 font-bold leading-normal text-center text-white align-middle transition-all bg-blue-500 border-0 rounded-lg cursor-pointer hover:-translate-y-px active:opacity-85 hover:shadow-xs text-size-sm ease-in tracking-tight-rem shadow-md bg-150 bg-x-25">Kirim</button>
                                </div>
                                <div class="mb-2 mt-6">
                                    <div>
                                        <label class="mb-2 ml-1 font-bold text-size-xm text-slate-700" for="token">Hasil generate</label>
                                        <div class="copy-btn cursor-pointer float-right"><i class="fas fa-copy"></i></div>
                                    </div>
                                    <textarea type="text" name="token" id="token" class="focus:shadow-primary-outline dark:bg-gray-950 dark:placeholder:text-white/80 dark:text-white/80 text-size-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-300 focus:outline-none"></textarea>
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
    initFormAjax('#form-generate-token', {
        success: function(response) {
            toastr.success(response.message)
            $("#token").text(response.access_token);
        },
        error: function(xhr) {
            const response = xhr.responseJSON
            toastr.error(response.message)
        }
    });
</script>
<script type="text/javascript">
    const copyBtn = document.querySelector(".copy-btn");
    const textarea = document.querySelector("textarea");

    copyBtn.addEventListener("click", () => {
        textarea.select();
        document.execCommand("copy");
        copyBtn.innerHTML = "<i class='fas fa-check'></i>";
    });
</script>
<?= $this->endSection() ?>