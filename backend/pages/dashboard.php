<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Trang chủ</title>
    <!-- Liên kết CSS boostrap -->
    <?php include_once(__DIR__.'/../layouts/styles.php'); ?>

</head>
<body>
    <!-- Phần Header -->
    <?php include_once(__DIR__.'/../layouts/partials/header.php'); ?>

    

    <!-- Content -->
    <div class="container">
    <div class="row">
    <div class="col-md-4">

    <!-- Phần sidebar -->
    <?php include_once(__DIR__.'/../layouts/partials/sidebar.php'); ?>
    
    </div>
    <div class="col-md-8">
    
    </div>
    </div>
    </div>

    <!-- Phần Footer -->

    <?php include_once(__DIR__.'/../layouts/partials/footer.php'); ?>

<!-- Liên kết jquery và js boostrap -->
    <?php include_once(__DIR__.'/../layouts/scripts.php'); ?>

</body>
</html>