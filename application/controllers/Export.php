<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Export extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('excel');
    }

    public function index()
    {
        // Dummy data
        $data = array(
            array('Name', 'Email', 'Phone'),
            array('John Doe', 'john@example.com', '1234567890'),
            array('Jane Smith', 'jane@example.com', '9876543210')
        );

        $this->excel->export($data, 'export_data');
    }
}