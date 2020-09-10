<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Thêm mới nhà sản xuất</title>
    <!-- Liên kết CSS boostrap -->
    <?php include_once(__DIR__.'/../../layouts/styles.php'); ?>

</head>
<body>
    <!-- Kiểm tra form phía server -->
    <?php  
        $errors =[];
        if(isset($_POST['btnThemmoinsx'])){
            $httt_ten = $_POST['txt_httt_ten_nsx'];
            // Trường hợp httt_ten rổng 
            if(empty($httt_ten)){
                $errors['httt_ten'][] = [
                        'rule' => 'required',
                        'rule_value' => true,
                        'value' => $httt_ten,
                        'msg' => 'Vui lòng nhập tên nhà sản xuất',
                ];
            }
                // Minlength < 3
            if(!empty($httt_ten)&& strlen($httt_ten) < 3){
                    $errors['httt_ten'][] = [
                        'rule' => 'minlength',
                        'rule_value' => 3,
                        'value' => $httt_ten,
                        'msg' => 'Tên nhà sản xuất phải từ 3 ký tự trở lên',
                    ];
            }
            // Maxlength > 30
            if(!empty($httt_ten)&& strlen($httt_ten) > 30){
                $errors['httt_ten'][] = [
                    'rule' => 'maxlength',
                    'rule_value' => 30,
                    'value' => $httt_ten,
                    'msg' => 'Tên nhà sản xuất phải nhỏ hơn 30 ký tự',
                ];
            }
        };
        // echo '<pre>';
        // echo print_r($errors);die;
        // echo '</pre>';
        // var_dump($httt_ten);die;
    ?>

    <!-- Thực hiện insert dữ liệu vào CSDL -->

    <?php 
    if(isset($_POST['txt_httt_ten_nsx'])){
        $httt_ten = $_POST['txt_httt_ten_nsx'];
    
        if(isset($_POST['btnThemmoinsx']) && (!isset($errors)) || (empty($errors))){
                
            // Truy vấn database để lấy danh sách
            // 1. Include file cấu hình kết nối đến database, khởi tạo kết nối $conn
                include_once(__DIR__.'/../../../dbconnect.php');
            // tạo câu truy vấn
                $sql = "INSERT INTO `nhasanxuat`(nsx_ten) VALUES('$httt_ten')";
            // Thực thi câu lệnh query
                mysqli_query($conn,$sql);
        }
    }
    ?>
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
    <h1>Thêm mới nhà sản xuất</h1>
    <form name="frmThemmoinsx" id="frmThemmoinsx" method="post" action="">
        <table>
            <tr>
            <td>Tên nhà sản xuất</td>
            </tr>
            <tr>
            <td>
                <div class="form-group">
                    <input type="text" class="form-control" name="txt_httt_ten_nsx" id="txt_httt_ten_nsx" aria-describedby="emailHelp">
                </div>
            </td>
            </tr>
            <tr>
                <td>
                    <!-- Nếu có lỗi VALIDATE dữ liệu thì hiển thị ra màn hình 
                    - Sử dụng thành phần (component) Alert của Bootstrap
                    - Mỗi một lỗi hiển thị sẽ in theo cấu trúc Danh sách không thứ tự UL > LI
                    -->
                    <?php if (
                    isset($_POST['btnThemmoinsx'])  // Nếu người dùng có bấm nút "Lưu dữ liệu"
                    && isset($errors)         // Nếu biến $errors có tồn tại
                    && (!empty($errors))      // Nếu giá trị của biến $errors không rỗng
                    ) : ?>
                    <div id="errors-container" class="alert alert-danger face my-2" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                        <ul>
                        <?php foreach ($errors as $fields) : ?>
                            <?php foreach ($fields as $field) : ?>
                            <li><?php echo $field['msg']; ?></li>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                        </ul>
                    </div>
                    <?php endif; ?>
                </td>
            </tr>
            <tr>
            <td>
                <input type="submit" name="btnThemmoinsx" id="btnThemmoinsx" value="Lưu dữ liệu"/>
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
$(document).ready(function(){
    $("#frmThemmoinsx").validate({
        rules:{
            txt_httt_ten_nsx:{
                required: true,
                minlength: 3,
                maxlength:50
            }
            
        },
        messages: {
            txt_httt_ten_Themmoi:{
                required:"Vui lòng nhập tên nhà sản xuất",
                minlength: "Vui lòng nhập tên nhà sản xuất lớn hơn 3 ký tự",
                maxlength:"Vui lòng nhập tên nhà sản xuất nhỏ hơn 30 ký tự",
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