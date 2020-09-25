<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sản phẩm</title>
    <!-- Liên kết CSS boostrap -->
    <?php include_once(__DIR__.'/../../layouts/styles.php'); ?>
    <link rel="stylesheet" type="text/css" href="/PHUC_CP20SCF04/assets/vendor/datatables/datatables.css" />
    <link rel="stylesheet" type="text/css" href="/PHUC_CP20SCF04/assets/vendor/datatables/buttons/css/buttons.bootstrap4.min.css" />
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
    <h1>Danh sách sản phẩm</h1>
    <a href="create.php" class="btn btn-primary">Thêm mới</a>
    <?php
                    // Truy vấn database để lấy danh sách
                    // 1. Include file cấu hình kết nối đến database, khởi tạo kết nối $conn
                    // C:\xampp\htdocs\web02\
                    include_once(__DIR__ . '/../../../dbconnect.php');
                    // 2. Chuẩn bị QUERY
                    // HERE DOC
                    $sql = <<<EOT
                        SELECT sp.*
                                , lsp.lsp_ten
                                , nsx.nsx_ten
                                , km.km_ten, km.km_noidung, km.km_tungay, km.km_denngay
                        FROM sanpham sp
                        JOIN loaisanpham lsp ON sp.lsp_ma = lsp.lsp_ma
                        JOIN nhasanxuat nsx ON sp.nsx_ma = nsx.nsx_ma
                        LEFT JOIN khuyenmai km ON sp.km_ma = km.km_ma
                        ORDER BY sp.sp_ma DESC;
EOT;
                    // 3. Yêu cầu PHP thực thi QUERY
                    $result = mysqli_query($conn, $sql);
                    // 4. Khi thực thi các truy vấn dạng SELECT, dữ liệu lấy về cần phải phân tích để sử dụng
                    // Thông thường, chúng ta sẽ sử dụng vòng lặp while để duyệt danh sách các dòng dữ liệu được SELECT
                    // Ta sẽ tạo 1 mảng array để chứa các dữ liệu được trả về
                    $data = [];
                    $rowNum = 0;
                    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                        $rowNum ++;
                        $km_tomtat ='';
                        $km_ten = $row['km_ten'];
                        $km_noidung = $row['km_noidung'];
                        $km_tungay = date('d/m/Y', strtotime($row['km_tungay']));
                        $km_denngay = date('d/m/Y', strtotime($row['km_denngay']));
                        if(!empty($row['km_ten'])){
                            $km_tomtat = sprintf("Khuyến mãi %s, nội dung: %s, thời gian: %s - %s",
                                                $km_ten,
                                                $km_noidung,
                                                $km_tungay,
                                                $km_denngay
                        );
                        }


                        $data[] = array(
                            'sp_ma' => $row['sp_ma'],
                            'sp_ten' => $row['sp_ten'],
                            'sp_gia' => number_format($row['sp_gia'], 2, ".", ",") . ' vnđ',
                            'sp_giacu' => number_format($row['sp_giacu'], 2, ".", ",") . ' vnđ',
                            'lsp_ten' => $row['lsp_ten'],
                            'nsx_ten' => $row['nsx_ten'],
                            'km_tomtat' => $km_tomtat,
                            'rownumber' => $rowNum
                        );
                    }
                    // var_dump($data);die;
                    // print_r($data);die;
                    ?>
                    <table id="dsSanpham" border="1" width="100%">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Tên sản phẩm</th>
                                <th>Giá sản phẩm</th>
                                <th>Giá cũ</th>
                                <th>Loại sản phẩm</th>
                                <th>Nhà sản xuất</th>
                                <th>Khuyến mãi</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($data as $sp): ?>
                            <tr>
                                <td><?= $sp['rownumber']; ?></td>
                                <td><?= $sp['sp_ten']; ?></td>
                                <td><?= $sp['sp_gia']; ?></td>
                                <td><?= $sp['sp_giacu']; ?></td>
                                <td><?= $sp['lsp_ten']; ?></td>
                                <td><?= $sp['nsx_ten']; ?></td>
                                <td><?= $sp['km_tomtat']; ?></td>
                                <td>
                                    <button class="btn btn-danger btnDelete" data-sp_ma="<?= $sp['sp_ma']; ?>">Xóa</button>
                                    <a href="update.php?sp_ma=<?= $sp['sp_ma']; ?>"class="btn btn-primary">Sửa</a>
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
    <script src="/PHUC_CP20SCF04/assets/vendor/datatables/datatables.js"></script>
    <script src="/PHUC_CP20SCF04/assets/vendor/datatables/buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="/PHUC_CP20SCF04/assets/vendor/datatables/pdfmake/pdfmake.min.js"></script>
    <script src="/PHUC_CP20SCF04/assets/vendor/datatables/pdfmake/vfs_fonts.js"></script>
    <script src="/PHUC_CP20SCF04/assets/vendor/sweetalert/sweetalert.min.js"></script>

    <script>
    $(document).ready(function(){
        // Xử lý table
        $('#dsSanpham').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'excel', 'pdf'
            ]
        }
        );
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
                        var sp_ma = $(this).data('sp_ma');
                        var url = "delete.php?sp_ma="+sp_ma;
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