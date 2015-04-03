<!-- =========================Tìm kiếm box================================ -->
<div class="modal fade" id="seach_box">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Tìm kiếm</h4>
      </div>
      <form action="<?php echo base_url('tim-kiem.chn') ?>" method="post" id="cpa-form">
          <div class="modal-body">
            <div id="err_tk"></div>
            <select class="form-control text-center" name="param_option" id="tim_kiem_tong_hop">
                <option <?php if (isset($selected) && $selected=="giangvien") echo "selected"; ?> value="timkiemgiangvien">Tìm kiếm giảng viên</option>
                <option <?php if (isset($selected) && $selected=="sinhvien") echo "selected"; ?> value="timkiemsinhvien">Tìm kiếm sinh viên</option>
                <option <?php if (isset($selected) && $selected=="detai") echo "selected"; ?> value="timkiemdetai">Tìm kiếm đề tài</option>  
            </select>
            <br />
            <label>Nhập từ khoá :</label>
            <input type="text"  class="form-control" id="parameter1" name="param_textbox" value="<?php if (isset($str_param)) echo $str_param;?>" placeholder="Tìm kiếm gì đó ...." />
            <div class="clear"></div>
            <div id="search_advance">
                <br />
                <div id="type_detai" style="display: none;">
                    <fieldset>
                        <legend>Chọn loại đề tài</legend>
                        <?php
                            $i=1;
                            foreach ($query_ds_loai_de_tai as $loai_dt)
                            {
                                if (isset($luu_vet_de_tai) && $luu_vet_de_tai==$loai_dt->id)
                                {
                                    ?>
                                        <input checked type="radio" name="group_loaidt" value="<?php echo $loai_dt->id ?>"/>
                                        <?php echo $loai_dt->tenloai.' | K 20'.$loai_dt->TenNK ?><br/>
                                    <?php
                                    $i++;
                                }
                                else
                                {
                                    if ($i==1)
                                    {
                                        ?>
                                            <input checked type="radio" name="group_loaidt" value="<?php echo $loai_dt->id ?>"/>
                                            <?php echo $loai_dt->tenloai.' | K 20'.$loai_dt->TenNK ?><br/>
                                        <?php
                                        $i++;
                                    }
                                    else
                                    {
                                        ?>
                                            <input type="radio" name="group_loaidt" value="<?php echo $loai_dt->id ?>"/>
                                            <?php echo $loai_dt->tenloai.' | K 20'.$loai_dt->TenNK ?><br/>
                                        <?php
                                    }
                                }
                            }
                        ?>
                    </fieldset>
            </div><!-- End #search_advance -->
          </div><!--End body -->
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary"  id="timkiem_btn">Tìm kiếm</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
</div>