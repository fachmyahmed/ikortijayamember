<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Events extends CI_Controller
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

	public function register($event_id)
	{
		if ($event_id) {
			$lang = $this->session->userdata('lang');
			$this->config->set_item('language', $lang);
			$data = GetHeaderFooter();

			$data['captcha_image'] = $this->captcha_image();
			$data['event_id'] = $event_id;
			$data['main_content'] = 'event_register';
			$data['event_detail'] = GetAll("event", array("id" => "where/" . $event_id))->result()[0];
			if ($this->session->userdata('member')) {
				$data['userdata'] = (array)$this->session->userdata('member');
				$this->load->view('template', $data);
			} else {
				redirect(base_url());
			}
		} else {
			redirect(base_url());
		}
	}

	public function test_mail(){
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
			'wordwrap'=> TRUE,
        ];
		$this->load->library('email',$configmail);

		$this->email->from('events@ikortijaya.org', 'Event Registration - No Reply');
		$this->email->to('fachmy.ahmed@gmail.com');

		$this->email->subject('Testt ci3');
		$this->email->message('Ini tes');

		if ($this->email->send()) {
			echo 'Email sent successfully.';
		} else {
			echo 'Email sending failed.';
		}

		
	}

	public function register_process()
	{
		$id_event = $this->input->post('id_event');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', 'Invalid email or password');
			redirect(base_url('events/register/'.$id_event));
        }

		if ($this->session->userdata('member')) {
			$data['userdata'] = (array)$this->session->userdata('member');
			$var = $data['userdata'];

			$data['datamember'] = $this->db->get_where('member', array('id' => $var['id']))->result()[0];
		} else {
			redirect(base_url());
		}
		// echo $data['datamember']->id;
		// die();

		$id_event = $this->input->post('id_event');
		$email = $this->input->post('email');
		$fullname = $this->input->post('fullname');
		$npa = $this->input->post('npa');
		$cb_phone = $this->input->post('cb_phone');
		$captcha = $this->input->post('captcha');
		$tgl_trf = $this->input->post('tgl_trf');
		$nama_bank = $this->input->post('nama_bank');
		$pemilik_rek = $this->input->post('pemilik_rek');
		$nomor_rek = $this->input->post('nomor_rek');

		$data = array(
			'id_event' => $id_event,
			'id_member' => $data['datamember']->id,
			'email' => $email,
			'fullname' => $fullname,
			'npa' => $npa,
			'cb_phone' => $cb_phone,
			'tgl_trf' => $tgl_trf,
			'nama_bank' => $nama_bank,
			'pemilik_rek' => $pemilik_rek,
			'nomor_rek' => $nomor_rek,
		);

		 //File
		 $flz = array("payment_proof");
		 foreach ($flz as $key) {
			 $file_up = date("YmdHis") . "." . ($_FILES[$key]['name']);
			 $myfile_up    = $_FILES[$key]['tmp_name'];
			 $ukuranfile_up = $_FILES[$key]['size'];
			 $loc = '';
			 if ($key == 'payment_proof') {
				 $loc = 'payment_proof';
			 } 
			 $up_file = "./uploads/" . $loc . "/" . $file_up;

			 $fileSizeLimit = 5 * 1024 * 1024; // 5MB
			if ($_FILES[$key]['size'] <= $fileSizeLimit) {
				// Proceed with file upload and processing
				if ($_FILES[$key]['name']) {
					//unlink("../uploads/".$file_up);
					if (copy($myfile_up, $up_file)) {
						$data[$key] = $file_up;
					}
				}

			} else {
				// File size exceeds the limit, handle the error
				$this->session->set_flashdata('message', 'ukuran file tidak boleh melebihi 5MB');
				redirect(base_url('events/register/'.$id_event));
			}

			 
		 }
 
		if($file_up){
			$data['status'] = 1;
			$statuspembayaran = "Bukti pembayaran diterima - Menunggu konfirmasi pembayaran";
		} else {
			$data['status'] = 0;
			$statuspembayaran = "Menunggu bukti pembayaran";
		}

		if ($this->captcha_check($captcha) == FALSE) {
			$this->session->set_flashdata("message", "Captcha salah");
			redirect(base_url('event/register/'.$id_event));
		}

		// Perform registration process, e.g., save data to the database
		$this->db->like('email', $email);
		$this->db->from('event_register');
		$emailexist = $this->db->count_all_results();

		if ($emailexist < 1) {
			$this->db->insert('event_register', $data);
			$this->session->set_flashdata("message", "Selamat, anda telah terdaftar pada event ini. Silakan cek email anda atau kunjungi profile untuk mengetahui status pendaftaran anda.");

			// send mail
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
				'wordwrap'=> TRUE,
			];
			$this->load->library('email',$configmail);

			$this->email->from('events@ikortijaya.org', 'Event Registration');
			$this->email->to($email);
	
			// Fetch event detail
			$event = GetAll("event", array("id" => "where/" . $id_event))->result()[0];

			$this->email->subject('Registration '.$event->title);
			$message = 'Hi, '.$var['fullname_title'];
			$message .= '<br>';
			$message .= 'Anda telah mendaftar pada event'.$event->title;
			$message .= '<br>';
			$message .= '<br>';
			$message .= 'Status pembayaran anda <br><b>'.$statuspembayaran.'</b>';
			$this->email->message($message);

			if ($this->email->send()) {
				// email sent
			} else {
				// email gagal
			}

			redirect(base_url('events/register/'.$id_event));
		} else {
			$this->session->set_flashdata("message", "Email telah terdaftar pada event ini. Silakan cek email anda atau kunjungi profile untuk mengetahui status pendaftaran anda.");
			redirect(base_url('events/register/'.$id_event));
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
}
