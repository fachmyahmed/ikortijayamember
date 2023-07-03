<?php 

class Member_model extends CI_Model {

    public function get_member($email, $password) {
        $is_active=1;
        $is_delete=0;
        $this->db->select('*');
        $this->db->from('member');
        $this->db->where('email', $email);
        $this->db->where('password', md5($password));
        $this->db->where('is_active', $is_active);
        $this->db->where('is_delete', $is_delete);
        $query = $this->db->get();
        return $query->row();
    }

    public function get_email($email) {
        $this->db->select('*');
        $this->db->from('member');
        $this->db->where('email', $email);
        $query = $this->db->get();
        return $query->row();
    }
    
}

?>