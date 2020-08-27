<?php  
 // Truy vấn database để lấy danh sách
    // 1. Include file cấu hình kết nối đến database, khởi tạo kết nối $conn
    include_once(__DIR__.'/dbconnect.php');
// tạo câu truy vấn
$sql = <<<EOT
DELETE FROM hinhthucthanhtoan
WHERE httt_ma = 6;
EOT;
// Thực thi câu lệnh query
mysqli_query($conn,$sql);
?>