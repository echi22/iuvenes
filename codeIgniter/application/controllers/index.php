<?php
class Index extends CI_Controller {
        
        public function __construct()
	{
		parent::__construct();
                $this->load->library('parser');
                $this->load->helper('form');
	}
        function index(){
            $this->load->view('index_view');
        }
}
?>
