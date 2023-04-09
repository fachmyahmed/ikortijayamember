<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ajax extends CI_Controller
{


	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
        public function index()
        {

        }

        public function alamat_praktek()
        {
            $searchTerm = $this->input->post('term');
            // $this->db->select('cb_praktek');
            // $this->db->like('cb_praktek', $searchTerm);
            // $this->db->group_by("cb_praktek");
            // $query = $this->db->get('member');

            $this->db->select('cb_praktek');
            $this->db->like('cb_praktek', $searchTerm);
            $this->db->from('member');
            $query1 = $this->db->get_compiled_select();
            
            $this->db->select('cb_praktek2 AS cb_praktek');
            $this->db->like('cb_praktek2', $searchTerm);
            $this->db->from('member');
            $query2 = $this->db->get_compiled_select();

            $this->db->select('cb_praktek3 AS cb_praktek');
            $this->db->like('cb_praktek3', $searchTerm);
            $this->db->from('member');
            $query3 = $this->db->get_compiled_select();

            $query = $this->db->query($query1 . ' UNION ' . $query2 . ' UNION ' . $query3);
            $data =  $query->result_array();
            // echo $this->db->last_query();
            echo json_encode($data);
        }

        public function get_latlong1()
        {
            $searchTerm = $this->input->post('term');
            $this->db->select('latlong1');
            $this->db->where('cb_praktek', $searchTerm);
            $this->db->group_by("cb_praktek");
            $query = $this->db->get('member');

            $data =  $query->result_array();
            echo json_encode($data);
        }
    }
