<?php 

class Member_model extends CI_Model {

    public function get_member($email, $password) {
        $this->db->select('*');
        $this->db->from('member');
        $this->db->where('email', $email);
        $this->db->where('password', md5($password));
        $query = $this->db->get();
        return $query->row();
    }
    
}

?>