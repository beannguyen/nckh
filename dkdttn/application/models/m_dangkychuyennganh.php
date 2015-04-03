<?php
class M_dangkychuyennganh extends CI_Model{
    public function __construct(){
        parent::__construct();
    }
    public function get_ketqua_dangky($user_id)
    {
        $data = array (
        'user_id ='    => $user_id
        
        );
        $this->db->select('*');
        $this->db->from('tb_sinhvien_dk_chuyennganh');
        $this->db->where($data);
		$this->db->order_by("nguyenvong", "asc");
        $query = $this->db->get();
		//return $this->db;
        return $query->result_array();
    }
	public function set_ketqua_dangky($user_id, $cn1, $cn2)
	{
		$result = $this->get_ketqua_dangky($user_id);
		if (count($result) > 0)	{
			$data =array('user_id'  =>$user_id);
			$this->db->where($data);
			$this->db->delete('tb_sinhvien_dk_chuyennganh');
		}
		
		$data1 = array ('user_id'    =>$user_id,
                            'nguyenvong'   =>1,
                            'chuyennganh'    =>$cn1
                            );
        $this->db->insert('tb_sinhvien_dk_chuyennganh',$data1);
		$data2 = array ('user_id'    =>$user_id,
                            'nguyenvong'   =>2,
                            'chuyennganh'    =>$cn2
                            );
        $this->db->insert('tb_sinhvien_dk_chuyennganh',$data2);
		
	}
    public function get_nienkhoa()
    {
        $this->db->order_by("TenNK","asc");
        $query = $this->db->get('tb_nienkhoa');
        return $query->result();
    }
	public function them_cauhinh($data)
	{
		$data1 = array('delete' => 1);
		$this->db->where($data1);
		$this->db->delete('tb_cauhinh_dk_chuyennganh');
		
		$this->db->insert('tb_cauhinh_dk_chuyennganh',$data);
	}
	public function get_cauhinh()
	{
		$data = array (
        'delete ='    => 1
        
        );
        $this->db->select('*');
        $this->db->from('tb_cauhinh_dk_chuyennganh');
        $this->db->where($data);
		
        $query = $this->db->get();
		//return $this->db;
        return $query->result_array();
	}
	public function get_ds_sinhvien()
	{
		$query = "select u.username,u.name,dkcn.nguyenvong,dkcn.TenCN,u.diem,u.TongTC from 
          (select svcn.user_id, svcn.nguyenvong, cn.TenCN from tb_chuyennganh as cn 
                 INNER JOIN tb_sinhvien_dk_chuyennganh as svcn 
                 ON cn.id = svcn.chuyennganh)
          as dkcn
            RIGHT JOIN 
              (select u.id,u.username,u.name,u.diem,u.TongTC from tb_users as u 
                       INNER JOIN (select lop.id as lopid from tb_cauhinh_dk_chuyennganh as ch 
                                   INNER JOIN tb_lop as lop ON ch.nienkhoa = lop.nienkhoa) as lopnk 
                                   ON u.lop = lopnk.lopid ) as u 
                       ON u.id = dkcn.user_id  ORDER BY u.username,dkcn.nguyenvong";
					   
		
		$runquery = $this->db->query($query) ;
		return $runquery->result_array();
		
	}
}
?>