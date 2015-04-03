<?php
    if (!empty($ketqua))
    {
		echo '<h3 style="color:#0000ff;">Bạn đã đăng ký chuyên ngành thành công</h3>';
	}
?>
<form id="dangkycn" class="form-horizontal" method="get" action="<?php echo base_url('user/xu-ly-dang-ky-chuyen-nganh/') ?>">
	<div class="form-group">
        <label class="col-sm-4 control-label">Nguyện vọng 1</label>
        <div class="col-sm-4">
            <select class="form-control" id="chuyenngan_1" name="chuyenngan_1" form="dangkycn">
                                    <option value="1" selected="">Công nghệ Phần mềm</option>
                                    <option value="2">Hệ thống Thông tin</option>
                                    <option value="3">Mạng máy tính</option>
                                    
                            </select>
        </div>
		</div>
		



	<div class="form-group">	
		<label class="col-sm-4 control-label">Nguyện vọng 2</label>
        <div class="col-sm-4">
            <select class="form-control" id="chuyenngan_2" name="chuyenngan_2">
                                    <option value="1">Công nghệ Phần mềm</option>
                                    <option value="2" selected="">Hệ thống Thông tin</option>
                                    <option value="3">Mạng máy tính</option>
                                    
                            </select>
        </div>
    </div>
<div class="modal-footer">
            <button  type="submit" class="btn btn-primary" id="dangky_cn">Đăng ký</button>
          
</div>

	</form>
<script>
var chuyennganhscript = ["","Công nghệ Phần mềm","Hệ thống Thông tin","Mạng máy tính"];
<?php
    if (!empty($ketqua))
    {
	?>
		$("#chuyenngan_1").val('<?php echo $ketqua[0]['chuyennganh']; ?>');
		$("#chuyenngan_2").val('<?php echo $ketqua[1]['chuyennganh']; ?>');
		alert("Bạn đã đăng ký chuyên ngành:\nNguyện vọng 1: "+ chuyennganhscript[<?php echo $ketqua[0]['chuyennganh'];?>] + "\nNguyện vọng 2: "+ chuyennganhscript[<?php echo $ketqua[1]['chuyennganh'];?>]);
		<?php
	}
?>


$("#chuyenngan_2").change(function() {
  if($("#chuyenngan_2").val()==$("#chuyenngan_1").val()){
		alert("Bạn phải chọn hai nguyện vọng khác nhau");
		$("#dangky_cn").hide();
  }
  else{
		$("#dangky_cn").show();
  }
});
$("#chuyenngan_1").change(function() {
  if($("#chuyenngan_2").val()==$("#chuyenngan_1").val()){
		alert("Bạn phải chọn hai nguyện vọng khác nhau");
		$("#dangky_cn").hide();
  }
  else{
		$("#dangky_cn").show();
  }
});
</script>