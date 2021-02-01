<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Menu_mngmt_service extends MY_Controller {

		private $data = [];
		protected $session;
		public function __construct()
		{
			parent::__construct(); 
			$this->session = (object)get_userdata(USER);
			
			if(is_empty_object($this->session)){
				redirect(base_url().'dashboard/authentication', 'refresh');
			}

			$model_list = [
				'menu_mngmt/Menu_mngmt_model' => 'smodel'			
			];
			$this->load->model($model_list);

		}

		public function index()
		{
			echo 'error';
		}

		public function is_active(){
			$this->smodel->product_auth = $this->input->post('product_auth');
			$this->smodel->is_active = filter_var($this->input->post('is_active'), FILTER_VALIDATE_BOOLEAN);
			$this->smodel->is_active();
		}

		

		
		
	}
?>
