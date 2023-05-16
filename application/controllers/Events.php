<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Events extends CI_Controller {

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

    public function register($event_id=null)
    {
        $lang = $this->session->userdata('lang');
		$this->config->set_item('language', $lang);
		$data = GetHeaderFooter();
		$data['main_content'] = 'register';
		if($this->session->userdata('member')) {
			redirect(base_url());
		} else {
			$this->load->view('template',$data);
		}
    
    }
}
