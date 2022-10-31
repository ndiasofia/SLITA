<?= $this->extend('layouts/app-layout') ?>

<?= $this->section('page-assets') ?>

<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="relative flex flex-col flex-auto min-w-0 p-4 mx-6 overflow-hidden break-words bg-white border-0 dark:bg-slate-850 dark:shadow-dark-xl shadow-3xl rounded-2xl bg-clip-border">
  <div class="flex flex-wrap -mx-3">
    <div class="flex-none w-auto max-w-full px-3">
      <div class="relative inline-flex items-center justify-center text-white transition-all duration-200 ease-in-out text-size-base h-19 w-19 rounded-xl">
        <img src="<?= base_url($pengguna['foto'] ? 'foto/' . $pengguna['foto'] : 'img/team-3.jpg') ?>" alt="profile_image" class="w-full shadow-2xl rounded-xl" />
      </div>
    </div>
    <div class="flex-none w-auto max-w-full px-3 my-auto">
      <div class="h-full">
        <h5 class="mb-1 dark:text-white"><?= session('nama') ?></h5>
        <p class="mb-0 font-semibold leading-normal dark:text-white dark:opacity-60 text-size-sm"><?= session('nim') ?></p>
      </div>
    </div>
    <div class="w-full max-w-full px-3 mx-auto mt-4 sm:my-auto sm:mr-0 md:w-1/2 md:flex-none lg:w-4/12">
      <div class="relative right-0">
        <ul class="relative flex flex-wrap p-1 list-none rounded-xl" nav-pills role="tablist">
          <form id="form-upload-foto" action="<?= base_url('beranda/upload_foto') ?>" method="POST" enctype="multipart/form-data">
            <input type="file" class="hidden" name="foto" id="foto">
          </form>
          <label for="foto" class="btn inline-block px-8 py-2 mb-4 ml-auto font-bold leading-normal text-center text-white align-middle transition-all ease-in bg-blue-500 border-0 rounded-lg shadow-md cursor-pointer text-size-xs tracking-tight-rem hover:shadow-xs hover:-translate-y-px active:opacity-85">Ganti Foto</label>
        </ul>
      </div>
    </div>
  </div>
</div>
<div class="w-full p-6 mx-auto">
  <div class="flex flex-wrap -mx-3">
    <div class="w-full max-w-full px-3 shrink-0  md:flex-0">
      <div class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
        <div class="border-black/12.5 rounded-t-2xl border-b-0 border-solid p-6 pb-0">
          <div class="flex items-center justify-between">
            <p class="mb-0 dark:text-white/80">Edit Profile</p>
          </div>
        </div>
        <form role="form" id="form-update-profil" method="POST" action="<?= base_url('beranda/update_profil') ?>">
        <div class="flex-auto p-6">
          <div class="grid gap-2 md:grid-cols-2">
            <div class="mb-4">
              <label for="username" class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700 dark:text-white/80">Nama</label>
              <input type="text" name="username" value="<?= $pengguna['nama'] ?>" readonly class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-size-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" />
            </div>
            <div class="mb-4">
              <label for="jurusan" class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700 dark:text-white/80">Jurusan</label>
              <input type="text" name="jurusan" value="<?= $pengguna['jurusan'] ?>" readonly class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-size-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" />
            </div>
            <div class="mb-4">
              <label for="no_ijazah" class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700 dark:text-white/80">No Ijazah</label>
              <input type="text" name="no_ijazah" value="<?= $pengguna['no_ijazah'] ?>" readonly class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-size-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" />
            </div>

            <div class="mb-4">
              <label for="tanggal_lulus" class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700 dark:text-white/80">Tanggal Lulus</label>
              <input type="date" name="tanggal_lulus" value="<?= $pengguna['tanggal_lulus'] ?>" readonly class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-size-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" />
            </div>

            <div class="mb-4">
              <label for="ipk" class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700 dark:text-white/80">IPK</label>
              <input type="text" name="ipk" value="<?= $pengguna['ipk'] ?>" readonly class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-size-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" />
            </div>

            <div class="mb-4">
              <label for="email" class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700 dark:text-white/80">Email</label>
              <input type="email" name="email" value="<?= $pengguna['email'] ?>" class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-size-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" />
            </div>

            <div class="mb-4">
              <label for="nohp" class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700 dark:text-white/80">No HP</label>
              <input type="text" maxlength="12" minlength="11" onkeypress="return Angkasaja(event)" name="nohp" value="<?= $pengguna['nohp'] ?>" class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-size-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" />
            </div>

            <div class="mb-4">
              <label for="alamat" class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700 dark:text-white/80">Alamat</label>
              <input type="text" name="alamat" value="<?= $pengguna['alamat'] ?>" class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-size-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" />
            </div>
          </div>
          <div class="text-center p-4">
            <button type="submit" class="inline-block px-8 py-2 mb-4 ml-auto font-bold leading-normal text-center text-white align-middle transition-all ease-in bg-blue-500 border-0 rounded-lg shadow-md cursor-pointer text-size-s tracking-tight-rem hover:shadow-xs hover:-translate-y-px active:opacity-85">Simpan</button>
          </div>
        </div>
      </div>
      </form>
    </div>
  </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('assets-js') ?>
<script>
  $('#foto').on('change', function() {
    $('#form-upload-foto').submit()
  })

  function Angkasaja(evt) {
      var charCode = (evt.which) ? evt.which : event.keyCode
      if (charCode > 31 && (charCode < 48 || charCode > 57))
      return false;
      return true;
  }

  initFormAjax('#form-upload-foto', {
    success: function(response) {
      toastr.success(response.message)
      setTimeout(function() {
        location.href = `${BASE_URL}/beranda`
      }, 1500);
    },
    error: function(xhr) {
      const response = xhr.responseJSON
      toastr.error(response.message)
    }
  })

  initFormAjax('#form-update-profil', {
    success: function(response) {
      toastr.success(response.message)
      setTimeout(function() {
        location.href = `${BASE_URL}/beranda`
      }, 1500);
    },
    error: function(xhr) {
      const response = xhr.responseJSON
      toastr.error(response.message)
    }
  })

  $(document).on('click', '#modal_ubah_password', function() {
    $.ajax({
      url: `${BASE_URL}/beranda/modal_ubah_password`,
      success: function(response) {
        $('#sidebar').removeClass('z-990')
        $('#modal-global.modal .modal-content .modal-box').html(response.html)
        $('#modal-global').css('display', 'block')
      }
    })
  })

  initFormAjax('#form-update-password', {
    beforeSend: function() {
      spinner.spin($('#spinner')[0])
    },
    success: function(response) {
      spinner.stop()
      toastr.success(response.message)
      $('#modal-global').css('display', 'none')
    },
    error: function(xhr) {
      spinner.stop()
      const response = xhr.responseJSON
      toastr.error(response.message)
    }
  })
</script>
<?= $this->endSection() ?>