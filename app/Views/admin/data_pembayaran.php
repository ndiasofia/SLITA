<?= $this->extend('layouts/admin-layout') ?>

<?= $this->section('assets-css') ?>
<link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet">
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="flex flex-wrap -mx-3">
  <div class="flex-none w-full max-w-full px-3">
    <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
      <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
        <h6 class="dark:text-white">Data Pembayaran</h6>
      </div>

      <div class="flex flex-wrap -mx-3 justify-end">
        <div class="w-full mx-4 max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
          <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <div class="flex-auto p-4">
              <div class="flex flex-row -mx-4">
                <div class="flex-none w-2/3 max-w-full px-3">
                  <div>
                    <p class="mb-0 font-sans font-semibold leading-normal uppercase text-size-sm">Total Tagihan</p>
                    <h5 class="mb-2 font-bold dark:text-white"><?php echo $jumlah ?></h5>
                  </div>
                </div>
                <div class="px-3 text-right basis-1/3">
                  <div class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-blue-500 to-violet-500">
                    <i class="fa fa-coins text-size-lg relative top-3.5 text-white"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="w-full mx-4 max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
          <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <div class="flex-auto p-4">
              <div class="flex flex-row -mx-3">
                <div class="flex-none w-2/3 max-w-full px-3">
                  <div>
                    <p class="mb-0 font-sans font-semibold leading-normal uppercase text-size-sm">Total Pembayaran</p>
                    <h5 class="mb-2 font-bold dark:text-white"><?php echo $total ?></h5>
                  </div>
                </div>
                <div class="px-3 text-right basis-1/3">
                  <div class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-emerald-500 to-teal-500">
                    <i class="fa fa-coins text-size-lg relative top-3.5 text-white"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="w-full mx-4 max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
          <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <div class="flex-auto p-4">
              <div class="flex flex-row -mx-3">
                <div class="flex-none w-2/3 max-w-full px-3">
                  <div>
                    <p class="mb-0 font-sans font-semibold leading-normal uppercase text-size-sm">Estimasi Biaya</p>
                    <h5 class="mb-2 font-bold dark:text-white"><?php echo $estimasi ?></h5>
                  </div>
                </div>
                <div class="px-3 text-right basis-1/3">
                  <div class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-cyan-500 to-blue-500">
                    <i class="fa fa-coins text-size-lg relative top-3.5 text-white"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="p-6 overflow-x-auto my-0 ml-4">
        <button class=" float-left bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg">
          <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
            <path d="M13 8V2H7v6H2l8 8 8-8h-5zM0 18h20v2H0v-2z" />
          </svg>
          <a href="<?= base_url('/excel') ?>"><span>Excel</span></a>
        </button>
      </div>

      <div class="flex-auto px-0 pt-0 pb-2">
        <div class="p-6 overflow-x-auto my-0">
          <table id="table" class="stripe hover text-center text-size-sm" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
            <thead>
              <tr>
                <th>Id Pembayaran</th>
                <th>Nomor Pembayaran</th>
                <th>Nama</th>
                <th>Biaya</th>
                <th>Tanggal Tagihan</th>
                <th>Status</th>
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
    ajax: `${BASE_URL}/pembayaran/datatable`,
    order: [
      [1, 'desc']
    ],
    columns: [{
        data: 'idPembayaran',
        render: function(data, _, row) {
          return `${data}`
        }
      },
      {
        data: 'nim',
        render: function(data) {
          return `${data}`
        }
      },
      {
        data: 'nama',
        render: function(data) {
          return `${data}`
        }
      },
      {
        data: 'biaya',
        render: function(data) {
          return `${rupiah(data)}`
        }
      },
      {
        data: 'created_at',
        render: function(data) {
          return `${formatDate(data)}`
        }
      },
      {
        data: 'status_pembayaran',
        render: function(data, _, row) {
          var status = data == 1 ? 'Sudah Bayar' : 'Belum Bayar'
          var bg_status = data == 1 ? 'bg-green-500' : 'bg-blue-500'
          return `<div class="${bg_status} inline-block px-6 py-3 mr-3 font-bold text-center text-white uppercase align-middle transition-all  rounded-lg cursor-pointer leading-normal text-size-xs ease-in tracking-tight-rem shadow-xs bg-150 bg-x-25">${status}</div>`
        }
      },
    ],
    drawCallback: function() {
      tippy('[data-tippy-content]', {
        arrow: false
      })
    }
  });
</script>
<?= $this->endSection() ?>