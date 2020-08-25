<?php  
 // Truy vấn database để lấy danh sách
    // 1. Include file cấu hình kết nối đến database, khởi tạo kết nối $conn
    include_once(__DIR__.'/dbconnect.php');
// tạo câu truy vấn
$updatetenhinhthucthanhtoan = 'Chuyển khoản';
$sql = <<<EOT
    UPDATE `hinhthucthanhtoan`
    SET httt_ten = N"chuyển khoản"
    WHERE httt_ma = 2;
EOT;
// Thực thi câu lệnh query
mysqli_query($conn,$sql);
?>