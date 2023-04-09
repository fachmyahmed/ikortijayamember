<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('member_model');
        $this->load->library('form_validation');

    }

    public function index()
    {
        $lang = $this->session->userdata('lang');
		$this->config->set_item('language', $lang);
		$data = GetHeaderFooter();
		$data['main_content'] = 'login';
		if($this->session->userdata('member')) {
			redirect(base_url());
		} else {
			$this->load->view('template',$data);
		}
    }

    
    public function profile()
    {
        $lang = $this->session->userdata('lang');
		$this->config->set_item('language', $lang);
		$data = GetHeaderFooterProfile();
		$data['main_content'] = 'profile';
		if($this->session->userdata('member')) {
            $data['userdata'] = (array)$this->session->userdata('member');
            $var = $data['userdata'];

            $data['datamember'] = $this->db->get_where('member', array('id' => $var['id']))->result()[0];
            // print_r($data['datamember']);
            // die();
			$this->load->view('templatemember',$data);
		} else {
			redirect(base_url().'member/login');
		}
    }

    public function process_login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('error_msg', 'Invalid email or password');
            redirect(base_url('login'));
        }
        else
        {
           
            $member = $this->member_model->get_member($email, $password);

            if($member)
            {
                $this->session->set_userdata('member', $member);
                redirect(base_url());
            }
            else
            {
                $this->session->set_flashdata('error', 'Invalid email or password');
                redirect(base_url().'member');
            }
        }
    }

    public function update_profile(){
        
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('error_msg', 'Invalid email or password');
            redirect(base_url('login'));
        }

        $data = array(
            'fullname' => $this->input->post('fullname'),
            'fullname_title' => $this->input->post('fullname_title'),
            'place_birth' => $this->input->post('place_birth'),
            'date_birth' => date("Y-m-d", strtotime($this->input->post('date_birth'))),
            'email' => $this->input->post('email'),
            'cb_phone' => $this->input->post('cb_phone'),
            'cb_phone2' => $this->input->post('cb_phone2'),
            'correspondence_address' => $this->input->post('correspondence_address'),
            'npa' => $this->input->post('npa'),
            'cb_pdgi' => $this->input->post('cb_pdgi'),
            'no_serkom' => $this->input->post('cb_pdgi'),
            'serkom_exp' => date("Y-m-d", strtotime($this->input->post('serkom_exp'))),
            'no_str' => $this->input->post('no_str'),
            'str_exp' => date("Y-m-d", strtotime($this->input->post('str_exp'))),
            'cb_pendidikan_s1' => $this->input->post('cb_pendidikan_s1'),
            'university_year' => $this->input->post('university_year'),
            'university_year_grad' => $this->input->post('university_year_grad'),
            'cb_pendidikan_sp' => $this->input->post('cb_pendidikan_sp'),
            'spc_year' => $this->input->post('spc_year'),
            'spc_year_grad' => $this->input->post('spc_year_grad'),
            'cb_alamat' => $this->input->post('cb_alamat'),
            'latlong1' => $this->input->post('latlong1'),
            'cb_praktek' => $this->input->post('cb_praktek'),
            'cb_alamat2' => $this->input->post('cb_alamat2'),
            'latlong2' => $this->input->post('latlong2'),
            'cb_praktek2' => $this->input->post('cb_praktek2'),
            'cb_alamat3' => $this->input->post('cb_alamat3'),
            'cb_praktek3' => $this->input->post('cb_praktek3'),
            'latlong3' => $this->input->post('latlong3'),
        );
        
        //File
		$flz = array("foto","serkom_file","str_file","file_univ_ijazah","file_spc_ijazah");
		foreach ($flz as $key) {
			$file_up = date("YmdHis") . "." . ($_FILES[$key]['name']);
			$myfile_up	= $_FILES[$key]['tmp_name'];
			$ukuranfile_up = $_FILES[$key]['size'];
            $loc='';
            if($key=='foto'){
                $loc='foto';
            }
            elseif($key=='serkom_file'){
                $loc='serkom';
            }
            elseif($key=='str_file'){
                $loc='str';
            }
            elseif($key=='file_univ_ijazah'){
                $loc='ijazah';
            }
            elseif($key=='file_spc_ijazah'){
                $loc='spc_ijazah';
            }
			$up_file = "./uploads/".$loc."/". $file_up;
			if ($_FILES[$key]['name']) {
				//unlink("../uploads/".$file_up);
				if (copy($myfile_up, $up_file)) {
					$data[$key] = $file_up;
				}
			}
		}

        
        // print_r($data);
        // die();

        $this->db->where('id', $this->input->post('id'));
        $this->db->update('member', $data);
        // lastq();
        $this->session->set_flashdata("message", "Update Profil Sukses");
		redirect(site_url('member/profile'));

    }

    public function logout()
    {
        $this->session->sess_destroy();
        $this->session->set_flashdata('error_msg', 'Anda Telah Logout');
        redirect(base_url().'member');
    }


}
