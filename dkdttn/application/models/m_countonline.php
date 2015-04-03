<?php
class M_countonline extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function count_all_sess_id_ci()
    {
        $data = array();
        $expiration = time()-360; // 6 phut
        $this->db->query("DELETE FROM ci_sessions WHERE last_activity < ".$expiration); 
        $this->db->from('ci_sessions');
        $query=$this->db->get();
        $rowcount = $query->num_rows();
        return array('result'    =>$query->result(),'count'    =>$rowcount);
    }
    public function count_all_sess()
    {
        $this->db->from('tb_session');
        return $this->db->count_all_results();
    }
    public function get_info_sess($session_id)
    {
        $this->db->from('tb_session');
        $this->db->where('session_id',$session_id);
        $query = $this->db->get();
        return $query->row();
    }
    public function delete_cur_sess($sess_id)
    {
        $this->delete_exp_sess();
        $this->db->where('session_id',$sess_id);
        $this->db->delete('tb_session');
    }
    public function delete_exp_sess()
    {
        $expiration = time()-300; // 5 phut
        $this->db->query("DELETE FROM tb_session WHERE time < ".$expiration); 
    }
    public function them_moi_session($data)
    {
        $this->db->insert('tb_session',$data);
    }
    public function update_sess_guest($sess_id,$last_activity)
    {
        $data = array('time'    =>$last_activity);
        $this->db->where('session_id',$sess_id);
        $this->db->update('tb_session',$data);
    }
    public function kt_tontai_sess($sesion_id)
    {
        //$this->delete_exp_sess();
        $this->db->select('*');
        $this->db->from('tb_session');
        $this->db->where('session_id',$sesion_id);
        $count = $this->db->count_all_results();
        if ($count == 0)
        {
            return 0;
        }
        else 
        {
            return 1;
        }
    }
    public function kt_tontai_ip($ip)
    {
        $this->delete_exp_sess();
        //$this->db->select('session_id');
        $this->db->from('tb_session');
        $this->db->where('data',$ip);
        $count = $this->db->count_all_results();
        if ($count == 0)
        {
            return 0;
        }
        else return 1;
    }
}
?>