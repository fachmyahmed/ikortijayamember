<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Blog extends CI_Controller
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
	public function index($page=null)
	{
		$this->load->helper('url');
		redirect(base_url().'blog/page/1', 'refresh');
	}

	public function page($page=null)
	{
		$this->load->library('pagination');
		$lang = $this->session->userdata('lang');
		$this->config->set_item('language', $lang);
		$data = GetHeaderFooter();
		$data['main_content'] = 'blogview';



		$this->db->from('news');
		$this->db->where('id_news_cat', 3);
		$this->db->order_by("create_date", "desc");
		$numrow = $this->db->get()->num_rows();

		$this->db->where('id_news_cat', 3);
		$this->db->order_by("create_date", "desc");

		$config['base_url'] = base_url().'blog/page/';
		$config['total_rows']=$numrow;
		$config['per_page'] = 3;
		$this->pagination->initialize($config);

		$data['blog'] = $this->db->get('news',$config['per_page'], $this->uri->segment(3));
		// echo $config['per_page']."<br>";
		// echo $this->db->last_query();
		// die();
		$this->load->view('template', $data);
	}

	public function read($slug = NULL)
	{
		$lang = $this->session->userdata('lang');
		$this->config->set_item('language', $lang);
		$data = GetHeaderFooter();
		$data['main_content'] = 'blogread';

		$data['blog_detail'] = $this->db->get_where('news', array('slug' => $slug))->result()[0];
		$this->load->view('template', $data);
	}
}
