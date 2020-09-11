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
    <?php  
    /* -----Truy vấn database lấy dữ liệu tạo select cho người dùng chọn---- */
    //  1. Kết nối database
    include_once(__DIR__ . '/../../../dbconnect.php');

    // 2. Tạo câu truy vấn
    $sqlSanPham = "select * from `sanpham`";
    
    // 3. Thực thi câu truy vấn
    $resultSanPham = mysqli_query($conn,$sqlSanPham);

    //. Bóc tách dữ liệu sử dụng vòng lặp while
    $dataSanpham = [];
    while($rowSanPham = mysqli_fetch_array($resultSanPham, MYSQLI_ASSOC)){
      $ten_tomtat = sprintf("Sản phẩm: %s, giá: %s",
                            $rowSanPham['sp_ten'],
                            number_format($rowSanPham['sp_gia'],2,".",",")
    );
      $dataSanpham[] = array(
              'sp_ma' => $rowSanPham['sp_ma'],
              'sp_ten' => $ten_tomtat
      );
    }
    ?>
    <?php 
    /* Tiến hành sao lưu file do client upload từ thư mục tạm của apache vào thư mục upload*/
    // Nếu người dùng bấm nút lưu thì thực thi câu lệnh update
    if(isset($_POST['btnSave'])){
      // lấy dữ liệu mã sản phẩm cần update mà người dùng POST
      $sp_ma = $_POST['sp_ma'];
      // Nếu người dùng có load file
      if(isset($_FILES['hsp_tentaptin'])){
        // Tạo biến chứa đường dẫn thư mục upload
        $upload_dir = __DIR__."/../../../assets/uploads/";
        $sub_dir = "product1/";
        // Kiểm tra file gởi lên xem có lỗi không
        if($_FILES['hsp_tentaptin']['error'] > 0){
          echo "File Upload bị lỗi"; die;
        } else{
          // Nếu không lỗi thì di chuyển từ thư mục tạm vào thư mục mong muốn
          $hsp_tentaptin = $_FILES['hsp_tentaptin']['name'];
          // Để tránh việc client load file trùng tên, gắn thêm date để phân biệt
          $tentaptin = date('YmdHis').'_'.$hsp_tentaptin;
          move_uploaded_file($_FILES['hsp_tentaptin']['tmp_name'], $upload_dir . $sub_dir . $tentaptin);
        }
        // Lưu thông tin upload vào database
        $sql = "INSERT INTO `hinhsanpham` (hsp_tentaptin, sp_ma) VALUES ('$tentaptin', $sp_ma);";
        // print_r($sql); die;
        // Thực thi INSERT
        mysqli_query($conn, $sql);
        // Đóng kết nối
        mysqli_close($conn);
        // Sau khi cập nhật dữ liệu, tự động điều hướng về trang Danh sách
        echo '<script>location.href = "index.php";</script>';
      
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
    <h1>Upload hình sản phẩm</h1>
        <form name="frmhinhsanpham" id="frmhinhanpham" method="post" action="" enctype="multipart/form-data">
            <div class="form-group">
                <label for="sp_ma">Sản phẩm</label>
                <select class="form-control" id="sp_ma" name="sp_ma">
                  <?php foreach($dataSanpham as $tensanpham): ?>
                      <option value="<?= $tensanpham['sp_ma'] ?>"><?= $tensanpham['sp_ten'] ?></option>
                  <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="hsp_tentaptin">Tập tin ảnh</label>
                <!-- Tạo khung div hiển thị ảnh cho người dùng Xem trước khi upload file lên Server -->
                <div class="preview-img-container">
                <img src="/PHUC_CP20SCF04/assets/shared/img/img-defaut.png" id="preview-img" width="200px" />
                </div>
                <!-- Input cho phép người dùng chọn FILE -->
                <input type="file" class="form-control" id="hsp_tentaptin" name="hsp_tentaptin">
            </div>
            <button class="btn btn-primary" name="btnSave">Lưu</button>
            <a href="index.php" class="btn btn-outline-secondary" name="btnBack" id="btnBack">Quay về</a>
        </form>


    <!-- Phần Footer -->

    <?php include_once(__DIR__.'/../../layouts/partials/footer.php'); ?>

<!-- Liên kết jquery và js boostrap -->
    <?php include_once(__DIR__.'/../../layouts/scripts.php'); ?>
<!-- Các file Javascript sử dụng riêng cho trang này, liên kết tại đây -->
<script>
    // Hiển thị ảnh preview (xem trước) khi người dùng chọn Ảnh
    const reader = new FileReader();
    const fileInput = document.getElementById("hsp_tentaptin");
    const img = document.getElementById("preview-img");
    reader.onload = e => {
      img.src = e.target.result;
    }
    fileInput.addEventListener('change', e => {
      const f = e.target.files[0];
      reader.readAsDataURL(f);
    })
  </script>
</body>
</html>