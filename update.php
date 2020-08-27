<?php  
 // Truy vấn database để lấy danh sách
    // 1. Include file cấu hình kết nối đến database, khởi tạo kết nối $conn
    include_once(__DIR__.'/dbconnect.php');
// tạo câu truy vấn
$sql = <<<EOT
    UPDATE hinhthucthanhtoan
        SET
              httt_ten='Trả tiền mặt'
        WHERE httt_ma = 1;
EOT;
// Thực thi câu lệnh query
mysqli_query($conn,$sql);
?>