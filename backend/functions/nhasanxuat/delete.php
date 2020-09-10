<?php 
if(isset($_GET['nsx_ma'])){
        $nsx_ma = $_GET['nsx_ma'];
    // Truy vấn database để lấy danh sách
        // 1. Include file cấu hình kết nối đến database, khởi tạo kết nối $conn
        include_once(__DIR__.'/../../../dbconnect.php');
    // tạo câu truy vấn
        $sql = <<<EOT
        DELETE FROM nhasanxuat
        WHERE nsx_ma = $nsx_ma;
EOT;
    // Thực thi câu lệnh query
        mysqli_query($conn,$sql);
    // Trở về trang index
    echo '<script>location.href = "index.php";</script>';
}
?>