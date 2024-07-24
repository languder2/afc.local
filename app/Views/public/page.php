<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>AFC</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
            integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
            integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
            crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://hammerjs.github.io/dist/hammer.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-zoom/dist/chartjs-plugin-zoom.min.js"></script>

    <link
            href="<?= base_url("css/public/main.css"); ?>?t=<?php echo(microtime(true) . rand()); ?>"
            rel="stylesheet"
            type="text/css"
    >
    <link
            href="<?= base_url("css/public/afc.css"); ?>?t=<?php echo(microtime(true) . rand()); ?>"
            rel="stylesheet"
            type="text/css"
    >

    <?php if (!empty($includes->js)) foreach ($includes->js as $js): ?>
        <script defer src="<?= base_url($js); ?>?t=<?php echo(microtime(true) . rand()); ?>"></script>
    <?php endforeach; ?>
    <?php if (!empty($includes->css)) foreach ($includes->css as $css): ?>
        <link href="<?= base_url($css); ?>?t=<?php echo(microtime(true) . rand()); ?>" rel="stylesheet" type="text/css">
    <?php endforeach; ?>
</head>
<body>
<?= view("public/Templates/Header")?>
<section class="pageContent">
    <div class="container-lg">
        <?= $pageContent ?? "" ?>
    </div>
</section>
</body>
</html>