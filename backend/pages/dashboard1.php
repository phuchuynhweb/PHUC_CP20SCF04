<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>NenTang.vn</title>
  <!-- Nhúng file Quản lý các Liên kết CSS dùng chung cho toàn bộ trang web -->
  <?php include_once(__DIR__ . '/../layouts/styles.php'); ?>
</head>
<body class="d-flex flex-column h-100">
  <!-- header -->
  <?php include_once(__DIR__ . '/../layouts/partials/header.php'); ?>
  <!-- end header -->
  <div class="container-fluid">
    <div class="row">
      <!-- sidebar -->
      <?php include_once(__DIR__ . '/../layouts/partials/sidebar.php'); ?>
      <!-- end sidebar -->
      <main role="main" class="col-md-10 ml-sm-auto px-4 mb-2">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h1 class="h2">Bảng tin DASHBOARD</h1>
        </div>
        <!-- Block content -->
        <div class="container-fluid">
          <div class="row">
            <div class="col-sm-6 col-lg-3">
              <div class="card text-white bg-primary mb-2">
                <div class="card-body pb-0">
                  <div class="text-value" id="baocaoSanPham_SoLuong">
                    <h1>0</h1>
                  </div>
                  <div>Tổng số mặt hàng</div>
                </div>
              </div>
              <button class="btn btn-primary btn-sm form-control" id="refreshBaoCaoSanPham">Refresh dữ liệu</button>
            </div> <!-- Tổng số mặt hàng -->
            <div class="col-sm-6 col-lg-3">
              <div class="card text-white bg-success mb-2">
                <div class="card-body pb-0">
                  <div class="text-value" id="baocaoKhachHang_SoLuong">
                    <h1>0</h1>
                  </div>
                  <div>Tổng số khách hàng</div>
                </div>
              </div>
              <button class="btn btn-success btn-sm form-control" id="refreshBaoCaoKhachHang">Refresh dữ liệu</button>
            </div> <!-- Tổng số khách hàng -->
            <div class="col-sm-6 col-lg-3">
              <div class="card text-white bg-warning mb-2">
                <div class="card-body pb-0">
                  <div class="text-value" id="baocaoDonHang_SoLuong">
                    <h1>0</h1>
                  </div>
                  <div>Tổng số đơn hàng</div>
                </div>
              </div>
              <button class="btn btn-warning btn-sm form-control" id="refreshBaoCaoDonHang">Refresh dữ liệu</button>
            </div> <!-- Tổng số đơn hàng -->
            <div class="col-sm-6 col-lg-3">
              <div class="card text-white bg-danger mb-2">
                <div class="card-body pb-0">
                  <div class="text-value" id="baocaoGopY_SoLuong">
                    <h1>0</h1>
                  </div>
                  <div>Tổng số góp ý</div>
                </div>
              </div>
              <button class="btn btn-danger btn-sm form-control" id="refreshBaoCaoGopY">Refresh dữ liệu</button>
            </div> <!-- Tổng số góp ý -->
            <div id="ketqua"></div>
          </div><!-- row -->
          <div class="row">
            <!-- Biểu đồ thống kê loại sản phẩm -->
            <div class="col-sm-6 col-lg-6">
              <canvas id="chartOfobjChartThongKeLoaiSanPham"></canvas>
              <button class="btn btn-outline-primary btn-sm form-control" id="refreshThongKeLoaiSanPham">Refresh dữ liệu</button>
            </div><!-- col -->
          </div><!-- row -->
        </div>
        <!-- End block content -->
      </main>
    </div>
  </div>
  <!-- footer -->
  <?php include_once(__DIR__ . '/../layouts/partials/footer.php'); ?>
  <!-- end footer -->
  <!-- Nhúng file quản lý phần SCRIPT JAVASCRIPT -->
  <?php include_once(__DIR__ . '/../layouts/scripts.php'); ?>
  
  
  <script>
    $(document).ready(function() {
      // ----------------- Tổng số mặt hàng --------------------------
      function getDuLieuBaoCaoTongSoMatHang() {
        $.ajax('http://localhost/PHUC_CP20SCF04/backend/API/baocao-tongsomathang.php', {
          success: function(data) {
            var dataObj = JSON.parse(data);
            var htmlString = `<h1>${dataObj.SoLuong}</h1>`;
            $('#baocaoSanPham_SoLuong').html(htmlString);
          },
          error: function() {
            var htmlString = `<h1>Không thể xử lý</h1>`;
            $('#baocaoSanPham_SoLuong').html(htmlString);
          }
        });
      }
      $('#refreshBaoCaoSanPham').click(function(event) {
        event.preventDefault();
        getDuLieuBaoCaoTongSoMatHang();
      });

        getDuLieuBaoCaoTongSoMatHang();
    
  
     
     // ----------------- Tổng số khách hàng --------------------------
      function getDuLieuBaoCaoTongSoKhachHang() {
        $.ajax('http://localhost/PHUC_CP20SCF04/backend/API/baocao-tongsokhachhang.php', {
          success: function(data) {
            var dataObj = JSON.parse(data);
            var htmlString = `<h1>${dataObj.SoLuong}</h1>`;
            $('#baocaoKhachHang_SoLuong').html(htmlString);
          },
          error: function() {
            var htmlString = `<h1>Không thể xử lý</h1>`;
            $('#baocaoKhachHang_SoLuong').html(htmlString);
          }
        });
      }
      $('#refreshBaoCaoKhachHang').click(function(event) {
        event.preventDefault();
        getDuLieuBaoCaoTongSoKhachHang();
      });
      getDuLieuBaoCaoTongSoKhachHang();
 // ----------------- Tổng số đơn hàng --------------------------
 function getDuLieuBaoCaoTongSoDonHang() {
        $.ajax('http://localhost/PHUC_CP20SCF04/backend/API/baocao-tongsodonhang.php', {
          success: function(data) {
            var dataObj = JSON.parse(data);
            var htmlString = `<h1>${dataObj.SoLuong}</h1>`;
            $('#baocaoDonHang_SoLuong').html(htmlString);
          },
          error: function() {
            var htmlString = `<h1>Không thể xử lý</h1>`;
            $('#baocaoDonHang_SoLuong').html(htmlString);
          }
        });
      }
      $('#refreshBaoCaoDonHang').click(function(event) {
        event.preventDefault();
        getDuLieuBaoCaoTongSoDonHang();
      });
      getDuLieuBaoCaoTongSoDonHang();
        // ----------------- Tổng số Góp ý --------------------------
        function getDuLieuBaoCaoTongSoGopY() {
        $.ajax('http://localhost/PHUC_CP20SCF04/backend/API/baocao-tongsogopy.php', {
          success: function(data) {
            var dataObj = JSON.parse(data);
            var htmlString = `<h1>${dataObj.SoLuong}</h1>`;
            $('#baocaoGopY_SoLuong').html(htmlString);
          },
          error: function() {
            var htmlString = `<h1>Không thể xử lý</h1>`;
            $('#baocaoGopY_SoLuong').html(htmlString);
          }
        });
      }
      $('#refreshBaoCaoGopY').click(function(event) {
        event.preventDefault();
        getDuLieuBaoCaoTongSoGopY();
      });
      getDuLieuBaoCaoTongSoGopY();



    });
   
</script>

</body>
