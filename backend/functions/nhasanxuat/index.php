<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nhà sản xuất</title>
    <!-- Liên kết CSS boostrap -->
    <?php include_once(__DIR__.'/../../layouts/styles.php'); ?>

</head>
<body>
    <!-- Phần Header -->
    <?php include_once(__DIR__.'/../../layouts/partials/header.php'); ?>

    

    <!-- Content -->
    <div class="container-fluid">
    <div class="row">
    <div class="col-md-4">

    <!-- Phần sidebar -->
    <?php include_once(__DIR__.'/../../layouts/partials/sidebar.php'); ?>
    
    </div>
    <div class="col-md-8">
    <h1>Danh sách nhà sản xuất</h1>
    <a href="create.php" class="btn btn-primary">Thêm mới</a>
    <?php
                    // Truy vấn database để lấy danh sách
                    // 1. Include file cấu hình kết nối đến database, khởi tạo kết nối $conn
                    // C:\xampp\htdocs\web02\
                    include_once(__DIR__ . '/../../../dbconnect.php');
                    // 2. Chuẩn bị QUERY
                    // HERE DOC
                    $sqlNsx = <<<EOT
                            SELECT nsx_ma, nsx_ten
                                    FROM nhasanxuat
EOT;
                    // 3. Yêu cầu PHP thực thi QUERY
                    $resultNsx = mysqli_query($conn, $sqlNsx);
                    // 4. Khi thực thi các truy vấn dạng SELECT, dữ liệu lấy về cần phải phân tích để sử dụng
                    // Thông thường, chúng ta sẽ sử dụng vòng lặp while để duyệt danh sách các dòng dữ liệu được SELECT
                    // Ta sẽ tạo 1 mảng array để chứa các dữ liệu được trả về
                    $dataNsx = [];
                    $rowNum = 0;
                    while ($rowNsx = mysqli_fetch_array($resultNsx, MYSQLI_ASSOC)) {
                        $rowNum++;
                        $dataNsx[] = array(
                            'nsx_ma' => $rowNsx['nsx_ma'],
                            'nsx_ten' => $rowNsx['nsx_ten'],
                            'row_num' => $rowNum
                        );
                    }
                    // var_dump($dataNsx);die;
                    // print_r($data);die;
                    ?>
                    <table border="1" width="100%">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Tên nhà sản xuất</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($dataNsx as $nsx): ?>
                            <tr>
                                <td><?= $nsx['row_num']; ?></td>
                                <td><?= $nsx['nsx_ten']; ?></td>
                                <td>
                                    <a class="btn btn-danger" href="delete.php?nsx_ma=<?= $nsx['nsx_ma']; ?>">Xóa</a>
                                    <a class="btn btn-primary" href="update.php?nsx_ma=<?= $nsx['nsx_ma']; ?>">Sửa</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
           
    </div>
    </div>
    </div>

    <!-- Phần Footer -->

    <?php include_once(__DIR__.'/../../layouts/partials/footer.php'); ?>

<!-- Liên kết jquery và js boostrap -->
    <?php include_once(__DIR__.'/../../layouts/scripts.php'); ?>

</body>
</html>