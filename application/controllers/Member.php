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

    public function forgotpass()
    {
        // nonaktifin dulu
        // redirect(base_url('member'));
        // 
        $lang = $this->session->userdata('lang');
        $this->config->set_item('language', $lang);
        $data = GetHeaderFooter();
        $data['main_content'] = 'forgotpass';
        $data['captcha_image'] = $this->captcha_image();
        if ($this->session->userdata('member')) {
            redirect(base_url());
        } else {
            $this->load->view('template', $data);
        }
    }

    public function reset_password()
    {
        $email = $this->input->post('email');

        // Generate a unique token
        $token = bin2hex(random_bytes(32));

        // Set the token expiration time (e.g., 1 hour from now)
        $token_expires_at = date('Y-m-d H:i:s', strtotime('+1 hour'));

        // Save the token and its expiration time in the database for the user
        $this->db->where('email', $email);
        $this->db->update('kg_member', ['reset_token' => $token, 'reset_token_expires_at' => $token_expires_at]);

        // send email
        $configmail = [
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'protocol'  => 'smtp',
            'smtp_host' => 'mail.ikortijaya.org',
            'smtp_user' => 'events@ikortijaya.org',
            'smtp_pass' => 'FYfiMhErl8bt',
            'smtp_crypto' => 'ssl',
            'smtp_port'   => 465,
            'crlf'    => "\r\n",
            'newline' => "\r\n",
            'wordwrap' => TRUE,
        ];
        $this->load->library('email', $configmail);
        $this->email->from('admin@ikortijaya.org', 'Admin IKORTIJAYA  - No Reply');
        $this->email->to($email);
        $this->email->subject('Password Reset - IKORTIJAYA');
        $this->email->message('Klik link berikut untuk me-reset password anda: ' . site_url('member/reset_password_form/' . $token));

        if ($this->email->send()) {
            $this->session->set_flashdata("message", "Request Reset Password berhasil, silakan cek email anda.");
            redirect(base_url('member/member'));
        } else {
            $this->session->set_flashdata("error_msg", "Request Reset Password gagal.");
            redirect(base_url('member/forgotpass'));
        }
    }

    public function reset_password_form($token)
    {
        // Check if the token is valid and not expired
        $lang = $this->session->userdata('lang');
        $user = $this->db->get_where('kg_member', ['reset_token' => $token])->row();
        $data = GetHeaderFooter();
        $data['main_content'] = 'resetpassform';
        $data['captcha_image'] = $this->captcha_image();

        if ($user && strtotime($user->reset_token_expires_at) > time()) {
            // Display the password reset form with the token
            $data['token'] = $token;
            $this->load->view('template', $data);
        } else {
            $this->session->set_flashdata("message", "Token salah atau expired.");
            redirect($_SERVER['REQUEST_URI'], 'refresh');
        }
    }

    public function update_password() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('repeat_password', 'Password Confirmation', 'required|matches[password]');

        
        $token = $this->input->post('token');
        $password = $this->input->post('password');

        if ($this->form_validation->run() == FALSE) {
            // Form validation failed, reload the registration form with errors
            $this->session->set_flashdata("error_msg", "Pasword Tidak Cocok atau Kurang");
             redirect(base_url('member/reset_password_form/'.$token));
        }

        $data = array(
            'reset_token' => null, 
            'reset_token_expires_at' => null,
            'middlename' => $password,
            'password' => md5($password)
        );

        // Update the user's password in the database
        $this->db->where('reset_token', $token);
        $this->db->update('kg_member',$data);
        
        $this->session->set_flashdata("message", "Password berhasil direset. Silakan login.");
        redirect(base_url('member'));
    }

    public function register()
    {
        // nonaktifin dulu
        // redirect(base_url('member'));
        // 
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

            if ($this->captcha_check($captcha) == FALSE) {
                $this->session->set_flashdata("message", "Captcha salah");
                redirect(base_url('member/register'));
            }

            //  print_r($data);
            //  die();

            // Perform registration process, e.g., save data to the database
            $this->db->like('email', $email);
            $this->db->from('member');
            $emailexist = $this->db->count_all_results();

            if ($emailexist < 1) {
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



    public function change_pass()
    {
        $lang = $this->session->userdata('lang');
        $this->config->set_item('language', $lang);
        $data = GetHeaderFooterProfile();
        $data['main_content'] = 'changepass';
        if ($this->session->userdata('member')) {
            $data['userdata'] = (array)$this->session->userdata('member');
            $var = $data['userdata'];

            $data['datamember'] = $this->db->get_where('member', array('id' => $var['id']))->result()[0];
            // print_r($data['datamember']);
            // die();
            $this->load->view('templatemember', $data);
        } else {
            redirect(base_url('member'));
        }
    }

    public function process_change_pass()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $newpass = $this->input->post('newpass');
        $repeatnewpass = $this->input->post('repeatnewpass');

        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        $this->form_validation->set_rules('newpass', 'New Password', 'required|min_length[6]');
        $this->form_validation->set_rules('repeatnewpass', 'Confirm Password', 'required|matches[newpass]');


        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error_msg', 'Please Check Input Form');
            redirect(base_url() . 'member/change_pass');
        } else {

            $member = $this->member_model->get_member($email, $password);

            if ($member) {
                $data = array(
                    'password' => md5($this->input->post('newpass')),
                    'middlename' => $this->input->post('newpass'),
                );
                $this->db->where('email', $this->input->post('email'));
                $this->db->update('member', $data);
                $this->session->set_flashdata('message', 'Password Changed');

                redirect(base_url() . 'member/change_pass');
            } else {
                $this->session->set_flashdata('error_msg', 'Invalid Password');
                redirect(base_url() . 'member/change_pass');
            }
        }
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
                $this->session->set_flashdata('error_msg', 'Invalid email,password or membership is not active');
                redirect(base_url() . 'member');
            }
        }
    }

    public function update_profile()
    {

        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error_msg', 'Invalid email or password');
            redirect(base_url('member'));
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
        $flz = array("foto", "serkom_file", "str_file", "file_univ_ijazah", "file_spc_ijazah", "bukti_bayar");
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
            } elseif ($key == 'bukti_bayar') {
                $loc = 'payment_proof';

                // send email
                $configmail = [
                    'mailtype'  => 'html',
                    'charset'   => 'utf-8',
                    'protocol'  => 'smtp',
                    'smtp_host' => 'mail.ikortijaya.org',
                    'smtp_user' => 'events@ikortijaya.org',
                    'smtp_pass' => 'FYfiMhErl8bt',
                    'smtp_crypto' => 'ssl',
                    'smtp_port'   => 465,
                    'crlf'    => "\r\n",
                    'newline' => "\r\n",
                    'wordwrap' => TRUE,
                ];
                $this->load->library('email', $configmail);
                $this->email->from('admin@ikortijaya.org', 'Pembayaran Iuran IKORTIJAYA  - No Reply');
                $this->email->to($this->input->post('email'));
                $this->email->subject('Pembayaran Iuran IKORTIJAYA  - No Reply');
                $this->email->message('Yth. Rekan Sejawat,<br>
                <br>
                <br>
                Terima kasih atas pembayaran iuran keanggotaan Ikatan Ortodontis Indonesia Pengurus Wilayah Jakarta Raya (IKORTI Pengwil Jaya) periode 2022-2025 <br>
                <br>
                <br>
                Harap menunggu verifikasi selanjutnya untuk informasi mengenai status pembayaran iuran keanggotaan.<br>
                <br>
                <br>
                Terima kasih,<br>
                Pengurus IKORTI Pengwil Jaya <br>
                WA	: (+62) 812 9245 292 <br>
                Email	: admin@ikortijaya.org');

                if ($myfile_up) {
                    $this->email->send();
                    // email sent
                } else {
                    // email gagal
                }
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
