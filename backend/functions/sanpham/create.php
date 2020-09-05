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
    <!-- Kiểm tra form phía server -->
    <?php  
        $errors =[];
        if(isset($_POST['btnThemmoi'])){
            $httt_ten = $_POST['txt_httt_ten_Themmoi'];
            // Trường hợp httt_ten rổng 
            if(empty($httt_ten)){
                $errors['httt_ten'][] = [
                        'rule' => 'required',
                        'rule_value' => true,
                        'value' => $httt_ten,
                        'msg' => 'Vui lòng nhập tên hình thức thanh toán',
                ];
            }
                // Minlength < 3
            if(!empty($httt_ten)&& strlen($httt_ten) < 3){
                    $errors['httt_ten'][] = [
                        'rule' => 'minlength',
                        'rule_value' => 3,
                        'value' => $httt_ten,
                        'msg' => 'Tên hình thức thanh toán phải từ 3 ký tự trở lên',
                    ];
            }
            // Maxlength > 30
            if(!empty($httt_ten)&& strlen($httt_ten) > 30){
                $errors['httt_ten'][] = [
                    'rule' => 'maxlength',
                    'rule_value' => 30,
                    'value' => $httt_ten,
                    'msg' => 'Tên hình thức thanh toán phải nhỏ hơn 30 ký tự',
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
    if(isset($_POST['txt_httt_ten_Themmoi'])){
        $httt_ten = $_POST['txt_httt_ten_Themmoi'];
    
        if(isset($_POST['btnThemmoi']) && (!isset($errors)) || (empty($errors))){
                
            // Truy vấn database để lấy danh sách
            // 1. Include file cấu hình kết nối đến database, khởi tạo kết nối $conn
                include_once(__DIR__.'/../../../dbconnect.php');
            // tạo câu truy vấn
                $sql = "INSERT INTO `hinhthucthanhtoan`(httt_ten) VALUES('$httt_ten')";
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
    <h1>Thêm mới sản phẩm</h1>
    <!-- Block content -->
    <?php
                // Truy vấn database
                // 1. Include file cấu hình kết nối đến database, khởi tạo kết nối $conn
                include_once(__DIR__ . '/../../../dbconnect.php');
                /* --- 
                --- 2.Truy vấn dữ liệu Loại sản phẩm 
                --- 
                */
                // Chuẩn bị câu truy vấn Loại sản phẩm
                $sqlLoaiSanPham = "select * from `loaisanpham`";
                // Thực thi câu truy vấn SQL để lấy về dữ liệu
                $resultLoaiSanPham = mysqli_query($conn, $sqlLoaiSanPham);
                // Khi thực thi các truy vấn dạng SELECT, dữ liệu lấy về cần phải phân tích để sử dụng
                // Thông thường, chúng ta sẽ sử dụng vòng lặp while để duyệt danh sách các dòng dữ liệu được SELECT
                // Ta sẽ tạo 1 mảng array để chứa các dữ liệu được trả về
                $dataLoaiSanPham = [];
                while ($rowLoaiSanPham = mysqli_fetch_array($resultLoaiSanPham, MYSQLI_ASSOC)) {
                    $dataLoaiSanPham[] = array(
                        'lsp_ma' => $rowLoaiSanPham['lsp_ma'],
                        'lsp_ten' => $rowLoaiSanPham['lsp_ten'],
                        'lsp_mota' => $rowLoaiSanPham['lsp_mota'],
                    );
                }
                /* --- End Truy vấn dữ liệu Loại sản phẩm --- */
                /* --- 
                --- 3. Truy vấn dữ liệu Nhà sản xuất 
                --- 
                */
                // Chuẩn bị câu truy vấn Nhà sản xuất
                $sqlNhaSanXuat = "select * from `nhasanxuat`";
                // Thực thi câu truy vấn SQL để lấy về dữ liệu
                $resultNhaSanXuat = mysqli_query($conn, $sqlNhaSanXuat);
                // Khi thực thi các truy vấn dạng SELECT, dữ liệu lấy về cần phải phân tích để sử dụng
                // Thông thường, chúng ta sẽ sử dụng vòng lặp while để duyệt danh sách các dòng dữ liệu được SELECT
                // Ta sẽ tạo 1 mảng array để chứa các dữ liệu được trả về
                $dataNhaSanXuat = [];
                while ($rowNhaSanXuat = mysqli_fetch_array($resultNhaSanXuat, MYSQLI_ASSOC)) {
                    $dataNhaSanXuat[] = array(
                        'nsx_ma' => $rowNhaSanXuat['nsx_ma'],
                        'nsx_ten' => $rowNhaSanXuat['nsx_ten'],
                    );
                }
                /* --- End Truy vấn dữ liệu Nhà sản xuất --- */
                /* --- 
                --- 4. Truy vấn dữ liệu Khuyến mãi
                --- 
                */
                // Chuẩn bị câu truy vấn Khuyến mãi
                $sqlKhuyenMai = "select * from `khuyenmai`";
                // Thực thi câu truy vấn SQL để lấy về dữ liệu
                $resultKhuyenMai = mysqli_query($conn, $sqlKhuyenMai);
                // Khi thực thi các truy vấn dạng SELECT, dữ liệu lấy về cần phải phân tích để sử dụng
                // Thông thường, chúng ta sẽ sử dụng vòng lặp while để duyệt danh sách các dòng dữ liệu được SELECT
                // Ta sẽ tạo 1 mảng array để chứa các dữ liệu được trả về
                $dataKhuyenMai = [];
                while ($rowKhuyenMai = mysqli_fetch_array($resultKhuyenMai, MYSQLI_ASSOC)) {
                    $km_tomtat = '';
                    if (!empty($rowKhuyenMai['km_ten'])) {
                        // Sử dụng hàm sprintf() để chuẩn bị mẫu câu với các giá trị truyền vào tương ứng từng vị trí placeholder
                        $km_tomtat = sprintf(
                            "Khuyến mãi %s, nội dung: %s, thời gian: %s-%s",
                            $rowKhuyenMai['km_ten'],
                            $rowKhuyenMai['km_noidung'],
                            // Sử dụng hàm date($format, $timestamp) để chuyển đổi ngày thành định dạng Việt Nam (ngày/tháng/năm)
                            // Do hàm date() nhận vào là đối tượng thời gian, chúng ta cần sử dụng hàm strtotime() để chuyển đổi từ chuỗi có định dạng 'yyyy-mm-dd' trong MYSQL thành đối tượng ngày tháng
                            date('d/m/Y', strtotime($rowKhuyenMai['km_tungay'])),    //vd: '2019-04-25'
                            date('d/m/Y', strtotime($rowKhuyenMai['km_denngay']))
                        );  //vd: '2019-05-10'
                    }
                    $dataKhuyenMai[] = array(
                        'km_ma' => $rowKhuyenMai['km_ma'],
                        'km_tomtat' => $km_tomtat,
                    );
                }
                /* --- End Truy vấn dữ liệu Khuyến mãi --- */
                ?>

    <form name="frmThemmoisanpham" id="frmThemmoisanpham" method="post" action="">
        <div class="form-group">
                        <label for="sp_ten">Tên Sản phẩm</label>
                        <input type="text" class="form-control" id="sp_ten" name="sp_ten" placeholder="Tên Sản phẩm" value="">
                    </div>
                    <div class="form-group">
                        <label for="sp_gia">Giá Sản phẩm</label>
                        <input type="text" class="form-control" id="sp_gia" name="sp_gia" placeholder="Giá Sản phẩm" value="">
                    </div>
                    <div class="form-group">
                        <label for="sp_giacu">Giá cũ Sản phẩm</label>
                        <input type="text" class="form-control" id="sp_giacu" name="sp_giacu" placeholder="Giá cũ Sản phẩm" value="">
                    </div>
                    <div class="form-group">
                        <label for="sp_mota_ngan">Mô tả ngắn</label>
                        <input type="text" class="form-control" id="sp_mota_ngan" name="sp_mota_ngan" placeholder="Mô tả ngắn Sản phẩm" value="">
                    </div>
                    <div class="form-group">
                        <label for="sp_mota_chitiet">Mô tả chi tiết</label>
                        <input type="text" class="form-control" id="sp_mota_chitiet" name="sp_mota_chitiet" placeholder="Mô tả chi tiết Sản phẩm" value="">
                    </div>
                    <div class="form-group">
                        <label for="sp_ngaycapnhat">Ngày cập nhật</label>
                        <input type="text" class="form-control" id="sp_ngaycapnhat" name="sp_ngaycapnhat" placeholder="Ngày cập nhật Sản phẩm" value="">
                    </div>
                    <div class="form-group">
                        <label for="sp_soluong">Số lượng</label>
                        <input type="text" class="form-control" id="sp_soluong" name="sp_soluong" placeholder="Số lượng Sản phẩm" value="">
                    </div>
                    <button class="btn btn-primary">Lưu dữ liệu</button>
        </div>
    </form>
    </div>
    </div>
    </div>

    <!-- Phần Footer -->

    <?php include_once(__DIR__.'/../../layouts/partials/footer.php'); ?>

<!-- Liên kết jquery và js boostrap -->
    <?php include_once(__DIR__.'/../../layouts/scripts.php'); ?>