<?php
class M_admin extends CI_Model{
    public function __construct()
    {
        parent::__construct();
    }
    # cấu hình
    public function get_danh_sach_loai_de_tai()
    {
        $this->db->select("tenloai,TenNK,NamBD,NamKT,hocky,namhoc,tb_cauhinh.id");
        $this->db->from('tb_cauhinh');
        $this->db->join('tb_nienkhoa','tb_cauhinh.nienkhoa = tb_nienkhoa.id');
        $this->db->join('tb_loaidetai','tb_cauhinh.loaidetai_id = tb_loaidetai.id');
        $this->db->order_by('NamBD desc,hocky desc');
        $query=$this->db->get();
        return $query->result();
    }
    public function get_chi_tiet_cau_hinh($id_cauhinh)
    {
        $this->db->select('tb_cauhinh.id,tb_cauhinh.loaidetai_id,soluongSVtoida,thoigianSVbatdaudk,thoigianSVketthucdk,nienkhoa,thoigianGVbatdaudk,thoigianGVketthucdk,hocky,namhoc,thoigianbdnhapgvpb,thoigianktnhapgvpb,dateupdate,soluongGVPBtoida,soluongGVHDtoida,thoigianSVktnopbc,diemTB,diemKHA,diemGIOI,tb_loaidetai.tenloai,NamBD,dateupdate');
        $this->db->from('tb_cauhinh');
        $this->db->join('tb_loaidetai','tb_loaidetai.id = tb_cauhinh.loaidetai_id');
        $this->db->join('tb_nienkhoa','tb_nienkhoa.id = tb_cauhinh.nienkhoa');
        $this->db->where('tb_cauhinh.id',$id_cauhinh);
        $query = $this->db->get();
        return $query->row();
    }
    public function get_giangvien()
    {
        $this->db->where('usertype','giangvien');
        $query = $this->db->get('tb_users');
        return $query->result();
    }
    public function get_nienkhoa()
    {
        $this->db->order_by("TenNK","asc");
        $query = $this->db->get('tb_nienkhoa');
        return $query->result();
    }
    public function get_lop()
    {
        $this->db->select('tb_lop.id,tb_nienkhoa.TenNK,TenLop,nienkhoa');
        $this->db->from('tb_lop');
        $this->db->join('tb_nienkhoa','tb_nienkhoa.id = tb_lop.nienkhoa');
        $this->db->order_by('tb_lop.id desc');
        $query = $this->db->get();
        return $query->result();
    }
    public function get_CN($id)
    {
        $this->db->where('id',$id);
        $query = $this->db->get('tb_chuyennganh');
        return $query->row();
    }
    public function get_sinhvien_cauhinh($cauhinh_id)
    {
        $this->db->select('*');
        $this->db->from('tb_sinhvien_cauhinh');
        $this->db->where('tb_sinhvien_cauhinh.cauhinh_id',$cauhinh_id);
        $this->db->join('tb_users','tb_users.id=tb_sinhvien_cauhinh.user_id');
        $this->db->order_by('tb_users.chuyennganh','asc');
        $query = $this->db->get();
        return $query->result();
    }
    public function delete_sinhvien_cauhinh($cauhinh_id,$id_sv)
    {
        $data = array('user_id' =>  $id_sv,'cauhinh_id' =>$cauhinh_id);
        $this->db->delete('tb_sinhvien_cauhinh',$data);
    }
    public function delete_all_sinhvien_cauhin($cauhinh)
    {
        $this->db->delete('tb_sinhvien_cauhinh',array('cauhinh_id'  =>  $cauhinh));
    }
    public function check_tontai_sv($mssv)
    {
        $this->db->from('tb_users');
        $this->db->where('username',$mssv);
        $query = $this->db->get();
        if ($query->num_rows() == 0)
        {
            return 0;
        } 
        else 
        {
            return $query->row();
        }
    }
    public function them_sinhvien_cauhinh($data)
    {
        $this->db->insert('tb_sinhvien_cauhinh',$data);
    }
    public function check_exist_data($data)
    {
        $this->db->from('tb_sinhvien_cauhinh');
        $this->db->where($data);
        $query = $this->db->get();
        if ($query->num_rows()==0)
        {
            return 1; //ok
        }
        else 
        {
            return 0;//da co record nay roi
        }
    }
    public function them_cauhinh($data)
    {
        $this->db->insert('tb_cauhinh',$data);
    }
    public function sua_cauhinh($id,$data)
    {
        $this->db->where('id', $id);
        $this->db->update('tb_cauhinh', $data); 
    }
    # thông báo
    public function get_all_thongbao()
    {
        $this->db->order_by('id desc');
        $query = $this->db->get('tb_thongbao');
        return $query->result();
    }
    public function them_thongbao($data)
    {
        $this->db->insert('tb_thongbao',$data);
    }
    public function check_tontai_thongbao($id)
    {
        $this->db->where('id',$id);
        $query = $this->db->get('tb_thongbao');
        $num = $query->num_rows();
        if ($num == 0)
        {
            return 0;
        }
        else return 1;
    }
    public function xoa_thongbao($id)
    {
        if ($this->check_tontai_thongbao($id) == 1)
        {
            $this->db->delete('tb_thongbao',array('id'  =>  $id));
        }
        else 
        {
            return 0;
        }
    }
    public function capnhat_thongbao($id,$data)
    {
        $this->db->where('id', $id);
        $this->db->update('tb_thongbao', $data); 
    }
    public function get_chitiet_thongbao($id_thongbao)
    {
        $this->db->where('id', $id_thongbao);
        $query = $this->db->get('tb_thongbao');
        return $query->row();
    }
    # người dùng
    public function find_user($id)
    {
        //$this->db->from('tb_users.id,name,username,email,usertype,registerDate,lastvisitDate,phone,chuyennganh,lop,diem,TongTC,TenCN');
        //$this->db->join('tb_chuyennganh','tb_users.chuyennganh = tb_chuyennganh.id');
        $this->db->select('tb_users.id,name,username,email,usertype,registerDate,lastvisitDate,phone,chuyennganh,lop,diem,TongTC,TenCN');
        $this->db->from('tb_users');
        $this->db->join('tb_chuyennganh','tb_chuyennganh.id=tb_users.chuyennganh');
        $this->db->where('username', $id);
        $query = $this->db->get();
        return $query->row();
    }
    public function them_ds_nguoidung($data)
    {
        $this->db->from('tb_users');
        $this->db->where('username',$data['username']);
        $query = $this->db->get();
        if ($query->num_rows()===0)
        {
            $this->db->insert('tb_users',$data);
            return true;
        }        
        else
        {
            return false;
        }
    }
    #niên khóa
    public function them_nk($data)
    {
        $this->db->from('tb_nienkhoa');
        $this->db->where('TenNK',$data['TenNK']);
        $query = $this->db->get();
        if ($query->num_rows()===0)
        {
            $this->db->insert('tb_nienkhoa',$data);
            return true;
        }        
        else
        {
            return false;
        }
    }
    public function sua_nk($data,$id)
    {
        $this->db->where('id', $id);
        $this->db->update('tb_nienkhoa', $data); 
        return true;
    }
    public function xoa_nk($id)
    {
        //kiem tra co lop nao thuoc nien khoa nay ko
        $this->db->where('nienkhoa',$id);
        $query = $this->db->get('tb_lop');
        $num = $query->num_rows();
        if ($num == 0)
        {
            //xoa ok
            $this->db->delete('tb_nienkhoa',array('id'  =>  $id));
            return true;
        }
        else 
        {
            return false;
        }
    }
    # lớp
    public function them_lop($data)
    {
        $this->db->where('TenLop',$data['TenLop']);
        $query = $this->db->get('tb_lop');
        $num = $query->num_rows();
        if ($num == 0)
        {
            $this->db->insert('tb_lop',$data);
            return true;
        }
        else 
        {
            return false;
        }
    }
    public function sua_lop($data,$id_lop)
    {
        $this->db->where('TenLop',$data['TenLop']);
        $query = $this->db->get('tb_lop');
        $num = $query->num_rows();
        if ($num == 0)
        {
            $this->db->where('id',$id_lop);
            $this->db->update('tb_lop',$data);
            return true;
        }
        else 
        {
            return false;
        }
    }
    public function xoa_lop($id)
    {
        //kiem tra co sinh vien nao thuoc lop nay ko
        $this->db->where('lop',$id);
        $query = $this->db->get('tb_users');
        $num = $query->num_rows();
        if ($num == 0)
        {
            //xoa ok
            $this->db->delete('tb_lop',array('id'  =>  $id));
            return true;
        }
        else 
        {
            return false;
        }
    }
    #chuyên ngành
    public function them_chuyennganh($data)
    {
        $this->db->where('TenCN',$data['TenCN']);
        $query = $this->db->get('tb_chuyennganh');
        $num = $query->num_rows();
        if ($num == 0)
        {
            $this->db->insert('tb_chuyennganh',$data);
            return true;
        }
        else 
        {
            return false;
        }
    }
    public function sua_cn($data,$id_cn)
    {
        $this->db->where('TenCN',$data['TenCN']);
        $query = $this->db->get('tb_chuyennganh');
        $num = $query->num_rows();
        if ($num == 0)
        {
            $this->db->where('id',$id_cn);
            $this->db->update('tb_chuyennganh',$data);
            return true;
        }
        else 
        {
            return false;
        }
    }
    public function xoa_cn($id)
    {
        //kiem tra co sinh vien nao thuoc chuyen nganh nay ko
        $this->db->where('chuyennganh',$id);
        $query = $this->db->get('tb_users');
        $num = $query->num_rows();
        if ($num == 0)
        {
            //xoa ok
            $this->db->delete('tb_chuyennganh',array('id'  =>  $id));
            return true;
        }
        else 
        {
            return false;
        }
    }
    # đề tài
    
}
?>