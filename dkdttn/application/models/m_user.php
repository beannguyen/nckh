<?php
class M_user extends CI_Model{
    public function __construct(){
        parent::__construct();
        
    }
    /*-----------------------------Quan tri tai khoan ----------------------------------*/
    public function get_info_user($user)
    {
        $this->db->select('tb_users.id,name,username,password,usertype,email,phone,chuyennganh,TenCN,tb_users.avatar');
        $this->db->from('tb_users');
        $this->db->join('tb_chuyennganh','tb_chuyennganh.id=tb_users.chuyennganh');
        $this->db->where('username',$user);
        $this->db->or_where('email',$user);
        $this->db->or_where('tb_users.id',$user);
        $query=$this->db->get();
        return $query->row();
    }
    public function get_lop_sinhvien($mssv)
    {
        $this->db->select('TenLop');
        $this->db->from('tb_users');
        $this->db->join('tb_lop','tb_lop.id=tb_users.lop');
        $this->db->where('tb_users.username',$mssv);
        $this->db->or_where('tb_users.id',$mssv);
        $query=$this->db->get();
        return $query->row();
    }
    public function kt_dangnhap($user,$pass_nhapvao)
    {
        $info = $this->get_info_user($user);
        if (empty($info))
        {
            return 0;
        }
        else
        {
            $dbpassword = $info->password;
            $hashparts = explode (':' , $dbpassword);
            $userhash = md5("$pass_nhapvao".$hashparts[1]);
            if ($userhash === $hashparts[0])
            {
                $this->update_lastvisit($user);
                return 1;
            }
            else
            {
                return 0;
            }
        }
    }
    public function update_lastvisit($username)
    {
        $now = date('Y-m-d H:i:s');
        $this->db->where('username',$username);
        $this->db->update('tb_users',array("lastvisitDate"  => $now));        
    }
    public function doimatkhau($username,$crypted_new_pass)
    {
        $data=array(
            'password'       =>$crypted_new_pass
        );
        $this->db->where('username',$username);
        $this->db->update('tb_users',$data);
    }
    public function doi_thong_tin_ca_nhan($username,$data)
    {
        $this->db->where('username',$username);
        $this->db->update('tb_users',$data);
    }
    public function doi_avatar($username,$img)
    {
        $data = array('avatar'  =>  $img);
        $this->db->where('username',$username);
        $this->db->update('tb_users',$data);
    }

    
    /*-----------------------Get danh sách sinh viên gi?ng viên -------------------------------*/
     
    public function get_chuyen_nganh()
    {
        $query=$this->db->get('tb_chuyennganh');
        return $query->result();
    }
    public function get_nien_khoa()
    {
        $this->db->order_by('TenNK asc');
        $query=$this->db->get('tb_nienkhoa');
        return $query->result();
    }

}
?>