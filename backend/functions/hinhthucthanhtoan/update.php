<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Trang chủ</title>
    <!-- Liên kết CSS boostrap -->
    <?php include_once(__DIR__.'/../../layouts/styles.php'); ?>

</head>
<body>
    <!-- Phần Header -->
    <?php include_once(__DIR__.'/../../layouts/partials/header.php'); ?>

    
    <!-- Content -->
    <div class="container">
    <div class="row">
    <div class="col-md-4">

    <!-- Phần sidebar -->
    <?php include_once(__DIR__.'/../../layouts/partials/sidebar.php'); ?>
    
    </div>
    <div class="col-md-8">
    <?php 
    if(isset($_GET['idmuonsua'])){
        $idmuonsua = $_GET['idmuonsua'];
    }
    if(isset($_POST['btnUpdate'])){
    $httt_ten = $_POST['txt_httt_ten_update'];
    // Truy vấn database để lấy danh sách
    // 1. Include file cấu hình kết nối đến database, khởi tạo kết nối $conn
    include_once(__DIR__.'/../../../dbconnect.php');
    // tạo câu truy vấn
        $sql = <<<EOT
        UPDATE hinhthucthanhtoan
	    SET
		httt_ten=N' $httt_ten'
	    WHERE httt_ma = $idmuonsua
EOT;
    // Thực thi câu lệnh query
        mysqli_query($conn,$sql);
}

?>
    <h1>Thêm mới hình thức thanh toán</h1>
    <form name="frmUpdate" id="frmUpdate" method="post" action="">
        <table>
            <tr>
            <td>Hình thức thanh toán</td>
            </tr>
            <tr>
            <td>
                <div class="form-group">
                    <input type="text" class="form-control" name="txt_httt_ten_update" id="txt_httt_ten_update" aria-describedby="emailHelp">
                </div>
            </td>
            </tr>
            <tr>
            <td>
                <input type="submit" name="btnUpdate" id="btnUpdate" value="Lưu dữ liệu"/>
            </td>
            </tr>
        </table>
    </form>
    </div>
    </div>
    </div>

    <!-- Phần Footer -->

    <?php include_once(__DIR__.'/../../layouts/partials/footer.php'); ?>

<!-- Liên kết jquery và js boostrap -->
    <?php include_once(__DIR__.'/../../layouts/scripts.php'); ?>

<script>
//
$(document).ready(function(){
    $("#frmUpdate").validate({
        rules:{
            txt_httt_ten_Themmoi:{
                required: true,
                minlength: 3,
                maxlength:50
            }
            
        },
        messages: {
            txt_httt_ten_Themmoi:{
                required:"Vui lòng nhập hình thức thanh toán",
                minlength: "Vui lòng nhập hình thức thanh toán lớn hơn 3 ký tự",
                maxlength:"Vui lòng nhập tên hình thức thanh toán nhỏ hơn 30 ký tự",
            }
        },
        errorElement: "em",
        errorPlacement: function(error, element) {
          // Thêm class `invalid-feedback` cho field đang có lỗi
          error.addClass("invalid-feedback");
          if (element.prop("type") === "checkbox") {
            error.insertAfter(element.parent("label"));
          } else {
            error.insertAfter(element);
          }
        },
        success: function(label, element) {},
        highlight: function(element, errorClass, validClass) {
          $(element).addClass("is-invalid").removeClass("is-valid");
        },
        unhighlight: function(element, errorClass, validClass) {
          $(element).addClass("is-valid").removeClass("is-invalid");
        },
    });

})
</script>
</body>
</html>