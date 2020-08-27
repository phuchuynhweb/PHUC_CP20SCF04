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
if(isset($_POST['btnThemmoi'])){
    $httt_ten = $_POST['txt_httt_ten'];
    // Truy vấn database để lấy danh sách
    // 1. Include file cấu hình kết nối đến database, khởi tạo kết nối $conn
    include_once(__DIR__.'/dbconnect.php');
// tạo câu truy vấn
$sql = "INSERT INTO `hinhthucthanhtoan`(httt_ten) VALUES('$httt_ten');";
// Thực thi câu lệnh query
mysqli_query($conn,$sql);
}

?>
    <h1>Thêm mới hình thức thanh toán</h1>
    <form name="frmThemmoi" id="frmThemmoi" method="post" action="">
        <table>
            <tr>
            <td>Hình thức thanh toán</td>
            </tr>
            <tr>
            <td>
                <input type="text" name="txt_httt_ten" id="txt_httt_ten"/>
            </td>
            </tr>
            <tr>
            <td>
                <input type="submit" name="btnThemmoi" id="btnThemmoi" value="Thêm dữ liệu"/>
            </td>
            </tr>
        </table>
    </form>
</body>
</html>