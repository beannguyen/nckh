<form class="form-horizontal" method="post" action="<?php echo site_url('user/them-thong-bao') ?>">
    <div class="form-group">
        <label class="col-sm-2 control-label">Tiêu đề</label>
        <div class="col-sm-10">
            <textarea cols="3" name="title" class="form-control" required="required"></textarea>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Nội dung</label>
        <div class="col-sm-10">
            <textarea cols="8" class="form-control" required="required" id="noidung" name="noidung"></textarea>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label"></label>
        <div class="col-sm-10">
            <input type="submit" class="btn btn-primary" value="Save" />
            <input type="reset" class="btn btn-default" value="Nhập lại" />
        </div>
    </div>
</form>
<script type="text/javascript">
   CKEDITOR.replace('noidung', { 
   });
   $(function() {
    $('#noidung').ckeditor({
        toolbar: 'Full',
        enterMode : CKEDITOR.ENTER_P
    });
});
</script>