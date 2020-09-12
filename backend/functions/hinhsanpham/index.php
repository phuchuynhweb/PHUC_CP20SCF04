<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hình sản phẩm</title>
    <!-- Liên kết CSS boostrap -->
    <?php include_once(__DIR__.'/../../layouts/styles.php'); ?>

</head>
<body>
    <!-- Phần Header -->
    <?php include_once(__DIR__.'/../../layouts/partials/header.php'); ?>

    

    <!-- Content -->
    <div class="container-fluid">
    <div class="row">
    <div class="col-md-4">

    <!-- Phần sidebar -->
    <?php include_once(__DIR__.'/../../layouts/partials/sidebar.php'); ?>
    
    </div>
    <div class="col-md-8">
    <h1>Danh sách hình sản phẩm</h1>
    <a href="create1.php" class="btn btn-primary">Thêm mới</a>
    <?php
                    // Truy vấn database để lấy danh sách
                    // 1. Include file cấu hình kết nối đến database, khởi tạo kết nối $conn
                    include_once(__DIR__ . '/../../../dbconnect.php');
                    // 2. Chuẩn bị QUERY
                    // HERE DOC
                    $sqlHsp = <<<EOT
                            SELECT *
                            from `hinhsanpham` hsp
                            join `sanpham` sp on hsp.sp_ma = sp.sp_ma
EOT;
                    // 3. Yêu cầu PHP thực thi QUERY
                    $resultHsp = mysqli_query($conn, $sqlHsp);
                    // 4. Khi thực thi các truy vấn dạng SELECT, dữ liệu lấy về cần phải phân tích để sử dụng
                    // Thông thường, chúng ta sẽ sử dụng vòng lặp while để duyệt danh sách các dòng dữ liệu được SELECT
                    // Ta sẽ tạo 1 mảng array để chứa các dữ liệu được trả về
                    $dataHsp = [];
                    $rowNum = 0;
                    while ($rowHsp = mysqli_fetch_array($resultHsp, MYSQLI_ASSOC)){
                        $rowNum++;
                        $ten_tomtat = sprintf("Sản phẩm: %s, giá: %s",
                                            $rowHsp['sp_ten'],
                                            number_format($rowHsp['sp_gia'],2,".",",")  
                        );

                        $dataHsp[] = array(
                            'hsp_ma' => $rowHsp['hsp_ma'],
                            'hsp_tentaptin' => $rowHsp['hsp_tentaptin'],
                            'sp_tomtat'  => $ten_tomtat,
                            'row_num' => $rowNum
                        );
                    }
                    // var_dump($dataNsx);die;
                    // print_r($data);die;
                    ?>
                    <table border="1" width="100%">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Sản phẩm</th>
                                <th>Tên tập tin</th>
                                <th>Hình ảnh</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($dataHsp as $hinhsanpham): ?>
                            <tr>
                                <td><?= $hinhsanpham['row_num']; ?></td>
                                <td><?= $hinhsanpham['sp_tomtat']; ?></td>
                                <td><?= $hinhsanpham['hsp_tentaptin']; ?></td>
                                <td>
                                    <img width ="100px" src = "/PHUC_CP20SCF04/assets/uploads/products/<?php echo $hinhsanpham['hsp_tentaptin']   ?>" />
                                </td>
                                <td>
                                    <button class="btn btn-danger btnDelete" data-hsp_ma ="<?= $hinhsanpham['hsp_ma'] ?>" >Xóa</button>
                                    <a class="btn btn-primary" href="update.php?hsp_ma=<?= $hinhsanpham['hsp_ma']; ?>">Sửa</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
           
    </div>
    </div>
    </div>

    <!-- Phần Footer -->

    <?php include_once(__DIR__.'/../../layouts/partials/footer.php'); ?>

<!-- Liên kết jquery và js boostrap -->
    <?php include_once(__DIR__.'/../../layouts/scripts.php'); ?>
    <script src="/PHUC_CP20SCF04/assets/vendor/sweetalert/sweetalert.min.js"></script>
    <script>
    $(document).ready(function(){
        // Bắt sự kiện (event) cho class .btnDelete
        $(".btnDelete").click(function(){
            swal({
                    title: "Bạn có chắc muốn xóa?",
                    text: "Dữ liệu của bạn sẽ không thể phục hồi",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
            .then((willDelete) => {
                if (willDelete) {
                        var hsp_ma = $(this).data('hsp_ma');
                        var url = "delete.php?hsp_ma="+hsp_ma;
                        location.href = url;
                        swal("Bạn đã xóa thành công!", {
                        icon: "success",
                        });
                } else {
                        swal("Dữ liệu của bạn chưa được xóa!");
                    }
                });
        })
    })
    </Script>
</body>
</html>