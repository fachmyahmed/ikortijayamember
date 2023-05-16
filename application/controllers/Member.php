<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Member extends CI_Controller
{

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
        if ($this->session->userdata('member')) {
            redirect(base_url());
        } else {
            $this->load->view('template', $data);
        }
    }

    public function register()
    {
        $lang = $this->session->userdata('lang');
        $this->config->set_item('language', $lang);
        $data = GetHeaderFooter();
        $data['main_content'] = 'register';
        $data['captcha_image'] = $this->captcha_image();
        if ($this->session->userdata('member')) {
            redirect(base_url());
        } else {
            $this->load->view('template', $data);
        }
    }

    public function register_process()
    {
        $this->load->library('form_validation');
        $this->load->library('session');

        // Set form validation rules
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('fullname', 'Full Name', 'required');
        $this->form_validation->set_rules('fullname_title', 'Full Name with Title', 'required');
        $this->form_validation->set_rules('npa', 'NPA', 'required');
        $this->form_validation->set_rules('cb_phone', 'Phone Number', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('password_confirmation', 'Password Confirmation', 'required|matches[password]');
        $this->form_validation->set_rules('captcha', 'Captcha', 'required');

        if ($this->form_validation->run() == FALSE) {
            // Form validation failed, reload the registration form with errors
            $this->session->set_flashdata("error", "cek kembali data anda");
            redirect(base_url('member/register'));
        } else {
            // Form validation succeeded, proceed with registration logic
            $email = $this->input->post('email');
            $fullname = $this->input->post('fullname');
            $fullname_title = $this->input->post('fullname_title');
            $npa = $this->input->post('npa');
            $cb_phone = $this->input->post('cb_phone');
            $gender = $this->input->post('gender');
            $password = $this->input->post('password');
            $captcha = $this->input->post('captcha');

             $data = array(
                'email' => $email,
                'fullname' => $fullname,
                'fullname_title' => $fullname_title,
                'npa' => $npa,
                'gender' => $gender,
                'cb_phone' => $cb_phone,
                'password' => md5($password)
             );

            if($this->captcha_check($captcha)==FALSE){
                $this->session->set_flashdata("message", "Captcha salah");
                redirect(base_url('member/register'));
            }

            //  print_r($data);
            //  die();

            // Perform registration process, e.g., save data to the database
            $this->db->like('email', $email);
            $this->db->from('member');
            $emailexist = $this->db->count_all_results();
        
            if($emailexist<1){
                $this->db->insert('member', $data);
                $this->session->set_flashdata("message", "Selamat, anda telah terdaftar. Silakan login menggunakan akun anda");
                redirect(base_url('member'));
            } else {
                $this->session->set_flashdata("message", "Email telah terdaftar");
                redirect(base_url('member/register'));
            }

        }
    }

    public function captcha_check($str)
    {
        if ($str != $this->session->userdata('captcha_word')) {
            $this->form_validation->set_message('captcha_check', 'The {field} does not match the captcha image.');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function captcha_image()
    {
        $this->load->helper('captcha');

        $config = array(
            'img_path'      => './assets/images/captcha/',
            'img_url'       => base_url('assets/images/captcha/'),
            // 'font_path'     => './path/to/font.ttf',
            'img_width'     => '150',
            'img_height'    => '50',
            'word_length'   => 6,
            'font_size'     => 16,
            'expiration'    => 3600,
            'colors'        => array(
                'background' => array(255, 255, 255),
                'border' => array(0, 0, 0),
                'text' => array(0, 0, 0),
                'grid' => array(255, 255, 255)
        )
        );

        $captcha = create_captcha($config);
        $this->session->set_userdata('captcha_word', $captcha['word']);

        return $captcha['image'];
    }



    public function profile()
    {
        $lang = $this->session->userdata('lang');
        $this->config->set_item('language', $lang);
        $data = GetHeaderFooterProfile();
        $data['main_content'] = 'profile';
        if ($this->session->userdata('member')) {
            $data['userdata'] = (array)$this->session->userdata('member');
            $var = $data['userdata'];

            $data['datamember'] = $this->db->get_where('member', array('id' => $var['id']))->result()[0];
            // print_r($data['datamember']);
            // die();
            $this->load->view('templatemember', $data);
        } else {
            redirect(base_url() . 'member/login');
        }
    }


    public function process_login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error_msg', 'Invalid email or password');
            redirect(base_url('login'));
        } else {

            $member = $this->member_model->get_member($email, $password);

            if ($member) {
                $this->session->set_userdata('member', $member);
                redirect(base_url());
            } else {
                $this->session->set_flashdata('error', 'Invalid email or password');
                redirect(base_url() . 'member');
            }
        }
    }

    public function update_profile()
    {

        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        if ($this->form_validation->run() == FALSE) {
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
        $flz = array("foto", "serkom_file", "str_file", "file_univ_ijazah", "file_spc_ijazah");
        foreach ($flz as $key) {
            $file_up = date("YmdHis") . "." . ($_FILES[$key]['name']);
            $myfile_up    = $_FILES[$key]['tmp_name'];
            $ukuranfile_up = $_FILES[$key]['size'];
            $loc = '';
            if ($key == 'foto') {
                $loc = 'foto';
            } elseif ($key == 'serkom_file') {
                $loc = 'serkom';
            } elseif ($key == 'str_file') {
                $loc = 'str';
            } elseif ($key == 'file_univ_ijazah') {
                $loc = 'ijazah';
            } elseif ($key == 'file_spc_ijazah') {
                $loc = 'spc_ijazah';
            }
            $up_file = "./uploads/" . $loc . "/" . $file_up;
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
        $this->session->set_flashdata('message', 'Anda Telah Logout');
        redirect(base_url() . 'member');
    }
}
