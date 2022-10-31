<?= $this->extend('layouts/auth-layout') ?>

<?= $this->section('page-assets') ?>

<?= $this->endSection() ?>

<?= $this->section('content') ?>
<main class="mt-0 transition-all duration-200 ease-in-out">
    <section>
        <div class="relative flex items-center min-h-screen p-0 overflow-hidden bg-center bg-cover">
            <div class="container z-1 ">
                <div class="flex flex-wrap -mx-3 justify-center">
                    <div class="bg-white border-0 shadow-soft-xl rounded-2xl bg-clip-border flex flex-col w-full max-w-full px-3 mx-auto lg:mx-0 shrink-0 md:flex-0 md:w-7/12 lg:w-5/12 xl:w-4/12">
                        <div class="relative flex flex-col min-w-0 break-words bg-transparent border-0 shadow-none lg:py4 dark:bg-gray-950 rounded-2xl bg-clip-border">
                            <div class="p-6 pb-0 mb-0 text-center content-center">
                                <img src="<?= base_url('img/logo_usk.png') ?>" alt="Logo USK" width="100" class="mx-auto">
                                <h4 class="mb-0 font-bold">Forgot Password</h4>
                            </div>
                            <div class="flex-auto p-6">
                                <form role="form" id="form-password" method="POST" action="<?= base_url('auth/reset_password') ?>" show-validation>
                                    <div class="mb-4">
                                        <label class="mb-2 ml-1 font-bold text-size-xs text-slate-700" for="username">Email</label>
                                        <input type="email" id="email" name="email" placeholder="Masukkan Email" class="focus:shadow-primary-outline dark:bg-gray-950 dark:placeholder:text-white/80 dark:text-white/80 text-size-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none" />
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="inline-block w-full px-16 py-3.5 mt-6 mb-0 font-bold leading-normal text-center text-white align-middle transition-all bg-blue-500 border-0 rounded-lg cursor-pointer hover:-translate-y-px active:opacity-85 hover:shadow-xs text-size-sm ease-in tracking-tight-rem shadow-md bg-150 bg-x-25">Reset Password</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<?= $this->endSection() ?>

<?= $this->section('assets-js') ?>
<script>
    initFormAjax('#form-password', {
        beforeSend: function() {
            spinner.spin($('#spinner')[0])
        },
        success: function(response) {
            spinner.stop()
            toastr.success(response.message)
            setTimeout(function() {
                location.href = `${BASE_URL}/masuk`
            }, 1500);
        },
        error: function(xhr) {
            const response = xhr.responseJSON
            spinner.stop()
            toastr.error(response.message)
        }
    })
</script>
<?= $this->endSection() ?>
