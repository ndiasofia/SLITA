<?= $this->extend('layouts/admin-layout') ?>

<?= $this->section('assets-css') ?>
<link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet">
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<?= $this->endSection() ?>

<?= $this->section('breadcrumb') ?>
<h6 class="mb-0 font-bold text-white capitalize">Data Ekspedisi</h6>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="flex flex-wrap -mx-3">
    <div class="flex-none w-full max-w-full px-3">
        <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <h6 class="dark:text-white">Data Ekspedisi</h6>
            </div>
            <div class="flex-auto px-0 pt-0 pb-2">
                <div class="text-right">
                    <button class="btn-add-ekspedisi-modal inline-block px-6 py-3 mr-6 font-bold text-center text-white uppercase align-middle transition-all bg-blue-500 rounded-2xl cursor-pointer leading-normal text-size-sm ease-in tracking-tight-rem shadow-xs bg-150 bg-x-25 hover:-translate-y-px active:opacity-85 hover:shadow-md">Tambah Ekspedisi</button>
                </div>
                <div class="p-6 overflow-x-auto mb-6">
                    <table id="table" class="stripe hover text-center text-size-sm" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                        <thead>
                            <tr>
                                <th>Nama Ekspedisi</th>
                                <th>Kontak</th>
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
        ajax: `${BASE_URL}/ekspedisi/datatable`,
        order: [
            [0, 'desc']
        ],
        columns: [{
                data: 'nama_ekspedisi',
                render: function(data) {
                    return `${data}`
                }
            },
            {
                data: 'kontak_ekspedisi',
                render: function(data, _, row) {
                    return `${data}`
                }
            },
            {
                data: 'id',
                searchable: false,
                orderable: false,
                width: '25%',
                render: function(data, _, row) {
                    return `
                  <div class="flex gap-2 justify-center">
                    <button data-reference="${data}" data-tippy-content="Edit Ekspedisi" class="btn-edit-ekspedisi-modal inline-block px-2 py-2 mr-3 font-bold text-center text-white uppercase align-middle transition-all bg-yellow-500 rounded-full cursor-pointer leading-normal text-size-xs ease-in tracking-tight-rem shadow-xs bg-150 bg-x-25 hover:-translate-y-px active:opacity-85 hover:shadow-md">
                      <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                      </svg>
                    </button>
                    <button data-reference="${data}" data-tippy-content="Hapus Ekspedisi" class="btn-delete-ekspedisi-modal inline-block px-2 py-2 mr-3 font-bold text-center text-white uppercase align-middle transition-all bg-red-500 rounded-full cursor-pointer leading-normal text-size-xs ease-in tracking-tight-rem shadow-xs bg-150 bg-x-25 hover:-translate-y-px active:opacity-85 hover:shadow-md">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                    </button>
                  </div>
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

    $(document).on('click', '.btn-add-ekspedisi-modal', function() {

        $.ajax({
            url: `${BASE_URL}/ekspedisi/modal_create/`,
            success: function(response) {
                $('#sidebar').removeClass('z-990')
                $('#modal-global.modal .modal-content .modal-box').html(response.html)
                $('#modal-global').css('display', 'block')
            }
        })
    })

    $(document).on('click', '.btn-edit-ekspedisi-modal', function() {
        const ref = $(this).data('reference')
        $.ajax({
            url: `${BASE_URL}/ekspedisi/modal_update/${ref}`,
            success: function(response) {
                $('#sidebar').removeClass('z-990')
                $('#modal-global.modal .modal-content .modal-box').html(response.html)
                $('#modal-global').css('display', 'block')
            }
        })
    })

    $(document).on('click', '.btn-delete-ekspedisi-modal', function() {
        const ref = $(this).data('reference')
        $.ajax({
            url: `${BASE_URL}/ekspedisi/modal_delete/${ref}`,
            success: function(response) {
                $('#sidebar').removeClass('z-990')
                $('#modal-global.modal .modal-content .modal-box').html(response.html)
                $('#modal-global').css('display', 'block')
            }
        })
    })

    initFormAjax('#form-add-ekspedisi', {
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

    initFormAjax('#form-update-ekspedisi', {
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

    initFormAjax('#form-delete-ekspedisi', {
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