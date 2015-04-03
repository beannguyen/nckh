<?php
class M_dangdetai_gv extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function get_cauhinh_for_giangvien($curr_date)
    {
        $data = array (
            'thoigianGVbatdaudk <='    =>$curr_date,
            'thoigianGVketthucdk >='    =>$curr_date
        );
        $this->db->select('*');
        $this->db->from('tb_cauhinh');
        $this->db->where($data);
        $query = $this->db->get();
        return $query->row();
    }
    public function get_thongtin_cauhinh($cauhinh_id)
    {
        $this->db->select('*');
        $this->db->from('tb_cauhinh');
        $this->db->join('tb_loaidetai','tb_loaidetai.id = tb_cauhinh.loaidetai_id');
        $this->db->join('tb_nienkhoa','tb_cauhinh.nienkhoa = tb_nienkhoa.id');
        $this->db->where('tb_cauhinh.id',$cauhinh_id);
        $query = $this->db->get();
        return $query->row();
    }
    //Thêm
    public function them_detai_moi($data,$user_id,$detai_id)
    {
        $this->db->insert('tb_detai',$data);
        $this->them_detai_giangvien($user_id,$detai_id);
    }
    public function them_detai_giangvien($user_id,$detai_id)
    {
        $data = array('user_id' =>$user_id,'detai_id'   =>$detai_id,'gvchinh'   =>'1');
        $this->db->insert('tb_giangvien_detai',$data);
    }
    public function get_detai_giangvien($giangvien_id,$cauhinh_id)
    {
        $data = array(
        'tb_detai.cauhinh_id'   =>$cauhinh_id,
        'tb_giangvien_detai.user_id'    =>$giangvien_id
        );
        $this->db->select('*');
        $this->db->from('tb_detai');
        $this->db->join('tb_giangvien_detai','tb_giangvien_detai.detai_id = tb_detai.id');
        $this->db->where($data);
        $query = $this->db->get();
        return $query->result();
    }
    //Xoá
    public function get_detai_cauhinh($cauhinh_id){
        $this->db->select('id,user_id');
        $this->db->from('tb_detai');
        $this->db->join('tb_giangvien_detai','tb_detai.id = tb_giangvien_detai.detai_id');
        $this->db->where('cauhinh_id',$cauhinh_id);
        $query = $this->db->get();
        return $query->result();
    }
    public function kt_xoa_detai_giangvien($user_id,$detai_id)
    {
        $data = array(
        'user_id'       =>$user_id,
        'detai_id'      =>$detai_id
        );
        $this->db->from('tb_giangvien_detai');
        $this->db->where($data);
        return $this->db->count_all_results();
    }
    public function xoa_detai_giangvien($user_id,$detai_id)
    {
        $data = array(
        'user_id'       =>$user_id,
        'detai_id'      =>$detai_id
        );
        $this->db->where($data);
        $this->db->delete('tb_giangvien_detai');
        $this->xoa_sinhvien_detai($detai_id);
        $this->xoa_detai($detai_id);
    }
    public function xoa_detai($detai_id)
    {
        $this->db->delete('tb_detai',array('id'     =>$detai_id));
    }
    public function xoa_sinhvien_detai($detai_id)
    {
        $this->db->delete('tb_sinhvien_detai',array('detai_id'     =>$detai_id));
    }
    public function update_nhomtruong($detai_id){
        $data = array('truongnhom'  =>  NULL);
        $this->db->where('id',$detai_id);
        $this->db->update('tb_detai',$data);
    }
    public function xoa_2sinhvien_detai($detai_id)
    {
        $this->xoa_sinhvien_detai($detai_id);
        $this->update_nhomtruong($detai_id);
    }
    public function sua_detai($detai_id,$data)
    {
        $this->db->where('id',$detai_id);
        $this->db->update('tb_detai',$data);
    }
}
?>