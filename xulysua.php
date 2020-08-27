<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Thêm mới hình thức thanh toán</title>
</head>
<body>
<?php 
$idmuonsua = $_GET['idmuonsua'];
// var_dump($idmuonsua);
// die;
//Xuất dữ liệu cũ vào ô input
// Truy vấn database để lấy danh sách
    // 1. Include file cấu hình kết nối đến database, khởi tạo kết nối $conn
    include_once(__DIR__.'/dbconnect.php');
$sql = <<<EOT
SELECT httt_ma AS MaThanhToan, httt_ten AS TenThanhToan FROM `hinhthucthanhtoan`
where MaThanhToan = $idmuonsua;
EOT;
// 3. Yêu cầu PHP thực thi QUERY
$result = mysqli_query($conn, $sql);
// 4. Khi thực thi các truy vấn dạng SELECT, dữ liệu lấy về cần phải phân tích để sử dụng
// Thông thường, chúng ta sẽ sử dụng vòng lặp while để duyệt danh sách các dòng dữ liệu được SELECT
// Ta sẽ tạo 1 mảng array để chứa các dữ liệu được trả về
$datacu = [];
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    $datacu = array(
        'ma' => $row['MaThanhToan'],
        'ten' => $row['TenThanhToan'],
    );
}
// update dữ liệu người dùng thay đổi

if(isset($_POST['btnSua'])){
    $httt_tenupdate = $_POST['txt_httt_ten_update'];
// tạo câu truy vấn
$sql = <<<EOT
    UPDATE hinhthucthanhtoan
        SET
              httt_ten=N'$httt_tenupdate'
        WHERE httt_ma = $idmuonsua;
EOT;
// Thực thi câu lệnh query
mysqli_query($conn,$sql);
}

?>
    <h1>Thêm mới hình thức thanh toán</h1>
    <form name="frmSua" id="frmSua" method="post" action="">
        <table>
            <tr>
            <td>Hình thức thanh toán</td>
            </tr>
            <tr>
            <td>
                <input type="text" name="txt_httt_ten_update" id="txt_httt_ten_update" value="<?php echo $datacu['TenThanhToan'];  ?>"/>
            </td>
            </tr>
            <tr>
            <td>
                <input type="submit" name="btnSua" id="btnSua" value="Thay đổi sữ liệu"/>
            </td>
            </tr>
        </table>
    </form>
</body>
</html>