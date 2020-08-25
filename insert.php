<?php  
 // Truy vấn database để lấy danh sách
    // 1. Include file cấu hình kết nối đến database, khởi tạo kết nối $conn
    include_once(__DIR__.'/dbconnect.php');
// tạo câu truy vấn
$tenhinhthucthanhtoan = 'Chuyển khoản ATM';
$sql = "INSERT INTO `hinhthucthanhtoan`(httt_ten) VALUES('$tenhinhthucthanhtoan');";
// Thực thi câu lệnh query
mysqli_query($conn,$sql);
?>