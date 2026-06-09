<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($judul) ? $judul . ' - Lifesports' : 'Lifesports'; ?></title>
    <link rel="stylesheet" href="<?= BASEURL; ?>/assets/css/styles.css?v=<?= time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="watermark">LIFESPORTS</div>
    <?= $content; ?>
</body>
</html>
