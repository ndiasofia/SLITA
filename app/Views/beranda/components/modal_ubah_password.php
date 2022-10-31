<div class="p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
    <h6 class="dark:text-white">Ubah Password</h6>
</div>
<div class="flex flex-wrap -mx-3 justify-center">
    <div class="bg-white border-0 shadow-soft-xl rounded-2xl bg-clip-border flex flex-col w-full max-w-full px-3 mx-auto lg:mx-0 shrink-0 md:flex-0 md:w-7/12 lg:w-5/12 xl:w-8/12">
        <div class="relative flex flex-col min-w-0 break-words bg-transparent border-0 shadow-none lg:py4 dark:bg-gray-950 rounded-2xl bg-clip-border">
            <div class="flex-auto px-6 mb-10">
                <form role="form" id="form-update-password" enctype="multipart/form-data" method="POST" action="<?= base_url("beranda/update_password") ?>">
                    <div class="mt-4 mb-2">
                        <div>
                            <label class="mb-2 ml-1 font-bold text-size-xs text-slate-700" for="password">Password Baru</label>
                            <input type="password" name="password" id="password" placeholder="Masukkan Password" placeholder="Masukkan Password Baru" class="focus:shadow-primary-outline dark:bg-gray-950 dark:placeholder:text-white/80 dark:text-white/80 text-size-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-300 focus:outline-none" />
                        </div> 
                        <div>
                            <label class="mb-2 ml-1 font-bold text-size-xs text-slate-700" for="konfirmasi">Konfirmasi Password</label>
                            <input type="password" name="konfirmasi" id="konfirmasi" placeholder="Konfirmasi Password" placeholder="Masukkan Konfirmasi Password Baru" class="focus:shadow-primary-outline dark:bg-gray-950 dark:placeholder:text-white/80 dark:text-white/80 text-size-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-300 focus:outline-none" />
                        </div>    
                    </div>
                    
                    <div class="text-center">
                        <button type="submit" class="inline-block w-full px-16 py-3.5 mt-6 mb-0 font-bold leading-normal text-center text-white align-middle transition-all bg-blue-500 border-0 rounded-lg cursor-pointer hover:-translate-y-px active:opacity-85 hover:shadow-xs text-size-sm ease-in tracking-tight-rem shadow-md bg-150 bg-x-25">Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>