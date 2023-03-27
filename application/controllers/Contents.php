<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Contents extends CI_Controller
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
		redirect(base_url());
	}

    public function pages($content=null)
	{
		$lang = $this->session->userdata('lang');
		$this->config->set_item('language', $lang);
		$data = GetHeaderFooter();
		$data['jenis_konten'] = $content;
		$data['main_content'] = 'konten';
        $this->db->from('contents');
        $this->db->where('link',$content);
        $result=$this->db->get()->result()[0];
        if(empty($result)){
            // no records to display
            redirect(base_url());
        } 
        

		$data['konten'] = $result;
       
		if ($this->session->userdata('member')) {
			$this->load->view('template',$data);
		} else {
			redirect(base_url().'member');
		}
	}
}
