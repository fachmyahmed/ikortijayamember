<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	
	public function __construct()
    {

        parent::__construct();
		$this->load->library('session');

    }
	public function index()
	{
		$lang = $this->session->userdata('lang');
		$this->config->set_item('language', $lang);
		$data = GetHeaderFooter();
		$data['main_content'] = 'main';


		$data['hero'] = $this->db->get_where('banner', array('id' => 1), 1)->result()[0];
		$data['welcome'] = $this->db->get_where('banner', array('id' => 2), 1)->result()[0];
		$data['orange_tagline'] = $this->db->get_where('banner', array('id' => 3), 1)->result()[0];
		$data['mid_tagline'] = $this->db->get_where('banner', array('id' => 4), 1)->result()[0];
		$data['mid_left_content'] = $this->db->get_where('banner', array('id' => 5), 1)->result()[0];
		$data['mid_right_content'] = $this->db->get_where('banner', array('id' => 6), 1)->result()[0];
		$data['mid_bottom_content'] = $this->db->get_where('banner', array('id' => 7), 1)->result()[0];
		$data['join_us'] = $this->db->get_where('banner', array('id' => 8), 1)->result()[0];
		$data['ort_join'] = $this->db->get_where('banner', array('id' => 9), 1)->result()[0];

		$this->db->from('news');
		$this->db->where('id_news_cat', 3);
		$this->db->order_by("create_date", "desc");
		$this->db->limit(6);

		$data['blog'] = $this->db->get(); 

		if ($this->session->userdata('member')) {
			$this->load->view('template',$data);
		} else {
			redirect(base_url().'member');
		}		
	}
}
