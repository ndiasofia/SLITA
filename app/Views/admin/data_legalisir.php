<?= $this->extend('layouts/admin-layout') ?>

<?= $this->section('assets-css') ?>
<link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet">
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<?= $this->endSection() ?>

<?= $this->section('breadcrumb') ?>
<h6 class="mb-0 font-bold text-white capitalize">Data Legalisir</h6>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="flex flex-wrap -mx-3">
  <div class="flex-none w-full max-w-full px-3">
    <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
      <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
        <h6 class="dark:text-white">Riwayat Pengajuan Legalisir</h6>
      </div>
      <div class="relative p-4 m-6 rounded-lg bg-transparent border border-slate-800">
        <div class="font-bold">Informasi</div>
        <p class="text-size-sm">Berkas dapat diunduh pada icon kuning dikolom Opsi
          <br>
          <b>PENTING :
            <br> Pada kolom Opsi terdapat icon berwarna biru, jika icon tersebut di klik maka akan mengunduh struk bukti pembayaran.
            <br> Apabila Status "Menunggu Pembayaran", maka bukti pembayaran belum dikirimkan </b>
        </p>
      </div>
      <div class="flex-auto px-0 pt-0 pb-2">
        <div class="p-6 overflow-x-auto my-6">
          <table id="table" class="stripe hover text-center text-size-sm" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
            <thead>
              <tr>
                <th>Kode Pengajuan</th>
                <th>Nama</th>
                <th>Jenis Berkas</th>
                <th>Status</th>
                <th>Tanggal</th>
                <th>Opsi</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('assets-js') ?>
<script>
  const table = $('#table').DataTable({
    processing: false,
    serverSide: true,
    responsive: true,
    "oLanguage": {
      "sUrl": "//cdn.datatables.net/plug-ins/1.12.1/i18n/id.json"
    },
    ajax: `${BASE_URL}/legalisir/datatable`,
    order: [
      [3, 'desc']
    ],
    columns: [{
        data: 'kode_pengajuan',
        render: function(data) {
          return `${data}`
        }
      },
      {
        data: 'nama',
        render: function(data, _, row) {
          return `${data}`
        }
      },
      {
        data: 'keterangan_berkas',
        render: function(data, _, row) {
          return `${data}`
        }
      },
      {
        data: 'nama_status',
        render: function(data, _, row) {
          var bg_status;
          if (row.status_id == 1) {
            bg_status = 'bg-blue-500'
          } else if (row.status_id == 2) {
            bg_status = 'bg-gray-500'
          } else if (row.status_id == 3) {
            bg_status = 'bg-red-500'
          } else if (row.status_id == 4) {
            bg_status = 'bg-yellow-500'
          } else if (row.status_id == 5) {
            bg_status = 'bg-green-500'
          } else if (row.status_id == 6) {
            bg_status = 'bg-black'
          }
          return `<div  class="${bg_status} inline-block px-6 py-3 mr-3 font-bold text-center text-white uppercase align-middle transition-all  rounded-lg cursor-pointer leading-normal text-size-xs ease-in tracking-tight-rem shadow-xs bg-150 bg-x-25">${data}</div>`
        }
      },
      {
        data: 'created_at',
        render: function(data) {
          return `${formatDate(data)}`
        }
      },
      {
        data: 'kode_pengajuan',
        searchable: false,
        orderable: false,
        width: '25%',
        render: function(data, _, row) {

          if (row.status_id == 1) {
            return `
                  <div class="flex gap-2 justify-center">
                    <button data-reference="${data}" data-tippy-content="Detail Pengajuan" class="btn-detail-pengajuan-modal inline-block px-2 py-2 mr-3 font-bold text-center text-white uppercase align-middle transition-all bg-emerald-500 rounded-full cursor-pointer leading-normal text-size-xs ease-in tracking-tight-rem shadow-xs bg-150 bg-x-25 hover:-translate-y-px active:opacity-85 hover:shadow-md">
                      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                      </svg>
                    </button>
                      <button data-reference="${row.nama_file}" data-tippy-content="Download Berkas" class="btn-download-berkas inline-block px-2 py-2 mr-3 font-bold text-center text-white uppercase align-middle transition-all bg-yellow-500 rounded-full cursor-pointer leading-normal text-size-xs ease-in tracking-tight-rem shadow-xs bg-150 bg-x-25 hover:-translate-y-px active:opacity-85 hover:shadow-md">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                        </svg>
                      </button>
                    <button data-reference="${data}" data-tippy-content="Edit Pengajuan" class="btn-edit-pengajuan-modal inline-block px-2 py-2 mr-3 font-bold text-center text-white uppercase align-middle transition-all bg-red-500 rounded-full cursor-pointer leading-normal text-size-xs ease-in tracking-tight-rem shadow-xs bg-150 bg-x-25 hover:-translate-y-px active:opacity-85 hover:shadow-md">
                      <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                      </svg>
                    </button>
                  </div>
                    `
          } else {
            return `
                  <div class="flex gap-2 justify-center">
                    <button data-reference="${data}" data-tippy-content="Detail Pengajuan" class="btn-detail-pengajuan-modal inline-block px-2 py-2 mr-3 font-bold text-center text-white uppercase align-middle transition-all bg-emerald-500 rounded-full cursor-pointer leading-normal text-size-xs ease-in tracking-tight-rem shadow-xs bg-150 bg-x-25 hover:-translate-y-px active:opacity-85 hover:shadow-md">
                      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                      </svg>
                    </button>
                      <button data-reference="${data}" data-tippy-content="Download Berkas" class="btn-download-berkas inline-block px-2 py-2 mr-3 font-bold text-center text-white uppercase align-middle transition-all bg-yellow-500 rounded-full cursor-pointer leading-normal text-size-xs ease-in tracking-tight-rem shadow-xs bg-150 bg-x-25 hover:-translate-y-px active:opacity-85 hover:shadow-md">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                        </svg>
                      </button>
                      <button data-reference="${row.nama_bukti_pembayaran}" data-tippy-content="Download Bukti Pembayaran" class="btn-download-bukti-pembayaran inline-block px-2 py-2 mr-3 font-bold text-center text-white uppercase align-middle transition-all bg-blue-500 rounded-full cursor-pointer leading-normal text-size-xs ease-in tracking-tight-rem shadow-xs bg-150 bg-x-25 hover:-translate-y-px active:opacity-85 hover:shadow-md">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                          <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"></path>
                          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd"></path>
                        </svg>
                      </button>
                    <button data-reference="${data}" data-tippy-content="Edit Pengajuan" class="btn-edit-pengajuan-modal inline-block px-2 py-2 mr-3 font-bold text-center text-white uppercase align-middle transition-all bg-red-500 rounded-full cursor-pointer leading-normal text-size-xs ease-in tracking-tight-rem shadow-xs bg-150 bg-x-25 hover:-translate-y-px active:opacity-85 hover:shadow-md">
                      <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                      </svg>
                    </button>
                  </div>
                    `
          }
        }
      }
    ],
    drawCallback: function() {
      tippy('[data-tippy-content]', {
        arrow: false
      })
    }
  });

  $(document).on('click', '.btn-detail-pengajuan-modal', function() {
    const ref = $(this).data('reference')
    $.ajax({
      url: `${BASE_URL}/legalisir/modal_detail/${ref}`,
      success: function(response) {
        $('#sidebar').removeClass('z-990')
        $('#modal-global.modal .modal-content .modal-box').html(response.html)
        $('#modal-global').css('display', 'block')
      }
    })
  })

  $(document).on('click', '.btn-download-berkas', function() {
    const ref = $(this).data('reference')
    $.ajax({
      url: `${BASE_URL}/legalisir/modal_download_berkas/${ref}`,
      success: function(response) {
        // console.log(response)
        $('#sidebar').removeClass('z-990')
        $('#modal-global.modal .modal-content .modal-box').html(response.html)
        $('#modal-global').css('display', 'block')
      }
    })
  })

  $(document).on('click', '.btn-download-bukti-pembayaran', function() {
    const ref = $(this).data('reference')
    open(`${BASE_URL}/bukti_pembayaran/${ref}`)
  })

  $(document).on('click', '.btn-edit-pengajuan-modal', function() {
    const ref = $(this).data('reference')
    $.ajax({
      url: `${BASE_URL}/legalisir/modal_edit/${ref}`,
      success: function(response) {
        $('#sidebar').removeClass('z-990')
        $('#modal-global.modal .modal-content .modal-box').html(response.html)
        $('#modal-global').css('display', 'block')
      }
    })
  })

  initFormAjax('#form-edit-legalisir', {
    beforeSend: function() {
      spinner.spin($('#spinner')[0])
    },
    success: function(response) {
      spinner.stop()
      toastr.success(response.message)
      $('#modal-global').css('display', 'none')
      table.draw()
    },
    error: function(xhr) {
      const response = xhr.responseJSON
      toastr.error(response.message)
    }
  })
</script>
<?= $this->endSection() ?>