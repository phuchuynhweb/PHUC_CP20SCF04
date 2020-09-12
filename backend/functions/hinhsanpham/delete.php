<?php  
// /Kết nối đến database
include_once(__DIR__ . '/../../../dbconnect.php');
// Lấy yêu mã sản phẩm mà người dùng cần xóa hình
$hsp_ma = $_GET['hsp_ma'];
//Chuẩn bị câu truy vấn để lấy dữ liệu cũ
$sqlHinhsanpham = "Select * from `hinhsanpham` where hsp_ma = $hsp_ma ";
//Thực thi câu truy vấn
$resultSelect = mysqli_query($conn,$sqlHinhsanpham);
//Bóc tách dữ liệu
$hinhsanphamRow = mysqli_fetch_array($resultSelect, MYSQLI_ASSOC);

// Xóa file hình cũ nếu tồn tại để tránh dữ liệu rác
// Tạo đường dẫn tới file cũ
$upload_dir = __DIR__.'/../../../assets/uploads/';
$sub_dir = 'products/';
$old_file = $upload_dir.$sub_dir.$hinhsanphamRow['hsp_tentaptin'];
if(file_exists($old_file)){
    unlink($old_file);
}
// Xóa dữ liệu khỏi database
// Chuẩn bị câu truy vấn xóa
$sqlDeletehsp = "delete from hinhsanpham where hsp_ma = $hsp_ma ";
// Thực thi câu truy vấn
mysqli_query($conn,$sqlDeletehsp);
//Đóng kết nối
mysqli_close($conn);
header('location:index.php');
?>