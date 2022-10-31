<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="apple-touch-icon" sizes="76x76" href="<?= base_url('img/apple-icon.png') ?>" />
    <link rel="shortcut icon" href="<?= base_url('favicon.ico') ?>" type="image/x-icon" />
    <title>Sistem Legalisir Ijazah Dan Transkrip</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="<?= base_url('css/nucleo-icons.css') ?>" rel="stylesheet" />
    <link href="<?= base_url('css/nucleo-svg.css') ?>" rel="stylesheet" />
    <link rel="stylesheet" href="<?= base_url('css/app.css') ?>">
    <link href="<?= base_url('css/argon-dashboard-tailwind.css?v=1.0.0" rel="stylesheet') ?>" />

    <?= $this->renderSection('assets-css') ?>
    <script>
        const BASE_URL = "<?= base_url() ?>"
    </script>
</head>

<body style="background-image: url('img/mipa.jpg');" class="m-0 font-sans antialiased font-normal bg-sky-100 text-start text-size-base leading-default text-slate-500">
    <?= $this->renderSection('content') ?>
    <div id="spinner"></div>
</body>
<script src="<?= base_url('js/app.js') ?>"></script>
<script src="<?= base_url('js/plugins/perfect-scrollbar.min.js') ?>" async></script>
<script src="<?= base_url('js/argon-dashboard-tailwind.js?v=1.0.0') ?>" async></script>
<script>
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