<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Order_menu_service extends MY_Controller {

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
				'order_menu/Order_menu_model' => 'omodel'			
			];
			$this->load->model($model_list);
			// redirect(base_url().'dashboard', 'refresh');
		}

		public function index()
		{
			echo 'error';
		}


		public function by_category(){
			$this->omodel->category_id = $this->input->post('category_id');
			
			$response = $this->omodel->by_category();

			echo json_encode($response);
		}


		public function employee(){
			
			$this->omodel->emply_no = $this->input->post('employee_no');
			$data = $this->omodel->employee();

			echo json_encode($data);
	
		}

		public function orderlist(){
			$data = $this->input->post('orderlist');

			$this->omodel->orderlist = (json_decode($data));
			$this->omodel->emply_no = $this->input->post('employee_no');
			$data = $this->omodel->orderlist();

			echo json_encode($data);

		}



		
		
	}
?>
