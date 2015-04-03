<?php
class M_timkiem extends CI_Model{
    public function __construct(){
        parent::__construct();
    }
    public function get_giang_vien($ten_giang_vien){
        
        $this->db->select('tb_users.id,name,email,usertype,phone,chuyennganh,TenCN');
        $this->db->from('tb_users');
        $this->db->join('tb_chuyennganh','tb_users.chuyennganh=tb_chuyennganh.id');
        $this->db->where('usertype','giangvien');
        $this->db->like('name',$ten_giang_vien);
        $query=$this->db->get();
        $rowcount = $query->num_rows();
        return array('query'    =>$query->result(),'row_count'    =>$rowcount);
        //return $query->result();
    }
    public function get_sinh_vien($ten_sv)
    {
        $this->db->select('tb_users.id,name,email,usertype,phone,chuyennganh,TenCN,username');
        $this->db->from('tb_users');
        $this->db->join('tb_chuyennganh','tb_users.chuyennganh=tb_chuyennganh.id');
        $this->db->where('usertype','sinhvien');
        $this->db->like('name',$ten_sv);
        $this->db->order_by('username desc');
        $query=$this->db->get();
        $rowcount = $query->num_rows();
        return array('query'    =>$query->result(),'row_count'    =>$rowcount);
    }
    public function get_sinh_vien_mssv($id_sv)
    {
        $data = array('usertype' => 'sinhvien','username' => $id_sv);
        $this->db->select('tb_users.id,name,email,usertype,phone,chuyennganh,TenCN,username');
        $this->db->from('tb_users');
        $this->db->join('tb_chuyennganh','tb_users.chuyennganh=tb_chuyennganh.id');
        $this->db->where($data);
        $this->db->order_by('username desc');
        $query=$this->db->get();
        $rowcount = $query->num_rows();
        return array('query'    =>$query->result(),'row_count'    =>$rowcount);
    }
    public function get_de_tai($data)
    {
        $this->db->select('tb_detai.tendetai,tb_users.name,tb_detai.truongnhom,tb_detai.soluongSVtoida,tb_detai.id,tb_detai.cauhinh_id,TenCN');
        $this->db->from('tb_detai');
        $this->db->join('tb_chuyennganh','tb_chuyennganh.id=tb_detai.chuyennganh');
        $this->db->join('tb_giangvien_detai','tb_giangvien_detai.detai_id=tb_detai.id');
        $this->db->join('tb_users','tb_users.id=tb_giangvien_detai.user_id');
        $this->db->like('tb_detai.tendetai',$data['ten_detai']);
        $this->db->where('tb_detai.cauhinh_id',$data['loai_detai']);
        if (!empty($data['id_chuyennganh']))
        {
            $this->db->where('tb_detai.chuyennganh',$data['id_chuyennganh']);
        }
        if (!empty($data['id_tinhtrang']))
        {
            if ($data['id_tinhtrang']=="chua_dang_ky")
            {
                $this->db->where('tb_detai.truongnhom',NULL);
            }
            else
            {
                $this->db->where('tb_detai.truongnhom IS NOT NULL',NULL,false);
            }
        }
        if (!empty($data['id_chuyennganh']) && !empty($data['id_tinhtrang']))
        {
            $this->db->where('tb_detai.chuyennganh',$data['id_chuyennganh']);
            if ($data['id_tinhtrang']=="chua_dang_ky")
            {
                $this->db->where('tb_detai.truongnhom',NULL);
            }
            else
            {
                $this->db->where('tb_detai.truongnhom IS NOT NULL',NULL,false);
            }
        }
        $query=$this->db->get();
        $rowcount = $query->num_rows();
        return array('query'    =>$query->result(),'row_count'    =>$rowcount);
    }
    public function get_ct_detai($id_detai)
    {
        $this->db->select('tb_detai.tendetai,tb_users.name,tb_detai.truongnhom,tb_detai.soluongSVtoida,tb_detai.id,tb_detai.cauhinh_id,TenCN');
        $this->db->from('tb_detai');
        $this->db->join('tb_chuyennganh','tb_chuyennganh.id=tb_detai.chuyennganh');
        $this->db->join('tb_giangvien_detai','tb_giangvien_detai.detai_id=tb_detai.id');
        $this->db->join('tb_users','tb_users.id=tb_giangvien_detai.user_id');
        $this->db->where('tb_detai.id',$id_detai);
        $query=$this->db->get();
        $rowcount = $query->num_rows();
        return array('query'    =>$query->result(),'row_count'    =>$rowcount);
    }
    

}
?>