<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Đơn đặt hàng</title>
    <!-- Liên kết CSS boostrap -->
    <?php include_once(__DIR__.'/../../layouts/styles.php'); ?>

</head>
<body>
    <!-- Phần Header -->
    <?php include_once(__DIR__.'/../../layouts/partials/header.php'); ?>

    

    <!-- Content -->
    <div class="container-fluid">
    <div class="row">
    
    <div class="col-md-12">
    <h1>Danh sách</h1>
    <?php
    // Truy vấn database để lấy danh sách
    // 1. Include file cấu hình kết nối đến database, khởi tạo kết nối $conn
    include_once(__DIR__ . '/../../../dbconnect.php');
    // 2. Chuẩn bị câu truy vấn $sql
    // Sử dụng HEREDOC của PHP để tạo câu truy vấn SQL với dạng dễ đọc, thân thiện với việc bảo trì code
    $sql = <<<EOT
    SELECT 
        ddh.dh_ma, ddh.dh_ngaylap, ddh.dh_ngaygiao, ddh.dh_noigiao, ddh.dh_trangthaithanhtoan, httt.httt_ten, kh.kh_ten, kh.kh_dienthoai
        , SUM(spddh.sp_dh_soluong * spddh.sp_dh_dongia) AS TongThanhTien
    FROM `dondathang` ddh
    JOIN `sanpham_dondathang` spddh ON ddh.dh_ma = spddh.dh_ma
    JOIN `khachhang` kh ON ddh.kh_tendangnhap = kh.kh_tendangnhap
    JOIN `hinhthucthanhtoan` httt ON ddh.httt_ma = httt.httt_ma
    GROUP BY ddh.dh_ma, ddh.dh_ngaylap, ddh.dh_ngaygiao, ddh.dh_noigiao, ddh.dh_trangthaithanhtoan, httt.httt_ten, kh.kh_ten, kh.kh_dienthoai
EOT;
    // 3. Thực thi câu truy vấn SQL để lấy về dữ liệu
    $result = mysqli_query($conn, $sql);
    // 4. Khi thực thi các truy vấn dạng SELECT, dữ liệu lấy về cần phải phân tích để sử dụng
                // Thông thường, chúng ta sẽ sử dụng vòng lặp while để duyệt danh sách các dòng dữ liệu được SELECT
                // Ta sẽ tạo 1 mảng array để chứa các dữ liệu được trả về
                $data = [];
                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    $data[] = array(
                        'dh_ma' => $row['dh_ma'],
                        'dh_ngaylap' => date('d/m/Y H:i:s', strtotime($row['dh_ngaylap'])),
                        'dh_ngaygiao' => empty($row['dh_ngaygiao']) ? '' : date('d/m/Y H:i:s', strtotime($row['dh_ngaygiao'])),
                        'dh_noigiao' => $row['dh_noigiao'],
                        'dh_trangthaithanhtoan' => $row['dh_trangthaithanhtoan'],
                        'httt_ten' => $row['httt_ten'],
                        'kh_ten' => $row['kh_ten'],
                        'kh_dienthoai' => $row['kh_dienthoai'],
                        'TongThanhTien' => number_format($row['TongThanhTien'], 2, ".", ",") . ' vnđ',
                    );
                }
    ?>
<!-- Tạo nút thêm mới  -->
    <a href="create.php" class="btn btn-primary">Thêm mới</a>
    <table id="tblDanhSach" class="table table-bordered table-hover table-sm table-responsive mt-2">
                    <thead class="thead-dark">
                        <tr>
                            <th>Mã Đơn đặt hàng</th>
                            <th>Khách hàng</th>
                            <th>Ngày lập</th>
                            <th>Ngày giao</th>
                            <th>Nơi giao</th>
                            <th>Hình thức thanh toán</th>
                            <th>Tổng thành tiền</th>
                            <th>Trạng thái thanh toán</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data as $dondathang) : ?>
                            <tr>
                                <td><?= $dondathang['dh_ma'] ?></td>
                                <td><b><?= $dondathang['kh_ten'] ?></b><br />(<?= $dondathang['kh_dienthoai'] ?>)</td>
                                <td><?= $dondathang['dh_ngaylap'] ?></td>
                                <td><?= $dondathang['dh_ngaygiao'] ?></td>
                                <td><?= $dondathang['dh_noigiao'] ?></td>
                                <td><span class="badge badge-primary"><?= $dondathang['httt_ten'] ?></span></td>
                                <td><?= $dondathang['TongThanhTien'] ?></td>
                                <td>
                                    <?php if ($dondathang['dh_trangthaithanhtoan'] == 0) : ?>
                                        <span class="badge badge-danger">Chưa xử lý</span>
                                    <?php else : ?>
                                        <span class="badge badge-success">Đã giao hàng</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <!-- Đơn hàng nào chưa thanh toán thì được phép phép Xóa, Sửa -->
                                    <?php if ($dondathang['dh_trangthaithanhtoan'] == 0) : ?>
                                        <!-- Nút sửa, bấm vào sẽ hiển thị form hiệu chỉnh thông tin dựa vào khóa chính `dh_ma` -->
                                        <a href="edit.php?dh_ma=<?= $dondathang['dh_ma'] ?>" class="btn btn-warning">
                                            Sửa
                                        </a>
                                        <!-- Nút xóa, bấm vào sẽ xóa thông tin dựa vào khóa chính `dh_ma` -->
                                        <button type="button" class="btn btn-danger btnDelete" data-dh_ma="<?= $dondathang['dh_ma'] ?>">
                                            Xóa
                                        </button>
                                    <?php else : ?>
                                        <!-- Đơn hàng nào đã thanh toán rồi thì không cho phép Xóa, Sửa (không hiển thị 2 nút này ra giao diện) 
                                        - Cho phép IN ấn ra giấy
                                        -->
                                        <!-- Nút in, bấm vào sẽ hiển thị mẫu in thông tin dựa vào khóa chính `dh_ma` -->
                                        <a href="print.php?dh_ma=<?= $dondathang['dh_ma'] ?>" class="btn btn-success">
                                            In
                                        </a>
                                    <?php endif; ?>
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