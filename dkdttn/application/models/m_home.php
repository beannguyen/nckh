<?php
class M_home extends CI_Model{
    public function __construct(){
        parent::__construct();
    }
    public function get_thongbao()
    {
        $this->db->order_by('cotinmoi desc,id desc');
        $this->db->limit('8');
        $query=$this->db->get('tb_thongbao');
        return $query->result();
    }
    public function get_chi_tiet_tin($id_news)
    {
        $this->db->where('id',$id_news);
        $query = $this->db->get('tb_thongbao');
        return $query->row();
    }
    public function get_tin_lien_quan($id_news)
    {
        $this->db->order_by('ngaycapnhat desc');
        $this->db->where('id !=',$id_news);
        $this->db->limit('6');
        $query = $this->db->get('tb_thongbao');
        return $query->result();
    }
    public function get_random_tin()
    {
        $this->db->select('*');
        $this->db->where('cotinmoi','1');
        $this->db->order_by('id','desc');
        $this->db->limit(1);
        $query = $this->db->get('tb_thongbao');
        return $query->row();
    }
    /*---------------------------- Lấy tất cả loại đề tài --------------------*/
    public function get_danh_sach_loai_de_tai()
    {
        $curYear=date("Y")-3;
        $data = array(
            'NamBD <='      =>$curYear
        );
        $this->db->select("tenloai,TenNK,NamBD,NamKT,hocky,namhoc,tb_cauhinh.id");
        $this->db->from('tb_cauhinh');
        $this->db->join('tb_nienkhoa','tb_cauhinh.nienkhoa = tb_nienkhoa.id');
        $this->db->join('tb_loaidetai','tb_cauhinh.loaidetai_id = tb_loaidetai.id');
        $this->db->where($data);
        $this->db->order_by('NamBD desc,hocky desc');
        $this->db->limit('4');
        $query=$this->db->get();
        return $query->result();
    }
    public function get_ten_loai_de_tai($cauhinh_id)
    {
        $this->db->select("tenloai,TenNK,tb_cauhinh.id,namhoc,hocky,");
        $this->db->from('tb_cauhinh');
        $this->db->join('tb_nienkhoa','tb_cauhinh.nienkhoa = tb_nienkhoa.id');
        $this->db->join('tb_loaidetai','tb_cauhinh.loaidetai_id = tb_loaidetai.id');
        $this->db->where('tb_cauhinh.id',$cauhinh_id);
        $query=$this->db->get();
        return $query->row();
    }
    public function count_all_ds_loai_de_tai()
    {
        $this->db->select("id");
        $this->db->from('tb_detai');
        $this->db->where('cauhinh_id',"5");
        return $this->db->count_all_results();
    }
    /* ------------------danh sách đề tài theo loại đề tài ----------------------*/
    public function get_danh_sach_de_tai_loai_de_tai($cauhinh_id,$per_pg,$offset)
    {
        $this->db->select('tb_detai.tendetai,tb_users.name,tb_detai.truongnhom,tb_detai.soluongSVtoida,tb_detai.id,tb_detai.cauhinh_id,TenCN');
        $this->db->from('tb_detai');
        $this->db->join('tb_chuyennganh','tb_chuyennganh.id=tb_detai.chuyennganh');
        $this->db->join('tb_giangvien_detai','tb_giangvien_detai.detai_id=tb_detai.id');
        $this->db->join('tb_users','tb_users.id=tb_giangvien_detai.user_id');
        $this->db->where('cauhinh_id',$cauhinh_id);
        $this->db->limit($per_pg,$offset);
        $query=$this->db->get();
        return $query->result();
    }
    public function count_so_luong_sinhvien_detai($id_detai)
    {
        $this->db->select('*');
        $this->db->from('tb_sinhvien_detai');
        $this->db->where('detai_id',$id_detai);
        return $this->db->count_all_results();
    }
    public function count_danh_sach_de_tai_loai_de_tai($cauhinh_id)
    {
        $this->db->select('id,cauhinh_id');
        $this->db->from('tb_detai');
        $this->db->where('cauhinh_id',$cauhinh_id);
        return $this->db->count_all_results();
    }
    /*---------------------Danh sách đề tài theo loai de tai và theo chuyên ngành------------------*/
    public function get_danh_sach_de_tai_loai_de_tai_chuyen_nganh($cauhinh_id,$chuyennganh,$per_pg,$offset)
    {
        if ($chuyennganh!='5')
        {
            $data = "(cauhinh_id = $cauhinh_id AND tb_detai.chuyennganh=$chuyennganh)  OR (cauhinh_id = $cauhinh_id AND tb_detai.duocdkkhaccn = '1')";
        }
        else
        {
            $data=array('cauhinh_id'    =>$cauhinh_id);
        }                  
        $this->db->select('tb_detai.tendetai,tb_users.name,tb_detai.truongnhom,tb_detai.soluongSVtoida,tb_detai.id,tb_detai.cauhinh_id,TenCN,tb_detai.chuyennganh');
        $this->db->from('tb_detai');
        $this->db->join('tb_chuyennganh','tb_chuyennganh.id=tb_detai.chuyennganh');
        $this->db->join('tb_giangvien_detai','tb_giangvien_detai.detai_id=tb_detai.id');
        $this->db->join('tb_users','tb_users.id=tb_giangvien_detai.user_id');
        $this->db->where($data);
        $this->db->limit($per_pg,$offset);
        $query=$this->db->get();
        return $query->result();
    }
    public function count_danh_sach_de_tai_loai_de_tai_theo_chuyen_nganh($cauhinh_id,$chuyennganh)
    {
        if ($chuyennganh!='5')
        {
            /*
            $data=array(
            'cauhinh_id'    =>$cauhinh_id,
            'tb_detai.chuyennganh'  =>$chuyennganh);
            */
            $data = "(cauhinh_id = $cauhinh_id AND tb_detai.chuyennganh=$chuyennganh)  OR (cauhinh_id = $cauhinh_id AND tb_detai.duocdkkhaccn = '1')";
        }
        else
        {
            $data=array('cauhinh_id'    =>$cauhinh_id);
        }           
        $this->db->select('tb_detai.cauhinh_id');
        $this->db->from('tb_detai');
        $this->db->join('tb_chuyennganh','tb_chuyennganh.id=tb_detai.chuyennganh');
        $this->db->join('tb_giangvien_detai','tb_giangvien_detai.detai_id=tb_detai.id');
        $this->db->join('tb_users','tb_users.id=tb_giangvien_detai.user_id');
        $this->db->where($data);
        return $this->db->count_all_results();
    }
    public function get_giangvien_chuyennganh_co_detai($id_chuyennganh,$cauhinh_id)
    {
        $data=array(
        'usertype'      =>'giangvien',
        'tb_detai.chuyennganh'   =>$id_chuyennganh,
        'tb_detai.cauhinh_id'   =>$cauhinh_id
        );
        $this->db->select('tb_users.id,name,email,usertype,phone,tb_users.chuyennganh,TenCN');
        $this->db->distinct('tb_users.id');
        $this->db->from('tb_users');
        $this->db->join('tb_chuyennganh','tb_users.chuyennganh=tb_chuyennganh.id');
        $this->db->join('tb_giangvien_detai','tb_giangvien_detai.user_id = tb_users.id');
        $this->db->join('tb_detai','tb_detai.id = tb_giangvien_detai.detai_id');
        $this->db->where($data);
        $query=$this->db->get();
        return $query->result();
    }
    public function get_detai_giangvien_chuyennganh($giangvien_id,$cauhinh_id,$chuyennganh_id)
    {
        $data = array(
        'tb_detai.cauhinh_id'   =>$cauhinh_id,
        'tb_giangvien_detai.user_id'    =>$giangvien_id,
        'tb_detai.chuyennganh'          =>$chuyennganh_id
        );
        $this->db->select('*');
        $this->db->from('tb_detai');
        $this->db->join('tb_giangvien_detai','tb_giangvien_detai.detai_id = tb_detai.id');
        $this->db->where($data);
        $query=$this->db->get();
        $rowcount = $query->num_rows();
        return array('result'    =>$query->result(),'row_count'    =>$rowcount);
    }
    /*-----------------Chi tiết đề tài ----------------*/
    public function get_chi_tiet_de_tai($id_detai)
    {
        $this->db->select('tendetai,muctieu,tb_detai.yeucau,sanpham,chuthich,tb_detai.soluongSVtoida,timebatdaubaove,timeketthucbaove,TenCN,tenloai,tenTT,duocdkkhaccn,TenNK,NamBD,NamKT,truongnhom,chuyennganh,loaidetai,trangthai');
        //$this->db->select('*');
        $this->db->from('tb_detai');
        $this->db->join('tb_chuyennganh','tb_chuyennganh.id=tb_detai.chuyennganh');
        $this->db->join('tb_loaidetai','tb_detai.loaidetai = tb_loaidetai.id');
        $this->db->join('tb_trangthai','tb_detai.trangthai = tb_trangthai.id');
        $this->db->join('tb_cauhinh','tb_cauhinh.id = tb_detai.cauhinh_id');
        $this->db->join('tb_nienkhoa','tb_nienkhoa.id = tb_cauhinh.nienkhoa');
        $this->db->where('tb_detai.id',$id_detai);
        $query = $this->db->get();
        return $query->row();
    }
    public function get_diem_detai($id_detai)
    {
        $this->db->from('tb_sinhvien_detai');
        $this->db->where('detai_id',$id_detai);
        $query = $this->db->get();
        if ($query->num_rows()>0)
        {
            return $query->row()->diem;
        }
        else return NULL;
    }
    public function kt_detai_trong_danhsach($detai_id)
    {
        $this->db->from('tb_detai');
        $this->db->where('id',$detai_id);
        $count = $this->db->count_all_results();
        if ($count==1)
        {
            return true;
        }
        else return false;
    }
    public function count_thanh_vien($id_detai)
    {
        $this->db->select('*');
        $this->db->from('tb_sinhvien_detai');
        $this->db->where('detai_id',$id_detai);
        return $this->db->count_all_results();
    }
    public function get_ten_truong_nhom($id_user)
    {
        $this->db->select('id,name,username');
        $this->db->from('tb_users');
        $this->db->where('id',$id_user);
        $query=$this->db->get();
        return $query->row();
    }
    public function get_ten_thanh_vien($id_detai,$id_nhomtruong)
    {
        $data = array('tb_sinhvien_detai.detai_id' =>$id_detai,'tb_sinhvien_detai.user_id !='    =>$id_nhomtruong);
        $this->db->select('tb_users.id,tb_users.name,tb_users.username');
        $this->db->from('tb_detai');
        $this->db->join('tb_sinhvien_detai','tb_sinhvien_detai.detai_id=tb_detai.id');
        $this->db->join('tb_users','tb_users.id=tb_sinhvien_detai.user_id');
        $this->db->where($data);
        $query=$this->db->get();
        //return $query->row();
        return $query->result();
    }
    public function get_ten_giang_vien($id_detai)
    {
        $data = array ('tb_giangvien_detai.detai_id'    => $id_detai);
        $this->db->select('tb_users.id,tb_users.name,tb_users.username');
        $this->db->from('tb_giangvien_detai');
        $this->db->join('tb_users','tb_users.id=tb_giangvien_detai.user_id');
        $this->db->where($data);
        $query=$this->db->get();
        return $query->row();
    }
    public function get_ten_giang_vien_phan_bien($id_detai)
    {
        $data = array ('tb_phanbien_detai.detai_id'    => $id_detai);
        $this->db->select('tb_users.id,tb_users.name,tb_users.username');
        $this->db->from('tb_phanbien_detai');
        $this->db->join('tb_users','tb_users.id=tb_phanbien_detai.user_id');
        $this->db->where($data);
        $query=$this->db->get();
        return $query->row();
    }
    /*--------------------Lọc -------------------------------------*/
    public function get_giang_vien_chuyen_nganh($id_cn)
    {
        $data=array(
        'usertype'      =>'giangvien',
        'chuyennganh'   =>$id_cn
        );
        $this->db->select('tb_users.id,name,email,usertype,phone,chuyennganh,TenCN');
        $this->db->from('tb_users');
        $this->db->join('tb_chuyennganh','tb_users.chuyennganh=tb_chuyennganh.id');
        $this->db->where($data);
        $query=$this->db->get();
        $rowcount = $query->num_rows();
        return array('result'    =>$query->result(),'row_count'    =>$rowcount);
    }
    public function get_danh_sach_sinh_vien($per_pg,$offset)
    {
        $this->db->select('tb_users.id,name,email,usertype,phone,chuyennganh,TenCN,username');
        $this->db->from('tb_users');
        $this->db->join('tb_chuyennganh','tb_users.chuyennganh=tb_chuyennganh.id');
        $this->db->where('usertype','sinhvien');
        $this->db->limit($per_pg,$offset);
        $this->db->order_by('username','asc');
        $query=$this->db->get();
        return $query->result();
    }
    public function count_danh_sach_sinh_vien()
    {
        $this->db->select('id,usertype');
        $this->db->where('usertype','sinhvien');
        $this->db->from('tb_users');
        return $this->db->count_all_results();
    }
    public function get_sinh_vien_chuyen_nganh($id_cn,$per_pg,$offset)
    {
        $data=array(
        'usertype'      =>'sinhvien',
        'chuyennganh'   =>$id_cn
        );
        $this->db->select('tb_users.id,name,email,usertype,phone,chuyennganh,TenCN,username');
        $this->db->from('tb_users');
        $this->db->join('tb_chuyennganh','tb_users.chuyennganh=tb_chuyennganh.id');
        $this->db->where($data);
        $this->db->limit($per_pg,$offset);
        $this->db->order_by('username','asc');
        $query=$this->db->get();
        return $query->result();
    }
    public function count_sinh_vien_chuyen_nganh($id_cn)
    {
        $data=array(
        'usertype'      =>'sinhvien',
        'chuyennganh'   =>$id_cn
        );
        $this->db->select('tb_users.id');
        $this->db->from('tb_users');
        $this->db->join('tb_chuyennganh','tb_users.chuyennganh=tb_chuyennganh.id');
        $this->db->where($data);
        return $this->db->count_all_results();
    }
    public function get_sinh_vien_nien_khoa($id_cn,$id_nienkhoa,$per_pg,$offset)
    {
        if ($id_cn==-1)
        {
            $data=array(
            'usertype'      =>'sinhvien',
            'TenNK'         =>$id_nienkhoa
            );
        }
        else
        {
            $data=array(
            'usertype'      =>'sinhvien',
            'chuyennganh'   =>$id_cn,
            'TenNK'         =>$id_nienkhoa
            );
        }
        $this->db->distinct();
        $this->db->select("tb_users.id,name,email,usertype,phone,chuyennganh,TenCN,username,tb_users.lop,tb_lop.nienkhoa,tb_nienkhoa.id,TenNK");
        $this->db->from('tb_users');
        $this->db->join('tb_chuyennganh','tb_users.chuyennganh=tb_chuyennganh.id');
        $this->db->join('tb_lop','tb_users.lop=tb_lop.id');
        $this->db->join('tb_nienkhoa','tb_nienkhoa.id=tb_lop.nienkhoa');
        $this->db->where($data);
        $this->db->limit($per_pg,$offset);
        $this->db->order_by('username','asc');
        $query=$this->db->get();
        return $query->result();
    }
    public function count_sinh_vien_nien_khoa($id_cn,$id_nienkhoa)
    {
        if ($id_cn==-1)
        {
            $data=array(
            'usertype'      =>'sinhvien',
            'TenNK'         =>$id_nienkhoa
            );
        }
        else
        {
            $data=array(
            'usertype'      =>'sinhvien',
            'chuyennganh'   =>$id_cn,
            'TenNK'         =>$id_nienkhoa
            );
        }
        $this->db->distinct();
        $this->db->select("tb_users.id");
        $this->db->from('tb_users');
        $this->db->join('tb_chuyennganh','tb_users.chuyennganh=tb_chuyennganh.id');
        $this->db->join('tb_lop','tb_users.lop=tb_lop.id');
        $this->db->join('tb_nienkhoa','tb_nienkhoa.id=tb_lop.nienkhoa');
        $this->db->where($data);
        return $this->db->count_all_results();
    }
    public function get_danh_sach_giang_vien($per_pg,$offset)
    {
        $this->db->select('tb_users.id,name,email,avatar,usertype,phone,chuyennganh,TenCN');
        $this->db->from('tb_users');
        $this->db->join('tb_chuyennganh','tb_users.chuyennganh=tb_chuyennganh.id');
        $this->db->where('usertype','giangvien');
        $this->db->limit($per_pg,$offset);
        $query=$this->db->get();
        return $query->result();
    }
    public function count_danh_sach_giang_vien()
    {
        $this->db->select('id,usertype');
        $this->db->where('usertype','giangvien');
        $this->db->from('tb_users');
        return $this->db->count_all_results();
    }   
    /*=================Thống kê =====================*/
    public function count_detai_sinhvien_cauhinh($cauhinh_id,$CN_id)
    {
        $data = array(
            'cauhinh_id'    =>  $cauhinh_id,
            'chuyennganh'   =>  $CN_id
        );
        $this->db->select('user_id');
        $this->db->from('tb_sinhvien_cauhinh');
        $this->db->join('tb_users','tb_users.id = tb_sinhvien_cauhinh.user_id');
        $this->db->where($data);
        return $this->db->count_all_results();
    }
    public function count_detai_cauhinh($cauhinh_id,$CN_id)
    {
        $data = array(
            'cauhinh_id'    =>  $cauhinh_id,
            'chuyennganh'   =>  $CN_id
        );
        $this->db->select('id');
        $this->db->from('tb_detai');
        $this->db->where($data);
        return $this->db->count_all_results();
    }
    public function count_detai_truongnhom_cauhinh($cauhinh_id)
    {
        $data = array(
            'cauhinh_id'    =>  $cauhinh_id,
            'truongnhom !='    =>  'NULL'
        );
        $this->db->select('id');
        $this->db->from('tb_detai');
        $this->db->where($data);
        return $this->db->count_all_results();
    }
    public function get_all_giangvien()
    {
        $this->db->select('id,name');
        $this->db->from('tb_users');
        $this->db->where('usertype','giangvien');
        $query = $this->db->get();
        return $query->result();
    }
    public function count_giangvien_detai($giangvien_id,$cauhinh_id)
    {
        if ($giangvien_id == 0)
        {
            $data = array('cauhinh_id' =>  $cauhinh_id);
        }
        else
        {
            $data =array(
                'user_id'       =>  $giangvien_id,
                'cauhinh_id'    =>  $cauhinh_id,
            );
        }
        $this->db->select('user_id');
        $this->db->from('tb_giangvien_detai');
        $this->db->join('tb_detai','tb_detai.id = tb_giangvien_detai.detai_id');
        $this->db->where($data);
        return $this->db->count_all_results();
    }
    public function get_detai_cauhinh($cauhinh_id,$chuyennganh_id)
    {
        $data = array(
            'cauhinh_id'    =>  $cauhinh_id,
            'chuyennganh'   =>  $chuyennganh_id,
            'truongnhom !=' =>  'NULL' 
        );
        $this->db->select('id');
        $this->db->from('tb_detai');
        $this->db->where($data);
        $query=$this->db->get();
        return $query->result();
    }
}
?>