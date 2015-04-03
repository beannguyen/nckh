<div class="row">
    <form method="post" action="<?php echo site_url('user/detail-user') ?>">
    <div class="col-md-6">
        <div class="input-group">
            <input type="text" class="form-control" name="user_id" placeholder="Nhập MSSV hoặc MSGV" required="required" />
            <span class="input-group-btn">
                <button name="info_nguoidung" type="submit" class="btn btn-primary">Tìm kiếm <i class="icon-search"></i></button>
            </span>
        </div>
    </div>
    </form>
</div>
<br />
<div class="btn-group">
    <button class="btn btn-danger" id="add_list">Thêm danh sách người dùng</button>
    <button class="btn btn-default" data-toggle="modal" data-target="#myModal">Thêm người dùng mới</button>
</div>
<div id="excel_input" style="display: none;">
    <hr />
    <form class="form-horizontal" method="post" enctype="multipart/form-data" action="<?php echo site_url('user/detail-user') ?>">
        <div class="form-group">
            <label class="col-sm-2 control-label">Chọn file excel </label>
            <div class="col-sm-6">
                <input type="file" name="ds_users_sinhvien" class="form-control" required="required" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" />
            </div>
            <div class="col-sm-3">
                <input type="submit" name="submit_ds_nguoidung"  class="btn btn-primary text-center btn-sm" value="Thêm danh sách" />
            </div>
        </div>
    </form>
</div>
<div class="clearfix"></div>
<hr />
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Thêm người dùng mới</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" role="form">
          <div class="form-group">
            <label class="col-sm-2 control-label">Username</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="u_name">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label">Họ tên</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="name">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label">Email</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="email">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label">Phone</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="phone">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label">C.Ngành</label>
            <div class="col-sm-10">
              <select id="c_nganh" class="form-control">
                <?php foreach ($ds_cn as $cn): ?>
                    <option value="<?php echo $cn->id ?>"><?php echo $cn->TenCN ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label">Usertype</label>
            <div class="col-sm-10">
              <select id="usertype" class="form-control">
                <option value="0">Chọn loại người dùng</option>
                <option value="sinhvien">Sinh Viên</option>
                <option value="giangvien">Giảng Viên</option>
              </select>
            </div>
          </div>
          <div id="sv_option" style="display: none;">
          <div class="form-group">
            <label class="col-sm-2 control-label">Lớp</label>
            <div class="col-sm-10">
              <select id="lop" class="form-control">
                <?php foreach ($ds_lop as $rows): ?>
                    <option value="<?php echo $rows->id ?>"><?php echo $rows->TenLop ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label">Điểm TB</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="diem">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label">Tổng TC</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="tong_tc">
            </div>
          </div>
          </div><!-- End sinhvien option -->
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" id="save" class="btn btn-primary">Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function(){
    //code ẩn hiện nút chọn excel
    $("#add_list").click(function(e){
        e.preventDefault();
        $("#excel_input").toggle();
    });
    //code ẩn hiện sinh viên option
    $("#usertype").change(function(){
        var type = $(this).val();
        if (type == 'sinhvien')
        {
            $("#sv_option").show();
        }
        else
        {
            $("#sv_option").hide();
        }
    });
    //code ajax save
    $("#save").click(function(){
        //validate
        if ($("#u_name").val() == '') {alert('Vui lòng nhập username');$("#u_name").focus();return false;}
        else if ($("#name").val() == '') {alert('Vui lòng nhập họ tên');$("#name").focus();return false;}
        else if ($("#email").val() == '') {alert('Vui lòng nhập email');$("#email").focus();return false;}
        else if ($("#phone").val() == '') {alert('Vui lòng nhập phone');$("#phone").focus();return false;}
        else if ($("#c_nganh").val() == '') {alert('Vui lòng nhập chuyên ngành');$("#c_nganh").focus();return false;}
        else if ($("#usertype").val() == '0') {alert('Vui lòng chọn loại người dùng');$("#usertype").focus();return false;}
        else
        {
            var form_data_reg = {
                reg_account:'yes',
                u_name:$("#u_name").val(),
                name:$("#name").val(),
                email:$("#email").val(),
                phone:$("#phone").val(),
                c_nganh:$("#c_nganh").val(),
                usertype:$("#usertype").val(),
                diem:$("#diem").val(),
                lop:$("#lop").val(),
                tong_tc:$("#tong_tc").val(),
            };
            $.ajax({
            url:'<?php echo site_url('user/detail-user') ?>',
            type:'POST',
            async:true,
            data: form_data_reg,
            success:function(mess_reg){
                alert(mess_reg);
            }
            })//end ajax
        }
    })
})
</script>
