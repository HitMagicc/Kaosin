<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Toko Baju</title>

    <!-- Style -->
	<link rel="stylesheet" href="<?= base_url('css/style.css') ?>" />

    <!-- CSS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="shortcut icon" href="<?= base_url('uploads\favicon.ico') ?>" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet">

</head>

<body>
    
    <?= $this->include('components/header') ?>
	
    
    <?= $this->renderSection('content') ?>
	
    <?= $this->include('components/footer') ?>
	<script src="<?= base_url('js/script.js') ?>"></script>
</body>

</html>