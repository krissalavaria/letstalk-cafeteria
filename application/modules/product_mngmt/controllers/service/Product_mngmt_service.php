<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Product_mngmt_service extends MY_Controller {

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
				'product_mngmt/Product_mngmt_model' => 'pmodel'			
			];
			$this->load->model($model_list);

		}

		public function index()
		{
			echo 'error';
		}

		public function save_product(){

			$this->pmodel->product_name = $this->input->post('product-name');
			$this->pmodel->product_unit_id = $this->input->post('product_unit');
			$this->pmodel->product_category_id = $this->input->post('product_category');
			$this->pmodel->price = $this->input->post('product_retail_price');
			$this->pmodel->datetime_created = date('Y-m-d H:i:s');

			$response = $this->pmodel->save_product();
			
			echo json_encode($response);

		}

		public function update_product(){

			$this->pmodel->prod_auth = $this->input->post('product-auth');
			$this->pmodel->product_name = $this->input->post('product-name');
			$this->pmodel->product_unit_id = $this->input->post('product_unit');
			$this->pmodel->product_category_id = $this->input->post('product_category');
			$this->pmodel->price = $this->input->post('product_retail_price');
			$this->pmodel->datetime_last_update = date('Y-m-d H:i:s');

			$response = $this->pmodel->update_product();
			
			echo json_encode($response);

		}

		
		
	}
?>
