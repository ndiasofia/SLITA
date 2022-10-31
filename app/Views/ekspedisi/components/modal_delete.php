<div class="p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
    <h6 class="dark:text-white">Apakah Anda Yakin Menghapus Ekspedisi Ini ?</h6>
</div>
<div class="flex flex-wrap -mx-3 justify-center">
    <div class="bg-white border-0 shadow-soft-xl rounded-2xl bg-clip-border flex flex-col w-full max-w-full px-3 mx-auto lg:mx-0 shrink-0 md:flex-0 md:w-7/12 lg:w-5/12 xl:w-8/12">
        <div class="relative flex flex-col min-w-0 break-words bg-transparent border-0 shadow-none lg:py4 dark:bg-gray-950 rounded-2xl bg-clip-border">
            <div class="flex-auto px-6 mb-10">
                <form role="form" id="form-delete-ekspedisi" enctype="multipart/form-data" method="POST" action="<?= base_url("ekspedisi/delete/" . $id) ?>">
                    <div class="text-center">
                        <button type="submit" class="inline-block w-full px-6 py-3.5 mt-6 mb-0 font-bold leading-normal text-center text-white align-middle transition-all bg-blue-500 border-0 rounded-lg cursor-pointer hover:-translate-y-px active:opacity-85 hover:shadow-xs text-size-sm ease-in tracking-tight-rem shadow-md bg-150 bg-x-25">YAKIN</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>