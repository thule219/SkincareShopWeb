<!DOCTYPE html>
<html lang="en">

<head>
  <title>Danh sách sản phẩm | Quản trị Admin</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  @include('admin.layouts.lib')
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
  <!-- or -->
  <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">

  <!-- Font-icon css-->
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">

</head>

<body onload="time()" class="app sidebar-mini rtl">
  <!-- Navbar-->
  <header class="app-header">
    <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
    <!-- Navbar Right Menu-->
    <ul class="app-nav">


      <!-- User Menu-->
      <li><a class="app-nav__item" href="/index.html"><i class='bx bx-log-out bx-rotate-180'></i> </a>

      </li>
    </ul>
  </header>
  <!-- Sidebar menu-->
  <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
  @include('admin.layouts.navigation')
  <main class="app-content">
    <div class="app-title">
      <ul class="app-breadcrumb breadcrumb side">
        <li class="breadcrumb-item active"><a href="#"><b>Danh sách sản phẩm</b></a></li>
      </ul>
      <div id="clock"></div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="tile">
          <div class="tile-body">
            <div class="row element-button">
              <div class="col-sm-2">

                <a class="btn btn-add btn-sm" href="{{URL::to('/add-product')}}" title="Thêm"><i class="fas fa-plus"></i>
                  Tạo mới sản phẩm</a>
              </div>


              <div class="col-sm-2">
                <a class="btn btn-delete btn-sm print-file" type="button" title="In" onclick="myApp.printTable()"><i class="fas fa-print"></i> In dữ liệu</a>
              </div>

              <div class="col-sm-2">
                <a class="btn btn-excel btn-sm" href="" title="In"><i class="fas fa-file-excel"></i> Xuất Excel</a>
              </div>
              <!-- <div class="col-sm-2">
                              <a class="btn btn-delete btn-sm pdf-file" type="button" title="In" onclick="myFunction(this)"><i
                                  class="fas fa-file-pdf"></i> Xuất PDF</a>
                            </div> -->
              <div class="col-sm-2">
                <a class="btn btn-delete btn-sm" type="button" title="Xóa" onclick="myFunction(this)"><i class="fas fa-trash-alt"></i> Xóa tất cả </a>
              </div>
            </div>
            <table class="table table-hover table-bordered" id="sampleTable">
              <thead>
                <tr>
                  <th width="10"><input type="checkbox" id="all"></th>
                  <th>Mã sản phẩm</th>
                  <th>Tên sản phẩm</th>
                  <th>Số lượng</th>
                  <th>Hiển thị</th>
                  <th>Giá tiền</th>
                  <td style="text-align: center;"><b>Ảnh</td>
                  <th>Loại sản phẩm</th>
                  <th>Chức năng</th>
                </tr>
              </thead>
              <tbody>
                @foreach( $all_product as $pro)
                <tr>
                  <td width="10"><input type="checkbox" name="check1" value="1"></td>
                  <td>{{ $pro->id_product }}</td>
                  <td>{{ $pro -> name_product  }}</td>
                  <td>{{ $pro -> number }}</td>
                  <!-- <td><span class="badge bg-success">Còn hàng</span></td> -->
                  <td>
                  <?php
                    if($pro->show_product==0){
                      echo 'Ẩn';
                    }else{
                      echo 'Hiện';
                    }
                    ?>
                  </td>
                  <td>{{ $pro->price}}</td>
                  <td><img src="public/admin/image/product/{{ $pro->product_image }}" height="50" width="50"></td>
                  <td>{{ $pro->name_category_product }}</td>
                 
                  <td><a class="btn btn-primary btn-sm trash" type="submit" title="Xóa"  href="{{URL::to('/delete-product/'.$pro->id_product)}}" onclick="return confirm('Bạn có chắc muốn xóa san pham này không?')"><i class="fas fa-trash-alt" href ></i>
                    </a>
                    <a class="btn btn-primary btn-sm edit" type="submit" title="Sửa" id="show-emp" href="{{URL::to('/edit-product?id_product='.$pro->id_product)}}"><i class="fas fa-edit"></i></a>

                    <a class="btn btn-primary btn-sm edit" type="submit" title="Sửa" id="show-emp" href="{{URL::to('/detail/'.$pro->id_product)}}"><i class="fas fa-edit"></i></a>
                    
                    
                  </td>
                </tr>
                @endforeach

              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </main>

  <!--
  MODAL
-->
  <div class="modal fade" id="ModalUP" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">

        <div class="modal-body">
          <div class="row">
            <div class="form-group  col-md-12">
              <span class="thong-tin-thanh-toan">
                <h5>Chỉnh sửa thông tin sản phẩm cơ bản</h5>
              </span>
            </div>
          </div>
          <div class="row">
            <div class="form-group col-md-6">
              <label class="control-label">Mã sản phẩm </label>
              <input class="form-control" type="number" value="71309005">
            </div>
            <div class="form-group col-md-6">
              <label class="control-label">Tên sản phẩm</label>
              <input class="form-control" type="text" required value="Bàn ăn gỗ Theresa">
            </div>
            <div class="form-group  col-md-6">
              <label class="control-label">Số lượng</label>
              <input class="form-control" type="number" required value="20">
            </div>
            <div class="form-group col-md-6 ">
              <label for="exampleSelect1" class="control-label">Tình trạng sản phẩm</label>
              <select class="form-control" id="exampleSelect1">
                <option>Còn hàng</option>
                <option>Hết hàng</option>
                <option>Đang nhập hàng</option>
              </select>
            </div>
            <div class="form-group col-md-6">
              <label class="control-label">Giá bán</label>
              <input class="form-control" type="text" value="5.600.000">
            </div>
            <div class="form-group col-md-6">
              <label for="exampleSelect1" class="control-label">Danh mục</label>
              <select class="form-control" id="exampleSelect1">
                <option>Bàn ăn</option>
                <option>Bàn thông minh</option>
                <option>Tủ</option>
                <option>Ghế gỗ</option>
                <option>Ghế sắt</option>
                <option>Giường người lớn</option>
                <option>Giường trẻ em</option>
                <option>Bàn trang điểm</option>
                <option>Giá đỡ</option>
              </select>
            </div>
          </div>
          <BR>
          <div class="form-group col-md-6">
            <label class="control-label">Ảnh thẻ</label>
            <!-- <div id="myfileupload">
            <input type="file" id="uploadfile" name="ImageUpload" onchange="readURL(this);" />
          </div>
          <div id="thumbbox">
            <img height="450" width="400" alt="Thumb image" id="thumbimage" style="display: none" />
            <a class="removeimg" href="javascript:"></a>
          </div> -->
            <div id="boxchoice">
              <a href="javascript:" class="Choicefile"><i class="fas fa-cloud-upload-alt"></i> Chọn ảnh</a>
              <p style="clear:both"></p>
            </div>

          </div>
          <BR>
          <BR>
          <button class="btn btn-save" type="button">Lưu lại</button>
          <a class="btn btn-cancel" data-dismiss="modal" href="#">Hủy bỏ</a>
          <BR>
        </div>
        <div class="modal-footer">
        </div>
      </div>
    </div>
  </div>
  <!--
MODAL
-->


  <script type="text/javascript">
    $('#sampleTable').DataTable();
    //Thời Gian
    function time() {
      var today = new Date();
      var weekday = new Array(7);
      weekday[0] = "Chủ Nhật";
      weekday[1] = "Thứ Hai";
      weekday[2] = "Thứ Ba";
      weekday[3] = "Thứ Tư";
      weekday[4] = "Thứ Năm";
      weekday[5] = "Thứ Sáu";
      weekday[6] = "Thứ Bảy";
      var day = weekday[today.getDay()];
      var dd = today.getDate();
      var mm = today.getMonth() + 1;
      var yyyy = today.getFullYear();
      var h = today.getHours();
      var m = today.getMinutes();
      var s = today.getSeconds();
      m = checkTime(m);
      s = checkTime(s);
      nowTime = h + " giờ " + m + " phút " + s + " giây";
      if (dd < 10) {
        dd = '0' + dd
      }
      if (mm < 10) {
        mm = '0' + mm
      }
      today = day + ', ' + dd + '/' + mm + '/' + yyyy;
      tmp = '<span class="date"> ' + today + ' - ' + nowTime +
        '</span>';
      document.getElementById("clock").innerHTML = tmp;
      clocktime = setTimeout("time()", "1000", "Javascript");

      function checkTime(i) {
        if (i < 10) {
          i = "0" + i;
        }
        return i;
      }
    }
  </script>
 
</body>

</html>