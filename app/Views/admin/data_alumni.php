<?= $this->extend('layouts/admin-layout') ?>

<?= $this->section('assets-css') ?>
<link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet">
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<?= $this->endSection() ?>

<?= $this->section('breadcrumb') ?>
<h6 class="mb-0 font-bold text-white capitalize">Data Alumni</h6>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="flex flex-wrap -mx-3">
  <div class="flex-none w-full max-w-full px-3">
    <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
      <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
        <h6 class="dark:text-white">Data Alumni</h6>
      </div>
      <div class="flex-auto px-0 pt-0 pb-2">
        <div class="p-6 overflow-x-auto my-6">
          <table id="table" class="stripe hover text-center text-size-sm" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
            <thead>
              <tr>
                <th>Nama</th>
                <th>NIM</th>
                <th>Email</th>
                <th>Nomor HP</th>
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
    ajax: `${BASE_URL}/alumni/datatable`,
    order: [
      [1, 'desc']
    ],
    columns: [{
        data: 'nama',
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
        data: 'email',
        render: function(data) {
          return `${data}`
        }
      },
      {
        data: 'nohp',
        render: function(data) {
          return `${data}`
        }
      },
      {
        data: 'nim',
        searchable: false,
        orderable: false,
        width: '25%',
        render: function(data, _, row) {
          return `
              <button data-reference="${data}" data-tippy-content="Detail Alumni" class="btn-detail-alumni-modal inline-block px-2 py-2 mr-3 font-bold text-center text-white uppercase align-middle transition-all bg-emerald-500 rounded-full cursor-pointer leading-normal text-size-xs ease-in tracking-tight-rem shadow-xs bg-150 bg-x-25 hover:-translate-y-px active:opacity-85 hover:shadow-md">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                  </svg>
              </button>
          `
        }
      }
    ],
    drawCallback: function() {
      tippy('[data-tippy-content]', {
        arrow: false
      })
    }
  });

  $(document).on('click', '.btn-detail-alumni-modal', function() {
    const ref = $(this).data('reference')
    $.ajax({
      url: `${BASE_URL}/alumni/modal_detail/${ref}`,
      success: function(response) {
        $('#sidebar').removeClass('z-990')
        $('#modal-global.modal .modal-content .modal-box').html(response.html)
        $('#modal-global').css('display', 'block')
      }
    })
  })
</script>
<?= $this->endSection() ?>