<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hình thức thanh toán</title>
    <!-- Liên kết CSS boostrap -->
    <?php include_once(__DIR__.'/../../layouts/styles.php'); ?>

</head>
<body>
    <!-- Phần Header -->
    <?php include_once(__DIR__.'/../../layouts/partials/header.php'); ?>

    

    <!-- Content -->
    <div class="container">
    <div class="row">
    <div class="col-md-4">

    <!-- Phần sidebar -->
    <?php include_once(__DIR__.'/../../layouts/partials/sidebar.php'); ?>
    
    </div>
    <div class="col-md-8">
    <h1>Danh sách hình thức thanh toán</h1>
    <a href="create.php" class="btn btn-primary">Thêm mới</a>
    <?php
                    // Truy vấn database để lấy danh sách
                    // 1. Include file cấu hình kết nối đến database, khởi tạo kết nối $conn
                    // C:\xampp\htdocs\web02\
                    include_once(__DIR__ . '/../../../dbconnect.php');
                    // 2. Chuẩn bị QUERY
                    // HERE DOC
                    $sql = <<<EOT
                    SELECT httt_ma AS MaThanhToan, httt_ten AS TenThanhToan FROM `hinhthucthanhtoan`
EOT;
                    // 3. Yêu cầu PHP thực thi QUERY
                    $result = mysqli_query($conn, $sql);
                    // 4. Khi thực thi các truy vấn dạng SELECT, dữ liệu lấy về cần phải phân tích để sử dụng
                    // Thông thường, chúng ta sẽ sử dụng vòng lặp while để duyệt danh sách các dòng dữ liệu được SELECT
                    // Ta sẽ tạo 1 mảng array để chứa các dữ liệu được trả về
                    $data = [];
                    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                        $data[] = array(
                            'ma' => $row['MaThanhToan'],
                            'ten' => $row['TenThanhToan'],
                        );
                    }
                    // var_dump($data);die;
                    // print_r($data);die;
                    ?>
                    <table border="1" width="100%">
                        <thead>
                            <tr>
                                <th>Mã Hình thức Thanh toán</th>
                                <th>Tên Hình thức Thanh toán</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($data as $httt): ?>
                            <tr>
                                <td><?= $httt['ma']; ?></td>
                                <td><?= $httt['ten']; ?></td>
                                <td>
                                    <a href="delete.php?id=<?= $httt['ma']; ?>">Xóa</a>
                                    <a href="create.php?idmuonsua=<?= $httt['ma']; ?>">Sửa</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
             fvvcvbbxdf   
    </div>
    </div>
    </div>

    <!-- Phần Footer -->

    <?php include_once(__DIR__.'/../../layouts/partials/footer.php'); ?>

<!-- Liên kết jquery và js boostrap -->
    <?php include_once(__DIR__.'/../../layouts/scripts.php'); ?>

</body>
</html>