<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="apple-touch-icon" sizes="76x76" href="img/apple-icon.png" />
    <link rel="shortcut icon" href="<?= base_url('favicon.ico') ?>" type="image/x-icon" />
    <title>Sistem Legalisir Ijazah Dan Transkrip</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="<?= base_url('css/nucleo-icons.css') ?>" rel="stylesheet" />
    <link href="<?= base_url('css/nucleo-svg.css') ?>" rel="stylesheet" />
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <link rel="stylesheet" href="<?= base_url('css/app.css') ?>">
    <script src="<?= base_url('js/app.js') ?> "></script>
    <script>
        const BASE_URL = "<?= base_url() ?>"
    </script>

    <?= $this->renderSection('assets-css') ?>
    <style>
        .active {
            background-color: rgb(94 114 228 / 0.13);
            border-radius: 0.5rem;
            font-weight: 600;
            --tw-text-opacity: 1;
            color: rgb(52 71 103 / var(--tw-text-opacity));
        }

        .dataTables_wrapper select,
        .dataTables_wrapper .dataTables_filter input {
            color: #4a5568;
            padding-left: 1rem;
            padding-right: 1rem;
            padding-top: .5rem;
            padding-bottom: .5rem;
            line-height: 1.25;
            border-width: 2px;
            border-radius: .25rem;
            border-color: #edf2f7;
            background-color: #edf2f7;
            font-size: 0.875rem;
        }

        table.dataTable.hover tbody tr:hover,
        table.dataTable.display tbody tr:hover {
            background-color: #ebf4ff;
            font-size: 0.875rem;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            font-weight: 700;
            border-radius: .25rem;
            border: 1px solid transparent;
            font-size: 0.875rem;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            color: #fff !important;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .1), 0 1px 2px 0 rgba(0, 0, 0, .06);
            font-weight: 700;
            border-radius: .25rem;
            background: #667eea !important;
            border: 1px solid transparent;
            font-size: 0.875rem;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            color: #fff !important;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .1), 0 1px 2px 0 rgba(0, 0, 0, .06);
            font-weight: 700;
            border-radius: .25rem;
            background: #667eea !important;
            border: 1px solid transparent;
            font-size: 0.875rem;
        }

        table.dataTable.no-footer {
            border-bottom: 1px solid #e2e8f0;
            margin-top: 0.75em;
            margin-bottom: 0.75em;
            font-size: 0.875rem;
        }

        table.dataTable.dtr-inline.collapsed>tbody>tr>td:first-child:before,
        table.dataTable.dtr-inline.collapsed>tbody>tr>th:first-child:before {
            background-color: #667eea !important;
            font-size: 0.875rem;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            padding-top: 100px;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0, 0, 0);
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            border-radius: 20px;
            background-color: #fefefe;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;

        }

        .modal-close {
            color: #aaaaaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .modal-close:hover,
        .modal-close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>

<body class="m-0 font-sans antialiased font-normal dark:bg-slate-900 text-size-base leading-default bg-gray-50 text-slate-500">
    <div class="absolute w-full bg-blue-500 dark:hidden min-h-75"></div>
    <!-- sidenav  -->
    <aside id="sidebar" class="fixed inset-y-0 flex-wrap items-center justify-between block w-full p-0 my-4 overflow-y-auto antialiased transition-transform duration-200 -translate-x-full bg-white border-0 shadow-xl dark:shadow-none dark:bg-slate-850 max-w-64 ease-nav-brand z-990 xl:ml-6 rounded-2xl xl:left-0 xl:translate-x-0" aria-expanded="false">
        <div class="h-30">
            <i class="absolute top-0 right-0 p-4 opacity-50 cursor-pointer fas fa-times dark:text-white text-slate-400 xl:hidden" sidenav-close></i>
            <a class="block text-center pt-6 m-0 text-size-sm whitespace-nowrap dark:text-white text-slate-700" href="#">
                <img src="<?= base_url('img/logo-slit.png') ?>" alt="logo" width="120" class="mx-auto">
            </a>
        </div>

        <hr class="h-px mt-0 bg-transparent bg-gradient-to-r from-transparent via-black/40 to-transparent dark:bg-gradient-to-r dark:from-transparent dark:via-white dark:to-transparent" />

        <div class="items-center block w-auto max-h-screen overflow-auto h-sidenav grow basis-full">
            <ul class="flex flex-col pl-0 mb-0">
                <li class="mt-0.5 w-full">
                    <a class="<?= current_url() == base_url() . '/' || strpos(current_url(), 'alumni') ? 'active' : '' ?> dark:text-white dark:opacity-80 py-2.7 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors" href="<?= base_url('/alumni') ?>">
                        <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                            <i class="relative top-0 leading-normal text-blue-500 ni ni-tv-2 text-size-sm"></i>
                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Data Alumni</span>
                    </a>
                </li>

                <li class="mt-0.5 w-full">
                    <a class="<?= strpos(current_url(), 'legalisir') ? 'active' : '' ?> dark:text-white dark:opacity-80 py-2.7 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors" href="<?= base_url('/legalisir') ?>">
                        <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                            <i class="relative top-0 leading-normal text-orange-500 ni ni-email-83 text-size-sm"></i>
                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Data Legalisir</span>
                    </a>
                </li>

                <li class="mt-0.5 w-full <?= session('level') != 3 ? 'hidden' : '' ?>">
                    <a class="<?= strpos(current_url(), 'pembayaran') ? 'active' : '' ?> dark:text-white dark:opacity-80 py-2.7 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors" href="<?= base_url('/pembayaran') ?>">
                        <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center fill-current stroke-0 text-center xl:p-2.5">
                            <i class="relative top-0 leading-normal text-emerald-500 text-size-sm ni ni-collection"></i>
                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Data Pembayaran</span>
                    </a>
                </li>

                <li class="mt-0.5 w-full">
                    <a class="<?= strpos(current_url(), 'ekspedisi') ? 'active' : '' ?> dark:text-white dark:opacity-80 py-2.7 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors" href="<?= base_url('/ekspedisi') ?>">
                        <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center fill-current stroke-0 text-center xl:p-2.5">
                            <i class="relative top-0 leading-normal text-emerald-500 text-size-sm ni ni-collection"></i>
                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Data Ekspedisi</span>
                    </a>
                </li>

                <li class="mt-0.5 w-full">
                    <a class="<?= strpos(current_url(), 'tokenjwt') ? 'active' : '' ?> dark:text-white dark:opacity-80 py-2.7 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors" href="<?= base_url('/tokenjwt') ?>">
                        <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center fill-current stroke-0 text-center xl:p-2.5">
                            <i class="relative top-0 leading-normal text-purple-500 text-size-sm ni ni-send"></i>
                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Token JWT</span>
                    </a>
                </li>

                <li class="mt-0.5 w-full">
                    <a class=" dark:text-white dark:opacity-80 py-2.7 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors" href="<?= base_url('keluar') ?>">

                        <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                            <i class="relative top-0 leading-normal text-red-500 text-size-sm ni ni-curved-next"></i>
                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Keluar</span>
                    </a>
                </li>
            </ul>
        </div>
    </aside>

    <!-- end sidenav -->

    <main class="relative h-full max-h-screen transition-all duration-200 ease-in-out xl:ml-68 rounded-xl">
        <!-- Navbar -->
        <nav class="relative flex flex-wrap items-center justify-between px-0 py-2 mx-6 transition-all ease-in shadow-none duration-250 rounded-2xl lg:flex-nowrap lg:justify-start" navbar-main navbar-scroll="false">
            <div class="flex items-center justify-between w-full px-4 py-1 mx-auto flex-wrap-inherit">
                <nav>
                    <?= $this->renderSection('breadcrumb') ?>

                </nav>

                <div class="flex items-center mt-2 grow sm:mt-0 sm:mr-6 md:mr-0 lg:flex lg:basis-auto">
                    <div class="flex items-center md:ml-auto md:pr-4">
                    </div>
                    <ul class="flex flex-row justify-end pl-0 mb-0 list-none md-max:w-full">
                        <!-- online builder btn  -->
                        <!-- <li class="flex items-center">
                <a class="inline-block px-8 py-2 mb-0 mr-4 font-bold text-center text-blue-500 uppercase align-middle transition-all ease-in bg-transparent border border-blue-500 border-solid rounded-lg shadow-none cursor-pointer leading-pro text-size-xs hover:-translate-y-px active:shadow-xs hover:border-blue-500 active:bg-blue-500 active:hover:text-blue-500 hover:text-blue-500 tracking-tight-rem hover:bg-transparent hover:opacity-75 hover:shadow-none active:text-white active:hover:bg-transparent" target="_blank" href="https://www.creative-tim.com/builder/soft-ui?ref=navbar-dashboard&amp;_ga=2.76518741.1192788655.1647724933-1242940210.1644448053">Online Builder</a>
              </li> -->
                        <li class="flex items-center md:px-4">
                            <div class="block px-0 py-2 font-semibold text-white transition-all ease-nav-brand text-size-sm">
                                <span class="hidden sm:inline sm:mr-1"><?= session('nama') ?></span>
                                <i class="fa fa-user"></i>
                            </div>
                        </li>
                        <li class="flex items-center px-4 xl:hidden">
                            <a href="javascript:;" class="block p-0 text-white transition-all ease-nav-brand text-size-sm" sidenav-trigger>
                                <div class="w-4.5 overflow-hidden">
                                    <i class="ease mb-0.75 relative block h-0.5 rounded-sm bg-white transition-all"></i>
                                    <i class="ease mb-0.75 relative block h-0.5 rounded-sm bg-white transition-all"></i>
                                    <i class="ease relative block h-0.5 rounded-sm bg-white transition-all"></i>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="w-full px-6 py-6 mx-auto">
            <?= $this->renderSection('content') ?>
            <div id="spinner"></div>
        </div>
    </main>

    <div id="modal-global" class="modal">
        <div class="modal-content w-9/10 lg:w-2/4">
            <span class="modal-close">&times;</span>
            <div class="modal-box"></div>
        </div>
    </div>

    <div class="translate-x-0 ml-6 shadow-xl -translate-x-[5px] translate-x-[5px]"></div>
</body>
<script src="<?= base_url('js/plugins/perfect-scrollbar.min.js') ?>" async></script>
<script src="<?= base_url('js/argon-dashboard-tailwind.min.js?v=1.0.0') ?>" async></script>
<script>
    $('.modal-close').on('click', function() {
        $('#sidebar').addClass('z-990')
        $('#modal-global').css('display', 'none')
    })

    window.onclick = function(event) {
        if (event.target.id == $('#modal-global').attr('id')) {
            $('#sidebar').addClass('z-990')
            $('#modal-global').css('display', 'none')
        }
    }

    const rupiah = (angka) => {
        var number_string = angka.toString().replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka satuan ribuan
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return rupiah
    }


    const formatDate = (data) => {
        var date = new Date(data);
        var dateStr =
            ("00" + date.getDate()).slice(-2) + "-" +
            ("00" + (date.getMonth() + 1)).slice(-2) + "-" +
            date.getFullYear() + " " +
            ("00" + date.getHours()).slice(-2) + ":" +
            ("00" + date.getMinutes()).slice(-2) + ":" +
            ("00" + date.getSeconds()).slice(-2);
        return dateStr
    }

    var opts = {
        lines: 13,
        length: 38,
        width: 8,
        radius: 45,
        scale: 1,
        corners: 1,
        speed: 1,
        rotate: 0,
        animation: 'spinner-line-shrink',
        direction: 1,
        color: '#000000',
        fadeColor: 'transparent',
        top: '50%',
        left: '50%',
        shadow: '0 0 1px transparent',
        zIndex: 2000000000,
        className: 'spinner',
        position: 'absolute',
    };
    const spinner = new Spinner(opts);
</script>
<?= $this->renderSection('assets-js') ?>

</html>