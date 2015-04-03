<?php
class M_dangkydetai extends CI_Model{
    public function __construct(){
        parent::__construct();
    }
    public function get_start_cauhinh($curr_date)
    {
        $data = array (
        'thoigianSVbatdaudk <='    =>$curr_date,
        'thoigianSVketthucdk >='    =>$curr_date
        );
        $this->db->select('*');
        $this->db->from('tb_cauhinh');
        $this->db->where($data);
        $query = $this->db->get();
        return $query->row();
    }
    public function get_info_cauhinh($cauhinh_id)
    {
        $this->db->select('thoigianSVbatdaudk,thoigianSVketthucdk,thoigianGVbatdaudk,thoigianGVketthucdk,tenloai,TenNK,NamBD');
        $this->db->from('tb_cauhinh');
        $this->db->join('tb_loaidetai','tb_loaidetai.id=tb_cauhinh.loaidetai_id');
        $this->db->join('tb_nienkhoa','tb_cauhinh.nienkhoa = tb_nienkhoa.id');
        $this->db->where('tb_cauhinh.id',$cauhinh_id);
        $query = $this->db->get();
        return $query->row();
    }
    public function get_cauhinh_for_sinhvien($curr_date){
        $data = array (
            'thoigianSVbatdaudk <='    =>$curr_date,
            'thoigianSVketthucdk >='    =>$curr_date
        );
        $this->db->select('*');
        $this->db->from('tb_cauhinh');
        $this->db->where($data);
        $query = $this->db->get();
        return $query->row();
    }
    public function kt_cauhinh_sinhvien($cauhinh_id,$user_id)
    {
        $data = array ('user_id'    => $user_id,'cauhinh_id' =>$cauhinh_id);
        $this->db->from('tb_sinhvien_cauhinh');
        $this->db->where($data);
        $count =  $this->db->count_all_results();
        if ($count == 0)
        {
            return false;
        }
        else
        return true;
    }
    public function get_id_detai($id_user)
    {
        $this->db->where('user_id',$id_user);
        $this->db->order_by('detai_id','desc');
        $query = $this->db->get('tb_sinhvien_detai');
        return $query->row();
    }
    public function da_dang_ky_de_tai($id_user,$cauhinh_id)
    {
        $sql = "select * from tb_sinhvien_detai
                where user_id= ? AND detai_id IN 
                (SELECT id from tb_detai where cauhinh_id= ?)";
        $query = $this->db->query($sql,array($id_user,$cauhinh_id)) ; 
        $kq =  $query->result();
        if (empty($kq))
        {
            return false;
        }
        else return true;
    }
    public function dk_nhom_truong($id_user,$id_detai,$cauhinh_id)
    {
        $data = array('truongnhom'  => $id_user);
        $this->db->where('id',$id_detai);
        $this->db->update('tb_detai',$data);
        $this->them_sinhvien_detai($id_user,$id_detai,NULL);
        $this->ghi_lai_lichsu($id_user,$cauhinh_id,'1',$id_detai);
    }
    public function kt_detai_dangky_roi($id_detai)
    {
        $this->db->from('tb_sinhvien_detai');
        $this->db->where('detai_id',$id_detai);
        //$query=$this->db->get();
        $kq =  $this->db->count_all_results();
        if ($kq==0)
        {
            //chua dk
            return false;
        }
        else 
        {
            return true;
        }
    }
    public function kt_detai_cauhinh_hople($detai_id,$cauhinh_id)
    {
        $data =  array(
        'id'        =>$detai_id,
        'cauhinh_id'=>$cauhinh_id
        );
        $this->db->from('tb_detai');
        $this->db->where($data);
        $kq = $this->db->count_all_results();
        if ($kq==0) 
        {
            return false;
        }
        else {return true;}
    }
    public function them_sinhvien_detai($id_user,$id_detai,$cauhinh_id)
    {
        $id_nguoithem = $this->session->userdata('id_user');
        $data=array('user_id'   =>$id_user,'detai_id'   =>$id_detai);
        $this->db->insert('tb_sinhvien_detai',$data);
        $id_nguoithem = $this->session->userdata('id_user');
        if (!empty($cauhinh_id))
        {
            $this->ghi_lai_lichsu($id_user,$cauhinh_id,'2',$id_detai);
            $this->ghi_lai_lichsu($id_nguoithem,$cauhinh_id,'5',$id_detai);
        }
    }
    public function kt_tontai_sinhvien($id_user)
    {
        $this->db->from('tb_users');
        $this->db->where('username',$id_user);
        return $this->db->count_all_results();
    }
    public function kt_duocdkkhaccn($detai_id)
    {
        $data = array('id' => $detai_id);
        $this->db->from('tb_detai');
        $this->db->where($data);
        $query = $this->db->get()->row();
        if ($query->duocdkkhaccn == '1') return true;
        else return false;
    }
    public function get_info_detai($detai_id)
    {
        $this->db->where(array('id' =>$detai_id));
        $query = $this->db->get('tb_detai');
        return $query->row();
    }
    public function huy_nhom_truong($detai_id,$id_nhomtruong,$id_thanhvien,$cauhinh_id)
    {
        $data =array('user_id'  =>$id_nhomtruong,'detai_id'   =>$detai_id);
        $this->db->where('id',$detai_id);
        $this->db->update('tb_detai',array('truongnhom'   => $id_thanhvien));
        $this->huy_detai_sinhvien($detai_id,$id_nhomtruong,NULL);
        $this->ghi_lai_lichsu($id_nhomtruong,$cauhinh_id,'3',$detai_id);
        if (!empty($id_thanhvien))
        {
            $this->ghi_lai_lichsu($id_thanhvien,$cauhinh_id,'1',$detai_id);
        }
    }
    public function huy_detai_sinhvien($detai_id,$id_user,$cauhinh_id)
    {
        $data =array('user_id'  =>$id_user,'detai_id'   =>$detai_id);
        $this->db->where($data);
        $this->db->delete('tb_sinhvien_detai');
        if (!empty($cauhinh_id))
        {
            $this->ghi_lai_lichsu($id_user,$cauhinh_id,'4',$detai_id);
        } 
    }
    public function is_truong_nhom($id_user,$cauhinh_id)
    {
        $data =array('truongnhom'   => $id_user,'cauhinh_id'    => $cauhinh_id);
        $this->db->from('tb_detai');
        $this->db->where($data);
        $query = $this->db->count_all_results();
        if ($query ===0)
        {
            return false;
        }
        else
        {
            //là trưởng nhóm
            return true;
        }
    }
    public function them_thu_vao_nhom($id_nguoigui,$detai_id,$cauhinh_id)
    {
        $data = array ('id_nguoigui'    =>$id_nguoigui,'detai_id'   =>$detai_id,'cauhinh_id'    =>$cauhinh_id);
        if ($this->kt_them_thu_vao_nhom($data) == 0)
        {
            $data1 = array ('id_nguoigui'    =>$id_nguoigui,
                            'detai_id'   =>$detai_id,
                            'cauhinh_id'    =>$cauhinh_id,
                            'time'          =>date('Y-m-d H:i:s'),
                            );
            $this->db->insert('tb_xinvaonhom',$data1);
        }
        else
        {
            return false;
        }
    }
    public function kt_them_thu_vao_nhom($data)
    {
        $this->db->from('tb_xinvaonhom');
        $this->db->where($data);
        return $this->db->count_all_results();
    }
    public function count_thu_vao_nhom($cauhinh_id,$detai_id,$id_nguoigui)
    {
        $data=array('detai_id'  =>$detai_id,'cauhinh_id'    =>$cauhinh_id,'id_nguoigui !=' =>$id_nguoigui);
        $this->db->from('tb_xinvaonhom');
        $this->db->where($data);
        return $this->db->count_all_results();
    }
    public function get_thu_vao_nhom($cauhinh_id,$detai_id,$id_nguoigui)
    {
        $my_array = ('');
        $i=0;
        $data=array('detai_id'  =>$detai_id,'cauhinh_id'    =>$cauhinh_id,'id_nguoigui !=' =>$id_nguoigui);
        $this->db->from('tb_xinvaonhom');
        $this->db->order_by('time desc');
        $this->db->where($data);
        $query = $this->db->get();
        return $query->result();
    }
    public function xoa_thu_vao_nhom($data)
    {
        $this->db->where($data);
        $this->db->delete('tb_xinvaonhom');   
    }
    public function get_id_truong_nhom($detai_id)
    {
        $this->db->select('truongnhom');
        $this->db->from('tb_detai');
        $this->db->where('id',$detai_id);
        $query=$this->db->get();
        return $query->row();
    }
    # Lịch sử hoạt động
    public function ghi_lai_lichsu($user_id,$cauhinh_id,$hoatdong_id,$detai_id)
    {
        $data = array (
        'user_id'   =>$user_id,
        'cauhinh_id'=>$cauhinh_id,
        'hoatdong_id'=>$hoatdong_id,
        'thoigian'  => date('Y-m-d H:i:s'),
        'detai_id'  =>$detai_id
        );
        $this->db->insert('tb_xlichsu_nguoidung',$data);
    }
    public function get_lichsu($user_id)
    {
        $data = array ('user_id'    =>$user_id);
        $this->db->select('tb_detai.tendetai,tb_xlichsu_nguoidung.thoigian,tendetai,tenhoatdong,tb_detai.id');
        $this->db->from('tb_xlichsu_nguoidung');
        $this->db->join('tb_detai','tb_xlichsu_nguoidung.detai_id = tb_detai.id');
        $this->db->join('tb_xhoatdong','tb_xhoatdong.id = tb_xlichsu_nguoidung.hoatdong_id');
        $this->db->where($data);
        $this->db->order_by('tb_xlichsu_nguoidung.thoigian asc');
        $query = $this->db->get();
        return $query->result();
    }
}
?>