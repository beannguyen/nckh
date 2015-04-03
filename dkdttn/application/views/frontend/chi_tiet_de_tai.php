<div id="detail">
    <table class="table table-hover">
        <tr>
            <td>Tên đề tài</td>
            <td><?php echo $arr_detail->tendetai ?></td>
        </tr>
        <tr>     
            <td>Mục tiêu</td>
            <td><?php echo nl2br($arr_detail->muctieu) ?></td>
        </tr>
        <tr>   
            <td>Yêu cầu</td>
            <td><?php echo nl2br($arr_detail->yeucau) ?></td>
        </tr> 
        <tr>       
            <td>Sản phẩm</td>
            <td><?php echo nl2br($arr_detail->sanpham) ?></td>
        </tr> 
        <tr>     
            <td>Chú thích</td>
            <td><?php echo nl2br($arr_detail->chuthich) ?></td>
        </tr>   
        <tr>      
            <td>SL sinh viên</td>
            <td><?php echo '<span class="badge green">'.$soluong_thanhvien_dadangky.'</span> / <span class="badge red">'.$arr_detail->soluongSVtoida.'</span>' ?></td>
        </tr>
        <tr>
            <td>Được phép đăng ký khác chuyên ngành</td>
            <td><?php if ($arr_detail->duocdkkhaccn == 1) echo 'Có'; else echo 'Không';  ?></td>
        </tr>
        <!--  
        <tr>     
            <td>Thời gian bắt đầu bảo vệ</td>
            <td><?php echo $arr_detail->timebatdaubaove ?></td>
        </tr>   
        <tr>      
            <td>Thời gian kết thúc bảo vệ</td>
            <td><?php echo $arr_detail->timeketthucbaove ?></td>
        </tr>
        -->
        <tr>     
            <td>Chuyên ngành</td>
            <td><?php echo @$arr_detail->TenCN ?></td>
        </tr>   
        <tr>      
            <td>Loại đề tài</td>
            <td><?php echo @$arr_detail->tenloai ?></td>
        </tr>  
        <tr>  
            <td>Trạng thái</td>
            <td><?php echo @$arr_detail->tenTT ?></td>
        </tr>    
        <tr>     
            <td>Niên khóa</td>
            <td>20<?php echo @$arr_detail->TenNK ?></td>
        </tr>   
        <tr class="success">       
            <td>Trưởng nhóm</td>
            <td>
            <?php
                if (!empty($arr_nhomtruong))
                { 
                    echo '<a data-toggle="modal" href="#truong_nhom">'.$arr_nhomtruong->name.'</a>';
                } 
            ?>
            </td>
        </tr> 
        <tr>        
            <td>Thành viên</td>
            <td><?php 
            if (!empty($arr_thanhvien))
                { 
                   foreach ($arr_thanhvien as $rows)
                   {
                        //echo '<a data-toggle="modal" href="#thanh_vien">'.$rows->name.'</a>'.'<br>';
                        ?>
                        <a data-toggle="modal" href="#thanh_vien<?php echo $rows->id ?>" ><?php echo $rows->name ?></a><br />
                        <!-- ========================== Info thanh vien ==========================-->
                        <div class="modal fade" id="thanh_vien<?php echo $rows->id ?>">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title">Thông tin thành viên</h4>
                              </div>
                              <div class="modal-body">
                                <?php
                                    if (!empty($arr_thanhvien))
                                    {
                                        $this->load->model('m_user');
                                        $info_thanhvien = $this->m_user->get_info_user($rows->id);
                                        $url_member = 'http://online.hcmute.edu.vn/HinhSV/'.$info_thanhvien->username.'.jpg';
                                        ?>
                                        <img style="width: 92px;height:102px;" class="pull-right img-thumbnail" src="<?php echo $url_member ?>" />
                                        <label>Họ tên : <span class="text-info"><?php echo $info_thanhvien->name ?></span></label><br />
                                        <label>MSSV : <span class="text-info"><?php echo $info_thanhvien->username ?></span></label><br />
                                        <label>Chuyên ngành : <span class="text-info"><?php echo $info_thanhvien->TenCN ?></span></label><br />
                                        <label>Số điện thoại : <span class="text-info"><?php echo $info_thanhvien->phone ?></span></label><br />
                                        <label>Email : <span class="text-info"><?php echo $info_thanhvien->email ?></span></label><br />  
                                        <?php
                                    }
                                ?>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                              </div>
                            </div><!-- /.modal-content -->
                          </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->
                        <?php 
                   }
                } 
            ?>
            </td>
        </tr>
        <tr class="danger">   
            <td>GV hướng dẫn </td>
            <td>
            <?php
                if (!empty($arr_giangvien_huongdan))
                {
                    echo '<a data-toggle="modal" href="#GVHD">'.$arr_giangvien_huongdan->name.'</a>'; 
                }
            ?>
            </td>
        </tr>    
        <tr class="warning">       
            <td>GV phản biện</td>
            <td>
            <?php
                if (!empty($arr_giangvien_phanbien))
                { 
                    echo '<a data-toggle="modal" href="#GVPB">'.$arr_giangvien_phanbien->name.'</a>'; 
                }
            ?>
            </td>   
        </tr>
        <tr>
            <td>Điểm đề tài</td>
            <?php
                if (!empty($diem_detai))
                {
                    echo '<td><span class="badge red">'.@$diem_detai.'</span></td>';
                }
                else
                {
                    echo '<td>Chưa có điểm</td>';
                }
            ?>
        </tr>
        <tr>
            <td colspan="2" style="text-align: center;"><button id="back" type="button" class="btn btn-info">Quay về</button></td>
        </tr>
    </table>
</div>
<!-- ========================== Info nhom truong ==========================-->
<div class="modal fade" id="truong_nhom">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Thông tin nhóm trưởng</h4>
      </div>
      <div class="modal-body">
        <?php
            if (!empty($arr_nhomtruong))
            {
                $this->load->model('m_user');
                $info_nhomtruong = $this->m_user->get_info_user($arr_nhomtruong->id);
                $url = 'http://online.hcmute.edu.vn/HinhSV/'.$info_nhomtruong->username.'.jpg';
                ?>
                <img style="width: 92px;height:102px;" class="pull-right img-thumbnail" src="<?php echo $url ?>" />
                <label>Họ tên : <span class="text-info"><?php echo $info_nhomtruong->name ?></span></label><br />
                <label>MSSV : <span class="text-info"><?php echo $info_nhomtruong->username ?></span></label><br />
                <label>Chuyên ngành : <span class="text-info"><?php echo $info_nhomtruong->TenCN ?></span></label><br />
                <label>Số điện thoại : <span class="text-info"><?php echo $info_nhomtruong->phone ?></span></label><br />
                <label>Email : <span class="text-info"><?php echo $info_nhomtruong->email ?></span></label><br />  
                <?php
            }
        ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- ========================== Info GVHD ==========================-->
<div class="modal fade" id="GVHD">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Thông tin GVHD</h4>
      </div>
      <div class="modal-body">
        <?php
            if (!empty($arr_giangvien_huongdan))
            {
                $this->load->model('m_user');
                $info_GVHD = $this->m_user->get_info_user($arr_giangvien_huongdan->id);
                if (!empty($info_GVHD->avatar))
                {
                    ?>
                    <img class="pull-right img-thumbnail" src="<?php echo base_url('public/images/upload-image/'.$info_GVHD->avatar) ?>" />
                    <?php
                }
                ?>
                <label>Họ tên : <span class="text-info"><?php echo $info_GVHD->name ?></span></label><br />
                <label>Chuyên ngành : <span class="text-info"><?php echo $info_GVHD->TenCN ?></span></label><br />
                <label>Số điện thoại : <span class="text-info"><?php echo $info_GVHD->phone ?></span></label><br />
                <label>Email : <span class="text-info"><?php echo $info_GVHD->email ?></span></label><br />  
                <?php
            }
        ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- ========================== Info GVPB ==========================-->
<div class="modal fade" id="GVPB">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Thông tin GVPB</h4>
      </div>
      <div class="modal-body">
        <?php
            if (!empty($arr_giangvien_phanbien))
            {
                $this->load->model('m_user');
                $info_GVPB = $this->m_user->get_info_user($arr_giangvien_phanbien->id);
                ?>
                <label>Họ tên : <span class="text-info"><?php echo $info_GVPB->name ?></span></label><br />
                <label>Chuyên ngành : <span class="text-info"><?php echo $info_GVPB->TenCN ?></span></label><br />
                <label>Số điện thoại : <span class="text-info"><?php echo $info_GVPB->phone ?></span></label><br />
                <label>Email : <span class="text-info"><?php echo $info_GVPB->email ?></span></label><br />  
                <?php
            }
        ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->