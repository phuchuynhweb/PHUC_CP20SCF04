<?php 
if(isset($_GET['idmuonxoa'])){
        $idmuonxoa = $_GET['idmuonxoa'];
    // Truy vấn database để lấy danh sách
        // 1. Include file cấu hình kết nối đến database, khởi tạo kết nối $conn
        include_once(__DIR__.'/../../../dbconnect.php');
    // tạo câu truy vấn
        $sql = <<<EOT
        DELETE FROM hinhthucthanhtoan
        WHERE httt_ma = $idmuonxoa;
EOT;
    // Thực thi câu lệnh query
        mysqli_query($conn,$sql);
    // Trở về trang index
    echo '<script>location.href = "index.php";</script>';
}
?>